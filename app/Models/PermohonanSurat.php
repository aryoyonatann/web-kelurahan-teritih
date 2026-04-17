<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    protected $table      = 'permohonan_surat';
    protected $primaryKey = 'id_permohonan';
    public    $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_jenis_surat',
        'nama_pemohon',
        'nik_pemohon',
        'alamat_pemohon',
        'keperluan',
        'tanggal_pengajuan',
        'data_tambahan',      // ← kolom JSON data per jenis surat
        'keterangan_admin',   // ← catatan admin saat proses
        'nomor_surat',        // ← nomor surat setelah disetujui
    ];

    protected $casts = [
        'data_tambahan'     => 'array',    // ← otomatis encode/decode JSON
        'tanggal_pengajuan' => 'datetime',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Relasi ke jenis surat
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat', 'id_jenis_surat');
    }

    // Relasi ke persyaratan (dokumen)
    public function persyaratan()
    {
        return $this->hasMany(Persyaratan::class, 'id_permohonan');
    }

    // Relasi ke approval
    public function approval()
    {
        return $this->hasOne(Approval::class, 'id_permohonan');
    }
}