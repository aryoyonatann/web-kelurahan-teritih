<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PermohonanSurat;
use App\Models\JenisSurat;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PermohonanUserController extends Controller
{
    private const MAX_DOKUMEN_PENDUKUNG = 3;

    private function dokumenRules(): array
    {
        return [
            'dokumen_ktp'         => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'dokumen_kk'          => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'dokumen_pendukung'   => 'nullable|array|max:' . self::MAX_DOKUMEN_PENDUKUNG,
            'dokumen_pendukung.*' => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
        ];
    }

    private function dokumenMessages(): array
    {
        return [
            'dokumen_ktp.required'        => 'KTP wajib diunggah.',
            'dokumen_ktp.mimes'           => 'Format KTP harus JPG, PNG, atau PDF.',
            'dokumen_ktp.max'             => 'Ukuran KTP maksimal 10MB.',
            'dokumen_kk.required'         => 'Kartu Keluarga wajib diunggah.',
            'dokumen_kk.mimes'            => 'Format KK harus JPG, PNG, atau PDF.',
            'dokumen_kk.max'              => 'Ukuran KK maksimal 10MB.',
            'dokumen_pendukung.max'       => 'Maksimal ' . self::MAX_DOKUMEN_PENDUKUNG . ' dokumen pendukung.',
            'dokumen_pendukung.*.mimes'   => 'Format dokumen pendukung harus JPG, PNG, atau PDF.',
            'dokumen_pendukung.*.max'     => 'Ukuran dokumen pendukung maksimal 10MB per file.',
        ];
    }

    private function simpanDokumen(Request $request, PermohonanSurat $permohonan): void
    {
        if ($request->hasFile('dokumen_ktp') && $request->file('dokumen_ktp')->isValid()) {
            $file = $request->file('dokumen_ktp');
            Persyaratan::create([
                'id_permohonan' => $permohonan->id_permohonan,
                'nama_file'     => $file->getClientOriginalName(),
                'jenis_dokumen' => 'ktp',
                'path_file'     => $file->store('persyaratan', 'public'),
                'uploaded_at'   => now(),
            ]);
        }

        if ($request->hasFile('dokumen_kk') && $request->file('dokumen_kk')->isValid()) {
            $file = $request->file('dokumen_kk');
            Persyaratan::create([
                'id_permohonan' => $permohonan->id_permohonan,
                'nama_file'     => $file->getClientOriginalName(),
                'jenis_dokumen' => 'kk',
                'path_file'     => $file->store('persyaratan', 'public'),
                'uploaded_at'   => now(),
            ]);
        }

        if ($request->hasFile('dokumen_pendukung')) {
            $files = $request->file('dokumen_pendukung');
            if (!is_array($files)) $files = [$files];
            $files = array_slice($files, 0, self::MAX_DOKUMEN_PENDUKUNG);
            foreach ($files as $i => $file) {
                if ($file && $file->isValid()) {
                    Persyaratan::create([
                        'id_permohonan' => $permohonan->id_permohonan,
                        'nama_file'     => $file->getClientOriginalName(),
                        'jenis_dokumen' => 'pendukung_' . ($i + 1),
                        'path_file'     => $file->store('persyaratan', 'public'),
                        'uploaded_at'   => now(),
                    ]);
                }
            }
        }
    }

    public function index()
    {
        $data = PermohonanSurat::with(['jenisSurat', 'approval'])
            ->where('id_user', Auth::id())
            ->latest('tanggal_pengajuan')
            ->get();

        return view('User.permohonan.index', compact('data'));
    }

    public function form(string $slug)
    {
        $jenisSurat = JenisSurat::where('slug', $slug)->where('aktif', true)->firstOrFail();

        return view('User.permohonan.form_template', compact('jenisSurat'));
    }

    public function storeSurat(Request $request, string $slug)
    {
        $jenisSurat = JenisSurat::where('slug', $slug)->where('aktif', true)->firstOrFail();

        return $this->storeSuratTemplate($request, $jenisSurat);
    }

    public function show($id)
    {
        $permohonan = PermohonanSurat::with(['jenisSurat', 'approval', 'persyaratan'])
            ->where('id_user', Auth::id())
            ->findOrFail($id);

        return view('User.permohonan.show', compact('permohonan'));
    }

    public function destroy($id)
    {
        $permohonan = PermohonanSurat::with(['approval', 'persyaratan'])
            ->where('id_user', Auth::id())
            ->findOrFail($id);

        if ($permohonan->approval && $permohonan->approval->status !== 'pending') {
            return redirect()
                ->route('user.permohonan.index')
                ->with('error', 'Permohonan yang sudah diproses tidak dapat dihapus.');
        }

        foreach ($permohonan->persyaratan as $dok) {
            Storage::disk('public')->delete($dok->path_file);
        }

        $permohonan->delete();

        return redirect()
            ->route('user.permohonan.index')
            ->with('success', 'Permohonan berhasil dihapus.');
    }

    private function storeSuratTemplate(Request $request, JenisSurat $jenisSurat)
    {
        $fieldsConfig = $jenisSurat->fields_config ?? [];
        $bioFields    = collect($fieldsConfig)->where('group', 'biodata')->pluck('key')->toArray();
        $suamiFields  = collect($fieldsConfig)->where('group', 'suami')->where('type', '!=', 'section')->values();
        $istriFields  = collect($fieldsConfig)->where('group', 'istri')->where('type', '!=', 'section')->values();
        $extraFields  = collect($fieldsConfig)->where('group', 'extra')->values();
        $isPasangan   = $suamiFields->count() > 0;

        // Build validation rules
        $rules = $this->dokumenRules();
        $rules['jenis_pengajuan'] = 'required|in:sendiri,orang_lain';

        if (!$isPasangan) {
            // Standard biodata validation
            if (in_array('nama', $bioFields))            $rules['nama_pemohon']   = 'required|string|max:255';
            if (in_array('nik', $bioFields))             $rules['nik_pemohon']    = 'required|string|size:16';
            if (in_array('tempat_tgl_lahir', $bioFields)){ $rules['tempat_lahir'] = 'required|string|max:100'; $rules['tanggal_lahir'] = 'required|date'; }
            if (in_array('jenis_kelamin', $bioFields))   $rules['jenis_kelamin']  = 'required|in:Laki-Laki,Perempuan';
            if (in_array('agama', $bioFields))           $rules['agama']          = 'required|string';
            if (in_array('pekerjaan', $bioFields))       $rules['pekerjaan']      = 'required|string|max:100';
            if (in_array('umur', $bioFields))            $rules['umur']           = 'required|integer|min:0|max:150';
            if (in_array('alamat', $bioFields))          $rules['alamat_pemohon'] = 'required|string|max:500';
        } else {
            // Pasangan fields — each field key already includes suffix
            foreach ($suamiFields->merge($istriFields) as $f) {
                if ($f['required'] ?? false) {
                    $rules[$f['key']] = match($f['type']) {
                        'ttl'    => null, // handled below
                        default  => 'required|string|max:500',
                    };
                    if ($f['type'] === 'ttl') {
                        $suffix = explode('_', $f['key']);
                        $suffix = end($suffix);
                        $rules['tempat_lahir_'.$suffix]  = 'required|string|max:100';
                        $rules['tanggal_lahir_'.$suffix] = 'required|date';
                        unset($rules[$f['key']]);
                    }
                }
            }
        }

        foreach ($extraFields as $ef) {
            if (($ef['required'] ?? false) && ($ef['type'] ?? '') !== 'section') {
                $rules['extra_'.$ef['key']] = 'required|string';
            }
        }

        $request->validate($rules, $this->dokumenMessages());

        // Build data_tambahan
        $dataTambahan = ['jenis' => $jenisSurat->slug, 'jenis_pengajuan' => $request->jenis_pengajuan];

        if (!$isPasangan) {
            if (in_array('tempat_tgl_lahir', $bioFields)) { $dataTambahan['tempat_lahir'] = $request->tempat_lahir; $dataTambahan['tanggal_lahir'] = $request->tanggal_lahir; }
            foreach (['jenis_kelamin','agama','status_kawin','kewarganegaraan','pekerjaan','pendidikan','kelurahan','kecamatan','no_hp','umur'] as $k) {
                if (in_array($k, $bioFields)) $dataTambahan[$k] = $request->input($k);
            }
            if (in_array('rt_rw', $bioFields)) { $dataTambahan['rt'] = $request->rt; $dataTambahan['rw'] = $request->rw; }
        } else {
            // Collect all pasangan fields directly from request
            foreach ($suamiFields->merge($istriFields) as $f) {
                if ($f['type'] === 'ttl') {
                    $suffix = explode('_', $f['key']); $suffix = end($suffix);
                    $dataTambahan['tempat_lahir_'.$suffix]  = $request->input('tempat_lahir_'.$suffix);
                    $dataTambahan['tanggal_lahir_'.$suffix] = $request->input('tanggal_lahir_'.$suffix);
                } else {
                    $dataTambahan[$f['key']] = $request->input($f['key']);
                }
            }
        }

        foreach ($extraFields as $ef) {
            if (($ef['type'] ?? '') === 'section') continue;
            $dataTambahan[$ef['key']] = $request->input('extra_'.$ef['key']);
        }

        // Gunakan nilai field center_bold pertama sebagai keperluan, fallback ke nama surat
        $cbField = $extraFields->firstWhere('print_style', 'center_bold');
        $keperluan = $cbField ? $request->input('extra_'.$cbField['key']) : $jenisSurat->nama_surat;

        // For pasangan: use suami name as nama_pemohon
        $namaPemohon = $isPasangan
            ? ($request->input('nama_suami') ?? Auth::user()->nama)
            : ($request->nama_pemohon ?? Auth::user()->nama);
        $nikPemohon = $isPasangan
            ? ($request->input('nik_suami') ?? Auth::user()->nik ?? '-')
            : ($request->nik_pemohon ?? Auth::user()->nik ?? '-');
        $alamatPemohon = $isPasangan
            ? ($request->input('alamat_suami') ?? Auth::user()->alamat ?? '-')
            : ($request->alamat_pemohon ?? Auth::user()->alamat ?? '-');

        $permohonan = PermohonanSurat::create([
            'id_user'           => Auth::id(),
            'id_jenis_surat'    => $jenisSurat->id_jenis_surat,
            'nama_pemohon'      => $namaPemohon,
            'nik_pemohon'       => $nikPemohon,
            'alamat_pemohon'    => $alamatPemohon,
            'keperluan'         => $keperluan,
            'data_tambahan'     => $dataTambahan,
            'tanggal_pengajuan' => now(),
        ]);

        $this->simpanDokumen($request, $permohonan);

        return redirect()
            ->route('user.permohonan.index')
            ->with('success', 'Permohonan berhasil dikirim! Silakan tunggu konfirmasi dari admin kelurahan.');
    }
}
