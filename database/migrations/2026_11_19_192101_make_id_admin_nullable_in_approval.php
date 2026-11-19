<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // FK id_admin sudah tidak ada, langsung modify nullable
        DB::statement('ALTER TABLE approval MODIFY id_admin INT UNSIGNED NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE approval MODIFY id_admin INT UNSIGNED NOT NULL');
    }
};
