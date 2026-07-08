<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Kolom `username` tidak lagi dipakai — login masyarakat hanya
     * menggunakan NIK atau email (lihat LoginRequest::authenticate()).
     * Menggunakan raw SQL supaya tidak butuh package doctrine/dbal,
     * dan drop UNIQUE index-nya dulu (kalau ada) sebelum drop kolomnya.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'username')) {
            return;
        }

        // Cari nama index unique pada kolom username, lalu hapus dulu
        // (nama index bisa beda-beda tergantung cara tabel dibuat).
        $indexes = DB::select("SHOW INDEX FROM `users` WHERE Column_name = 'username'");
        foreach ($indexes as $idx) {
            if ($idx->Key_name !== 'PRIMARY') {
                DB::statement("ALTER TABLE `users` DROP INDEX `{$idx->Key_name}`");
            }
        }

        DB::statement('ALTER TABLE `users` DROP COLUMN `username`');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('users', 'username')) {
            DB::statement('ALTER TABLE `users` ADD COLUMN `username` VARCHAR(50) NULL AFTER `email`');
            DB::statement('ALTER TABLE `users` ADD UNIQUE `users_username_unique` (`username`)');
        }
    }
};