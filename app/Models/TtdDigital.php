<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TtdDigital extends Model
{
    protected $table    = 'ttd_digital';
    protected $fillable = ['nama', 'nip', 'jabatan', 'ttd_data', 'ttd_path', 'is_aktif'];

    /**
     * Ambil URL gambar TTD (canvas base64 atau file upload).
     */
    public function getTtdUrlAttribute(): ?string
    {
        if ($this->ttd_data) {
            return $this->ttd_data; // sudah base64 data URI
        }
        if ($this->ttd_path) {
            return asset('storage/' . $this->ttd_path);
        }
        return null;
    }
}
