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
        $pending = PermohonanSurat::whereDoesntHave('approval')
            ->orWhereHas('approval', function ($q) {
                $q->where('status', Approval::STATUS_PENDING);
            })
            ->latest('tanggal_pengajuan')
            ->take(8)
            ->get();

        // Load relasi manual untuk menghindari konflik eager loading dengan cast array
        $pending->each(function (PermohonanSurat $p) {
            $p->load('user', 'jenisSurat');
        });

        $notifsPending = $pending->map(function ($p) {
            return [
                'id'      => $p->id_permohonan,
                'type'    => 'permohonan',
                'icon'    => 'envelope-open',
                'color'   => 'blue',
                'title'   => 'Permohonan surat masuk',
                'message' => (optional($p->user)->nama ?? 'Warga') . ' mengajukan ' . (optional($p->jenisSurat)->nama_surat ?? 'surat'),
                'time'    => $p->tanggal_pengajuan
                    ? \Carbon\Carbon::parse($p->tanggal_pengajuan)->diffForHumans()
                    : '-',
                'url'     => route('permohonan.show', $p->id_permohonan),
            ];
        });

        // 2) Permohonan siap_diambil yang belum diambil > 3 hari (reminder)
        $siapLama = PermohonanSurat::whereHas('approval', function ($q) {
                $q->where('status', Approval::STATUS_SIAP_DIAMBIL)
                  ->where('tanggal_siap_diambil', '<=', now()->subDays(3));
            })
            ->latest('tanggal_pengajuan')
            ->take(4)
            ->get();

        $siapLama->each(function (PermohonanSurat $p) {
            $p->load('user', 'jenisSurat');
        });

        $notifsReminder = $siapLama->map(function ($p) {
            return [
                'id'      => $p->id_permohonan,
                'type'    => 'reminder',
                'icon'    => 'bell',
                'color'   => 'orange',
                'title'   => 'Surat belum diambil (3+ hari)',
                'message' => (optional($p->user)->nama ?? 'Warga') . ' — ' . (optional($p->jenisSurat)->nama_surat ?? 'surat') . ' masih belum diambil',
                'time'    => \Carbon\Carbon::parse($p->tanggal_pengajuan)->diffForHumans(),
                'url'     => route('permohonan.show', $p->id_permohonan),
            ];
        });

        $notifs = collect($notifsReminder->values())->merge(collect($notifsPending->values()))->values();

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
        // Route ini dipanggil dari navbar user via AJAX — harus pakai guard 'web' (user)
        $userId = auth('web')->id();

        $siapDiambil = PermohonanSurat::with(['jenisSurat', 'approval'])
            ->where('id_user', $userId)
            ->whereHas('approval', function ($q) {
                $q->where('status', Approval::STATUS_SIAP_DIAMBIL);
            })
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
