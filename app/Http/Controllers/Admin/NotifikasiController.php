<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanSurat;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
   
    public function index(Request $request)
    {

        $permohonan = PermohonanSurat::with(['user', 'jenisSurat'])
            ->whereDoesntHave('approval')
            ->orWhereHas('approval', fn($q) => $q->whereRaw('LOWER(status) = ?', ['pending']))
            ->latest('tanggal_pengajuan')
            ->take(10)
            ->get();

        $notifs = $permohonan->map(function ($p) {
            return [
                'id'      => $p->id_permohonan,
                'type'    => 'permohonan',
                'icon'    => 'envelope-open',
                'color'   => 'blue',
                'title'   => 'Permohonan surat masuk',
                'message' => ($p->user->nama ?? 'Warga') . ' mengajukan ' . ($p->jenisSurat->nama_surat ?? 'surat'),
                'time'    => $p->tanggal_pengajuan
                    ? \Carbon\Carbon::parse($p->tanggal_pengajuan)->diffForHumans()
                    : '-',
                'url'     => route('permohonan.show', $p->id_permohonan),
                'raw_time' => $p->tanggal_pengajuan,
            ];
        });

        return response()->json([
            'count' => $notifs->count(),
            'items' => $notifs->values(),
        ]);
    }

    /**
     * Tandai semua notifikasi sebagai sudah dibaca
     * (dalam konteks ini: tidak ada tabel notif, cukup kembalikan OK)
     */
    public function markRead()
    {
        return response()->json(['ok' => true]);
    }
}