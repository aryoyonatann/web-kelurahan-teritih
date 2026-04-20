<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jenis_surat', function (Blueprint $table) {
            // Template: 'A' = Keterangan Biasa, 'B' = Data Khusus, 'C' = Dua Pihak
            $table->char('template', 1)->nullable()->after('is_custom');
            // field_config: JSON array konfigurasi field tambahan
            $table->json('field_config')->nullable()->after('template');
        });
    }

    public function down(): void
    {
        Schema::table('jenis_surat', function (Blueprint $table) {
            $table->dropColumn(['template', 'field_config']);
        });
    }
};