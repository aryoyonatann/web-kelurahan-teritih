<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $table      = 'jenis_surat';
    protected $primaryKey = 'id_jenis_surat';
    public    $timestamps = false;

    protected $fillable = [
        'nama_surat',
        'deskripsi',
        'slug',
        'is_custom',
        'template',
        'field_config',
        'icon',
        'warna',
        'aktif',
        'kode_klasifikasi',
        'kode_surat',
        'template_pembuka',
        'template_isi',
        'template_penutup',
        'fields_config',
    ];

    protected $casts = [
        'field_config'  => 'array',
        'fields_config' => 'array',
        'is_custom'     => 'boolean',
        'aktif'         => 'boolean',
    ];

    public function permohonan()
    {
        return $this->hasMany(PermohonanSurat::class, 'id_jenis_surat');
    }
}