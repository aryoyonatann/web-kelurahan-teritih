<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanSurat;
use App\Models\Approval;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermohonanController extends Controller
{
    public function stats()
    {
        $data = PermohonanSurat::with(['user', 'jenisSurat', 'approval', 'persyaratan'])
            ->latest('tanggal_pengajuan')->get();

        $rows = $data->map(function ($d) {
            $approvalStatus = optional($d->approval)->status;
            $rowStatus      = $approvalStatus ?? 'pending';
            $namaPemohon    = $d->nama_pemohon ?? optional($d->user)->nama ?? '-';
            $nikPemohon     = $d->nik_pemohon  ?? optional($d->user)->nik  ?? '-';
            $isWakil        = $d->isPerwakilan();

            $statusLabel = match($rowStatus) {
                'disetujui'    => 'Disetujui',
                'ditolak'      => 'Ditolak',
                'siap_diambil' => 'Siap Diambil',
                'selesai'      => 'Selesai',
                'cancelled'    => 'Dibatalkan',
                default        => 'Pending',
            };

            $persyaratan = $d->persyaratan->map(fn($p) => [
                'nama' => $p->nama_file,
                'url'  => asset('storage/' . $p->path_file),
                'ext'  => strtolower(pathinfo($p->nama_file, PATHINFO_EXTENSION)),
                'tgl'  => $p->uploaded_at ? \Carbon\Carbon::parse($p->uploaded_at)->format('d M Y, H:i') : '-',
            ])->values();

            return [
                'id'           => $d->id_permohonan,
                'nama'         => $namaPemohon,
                'nik'          => $nikPemohon,
                'jenis_surat'  => $d->jenisSurat->nama_surat ?? '-',
                'tanggal'      => \Carbon\Carbon::parse($d->tanggal_pengajuan)->format('d M Y'),
                'status'       => $rowStatus,
                'status_label' => $statusLabel,
                'is_wakil'     => $isWakil,
                'nama_user'    => optional($d->user)->nama ?? '-',
                'url'          => route('permohonan.show', $d->id_permohonan),
                'url_print'    => route('permohonan.print', $d->id_permohonan),
                'no_hp'        => optional($d->user)->no_hp ?? '',
                'persyaratan'  => $persyaratan,
                'jenis_surat_nama' => $d->jenisSurat->nama_surat ?? '-',
            ];
        });

        return response()->json([
            'total'       => $data->count(),
            'pending'     => $data->filter(fn($d) => in_array(optional($d->approval)->status ?? 'pending', [null, 'pending']))->count(),
            'disetujui'   => $data->filter(fn($d) => optional($d->approval)->status === 'disetujui')->count(),
            'siap_diambil'=> $data->filter(fn($d) => optional($d->approval)->status === 'siap_diambil')->count(),
            'ditolak'     => $data->filter(fn($d) => optional($d->approval)->status === 'ditolak')->count(),
            'rows'        => $rows->values(),
        ]);
    }

    public function index()
    {
        $data = PermohonanSurat::with(['user', 'jenisSurat', 'approval', 'persyaratan'])
            ->latest('tanggal_pengajuan')
            ->get();

        return view('Admin.permohonan.index', compact('data'));
    }

    public function show($id)
    {
        $data = PermohonanSurat::with(['user', 'jenisSurat', 'approval', 'persyaratan'])
            ->findOrFail($id);

        return view('Admin.permohonan.show', compact('data'));
    }

    public function approve($id)
    {
        Approval::updateOrCreate(
            ['id_permohonan' => $id],
            [
                'id_admin'         => auth('admin')->id(),
                'status'           => Approval::STATUS_DISETUJUI,
                'tanggal_approval' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Permohonan berhasil disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string|max:1000',
        ]);

        Approval::updateOrCreate(
            ['id_permohonan' => $id],
            [
                'id_admin'         => auth('admin')->id(),
                'status'           => Approval::STATUS_DITOLAK,
                'tanggal_approval' => now(),
                'catatan'          => $request->input('catatan'),
            ]
        );

        return redirect()->back()->with('success', 'Permohonan berhasil ditolak.');
    }

    /**
     * Admin menandai surat sudah dicetak/ditandatangani dan siap diambil warga.
     * Hanya bisa dilakukan dari status 'disetujui'.
     */
    public function siapDiambil($id)
    {
        $approval = Approval::where('id_permohonan', $id)->firstOrFail();

        if ($approval->status !== Approval::STATUS_DISETUJUI) {
            return redirect()->back()->with('error', 'Hanya permohonan berstatus "Disetujui" yang bisa ditandai siap diambil.');
        }

        $approval->update([
            'status'               => Approval::STATUS_SIAP_DIAMBIL,
            'tanggal_siap_diambil' => now(),
        ]);

        return redirect()->back()->with('success', 'Permohonan ditandai Siap Diambil. Warga akan mendapat notifikasi.');
    }

    /**
     * Admin menandai surat sudah diambil warga (selesai).
     * Hanya bisa dilakukan dari status 'siap_diambil'.
     */
    public function selesai($id)
    {
        $approval = Approval::where('id_permohonan', $id)->firstOrFail();

        if ($approval->status !== Approval::STATUS_SIAP_DIAMBIL) {
            return redirect()->back()->with('error', 'Hanya permohonan berstatus "Siap Diambil" yang bisa ditandai selesai.');
        }

        $approval->update([
            'status'           => Approval::STATUS_SELESAI,
            'tanggal_selesai'  => now(),
        ]);

        return redirect()->back()->with('success', 'Permohonan selesai. Surat telah diambil warga.');
    }

    public function print($id)
    {
        $permohonan = PermohonanSurat::with(['user', 'jenisSurat', 'approval', 'persyaratan'])
            ->findOrFail($id);

        // Hanya permohonan yang sudah disetujui/siap diambil/selesai yang boleh dicetak
        $statusDiizinkan = [
            Approval::STATUS_DISETUJUI,
            Approval::STATUS_SIAP_DIAMBIL,
            Approval::STATUS_SELESAI,
        ];
        $approvalStatus = optional($permohonan->approval)->status;
        if (!$approvalStatus || !in_array($approvalStatus, $statusDiizinkan)) {
            return redirect()->back()->with('error', 'Surat hanya bisa dicetak setelah permohonan disetujui.');
        }

        $tahun = now()->year;

        // Jika permohonan sudah punya nomor surat di DB, pakai nomor tersebut
        if ($permohonan->nomor_surat) {
            $parts = explode(' / ', $permohonan->nomor_surat);
            $nomorUrut = (int) ($parts[1] ?? 1);
        } else {
            // Hitung nomor urut dengan locking untuk mencegah race condition
            $nomorUrut = DB::transaction(function () use ($permohonan, $tahun) {
                // lockForUpdate() mencegah dua proses membaca nilai yang sama bersamaan
                $nomorUrutTertinggi = PermohonanSurat::where('id_jenis_surat', $permohonan->id_jenis_surat)
                    ->whereYear('tanggal_pengajuan', $tahun)
                    ->whereNotNull('nomor_surat')
                    ->lockForUpdate()
                    ->get('nomor_surat')
                    ->map(function ($p) {
                        $parts = explode(' / ', $p->nomor_surat);
                        return isset($parts[1]) ? (int) trim($parts[1]) : 0;
                    })
                    ->max() ?? 0;

                return $nomorUrutTertinggi + 1;
            });
        }

        $bulanRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'][now()->month - 1];

        $nodeKeys = ['lurah','sekretaris','kasi-pemum','pelaksana','op-sanusi','op-hawari','kasi-pmk','op-hasan','kasi-trantibum','op-afif','op-jamaludin'];
        $pegawaiData = [];
        foreach ($nodeKeys as $key) {
            $pegawaiData[$key] = [
                'nama' => Pengaturan::getValue('pegawai_'.$key.'_nama', ''),
                'nip'  => Pengaturan::getValue('pegawai_'.$key.'_nip',  ''),
            ];
        }
        $namaLurah  = Pengaturan::getValue('nama_lurah', 'Jupran, SE, MM');
        $jabatLurah = Pengaturan::getValue('jabat_lurah', 'Kepala Kelurahan Teritih');

        return view('Admin.permohonan.print', compact('permohonan', 'nomorUrut', 'bulanRomawi', 'pegawaiData', 'namaLurah', 'jabatLurah'));
    }

    public function updateData(Request $request, $id)
    {
        $permohonan = PermohonanSurat::with('jenisSurat')->findOrFail($id);

        $request->validate([
            'nama_pemohon'   => 'required|string|max:255',
            'nik_pemohon'    => 'required|string|max:16',
            'alamat_pemohon' => 'required|string|max:500',
        ]);

        $permohonan->nama_pemohon   = $request->nama_pemohon;
        $permohonan->nik_pemohon    = $request->nik_pemohon;
        $permohonan->alamat_pemohon = $request->alamat_pemohon;
        $permohonan->keperluan      = $request->input('keperluan', $permohonan->keperluan);
        $permohonan->save();

        $dt = $permohonan->data_tambahan ?? [];

        $bioKeys = ['tempat_lahir','tanggal_lahir','jenis_kelamin','agama','status_kawin',
                    'kewarganegaraan','pekerjaan','pendidikan','kelurahan','kecamatan','no_hp','rt','rw','umur'];
        foreach ($bioKeys as $k) {
            if ($request->has($k)) $dt[$k] = $request->input($k);
        }

        $fc = is_array($permohonan->jenisSurat->fields_config)
            ? $permohonan->jenisSurat->fields_config
            : (json_decode($permohonan->jenisSurat->fields_config ?? '[]', true) ?? []);

        foreach (collect($fc)->where('group', 'extra')->where('type', '!=', 'section') as $ef) {
            if ($request->has('extra_' . $ef['key'])) {
                $dt[$ef['key']] = $request->input('extra_' . $ef['key']);
            }
        }

        $permohonan->update(['data_tambahan' => $dt]);

        return redirect()->back()->with('success', 'Data permohonan berhasil diperbarui.');
    }

    public function updateKeterangan(Request $request, $id)
    {
        $request->validate([
            'keterangan_admin' => 'nullable|string|max:1000',
            'nomor_surat'      => 'nullable|string|max:100',
        ]);

        $permohonan = PermohonanSurat::findOrFail($id);
        $permohonan->update(array_filter([
            'keterangan_admin' => $request->keterangan_admin,
            'nomor_surat'      => $request->nomor_surat,
        ], fn($v) => $v !== null));

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'Keterangan surat berhasil disimpan.');
    }
}
