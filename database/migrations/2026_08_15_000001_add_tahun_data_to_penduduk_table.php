<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            // Tahun data warga diinput — default tahun berjalan
            // Dipakai untuk hitung pertumbuhan penduduk per tahun secara otomatis
            $table->smallInteger('tahun_data')
                  ->default((int) date('Y'))
                  ->after('alamat')
                  ->index();
        });

        // Isi nilai default untuk data yang sudah ada: pakai tahun berjalan
        \Illuminate\Support\Facades\DB::table('penduduk')
            ->whereNull('tahun_data')
            ->orWhere('tahun_data', 0)
            ->update(['tahun_data' => (int) date('Y')]);
    }

    public function down(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropIndex(['tahun_data']);
            $table->dropColumn('tahun_data');
        });
    }
};
