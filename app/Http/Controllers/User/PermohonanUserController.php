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
    /**
     * Mapping slug ke ID jenis surat di database
     */
    private array $slugMap = [
        'sktm'        => 1,
        'kematian'    => 2,
        'suami-istri' => 3,
        'beda-nama'   => 4,
        'izin-cuti'   => 5,
    ];

    /**
     * Mapping slug ke nama view form
     */
    private array $viewMap = [
        'sktm'        => 'User.permohonan.form_sktm',
        'kematian'    => 'User.permohonan.form_kematian',
        'suami-istri' => 'User.permohonan.form_suami_istri',
        'beda-nama'   => 'User.permohonan.form_beda_nama',
        'izin-cuti'   => 'User.permohonan.form_izin_cuti',
    ];

    // =========================================================
    // DAFTAR PERMOHONAN MILIK USER
    // =========================================================
    public function index()
    {
        $data = PermohonanSurat::with(['jenisSurat', 'approval'])
            ->where('id_user', Auth::id())
            ->latest('tanggal_pengajuan')
            ->get();

        return view('User.permohonan.index', compact('data'));
    }

    // =========================================================
    // TAMPILKAN FORM BERDASARKAN SLUG
    // =========================================================
    public function form(string $slug)
    {
        // Surat bawaan → form khusus masing-masing
        if (array_key_exists($slug, $this->viewMap)) {
            return view($this->viewMap[$slug]);
        }

        // Surat custom Opsi D → form template dinamis
        $jenisSurat = \App\Models\JenisSurat::where('slug', $slug)
            ->where('is_custom', true)
            ->firstOrFail();

        return view('User.permohonan.form_template', compact('jenisSurat'));
    }

    // =========================================================
    // SIMPAN PERMOHONAN (SEMUA JENIS)
    // =========================================================
    public function storeSurat(Request $request, string $slug)
    {
        // Surat custom Opsi D
        if (!array_key_exists($slug, $this->slugMap)) {
            $jenisSurat = \App\Models\JenisSurat::where('slug', $slug)
                ->where('is_custom', true)
                ->firstOrFail();
            return $this->storeSuratTemplate($request, $jenisSurat);
        }

        // Validasi dasar semua surat
        $rules = [
            'jenis_pengajuan' => 'required|in:sendiri,orang_lain',
            'nama_pemohon'    => 'required|string|max:255',
            'nik_pemohon'     => 'required|string|size:16',
            'tempat_lahir'    => 'required|string|max:100',
            'tanggal_lahir'   => 'required|date',
            'jenis_kelamin'   => 'required|in:Laki-Laki,Perempuan',
            'alamat_pemohon'  => 'required|string|max:500',
            'dokumen_ktp'     => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'dokumen_kk'      => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ];

        $messages = [
            'nama_pemohon.required'  => 'Nama pemohon wajib diisi.',
            'nik_pemohon.required'   => 'NIK wajib diisi.',
            'nik_pemohon.size'       => 'NIK harus 16 digit.',
            'tempat_lahir.required'  => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'alamat_pemohon.required'=> 'Alamat wajib diisi.',
            'dokumen_ktp.required'   => 'KTP wajib diunggah.',
            'dokumen_ktp.mimes'      => 'Format KTP harus JPG, PNG, atau PDF.',
            'dokumen_ktp.max'        => 'Ukuran KTP maksimal 10MB.',
            'dokumen_kk.required'    => 'Kartu Keluarga wajib diunggah.',
            'dokumen_kk.mimes'       => 'Format KK harus JPG, PNG, atau PDF.',
            'dokumen_kk.max'         => 'Ukuran KK maksimal 10MB.',
        ];

        // Validasi tambahan per jenis surat
        $extraRules    = [];
        $extraMessages = [];

        switch ($slug) {
            case 'sktm':
                $extraRules = ['keperluan_sktm' => 'required|string'];
                $extraMessages = ['keperluan_sktm.required' => 'Tujuan SKTM wajib dipilih.'];
                break;

            case 'kematian':
                $extraRules = [
                    'hari_meninggal'    => 'required|string',
                    'tanggal_meninggal' => 'required|date',
                    'sebab_meninggal'   => 'required|string|max:255',
                ];
                $extraMessages = [
                    'hari_meninggal.required'    => 'Hari meninggal wajib dipilih.',
                    'tanggal_meninggal.required' => 'Tanggal meninggal wajib diisi.',
                    'sebab_meninggal.required'   => 'Sebab meninggal wajib diisi.',
                ];
                break;

            case 'suami-istri':
                $extraRules = [
                    'nama_istri'    => 'required|string|max:255',
                    'ttl_istri'     => 'required|string|max:100',
                    'tahun_menikah' => 'required|digits:4',
                ];
                $extraMessages = [
                    'nama_istri.required'    => 'Nama istri wajib diisi.',
                    'ttl_istri.required'     => 'Tempat/tanggal lahir istri wajib diisi.',
                    'tahun_menikah.required' => 'Tahun menikah wajib diisi.',
                    'tahun_menikah.digits'   => 'Tahun menikah harus 4 digit.',
                ];
                break;

            case 'beda-nama':
                $extraRules = [
                    'nama_dokumen_1'   => 'required|string|max:255',
                    'nama_dokumen_2'   => 'required|string|max:255',
                    'jenis_dokumen_2'  => 'required|string',
                    'keperluan'        => 'required|string|max:500',
                ];
                $extraMessages = [
                    'nama_dokumen_1.required'  => 'Nama di KTP wajib diisi.',
                    'nama_dokumen_2.required'  => 'Nama di dokumen lain wajib diisi.',
                    'jenis_dokumen_2.required' => 'Jenis dokumen pembanding wajib dipilih.',
                    'keperluan.required'       => 'Keperluan surat wajib diisi.',
                ];
                break;

            case 'izin-cuti':
                $extraRules = [
                    'nama_perusahaan'     => 'required|string|max:255',
                    'tanggal_mulai_cuti'  => 'required|date',
                    'tanggal_selesai_cuti'=> 'required|date|after_or_equal:tanggal_mulai_cuti',
                    'keperluan'           => 'required|string|max:500',
                ];
                $extraMessages = [
                    'nama_perusahaan.required'       => 'Nama perusahaan/instansi wajib diisi.',
                    'tanggal_mulai_cuti.required'    => 'Tanggal mulai cuti wajib diisi.',
                    'tanggal_selesai_cuti.required'  => 'Tanggal selesai cuti wajib diisi.',
                    'tanggal_selesai_cuti.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.',
                    'keperluan.required'             => 'Keperluan cuti wajib diisi.',
                ];
                break;
        }

        $request->validate(
            array_merge($rules, $extraRules),
            array_merge($messages, $extraMessages)
        );

        // ── Susun keperluan teks ──────────────────────────────
        $keperluan = match ($slug) {
            'sktm'        => $request->keperluan_sktm . ($request->keterangan_tambahan ? ' — ' . $request->keterangan_tambahan : ''),
            'kematian'    => $request->keperluan ?? '',
            'suami-istri' => $request->keperluan ?? '',
            'beda-nama'   => $request->keperluan ?? '',
            'izin-cuti'   => $request->keperluan ?? '',
            default       => $request->keperluan ?? '',
        };

        // ── Susun data_tambahan (JSON) ──────────────────────────
        $dataTambahan = match ($slug) {
            'sktm' => [
                'jenis'              => 'sktm',
                'tempat_lahir'       => $request->tempat_lahir,
                'tanggal_lahir'      => $request->tanggal_lahir,
                'jenis_kelamin'      => $request->jenis_kelamin,
                'agama'              => $request->agama,
                'status_kawin'       => $request->status_kawin,
                'pekerjaan'          => $request->pekerjaan,
                'rt'                 => $request->rt,
                'rw'                 => $request->rw,
                'keperluan_sktm'     => $request->keperluan_sktm,
                'keterangan_tambahan'=> $request->keterangan_tambahan,
            ],
            'kematian' => [
                'jenis'              => 'kematian',
                'tempat_lahir'       => $request->tempat_lahir,
                'tanggal_lahir'      => $request->tanggal_lahir,
                'jenis_kelamin'      => $request->jenis_kelamin,
                'agama'              => $request->agama,
                'status_kawin'       => $request->status_kawin,
                'pekerjaan'          => $request->pekerjaan,
                'umur'               => $request->umur,
                'hari_meninggal'     => $request->hari_meninggal,
                'tanggal_meninggal'  => $request->tanggal_meninggal,
                'tempat_meninggal'   => $request->tempat_meninggal,
                'sebab_meninggal'    => $request->sebab_meninggal,
                'rt'                 => $request->rt,
                'rw'                 => $request->rw,
            ],
            'suami-istri' => [
                'jenis'          => 'suami-istri',
                'tempat_lahir'   => $request->tempat_lahir,
                'tanggal_lahir'  => $request->tanggal_lahir,
                'jenis_kelamin'  => $request->jenis_kelamin,
                'agama'          => $request->agama,
                'status_kawin'   => 'Kawin',
                'pekerjaan'      => $request->pekerjaan,
                'rt'             => $request->rt,
                'rw'             => $request->rw,
                'nama_istri'     => $request->nama_istri,
                'nik_istri'      => $request->nik_istri,
                'ttl_istri'      => $request->ttl_istri,
                'agama_istri'    => $request->agama_istri,
                'pekerjaan_istri'=> $request->pekerjaan_istri,
                'alamat_istri'   => $request->alamat_istri,
                'tahun_menikah'  => $request->tahun_menikah,
            ],
            'beda-nama' => [
                'jenis'            => 'beda-nama',
                'tempat_lahir'     => $request->tempat_lahir,
                'tanggal_lahir'    => $request->tanggal_lahir,
                'jenis_kelamin'    => $request->jenis_kelamin,
                'agama'            => $request->agama,
                'status_kawin'     => $request->status_kawin,
                'pekerjaan'        => $request->pekerjaan,
                'rt'               => $request->rt,
                'rw'               => $request->rw,
                'nama_dokumen_1'   => $request->nama_dokumen_1,
                'nama_dokumen_2'   => $request->nama_dokumen_2,
                'jenis_dokumen_2'  => $request->jenis_dokumen_2,
            ],
            'izin-cuti' => [
                'jenis'                => 'izin-cuti',
                'tempat_lahir'         => $request->tempat_lahir,
                'tanggal_lahir'        => $request->tanggal_lahir,
                'jenis_kelamin'        => $request->jenis_kelamin,
                'agama'                => $request->agama,
                'status_kawin'         => $request->status_kawin,
                'pekerjaan'            => $request->pekerjaan,
                'rt'                   => $request->rt,
                'rw'                   => $request->rw,
                'nama_perusahaan'      => $request->nama_perusahaan,
                'lama_cuti'            => $request->lama_cuti,
                'tanggal_mulai_cuti'   => $request->tanggal_mulai_cuti,
                'tanggal_selesai_cuti' => $request->tanggal_selesai_cuti,
            ],
            default => [],
        };

        // ── Simpan permohonan ────────────────────────────────────
        $permohonan = PermohonanSurat::create([
            'id_user'           => Auth::id(),
            'id_jenis_surat'    => $this->slugMap[$slug],
            'nama_pemohon'      => $request->nama_pemohon,
            'nik_pemohon'       => $request->nik_pemohon,
            'alamat_pemohon'    => $request->alamat_pemohon,
            'keperluan'         => $keperluan,
            'data_tambahan'     => $dataTambahan,   // cast 'array' di model handle encode otomatis
            'tanggal_pengajuan' => now(),
        ]);

        // ── Simpan dokumen KTP ──────────────────────────────────
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

        // ── Simpan dokumen KK ───────────────────────────────────
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

        return redirect()
            ->route('user.permohonan.index')
            ->with('success', 'Permohonan berhasil dikirim! Silakan tunggu konfirmasi dari admin kelurahan.');
    }

    // =========================================================
    // DETAIL PERMOHONAN
    // =========================================================
    public function show($id)
    {
        $permohonan = PermohonanSurat::with(['jenisSurat', 'approval', 'persyaratan'])
            ->where('id_user', Auth::id())
            ->findOrFail($id);

        return view('User.permohonan.show', compact('permohonan'));
    }

    // =========================================================
    // HAPUS PERMOHONAN (hanya jika masih pending)
    // =========================================================
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

    // =========================================================
    // SIMPAN SURAT TEMPLATE OPSI D (custom jenis surat)
    // =========================================================
    private function storeSuratTemplate(Request $request, \App\Models\JenisSurat $jenisSurat)
    {
        $fieldConfig = is_array($jenisSurat->field_config)
            ? $jenisSurat->field_config
            : (json_decode($jenisSurat->field_config, true) ?? []);

        $rules = [
            'nama_pemohon'   => 'required|string|max:255',
            'nik_pemohon'    => 'required|string|size:16',
            'tempat_lahir'   => 'required|string|max:100',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:Laki-Laki,Perempuan',
            'alamat_pemohon' => 'required|string|max:500',
            'keperluan'      => 'required|string|max:500',
            'dokumen_ktp'    => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'dokumen_kk'     => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ];

        foreach ($fieldConfig as $field) {
            if (!empty($field['required'])) {
                $rules['field_' . $field['key']] = 'required';
            }
        }

        $request->validate($rules);

        $dataTambahan = [
            'jenis'         => $jenisSurat->slug,
            'template'      => $jenisSurat->template,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'status_kawin'  => $request->status_kawin,
            'pekerjaan'     => $request->pekerjaan,
            'rt'            => $request->rt,
            'rw'            => $request->rw,
        ];

        foreach ($fieldConfig as $field) {
            $dataTambahan[$field['key']] = $request->input('field_' . $field['key']);
        }

        $permohonan = PermohonanSurat::create([
            'id_user'           => Auth::id(),
            'id_jenis_surat'    => $jenisSurat->id_jenis_surat,
            'nama_pemohon'      => $request->nama_pemohon,
            'nik_pemohon'       => $request->nik_pemohon,
            'alamat_pemohon'    => $request->alamat_pemohon,
            'keperluan'         => $request->keperluan,
            'data_tambahan'     => $dataTambahan,
            'tanggal_pengajuan' => now(),
        ]);

        foreach (['dokumen_ktp' => 'ktp', 'dokumen_kk' => 'kk'] as $inputName => $jenisDok) {
            if ($request->hasFile($inputName) && $request->file($inputName)->isValid()) {
                $file = $request->file($inputName);
                Persyaratan::create([
                    'id_permohonan' => $permohonan->id_permohonan,
                    'nama_file'     => $file->getClientOriginalName(),
                    'jenis_dokumen' => $jenisDok,
                    'path_file'     => $file->store('persyaratan', 'public'),
                    'uploaded_at'   => now(),
                ]);
            }
        }

        return redirect()
            ->route('user.permohonan.index')
            ->with('success', 'Permohonan berhasil dikirim! Silakan tunggu konfirmasi dari admin kelurahan.');
    }
}