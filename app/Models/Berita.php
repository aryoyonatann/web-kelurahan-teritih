<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table      = 'berita';
    protected $primaryKey = 'id_berita';
    public    $timestamps = false;

    protected $fillable = [
        'judul', 'slug', 'kategori', 'isi', 'ringkasan',
        'tanggal_publish', 'id_admin', 'status', 'gambar', 'views',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}
