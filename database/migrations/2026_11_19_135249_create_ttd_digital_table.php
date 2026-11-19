<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ttd_digital', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 100);
            $table->string('nip', 30)->nullable();
            $table->string('jabatan', 100);
            $table->text('ttd_data')->nullable();   // base64 dari canvas
            $table->string('ttd_path', 255)->nullable(); // path file upload
            $table->tinyInteger('is_aktif')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ttd_digital');
    }
};
