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
        $perluVerifikasi  = PermohonanSurat::where(function ($q) {
                $q->whereDoesntHave('approval')
                  ->orWhereHas('approval', function ($q2) { $q2->where('status', 'pending'); });
            })->count();
        $suratKeluar      = Approval::where('status', 'disetujui')->count();
        $suratHariIni     = PermohonanSurat::whereDate('tanggal_pengajuan', today())->count();

        $beritaTerbaru = Berita::orderBy('tanggal_publish', 'desc')->take(6)->get();

        $permohonanTerbaru = PermohonanSurat::with(['user', 'jenisSurat', 'approval'])
            ->latest('tanggal_pengajuan')
            ->take(6)
            ->get();

        // Bulan & tahun terakhir yang punya data permohonan — untuk default dropdown
        $lastPermohonan = PermohonanSurat::latest('tanggal_pengajuan')->first();
        $defaultBulan   = $lastPermohonan
            ? (int) \Carbon\Carbon::parse($lastPermohonan->tanggal_pengajuan)->format('m')
            : now()->month;
        $defaultTahun   = $lastPermohonan
            ? (int) \Carbon\Carbon::parse($lastPermohonan->tanggal_pengajuan)->format('Y')
            : now()->year;

        return view('Admin.dashboard', compact(
            'totalWarga',
            'perluVerifikasi',
            'suratKeluar',
            'suratHariIni',
            'beritaTerbaru',
            'permohonanTerbaru',
            'defaultBulan',
            'defaultTahun'
        ));
    }

    public function stats()
    {
        $totalWarga      = User::count();
        $perluVerifikasi = PermohonanSurat::where(function ($q) {
            $q->whereDoesntHave('approval')
              ->orWhereHas('approval', fn($q2) => $q2->where('status', 'pending'));
        })->count();
        $suratKeluar  = Approval::where('status', 'disetujui')->count();
        $suratHariIni = PermohonanSurat::whereDate('tanggal_pengajuan', today())->count();

        // 6 permohonan terbaru untuk tabel aktivitas
        $permohonanTerbaru = PermohonanSurat::with(['user', 'jenisSurat', 'approval'])
            ->latest('tanggal_pengajuan')->take(6)->get()
            ->map(fn($p) => [
                'id'           => $p->id_permohonan,
                'nama'         => $p->nama_pemohon ?? $p->user->nama ?? '-',
                'jenis_surat'  => $p->jenisSurat->nama_surat ?? '-',
                'tanggal'      => \Carbon\Carbon::parse($p->tanggal_pengajuan)->diffForHumans(),
                'status'       => optional($p->approval)->status ?? 'pending',
                'url'          => route('permohonan.show', $p->id_permohonan),
            ]);

        return response()->json([
            'total_warga'      => number_format($totalWarga),
            'perlu_verifikasi' => number_format($perluVerifikasi),
            'perlu_verifikasi_raw' => $perluVerifikasi,
            'surat_keluar'     => number_format($suratKeluar),
            'surat_hari_ini'   => number_format($suratHariIni),
            'surat_hari_ini_raw' => (int) $suratHariIni,
            'permohonan_terbaru' => $permohonanTerbaru,
        ]);
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
                    'status'       => strtolower(optional($p->approval)->status ?? 'pending'),
                ];
            });

        return response()->json([
            'data'        => $data->values(),
            'total'       => $data->count(),
            'disetujui'   => $data->whereIn('status', ['disetujui','siap_diambil','selesai'])->count(),
            'ditolak'     => $data->where('status', 'ditolak')->count(),
            'pending'     => $data->whereIn('status', ['pending','diproses'])->count(),
        ]);
    }
}