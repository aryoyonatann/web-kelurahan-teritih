<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    protected $table = 'persyaratan';
    protected $primaryKey = 'id_persyaratan';
    public $timestamps = false;

    protected $fillable = [
        'id_permohonan',
        'nama_file',
        'jenis_dokumen',
        'path_file',
        'uploaded_at',
    ];

    public function permohonan()
    {
        return $this->belongsTo(PermohonanSurat::class, 'id_permohonan');
    }
}