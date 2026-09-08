<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('approval', function (Blueprint $table) {
            // Tambah kolom catatan jika belum ada
            if (!Schema::hasColumn('approval', 'catatan')) {
                $table->text('catatan')->nullable()->after('tanggal_approval');
            }

            // Tambah kolom tanggal_siap_diambil (kapan admin set siap diambil)
            if (!Schema::hasColumn('approval', 'tanggal_siap_diambil')) {
                $table->timestamp('tanggal_siap_diambil')->nullable()->after('catatan');
            }

            // Tambah kolom tanggal_selesai (kapan surat sudah diambil)
            if (!Schema::hasColumn('approval', 'tanggal_selesai')) {
                $table->timestamp('tanggal_selesai')->nullable()->after('tanggal_siap_diambil');
            }
        });

        // Kolom status adalah ENUM di MySQL — perlu ALTER untuk tambah nilai baru
        // Gunakan raw query agar kompatibel dengan semua versi MySQL
        DB::statement("ALTER TABLE `approval` MODIFY COLUMN `status` ENUM('pending','disetujui','ditolak','siap_diambil','selesai') NOT NULL DEFAULT 'pending'");
    }

    public function down(): void
    {
        // Kembalikan ENUM ke 3 nilai semula
        DB::statement("ALTER TABLE `approval` MODIFY COLUMN `status` ENUM('pending','disetujui','ditolak') NOT NULL DEFAULT 'pending'");

        Schema::table('approval', function (Blueprint $table) {
            $cols = ['catatan', 'tanggal_siap_diambil', 'tanggal_selesai'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('approval', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
