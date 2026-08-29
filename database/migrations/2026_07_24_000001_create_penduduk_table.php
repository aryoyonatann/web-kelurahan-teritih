<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->nullable()->unique();
            $table->string('nama', 150);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->enum('agama', [
                'Islam', 'Kristen Protestan', 'Katolik', 'Hindu',
                'Buddha', 'Konghucu', 'Kepercayaan Lainnya',
            ])->default('Islam');
            $table->enum('status_kawin', ['Belum Kawin', 'Kawin', 'Janda/Duda'])->default('Belum Kawin');
            $table->enum('pendidikan', [
                'Belum Sekolah (PAUD/TK)', 'Sedang Sekolah (7-18 Thn)', 'Tidak Tamat/Lainnya',
                'SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat',
                'Diploma (D1-D3)', 'Sarjana (S1)', 'Pascasarjana (S2/S3)',
            ])->default('SMA/Sederajat');
            $table->string('pekerjaan', 50)->default('Wiraswasta');
            $table->enum('hubungan_keluarga', ['Kepala Keluarga', 'Istri', 'Anak Kandung', 'Ibu'])->default('Anak Kandung');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->string('alamat')->nullable();
            $table->timestamps();

            $table->index('jenis_kelamin');
            $table->index('agama');
            $table->index('rt');
            $table->index('rw');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penduduk');
    }
};
