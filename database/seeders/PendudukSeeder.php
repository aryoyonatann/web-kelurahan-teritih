<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PendudukSeeder extends Seeder
{
    /**
     * Seeder DUMMY untuk demo/uji coba fitur Data Warga.
     * Jalankan lewat: php artisan db:seed --class=PendudukSeeder
     * (bukan data penduduk asli — sengaja dibuat variatif untuk
     * menunjukkan bagaimana statistik dihitung dari data individual)
     */
    public function run(): void
    {
        $namaLaki = ['Ahmad Fauzi', 'Budi Santoso', 'Cahyo Nugroho', 'Dedi Kurniawan', 'Eko Prasetyo', 'Fajar Ramadhan', 'Gunawan Wibisono', 'Hendra Saputra', 'Irfan Hakim', 'Joko Susilo', 'Kurniawan Adi', 'Lukman Hakim', 'Muhammad Rizki', 'Nanda Pratama', 'Oki Setiawan', 'Purnomo Aji', 'Rendi Firmansyah', 'Sigit Purnama', 'Taufik Hidayat', 'Umar Bakri'];
        $namaPerempuan = ['Ayu Lestari', 'Bunga Citra', 'Dewi Anggraini', 'Eka Putri', 'Fitri Handayani', 'Gita Savitri', 'Hesti Purwanti', 'Indah Permatasari', 'Julia Rahmawati', 'Kartika Sari', 'Lina Marlina', 'Maya Sinta', 'Nurul Aini', 'Oktavia Ningsih', 'Putri Wulandari', 'Rina Susanti', 'Sri Wahyuni', 'Tia Amelia', 'Uswatun Hasanah', 'Vina Melati'];

        $agamaOpts = ['Islam', 'Islam', 'Islam', 'Islam', 'Islam', 'Islam', 'Kristen Protestan', 'Katolik', 'Hindu', 'Buddha'];
        $kawinOpts = ['Belum Kawin', 'Kawin', 'Kawin', 'Janda/Duda'];
        $pendOpts  = ['SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat', 'SMA/Sederajat', 'Diploma (D1-D3)', 'Sarjana (S1)'];
        $kerjaOpts = ['Wiraswasta', 'Karyawan Swasta', 'Petani', 'Buruh Harian Lepas', 'Ibu Rumah Tangga', 'Pedagang Kelontong', 'Karyawan Pemerintah'];
        $hubOpts   = ['Kepala Keluarga', 'Istri', 'Anak Kandung'];

        $counter = 1;
        foreach (range(1, 8) as $rw) {
            foreach (range(1, 6) as $i) {
                $isL = $counter % 2 === 0;
                $nama = $isL ? $namaLaki[array_rand($namaLaki)] : $namaPerempuan[array_rand($namaPerempuan)];
                $umur = rand(3, 80);
                $tglLahir = Carbon::now()->subYears($umur)->subDays(rand(0, 365));

                // Sesuaikan pekerjaan/pendidikan kasar berdasarkan umur biar masuk akal
                if ($umur < 7) {
                    $pendidikan = 'Belum Sekolah (PAUD/TK)'; $pekerjaan = 'Belum Bekerja'; $hub = 'Anak Kandung'; $kawin = 'Belum Kawin';
                } elseif ($umur <= 18) {
                    $pendidikan = 'Sedang Sekolah (7-18 Thn)'; $pekerjaan = 'Pelajar'; $hub = 'Anak Kandung'; $kawin = 'Belum Kawin';
                } else {
                    $pendidikan = $pendOpts[array_rand($pendOpts)];
                    $pekerjaan  = $kerjaOpts[array_rand($kerjaOpts)];
                    $hub        = $hubOpts[array_rand($hubOpts)];
                    $kawin      = $kawinOpts[array_rand($kawinOpts)];
                }

                Penduduk::create([
                    'nik'               => null, // dummy, sengaja tidak diisi NIK asli
                    'nama'              => $nama . ' ' . $counter,
                    'jenis_kelamin'     => $isL ? 'L' : 'P',
                    'tanggal_lahir'     => $tglLahir->format('Y-m-d'),
                    'agama'             => $agamaOpts[array_rand($agamaOpts)],
                    'status_kawin'      => $kawin,
                    'pendidikan'        => $pendidikan,
                    'pekerjaan'         => $pekerjaan,
                    'hubungan_keluarga' => $hub,
                    'rt'                => (string) rand(1, 4),
                    'rw'                => (string) $rw,
                    'alamat'            => "Kp. Teritih RT " . rand(1, 4) . "/RW {$rw}",
                ]);

                $counter++;
            }
        }
    }
}
