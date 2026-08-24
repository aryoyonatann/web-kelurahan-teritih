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

    /**
     * Gabungkan data statistik manual/import dengan hasil HITUNG OTOMATIS
     * dari tabel `penduduk` (kalau sudah ada datanya). Kunci yang punya
     * padanan di data penduduk akan DITIMPA nilainya (di memori saja,
     * tidak disimpan ke DB) supaya grafik selalu mencerminkan data warga
     * terkini. Kunci yang tidak berhubungan dengan data individual
     * (RT/RW, fasilitas umum, data singkat, dll) tetap pakai nilai manual.
     */
    public static function withPendudukOverride()
    {
        $statistik = static::all()->keyBy('kunci');
        $computed  = \App\Models\Penduduk::hitungStatistik();

        foreach ($computed as $kunci => $val) {
            $nilai     = is_array($val) ? $val['nilai'] : $val;
            $nilaiTeks = is_array($val) ? $val['nilai_teks'] : null;

            if ($statistik->has($kunci)) {
                $statistik[$kunci]->nilai = $nilai;
                if ($nilaiTeks !== null) {
                    $statistik[$kunci]->nilai_teks = $nilaiTeks;
                }
            } else {
                $baru = new static([
                    'kunci'      => $kunci,
                    'label'      => str_replace('_', ' ', $kunci),
                    'nilai'      => $nilai,
                    'nilai_teks' => $nilaiTeks,
                ]);
                $statistik->put($kunci, $baru);
            }
        }

        return $statistik;
    }
}