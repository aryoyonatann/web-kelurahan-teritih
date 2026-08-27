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
     * Ambil statistik untuk halaman publik.
     * Jika data warga sudah ada (syncSemuaStatistik sudah pernah dijalankan),
     * baca langsung dari DB — TIDAK hitung ulang setiap page load.
     * Fallback ke hitung-ulang hanya jika tabel statistik_demografi kosong
     * atau belum pernah di-sync.
     */
    public static function withPendudukOverride()
    {
        $statistik = static::all()->keyBy('kunci');

        // Cek apakah data sudah pernah di-sync dari data warga
        // (ditandai dengan adanya kunci 'total_penduduk' di DB)
        $sudahSync = $statistik->has('total_penduduk') && $statistik['total_penduduk']->nilai > 0;

        if (!$sudahSync) {
            // Belum pernah sync — hitung on-the-fly dan merge (fallback)
            $computed = \App\Models\Penduduk::hitungStatistik();
            foreach ($computed as $kunci => $val) {
                $nilai     = is_array($val) ? $val['nilai'] : $val;
                $nilaiTeks = is_array($val) ? $val['nilai_teks'] : null;
                if ($statistik->has($kunci)) {
                    $statistik[$kunci]->nilai = $nilai;
                    if ($nilaiTeks !== null) $statistik[$kunci]->nilai_teks = $nilaiTeks;
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
        }

        return $statistik;
    }
}