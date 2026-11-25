<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanSurat;
use App\Models\TtdDigital;
use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class KirimWaController extends Controller
{
    const WA_SERVER = 'http://localhost:3001';

    public function getTtdList()
    {
        $ttds = TtdDigital::where('is_aktif', 1)->get()->map(fn($t) => [
            'id'      => $t->id,
            'nama'    => $t->nama,
            'nip'     => $t->nip ?? '-',
            'jabatan' => $t->jabatan,
            'ttd_url' => $t->ttd_url,
        ]);

        return response()->json($ttds);
    }

    public function kirim(Request $request, $id)
    {
        $request->validate([
            'ttd_id' => 'required|exists:ttd_digital,id',
        ]);

        $permohonan = PermohonanSurat::with(['user', 'jenisSurat', 'approval'])->findOrFail($id);

        $approval = $permohonan->approval;
        if (!$approval || !in_array($approval->status, [
            Approval::STATUS_DISETUJUI,
            Approval::STATUS_SIAP_DIAMBIL,
            Approval::STATUS_SELESAI,
        ])) {
            return response()->json(['success' => false, 'message' => 'Permohonan belum disetujui.'], 422);
        }

        $ttd = TtdDigital::findOrFail($request->ttd_id);

        $tahun       = now()->year;
        $bulanRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'][now()->month - 1];

        // Jika sudah punya nomor surat, pakai yang lama — jangan generate baru
        if ($permohonan->nomor_surat) {
            $nomorFormatted = $permohonan->nomor_surat;
            // Ekstrak nomorUrut dari nomor yang sudah ada untuk dikirim ke view
            $parts     = explode(' / ', $nomorFormatted);
            $nomorUrut = (int) ($parts[1] ?? 1);
        } else {
            $nomorUrut = DB::transaction(function () use ($permohonan, $tahun) {
                $max = PermohonanSurat::where('id_jenis_surat', $permohonan->id_jenis_surat)
                    ->whereYear('tanggal_pengajuan', $tahun)
                    ->whereNotNull('nomor_surat')
                    ->lockForUpdate()
                    ->get('nomor_surat')
                    ->map(fn($p) => (int) (explode(' / ', $p->nomor_surat)[1] ?? 0))
                    ->max() ?? 0;
                return $max + 1;
            });

            // Build nomor surat formatted (sama dengan yang ada di surat_render.blade.php)
            $js             = $permohonan->jenisSurat;
            $prefix         = optional($js)->kode_klasifikasi ?? '470';
            $kode           = optional($js)->kode_surat ?? 'SK';
            $nomorFormatted = $prefix . ' / ' . str_pad($nomorUrut, 3, '0', STR_PAD_LEFT)
                            . ' / Kel.1010/' . $kode . '/ ' . $bulanRomawi . ' /' . $tahun;
        }

        try {
            $waStatus = Http::timeout(3)->get(self::WA_SERVER . '/status')->json();
            if (!($waStatus['connected'] ?? false)) {
                return response()->json(['success' => false, 'message' => 'WA Server belum terhubung. Pastikan wa-server berjalan dan sudah scan QR.'], 503);
            }
        } catch (\Exception) {
            return response()->json(['success' => false, 'message' => 'WA Server tidak aktif. Jalankan: cd D:\wa-server && node server.js'], 503);
        }

        $htmlContent  = view('Admin.permohonan.surat_render', compact('permohonan', 'ttd', 'nomorUrut', 'bulanRomawi', 'nomorFormatted'))->render();
        $tempHtmlPath = storage_path('app/temp_surat_' . $id . '_' . time() . '.html');
        file_put_contents($tempHtmlPath, $htmlContent);

        $noHp   = $permohonan->user->no_hp ?? '';
        $noHpWa      = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $noHp));

        if (!$noHpWa) {
            @unlink($tempHtmlPath);
            return response()->json(['success' => false, 'message' => 'User tidak memiliki nomor WhatsApp.'], 422);
        }

        $namaPemohon = $permohonan->nama_pemohon ?? $permohonan->user->nama ?? '-';
        $jenisSurat  = $permohonan->jenisSurat->nama_surat ?? 'Surat';
        $tglPengajuan = \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->format('d M Y');
        $namaJenis   = str_replace(['Surat ', 'surat '], '', $jenisSurat);
        $fileName    = 'Surat_' . str_replace(' ', '_', $namaJenis) . '_' . str_replace(' ', '_', $permohonan->user->nama ?? 'pemohon') . '.pdf';

        $pesan = "Assalamu'alaikum Wr. Wb.\n\n" .
                 "Yth. Bapak/Ibu *{$namaPemohon}*,\n\n" .
                 "Kami informasikan bahwa permohonan *{$jenisSurat}* Anda telah selesai diproses.\n\n" .
                 "📋 *Detail Permohonan:*\n" .
                 "• Jenis Surat : {$jenisSurat}\n" .
                 "• Tanggal     : {$tglPengajuan}\n\n" .
                 "Terlampir surat resmi Anda dalam format PDF.\n\n" .
                 "Terima kasih 🙏\n" .
                 "*Kelurahan Teritih, Kecamatan Walantaka, Kota Serang*";

        try {
            set_time_limit(120);

            $response = Http::timeout(90)->post(self::WA_SERVER . '/render-and-send', [
                'file_path' => $tempHtmlPath,
                'target'    => $noHpWa,
                'message'   => $pesan,
                'file_name' => $fileName,
            ]);

            $result = $response->json();

            if ($result['success'] ?? false) {
                // Simpan nomor surat ke database agar QR code bisa diverifikasi
                $permohonan->update(['nomor_surat' => $nomorFormatted]);

                return response()->json(['success' => true, 'message' => 'Surat berhasil dikirim ke WhatsApp ' . $noHp]);
            }

            return response()->json(['success' => false, 'message' => 'Gagal: ' . ($result['message'] ?? 'Unknown error')], 422);

        } catch (\Exception $e) {
            @unlink($tempHtmlPath);
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
