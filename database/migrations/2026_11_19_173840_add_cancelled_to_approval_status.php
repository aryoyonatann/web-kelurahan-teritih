<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE approval MODIFY COLUMN status ENUM('pending','disetujui','ditolak','siap_diambil','selesai','cancelled') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE approval MODIFY COLUMN status ENUM('pending','disetujui','ditolak','siap_diambil','selesai') NOT NULL DEFAULT 'pending'");
    }
};
