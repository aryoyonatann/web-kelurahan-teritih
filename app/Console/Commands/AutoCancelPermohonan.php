<?php

namespace App\Console\Commands;

use App\Models\Approval;
use App\Models\PermohonanSurat;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class AutoCancelPermohonan extends Command
{
    protected $signature   = 'permohonan:auto-cancel';
    protected $description = 'Batalkan otomatis permohonan yang tidak ditindaklanjuti admin dalam 72 jam';

    public function handle(): void
    {
        $batas = Carbon::now()->subHours(72);

        // Permohonan dengan approval pending > 72 jam
        $denganApproval = PermohonanSurat::whereHas('approval', fn($q) =>
            $q->where('status', Approval::STATUS_PENDING)
              ->where('tanggal_approval', '<=', $batas)
        )->get();

        // Permohonan tanpa approval record sama sekali > 72 jam sejak pengajuan
        $tanpaApproval = PermohonanSurat::doesntHave('approval')
            ->where('tanggal_pengajuan', '<=', $batas)
            ->get();

        $semua = $denganApproval->merge($tanpaApproval);

        if ($semua->isEmpty()) {
            $this->info('Tidak ada permohonan yang perlu dibatalkan.');
            return;
        }

        foreach ($semua as $p) {
            if ($p->approval) {
                $p->approval->update([
                    'status'  => Approval::STATUS_CANCELLED,
                    'catatan' => 'Dibatalkan otomatis: tidak ada tindak lanjut dari admin dalam 72 jam.',
                ]);
            } else {
                Approval::create([
                    'id_permohonan'    => $p->id_permohonan,
                    'id_admin'         => null,
                    'status'           => Approval::STATUS_CANCELLED,
                    'tanggal_approval' => Carbon::now(),
                    'catatan'          => 'Dibatalkan otomatis: tidak ada tindak lanjut dari admin dalam 72 jam.',
                ]);
            }

            $this->line("Cancelled: Permohonan #{$p->id_permohonan}");
        }

        $this->info("Total dibatalkan: {$semua->count()} permohonan.");
    }
}
