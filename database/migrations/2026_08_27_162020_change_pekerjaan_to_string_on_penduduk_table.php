<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Revisi Bu Febri: opsi "Lainnya" pada Pekerjaan, dengan input manual.
     *
     * Kolom `pekerjaan` sebelumnya ENUM dengan daftar tetap, sehingga tidak
     * bisa menyimpan teks bebas. Diubah jadi VARCHAR(50) agar bisa menampung
     * pilihan manual dari opsi "Lainnya" di form, sambil tetap menyimpan
     * semua nilai lama apa adanya (nilai enum lama valid sebagai string).
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE penduduk MODIFY pekerjaan VARCHAR(50) NOT NULL DEFAULT 'Wiraswasta'");
    }

    public function down(): void
    {
        // Catatan: nilai custom hasil "Lainnya" yang tidak cocok dengan
        // daftar enum lama akan otomatis terpotong/ditolak MySQL saat rollback.
        DB::statement("ALTER TABLE penduduk MODIFY pekerjaan ENUM(
            'Belum Bekerja', 'Pelajar', 'Ibu Rumah Tangga', 'Wiraswasta',
            'Buruh Harian Lepas', 'Karyawan Swasta', 'Petani',
            'Karyawan Pemerintah', 'Pedagang Keliling', 'Pedagang Kelontong'
        ) NOT NULL DEFAULT 'Wiraswasta'");
    }
};