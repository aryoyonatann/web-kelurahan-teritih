<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Berita;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;

    protected $fillable = [
        'nama_admin',
        'username',
        'password',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // relasi approval
    public function approval()
    {
        return $this->hasMany(Approval::class, 'id_admin');
    }

    public function berita()
    {
        return $this->hasMany(Berita::class, 'id_admin');
    }
}