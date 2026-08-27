<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Revisi Bu Febri: NIK warga tidak boleh lagi opsional.
     *
     * Kolom `nik` sebelumnya nullable+unique. Sebelum diubah jadi NOT NULL,
     * migration ini mengecek dulu apakah masih ada data lama yang NIK-nya
     * kosong — kalau ada, migration akan berhenti dengan pesan yang jelas
     * supaya datanya dibereskan manual dulu (isi NIK atau hapus baris),
     * daripada gagal diam-diam atau memaksa isi nilai NIK palsu.
     */
    public function up(): void
    {
        $kosong = DB::table('penduduk')->whereNull('nik')->count();

        if ($kosong > 0) {
            throw new \RuntimeException(
                "Migration dibatalkan: masih ada {$kosong} data warga dengan NIK kosong. " .
                "Lengkapi atau hapus data tersebut dulu sebelum menjalankan migration ini, " .
                "karena kolom nik akan diubah menjadi wajib diisi (NOT NULL)."
            );
        }

        DB::statement('ALTER TABLE penduduk MODIFY nik VARCHAR(16) NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE penduduk MODIFY nik VARCHAR(16) NULL');
    }
};