<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $table = 'approval';
    protected $primaryKey = 'id_approval';
    public $timestamps = false;

    // Status constants — urutan alur: pending → disetujui → siap_diambil → selesai | ditolak
    const STATUS_PENDING       = 'pending';
    const STATUS_DISETUJUI     = 'disetujui';
    const STATUS_DITOLAK       = 'ditolak';
    const STATUS_SIAP_DIAMBIL  = 'siap_diambil';
    const STATUS_SELESAI       = 'selesai';

    protected $fillable = [
        'id_permohonan',
        'id_admin',
        'status',
        'tanggal_approval',
        'catatan',
        'tanggal_siap_diambil',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_approval'    => 'datetime',
        'tanggal_siap_diambil'=> 'datetime',
        'tanggal_selesai'     => 'datetime',
    ];

    public function permohonan()
    {
        return $this->belongsTo(PermohonanSurat::class, 'id_permohonan');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }

    /** Helper: apakah status ini termasuk "sudah selesai diproses" (bukan pending) */
    public function isFinal(): bool
    {
        return in_array($this->status, [
            self::STATUS_DISETUJUI,
            self::STATUS_DITOLAK,
            self::STATUS_SIAP_DIAMBIL,
            self::STATUS_SELESAI,
        ]);
    }
}
