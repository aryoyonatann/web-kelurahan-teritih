<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // ── 1. ADMINS ──────────────────────────────────────────────
        $this->call(AdminSeeder::class);

        // ── 2. JENIS SURAT ─────────────────────────────────────────
        DB::table('jenis_surat')->insert([
            ['id_jenis_surat'=>1,'nama_surat'=>'Surat Keterangan Tidak Mampu','slug'=>'sktm','is_custom'=>0,'template'=>null,'field_config'=>null,'icon'=>'bi-currency-dollar','warna'=>'#a855f7','aktif'=>1,'deskripsi'=>'Keterangan ekonomi lemah untuk keperluan berobat, sekolah, beasiswa, atau bantuan sosial.'],
            ['id_jenis_surat'=>2,'nama_surat'=>'Surat Keterangan Kematian','slug'=>'kematian','is_custom'=>0,'template'=>null,'field_config'=>null,'icon'=>'bi-file-earmark-medical-fill','warna'=>'#059669','aktif'=>1,'deskripsi'=>'Dokumen pelaporan kematian warga untuk administrasi Kartu Keluarga dan keperluan lainnya.'],
            ['id_jenis_surat'=>3,'nama_surat'=>'Surat Keterangan Suami/Istri','slug'=>'suami-istri','is_custom'=>0,'template'=>null,'field_config'=>null,'icon'=>'bi-people-fill','warna'=>'#f43f5e','aktif'=>1,'deskripsi'=>'Surat keterangan status pasangan suami istri yang telah menikah untuk berbagai keperluan.'],
            ['id_jenis_surat'=>4,'nama_surat'=>'Surat Keterangan Beda Nama','slug'=>'beda-nama','is_custom'=>0,'template'=>null,'field_config'=>null,'icon'=>'bi-person-badge-fill','warna'=>'#f59e0b','aktif'=>1,'deskripsi'=>'Surat keterangan perbedaan identitas nama pada dokumen yang berbeda namun satu orang yang sama.'],
            ['id_jenis_surat'=>5,'nama_surat'=>'Surat Keterangan Izin Cuti','slug'=>'izin-cuti','is_custom'=>0,'template'=>null,'field_config'=>null,'icon'=>'bi-calendar-check-fill','warna'=>'#1c64f2','aktif'=>1,'deskripsi'=>'Surat keterangan untuk keperluan pengajuan izin dari tempat kerja atau instansi.'],
        ]);

        // ── 3. STATISTIK DEMOGRAFI ─────────────────────────────────
        DB::table('statistik_demografi')->insert([
            ['id'=>1, 'kunci'=>'total_penduduk', 'label'=>'Total Penduduk', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>1],
            ['id'=>2, 'kunci'=>'jumlah_kk', 'label'=>'Kepala Keluarga (KK)', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>2],
            ['id'=>3, 'kunci'=>'jumlah_rt', 'label'=>'Rukun Tetangga (RT)', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>3],
            ['id'=>4, 'kunci'=>'jumlah_rw', 'label'=>'Rukun Warga (RW)', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>4],
            ['id'=>5, 'kunci'=>'jiwa_lakilaki', 'label'=>'Laki-Laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>5],
            ['id'=>6, 'kunci'=>'jiwa_perempuan', 'label'=>'Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>6],
            ['id'=>7, 'kunci'=>'jiwa_islam', 'label'=>'Islam', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>7],
            ['id'=>8, 'kunci'=>'jiwa_kristen', 'label'=>'Kristen Protestan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>8],
            ['id'=>9, 'kunci'=>'jiwa_katolik', 'label'=>'Katolik', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>9],
            ['id'=>10,'kunci'=>'jiwa_lainnya', 'label'=>'Kepercayaan Lainnya', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>15],
            ['id'=>11,'kunci'=>'update_terakhir', 'label'=>'Update Terakhir', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>11],
            ['id'=>12,'kunci'=>'umur_0_4', 'label'=>'0 - 4 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>20],
            ['id'=>13,'kunci'=>'umur_5_9', 'label'=>'5 - 9 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>21],
            ['id'=>14,'kunci'=>'umur_10_14', 'label'=>'10 - 14 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>22],
            ['id'=>15,'kunci'=>'umur_15_19', 'label'=>'15 - 19 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>23],
            ['id'=>16,'kunci'=>'umur_20_24', 'label'=>'20 - 24 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>24],
            ['id'=>17,'kunci'=>'umur_25_29', 'label'=>'25 - 29 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>25],
            ['id'=>18,'kunci'=>'umur_30_34', 'label'=>'30 - 34 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>26],
            ['id'=>19,'kunci'=>'umur_35_39', 'label'=>'35 - 39 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>27],
            ['id'=>20,'kunci'=>'umur_40_44', 'label'=>'40 - 44 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>28],
            ['id'=>21,'kunci'=>'umur_45_49', 'label'=>'45 - 49 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>29],
            ['id'=>22,'kunci'=>'umur_50_54', 'label'=>'50 - 54 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>30],
            ['id'=>23,'kunci'=>'umur_55_59', 'label'=>'55 - 59 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>31],
            ['id'=>24,'kunci'=>'umur_60_64', 'label'=>'60 - 64 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>32],
            ['id'=>25,'kunci'=>'umur_65_69', 'label'=>'65 - 69 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>33],
            ['id'=>26,'kunci'=>'umur_70_74', 'label'=>'70 - 74 Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>34],
            ['id'=>27,'kunci'=>'umur_75_plus', 'label'=>'75+ Tahun', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>35],
            ['id'=>28,'kunci'=>'umur_0_4_l', 'label'=>'0 - 4 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>29,'kunci'=>'umur_0_4_p', 'label'=>'0 - 4 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>30,'kunci'=>'umur_5_9_l', 'label'=>'5 - 9 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>31,'kunci'=>'umur_5_9_p', 'label'=>'5 - 9 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>32,'kunci'=>'umur_10_14_l', 'label'=>'10 - 14 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>33,'kunci'=>'umur_10_14_p', 'label'=>'10 - 14 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>34,'kunci'=>'umur_15_19_l', 'label'=>'15 - 19 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>35,'kunci'=>'umur_15_19_p', 'label'=>'15 - 19 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>36,'kunci'=>'umur_20_24_l', 'label'=>'20 - 24 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>37,'kunci'=>'umur_20_24_p', 'label'=>'20 - 24 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>38,'kunci'=>'umur_25_29_l', 'label'=>'25 - 29 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>39,'kunci'=>'umur_25_29_p', 'label'=>'25 - 29 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>40,'kunci'=>'umur_30_34_l', 'label'=>'30 - 34 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>41,'kunci'=>'umur_30_34_p', 'label'=>'30 - 34 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>42,'kunci'=>'umur_35_39_l', 'label'=>'35 - 39 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>43,'kunci'=>'umur_35_39_p', 'label'=>'35 - 39 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>44,'kunci'=>'umur_40_44_l', 'label'=>'40 - 44 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>45,'kunci'=>'umur_40_44_p', 'label'=>'40 - 44 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>46,'kunci'=>'umur_45_49_l', 'label'=>'45 - 49 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>47,'kunci'=>'umur_45_49_p', 'label'=>'45 - 49 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>48,'kunci'=>'umur_50_54_l', 'label'=>'50 - 54 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>49,'kunci'=>'umur_50_54_p', 'label'=>'50 - 54 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>50,'kunci'=>'umur_55_59_l', 'label'=>'55 - 59 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>51,'kunci'=>'umur_55_59_p', 'label'=>'55 - 59 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>52,'kunci'=>'umur_60_64_l', 'label'=>'60 - 64 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>53,'kunci'=>'umur_60_64_p', 'label'=>'60 - 64 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>54,'kunci'=>'umur_65_69_l', 'label'=>'65 - 69 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>55,'kunci'=>'umur_65_69_p', 'label'=>'65 - 69 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>56,'kunci'=>'umur_70_74_l', 'label'=>'70 - 74 Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>57,'kunci'=>'umur_70_74_p', 'label'=>'70 - 74 Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>58,'kunci'=>'umur_75_plus_l', 'label'=>'75+ Tahun - Laki-laki', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>59,'kunci'=>'umur_75_plus_p', 'label'=>'75+ Tahun - Perempuan', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>0],
            ['id'=>60,'kunci'=>'jiwa_hindu', 'label'=>'Hindu', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>12],
            ['id'=>61,'kunci'=>'jiwa_buddha', 'label'=>'Buddha', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>13],
            ['id'=>62,'kunci'=>'jiwa_konghucu', 'label'=>'Konghucu', 'nilai'=>0, 'nilai_teks'=>null, 'urutan'=>14],
        ]);

        // ── 4. PENGATURAN ──────────────────────────────────────────
        DB::table('pengaturan')->insert([
            ['kunci' => 'kode_pos',        'nilai' => '42183'],
            ['kunci' => 'luas_wilayah',    'nilai' => '4.33'],
            ['kunci' => 'jumlah_penduduk', 'nilai' => '15.101'],
            ['kunci' => 'kecamatan',       'nilai' => 'Walantaka'],
            ['kunci' => 'kota',            'nilai' => 'Serang'],
            ['kunci' => 'provinsi',        'nilai' => 'Banten'],
        ]);

        $this->command->info('');
        $this->command->info('Seeder selesai!');
        $this->command->info('  Admin    : adminteritih / Password12345');
        $this->command->info('  Admin    : Admin1        / Password12345');
        $this->command->info('  Login    : http://127.0.0.1:8000/admin/login');
    }
}