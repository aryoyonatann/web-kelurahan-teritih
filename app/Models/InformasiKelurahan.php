<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiKelurahan extends Model
{
    protected $table      = 'informasi_kelurahan';
    protected $primaryKey = 'id_informasi';
    public    $timestamps = false;

    // ✅ FIX: tambahkan 'slug', 'ringkasan', 'views' ke $fillable
    // Tanpa ini Laravel memblokir pengisian kolom-kolom tersebut
    // sehingga slug selalu NULL meski controller sudah generate slug dengan benar
    protected $fillable = [
        'judul',
        'slug',        // ✅ ditambahkan
        'kategori',
        'isi',
        'ringkasan',   // ✅ ditambahkan
        'tanggal_publish',
        'id_admin',
        'status',
        'gambar',
        'views',       // ✅ ditambahkan
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}
