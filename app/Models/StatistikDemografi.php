<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikDemografi extends Model
{
    protected $table      = 'statistik_demografi';
    protected $primaryKey = 'id';
    public    $timestamps = false;

    protected $fillable = ['kunci', 'label', 'nilai', 'nilai_teks', 'urutan'];

    protected $casts = ['nilai' => 'integer'];

    public static function asCollection()
    {
        return static::orderBy('urutan')->get()->keyBy('kunci');
    }
}