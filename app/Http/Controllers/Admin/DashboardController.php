<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\PermohonanSurat;
use App\Models\User;
use App\Models\Approval;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Stat cards
        $totalWarga       = User::count();
        $perluVerifikasi  = PermohonanSurat::whereDoesntHave('approval')
            ->orWhereHas('approval', fn($q) => $q->whereRaw('LOWER(status) = ?', ['pending']))
            ->count();
        $suratKeluar      = Approval::whereRaw('LOWER(status) = ?', ['disetujui'])->count();
        $suratHariIni     = PermohonanSurat::whereDate('tanggal_pengajuan', today())->count();

        $beritaTerbaru = Berita::orderBy('tanggal_publish', 'desc')->take(6)->get();

        $permohonanTerbaru = PermohonanSurat::with(['user', 'jenisSurat', 'approval'])
            ->latest('tanggal_pengajuan')
            ->take(6)
            ->get();

        return view('Admin.dashboard', compact(
            'totalWarga',
            'perluVerifikasi',
            'suratKeluar',
            'suratHariIni',
            'beritaTerbaru',
            'permohonanTerbaru'
        ));
    }

    public function permohonanBulan(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $data = PermohonanSurat::with(['user', 'jenisSurat', 'approval'])
            ->whereMonth('tanggal_pengajuan', $bulan)
            ->whereYear('tanggal_pengajuan', $tahun)
            ->latest('tanggal_pengajuan')
            ->get()
            ->map(function ($p) {
                return [
                    'nama_pemohon' => $p->nama_pemohon ?? $p->user->nama ?? '-',
                    'nik_pemohon'  => $p->nik_pemohon  ?? $p->user->nik  ?? '-',
                    'jenis_surat'  => $p->jenisSurat->nama_surat ?? '-',
                    'tanggal'      => \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d M Y'),
                    'status'       => strtolower($p->approval->status ?? 'pending'),
                ];
            });

        return response()->json([
            'data'      => $data->values(),
            'total'     => $data->count(),
            'disetujui' => $data->where('status', 'disetujui')->count(),
            'ditolak'   => $data->where('status', 'ditolak')->count(),
            'pending'   => $data->where('status', 'pending')->count(),
        ]);
    }
}