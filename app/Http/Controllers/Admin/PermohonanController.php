<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanSurat;
use App\Models\Approval;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function index()
    {
        $data = PermohonanSurat::with(['user', 'jenisSurat', 'approval', 'persyaratan'])
            ->latest('tanggal_pengajuan')
            ->get();

        return view('admin.permohonan.index', compact('data'));
    }

    public function show($id)
    {
        $data = PermohonanSurat::with(['user', 'jenisSurat', 'approval', 'persyaratan'])
            ->findOrFail($id);

        return view('admin.permohonan.show', compact('data'));
    }

    public function approve($id)
    {
        Approval::updateOrCreate(
            ['id_permohonan' => $id],
            [
                'id_admin'         => auth('admin')->id() ?? 1,
                'status'           => 'disetujui',
                'tanggal_approval' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Permohonan berhasil disetujui.');
    }

    public function reject($id)
    {
        Approval::updateOrCreate(
            ['id_permohonan' => $id],
            [
                'id_admin'         => auth('admin')->id() ?? 1,
                'status'           => 'ditolak',
                'tanggal_approval' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Permohonan berhasil ditolak.');
    }

    public function print($id)
    {
        $permohonan = PermohonanSurat::with(['user', 'jenisSurat', 'approval', 'persyaratan'])
            ->findOrFail($id);

        $tahun = now()->year;
        $nomorUrut = PermohonanSurat::where('id_jenis_surat', $permohonan->id_jenis_surat)
            ->whereYear('tanggal_pengajuan', $tahun)
            ->whereNotNull('nomor_surat')
            ->count() + 1;

        $bulanRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'][now()->month - 1];

        return view('admin.permohonan.print', compact('permohonan', 'nomorUrut', 'bulanRomawi'));
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

        \DB::table('permohonan_surat')
            ->where('id_permohonan', $permohonan->id_permohonan)
            ->update(['data_tambahan' => json_encode($dt)]);

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