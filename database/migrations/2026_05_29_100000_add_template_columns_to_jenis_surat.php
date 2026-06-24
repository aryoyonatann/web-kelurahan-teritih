<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jenis_surat', function (Blueprint $table) {
            $table->string('kode_klasifikasi', 20)->nullable()->after('deskripsi');
            $table->string('kode_surat', 20)->nullable()->after('kode_klasifikasi');
            $table->text('template_pembuka')->nullable()->after('kode_surat');
            $table->text('template_isi')->nullable()->after('template_pembuka');
            $table->text('template_penutup')->nullable()->after('template_isi');
            $table->jsonb('fields_config')->nullable()->after('template_penutup');
        });
    }

    public function down(): void
    {
        Schema::table('jenis_surat', function (Blueprint $table) {
            $table->dropColumn(['kode_klasifikasi', 'kode_surat', 'template_pembuka', 'template_isi', 'template_penutup', 'fields_config']);
        });
    }
};
