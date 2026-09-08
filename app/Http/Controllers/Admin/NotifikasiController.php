<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Approval;
use App\Models\PermohonanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    /**
     * Notifikasi untuk ADMIN:
     *   - Permohonan baru (pending / belum ada approval)
     *   - Permohonan sudah "siap_diambil" tapi belum "selesai" > 3 hari (reminder)
     */
    public function index(Request $request)
    {
        // 1) Permohonan pending (belum diproses admin)
        $pending = PermohonanSurat::with(['user', 'jenisSurat'])
            ->whereDoesntHave('approval')
            ->orWhereHas('approval', fn($q) => $q->whereRaw('LOWER(status) = ?', ['pending']))
            ->latest('tanggal_pengajuan')
            ->take(8)
            ->get();

        $notifsPending = $pending->map(function ($p) {
            return [
                'id'       => $p->id_permohonan,
                'type'     => 'permohonan',
                'icon'     => 'envelope-open',
                'color'    => 'blue',
                'title'    => 'Permohonan surat masuk',
                'message'  => ($p->user->nama ?? 'Warga') . ' mengajukan ' . ($p->jenisSurat->nama_surat ?? 'surat'),
                'time'     => $p->tanggal_pengajuan
                    ? \Carbon\Carbon::parse($p->tanggal_pengajuan)->diffForHumans()
                    : '-',
                'url'      => route('permohonan.show', $p->id_permohonan),
                'raw_time' => $p->tanggal_pengajuan,
            ];
        });

        // 2) Permohonan siap_diambil yang belum di-selesaikan lebih dari 3 hari (reminder)
        $siapLama = PermohonanSurat::with(['user', 'jenisSurat', 'approval'])
            ->whereHas('approval', fn($q) => $q->where('status', Approval::STATUS_SIAP_DIAMBIL)
                ->where('tanggal_siap_diambil', '<=', now()->subDays(3)))
            ->latest('tanggal_pengajuan')
            ->take(4)
            ->get();

        $notifsReminder = $siapLama->map(function ($p) {
            return [
                'id'       => $p->id_permohonan,
                'type'     => 'reminder',
                'icon'     => 'bell',
                'color'    => 'orange',
                'title'    => 'Surat belum diambil (3+ hari)',
                'message'  => ($p->user->nama ?? 'Warga') . ' — ' . ($p->jenisSurat->nama_surat ?? 'surat') . ' masih belum diambil',
                'time'     => $p->approval->tanggal_siap_diambil
                    ? \Carbon\Carbon::parse($p->approval->tanggal_siap_diambil)->diffForHumans()
                    : '-',
                'url'      => route('permohonan.show', $p->id_permohonan),
                'raw_time' => optional($p->approval)->tanggal_siap_diambil,
            ];
        });

        $notifs = $notifsReminder->merge($notifsPending)->values();

        return response()->json([
            'count' => $notifs->count(),
            'items' => $notifs,
        ]);
    }

    /**
     * Tandai semua notifikasi sebagai sudah dibaca (client-side only).
     */
    public function markRead()
    {
        return response()->json(['ok' => true]);
    }

    /**
     * Notifikasi untuk USER yang sedang login.
     * Mengembalikan daftar permohonan milik user yang statusnya 'siap_diambil'.
     * Dipanggil via AJAX polling dari navbar-user.
     */
    public function userNotif(Request $request)
    {
        $userId = Auth::id();

        $siapDiambil = PermohonanSurat::with(['jenisSurat', 'approval'])
            ->where('id_user', $userId)
            ->whereHas('approval', fn($q) => $q->where('status', Approval::STATUS_SIAP_DIAMBIL))
            ->latest('tanggal_pengajuan')
            ->get();

        $notifs = $siapDiambil->map(function ($p) {
            return [
                'id'      => $p->id_permohonan,
                'surat'   => $p->jenisSurat->nama_surat ?? 'Surat',
                'message' => '🎉 Surat Anda sudah siap diambil di kantor kelurahan!',
                'time'    => optional($p->approval->tanggal_siap_diambil)
                    ? \Carbon\Carbon::parse($p->approval->tanggal_siap_diambil)->diffForHumans()
                    : '-',
                'url'     => route('user.permohonan.show', $p->id_permohonan),
            ];
        });

        return response()->json([
            'count' => $notifs->count(),
            'items' => $notifs->values(),
        ]);
    }
}
