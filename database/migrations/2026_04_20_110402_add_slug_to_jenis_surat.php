<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jenis_surat', function (Blueprint $table) {
            $table->string('slug', 60)->nullable()->unique()->after('nama_surat');
            $table->boolean('is_custom')->default(false)->after('slug');
            // is_custom = false → surat bawaan (punya form khusus)
            // is_custom = true  → surat tambahan admin (pakai form generik)
        });

        // Isi slug untuk 5 surat bawaan yang sudah ada
        DB::table('jenis_surat')->where('id_jenis_surat', 1)->update(['slug' => 'sktm',        'is_custom' => false]);
        DB::table('jenis_surat')->where('id_jenis_surat', 2)->update(['slug' => 'kematian',    'is_custom' => false]);
        DB::table('jenis_surat')->where('id_jenis_surat', 3)->update(['slug' => 'suami-istri', 'is_custom' => false]);
        DB::table('jenis_surat')->where('id_jenis_surat', 4)->update(['slug' => 'beda-nama',   'is_custom' => false]);
        DB::table('jenis_surat')->where('id_jenis_surat', 5)->update(['slug' => 'izin-cuti',   'is_custom' => false]);
    }

    public function down(): void
    {
        Schema::table('jenis_surat', function (Blueprint $table) {
            $table->dropColumn(['slug', 'is_custom']);
        });
    }
};