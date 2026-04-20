<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    protected $table      = 'pengaturan';
    protected $primaryKey = 'id';
    public    $timestamps = false;

    protected $fillable = ['kunci', 'nilai'];

    /**
     * Ambil nilai berdasarkan kunci, kembalikan $default jika tidak ada.
     */
    public static function getValue(string $kunci, string $default = ''): string
    {
        return static::where('kunci', $kunci)->value('nilai') ?? $default;
    }

    /**
     * Simpan / update nilai berdasarkan kunci (upsert).
     */
    public static function setValue(string $kunci, string $nilai): void
    {
        static::updateOrCreate(
            ['kunci' => $kunci],
            ['nilai' => $nilai]
        );
    }
}