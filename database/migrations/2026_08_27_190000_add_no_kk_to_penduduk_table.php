<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom no_kk (Nomor Kartu Keluarga) ke tabel penduduk.
     * Nullable karena data lama (dummy) belum punya no_kk.
     * Format: 16 digit angka, sama seperti NIK.
     */
    public function up(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->string('no_kk', 16)->nullable()->after('nik');
            $table->index('no_kk');
        });
    }

    public function down(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropIndex(['no_kk']);
            $table->dropColumn('no_kk');
        });
    }
};
