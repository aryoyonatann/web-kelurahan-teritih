<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// DIPERBAIKI: migration lama hanya punya id & timestamps
// Sekarang langsung dibuat dengan kolom lengkap
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informasi_kelurahan', function (Blueprint $table) {
            $table->integer('id_informasi')->autoIncrement();
            $table->string('judul', 255);
            $table->string('slug', 300)->nullable()->unique();
            $table->string('kategori', 100);
            $table->text('isi');
            $table->text('ringkasan')->nullable();
            $table->dateTime('tanggal_publish')->nullable();
            $table->integer('id_admin')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->string('gambar', 255)->nullable();
            $table->integer('views')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_kelurahan');
    }
};