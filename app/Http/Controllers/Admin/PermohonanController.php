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

    // ── Halaman cetak surat resmi ────────────────────────────────────
    public function print($id)
    {
        $permohonan = PermohonanSurat::with(['user', 'jenisSurat', 'approval', 'persyaratan'])
            ->findOrFail($id);

        return view('admin.permohonan.print', compact('permohonan'));
    }

    // ── Input keterangan & nomor surat oleh admin ────────────────────
    public function updateKeterangan(Request $request, $id)
    {
        $request->validate([
            'keterangan_admin' => 'nullable|string|max:1000',
            'nomor_surat'      => 'nullable|string|max:100',
        ]);

        $permohonan = PermohonanSurat::findOrFail($id);
        $permohonan->update([
            'keterangan_admin' => $request->keterangan_admin,
            'nomor_surat'      => $request->nomor_surat,
        ]);

        return redirect()->back()->with('success', 'Keterangan surat berhasil disimpan.');
    }
}