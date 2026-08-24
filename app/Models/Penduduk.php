<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Penduduk extends Model
{
    protected $table = 'penduduk';

    protected $fillable = [
        'nik', 'nama', 'jenis_kelamin', 'tanggal_lahir', 'agama',
        'status_kawin', 'pendidikan', 'pekerjaan', 'hubungan_keluarga',
        'rt', 'rw', 'alamat', 'tahun_data',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tahun_data'    => 'integer',
    ];

    /** Rentang kelompok umur 5 tahunan, dipakai untuk mapping ke kunci statistik */
    public const KELOMPOK_UMUR = [
        [0, 4, '0_4'], [5, 9, '5_9'], [10, 14, '10_14'], [15, 19, '15_19'],
        [20, 24, '20_24'], [25, 29, '25_29'], [30, 34, '30_34'], [35, 39, '35_39'],
        [40, 44, '40_44'], [45, 49, '45_49'], [50, 54, '50_54'], [55, 59, '55_59'],
        [60, 64, '60_64'], [65, 69, '65_69'], [70, 74, '70_74'], [75, 999, '75_plus'],
    ];

    public function getUmurAttribute(): int
    {
        return (int) Carbon::parse($this->tanggal_lahir)->age;
    }

    /** Kunci kelompok umur 5 tahunan, misal "20_24" */
    public function getKelompokUmurKeyAttribute(): string
    {
        $umur = $this->umur;
        foreach (self::KELOMPOK_UMUR as [$min, $max, $key]) {
            if ($umur >= $min && $umur <= $max) return $key;
        }
        return '75_plus';
    }

    /** Kunci kelompok umur 4 kategori: anak / remaja / dewasa / lansia */
    public function getKelompokUmur4KeyAttribute(): string
    {
        $umur = $this->umur;
        if ($umur < 7)  return 'anak';
        if ($umur <= 18) return 'remaja';
        if ($umur <= 55) return 'dewasa';
        return 'lansia';
    }

    /**
     * Hitung jumlah penduduk per tahun_data.
     * Return: ['2024' => 12500, '2025' => 13200, '2026' => 50]
     */
    public static function hitungPerTahun(): array
    {
        return static::selectRaw('tahun_data, COUNT(*) as jumlah')
            ->whereNotNull('tahun_data')
            ->where('tahun_data', '>', 0)
            ->groupBy('tahun_data')
            ->orderBy('tahun_data')
            ->pluck('jumlah', 'tahun_data')
            ->map(fn($v) => (int) $v)
            ->all();
    }

    /**
     * Hitung seluruh statistik demografi dari data penduduk yang ada,
     * dalam format ['kunci' => ['label' => ..., 'nilai' => ..., 'nilai_teks' => ...]]
     * — siap dipakai untuk overwrite/merge ke koleksi StatistikDemografi.
     * Mengembalikan array kosong kalau belum ada data penduduk sama sekali
     * (supaya sistem fallback ke data manual/import lama).
     */
    public static function hitungStatistik(): array
    {
        $semua = static::all();
        if ($semua->isEmpty()) return [];
        $hasil = [];

        // Jenis kelamin
        $hasil['jiwa_lakilaki']  = $semua->where('jenis_kelamin', 'L')->count();
        $hasil['jiwa_perempuan'] = $semua->where('jenis_kelamin', 'P')->count();
        $hasil['total_penduduk'] = $semua->count();
        $hasil['jumlah_kk']      = $semua->where('hubungan_keluarga', 'Kepala Keluarga')->count();
        $hasil['jumlah_rt']      = $semua->map(fn($p) => $p->rw . '-' . $p->rt)->filter()->unique()->count();
        $hasil['jumlah_rw']      = $semua->pluck('rw')->filter()->unique()->count();

        // Agama
        $agamaMap = [
            'Islam' => 'jiwa_islam', 'Kristen Protestan' => 'jiwa_kristen',
            'Katolik' => 'jiwa_katolik', 'Hindu' => 'jiwa_hindu',
            'Buddha' => 'jiwa_buddha', 'Konghucu' => 'jiwa_konghucu',
            'Kepercayaan Lainnya' => 'jiwa_lainnya',
        ];
        foreach ($agamaMap as $label => $kunci) {
            $hasil[$kunci] = $semua->where('agama', $label)->count();
        }

        // Kelompok umur 5 tahunan (total + per gender)
        foreach (self::KELOMPOK_UMUR as [$min, $max, $key]) {
            $grup = $semua->filter(fn($p) => $p->kelompok_umur_key === $key);
            $hasil["umur_{$key}"]   = $grup->count();
            $hasil["umur_{$key}_l"] = $grup->where('jenis_kelamin', 'L')->count();
            $hasil["umur_{$key}_p"] = $grup->where('jenis_kelamin', 'P')->count();
        }

        // Kelompok umur 4 kategori, nilai_teks format "laki|perempuan"
        foreach (['anak', 'remaja', 'dewasa', 'lansia'] as $k4) {
            $grup = $semua->filter(fn($p) => $p->kelompok_umur_4_key === $k4);
            $hasil["umur4_{$k4}"] = [
                'nilai'      => $grup->count(),
                'nilai_teks' => $grup->where('jenis_kelamin', 'L')->count() . '|' . $grup->where('jenis_kelamin', 'P')->count(),
            ];
        }

        // Status kawin, nilai_teks format "laki|perempuan"
        $kawinMap = ['Belum Kawin' => 'kawin_belum', 'Kawin' => 'kawin_kawin', 'Janda/Duda' => 'kawin_janda_duda'];
        foreach ($kawinMap as $label => $kunci) {
            $grup = $semua->where('status_kawin', $label);
            $hasil[$kunci] = [
                'nilai'      => $grup->count(),
                'nilai_teks' => $grup->where('jenis_kelamin', 'L')->count() . '|' . $grup->where('jenis_kelamin', 'P')->count(),
            ];
        }

        // Pekerjaan
        $kerjaMap = [
            'Pelajar' => 'kerja_pelajar', 'Ibu Rumah Tangga' => 'kerja_irt',
            'Wiraswasta' => 'kerja_wiraswasta', 'Belum Bekerja' => 'kerja_belum',
            'Buruh Harian Lepas' => 'kerja_buruh', 'Karyawan Swasta' => 'kerja_swasta',
            'Petani' => 'kerja_petani', 'Karyawan Pemerintah' => 'kerja_pemerintah',
            'Pedagang Keliling' => 'kerja_pedagang_keliling', 'Pedagang Kelontong' => 'kerja_pedagang_kelontong',
        ];
        foreach ($kerjaMap as $label => $kunci) {
            $hasil[$kunci] = $semua->where('pekerjaan', $label)->count();
        }

        // Pendidikan
        $pendMap = [
            'Belum Sekolah (PAUD/TK)' => 'pend_belum_sekolah', 'SMA/Sederajat' => 'pend_sma',
            'SD/Sederajat' => 'pend_sd', 'SMP/Sederajat' => 'pend_smp',
            'Sarjana (S1)' => 'pend_s1', 'Sedang Sekolah (7-18 Thn)' => 'pend_sedang_sekolah',
            'Diploma (D1-D3)' => 'pend_diploma', 'Pascasarjana (S2/S3)' => 'pend_s2',
            'Tidak Tamat/Lainnya' => 'pend_tidak_tamat',
        ];
        foreach ($pendMap as $label => $kunci) {
            $hasil[$kunci] = $semua->where('pendidikan', $label)->count();
        }

        // Hubungan keluarga
        $hubMap = ['Anak Kandung' => 'hub_anak', 'Kepala Keluarga' => 'hub_kk', 'Istri' => 'hub_istri', 'Ibu' => 'hub_ibu'];
        foreach ($hubMap as $label => $kunci) {
            $hasil[$kunci] = $semua->where('hubungan_keluarga', $label)->count();
        }

        return $hasil;
    }

    /**
     * Label default untuk tiap kunci hasil hitungStatistik(), dipakai untuk
     * menyimpan ke tabel statistik_demografi dan untuk menentukan field mana
     * di form admin yang harus dikunci (karena nilainya hasil hitung, bukan
     * input manual).
     */
    public static function labelStatistikKey(): array
    {
        $labels = [
            'jiwa_lakilaki' => 'Laki-Laki', 'jiwa_perempuan' => 'Perempuan',
            'total_penduduk' => 'Total Penduduk', 'jumlah_kk' => 'Jumlah KK',
            'jumlah_rt' => 'Jumlah RT', 'jumlah_rw' => 'Jumlah RW',
            'jiwa_islam' => 'Islam', 'jiwa_kristen' => 'Kristen',
            'jiwa_katolik' => 'Katolik', 'jiwa_hindu' => 'Hindu',
            'jiwa_buddha' => 'Buddha', 'jiwa_konghucu' => 'Konghucu',
            'jiwa_lainnya' => 'Kepercayaan Lainnya',
            'umur4_anak' => 'Anak (< 7 Tahun)', 'umur4_remaja' => 'Remaja (7–18 Tahun)',
            'umur4_dewasa' => 'Dewasa (19–55 Tahun)', 'umur4_lansia' => 'Lansia (≥ 56 Tahun)',
            'kawin_belum' => 'Belum Kawin', 'kawin_kawin' => 'Kawin',
            'kawin_janda_duda' => 'Janda/Duda',
            'kerja_pelajar' => 'Pelajar', 'kerja_irt' => 'Ibu Rumah Tangga',
            'kerja_wiraswasta' => 'Wiraswasta', 'kerja_belum' => 'Belum Bekerja',
            'kerja_buruh' => 'Buruh Harian Lepas', 'kerja_swasta' => 'Karyawan Swasta',
            'kerja_petani' => 'Petani', 'kerja_pemerintah' => 'Karyawan Pemerintah',
            'kerja_pedagang_keliling' => 'Pedagang Keliling', 'kerja_pedagang_kelontong' => 'Pedagang Kelontong',
            'pend_belum_sekolah' => 'Belum Sekolah (PAUD/TK)', 'pend_sma' => 'SMA/Sederajat',
            'pend_sd' => 'SD/Sederajat', 'pend_smp' => 'SMP/Sederajat',
            'pend_s1' => 'Sarjana (S1)', 'pend_sedang_sekolah' => 'Sedang Sekolah (7-18 Thn)',
            'pend_diploma' => 'Diploma (D1-D3)', 'pend_s2' => 'Pascasarjana (S2/S3)',
            'pend_tidak_tamat' => 'Tidak Tamat/Lainnya',
            'hub_anak' => 'Anak Kandung', 'hub_kk' => 'Kepala Keluarga',
            'hub_istri' => 'Istri', 'hub_ibu' => 'Ibu',
            // Bukan hasil hitungStatistik(), tapi tetap "computed" —
            // periode update di-set otomatis, bukan input manual
            'update_terakhir' => 'Update Terakhir',
        ];

        foreach (self::KELOMPOK_UMUR as [$min, $max, $key]) {
            $labels["umur_{$key}"]   = "Umur {$key}";
            $labels["umur_{$key}_l"] = "Umur {$key} (L)";
            $labels["umur_{$key}_p"] = "Umur {$key} (P)";
        }

        return $labels;
    }

    /**
     * SATU-SATUNYA tempat yang menulis angka turunan data warga ke DB.
     * Dipanggil setiap kali ada perubahan data warga (tambah/edit/hapus/
     * import) DAN setiap kali form Statistik Demografi disimpan, supaya:
     *
     * 1. Semua angka demografi (jenis kelamin, agama, umur, pekerjaan,
     *    pendidikan, status kawin, total/KK/RT/RW) selalu sinkron ke tabel
     *    statistik_demografi — dipakai halaman publik Profil & Chatbot
     *    yang baca langsung dari DB (StatistikDemografi::asCollection()).
     * 2. "Jumlah Penduduk" di Data Singkat Kelurahan (tabel `pengaturan`)
     *    ikut disinkronkan ke jumlah warga sebenarnya — tidak ada lagi
     *    angka dummy yang beda dari data riil.
     * 3. "Periode Update Data" di-set otomatis ke bulan & tahun saat ini —
     *    admin tidak perlu pilih manual tiap kali data warga berubah.
     *
     * Kalau belum ada data warga sama sekali, tidak melakukan apa-apa —
     * mode manual/fallback lama tetap berlaku (lihat StatistikController).
     */
    public static function syncSemuaStatistik(): void
    {
        if (static::count() === 0) return;

        // ── Pertumbuhan penduduk per tahun (grafik) ──────────────────
        $perTahun = static::hitungPerTahun();
        foreach ($perTahun as $tahun => $jumlah) {
            StatistikDemografi::updateOrCreate(
                ['kunci' => 'penduduk_' . $tahun],
                ['label' => 'Tahun ' . $tahun, 'nilai' => $jumlah]
            );
        }
        // Hapus tahun yang sudah tidak ada warganya lagi
        $kunciDiDB = StatistikDemografi::where('kunci', 'like', 'penduduk_%')->pluck('kunci');
        foreach ($kunciDiDB as $kunci) {
            $tahun = (int) str_replace('penduduk_', '', $kunci);
            if (!isset($perTahun[$tahun])) {
                StatistikDemografi::where('kunci', $kunci)->delete();
            }
        }

        // ── Semua angka demografi (jenis kelamin, agama, umur, dst) ──
        $computed = static::hitungStatistik();
        $labels   = static::labelStatistikKey();
        foreach ($computed as $kunci => $val) {
            $nilai     = is_array($val) ? ($val['nilai'] ?? 0) : $val;
            $nilaiTeks = is_array($val) ? ($val['nilai_teks'] ?? null) : null;

            StatistikDemografi::updateOrCreate(
                ['kunci' => $kunci],
                [
                    'label'      => $labels[$kunci] ?? str_replace('_', ' ', $kunci),
                    'nilai'      => $nilai,
                    'nilai_teks' => $nilaiTeks,
                ]
            );
        }

        // ── Total sample DDK dari 4 kelompok umur ────────────────────
        $umur4Keys = ['umur4_anak', 'umur4_remaja', 'umur4_dewasa', 'umur4_lansia'];
        $totalDDK  = StatistikDemografi::whereIn('kunci', $umur4Keys)->sum('nilai');
        if ($totalDDK > 0) {
            $teksL = StatistikDemografi::whereIn('kunci', $umur4Keys)->get()
                ->sum(fn($r) => (int) explode('|', $r->nilai_teks ?? '0|0')[0]);
            $teksP = $totalDDK - $teksL;
            StatistikDemografi::updateOrCreate(
                ['kunci' => 'total_sample_ddk'],
                ['label' => 'Total Sample DDK', 'nilai' => $totalDDK, 'nilai_teks' => $teksL . '|' . $teksP, 'urutan' => 39]
            );
        }

        // ── Jumlah Penduduk di Data Singkat Kelurahan (tabel pengaturan) ──
        Pengaturan::setValue('jumlah_penduduk', (string) static::count());

        // ── Periode Update Data — otomatis bulan & tahun sekarang ────
        $bulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
        $now = now();
        StatistikDemografi::updateOrCreate(
            ['kunci' => 'update_terakhir'],
            [
                'label'      => 'Update Terakhir',
                'nilai'      => 0,
                'nilai_teks' => $bulanIndo[(int) $now->format('n')] . ' ' . $now->format('Y'),
            ]
        );
    }
}