<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->id();
            $table->string('kunci')->unique()->comment('Key unik pengaturan');
            $table->text('nilai')->nullable()->comment('Nilai pengaturan');
        });

        // Seed data awal data singkat kelurahan
        DB::table('pengaturan')->insert([
            ['kunci' => 'kode_pos',        'nilai' => '42183'],
            ['kunci' => 'luas_wilayah',    'nilai' => '2.54'],
            ['kunci' => 'jumlah_penduduk', 'nilai' => '4.520'],
            ['kunci' => 'kecamatan',       'nilai' => 'Walantaka'],
            ['kunci' => 'kota',            'nilai' => 'Serang'],
            ['kunci' => 'provinsi',        'nilai' => 'Banten'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan');
    }
};