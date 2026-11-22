<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('ALTER TABLE approval DROP FOREIGN KEY approval_id_admin_fkey');
        DB::statement('ALTER TABLE approval MODIFY id_admin INT NULL');
        DB::statement('ALTER TABLE approval ADD CONSTRAINT approval_id_admin_fkey FOREIGN KEY (id_admin) REFERENCES admin (id_admin) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE approval DROP FOREIGN KEY approval_id_admin_fkey');
        DB::statement('ALTER TABLE approval MODIFY id_admin INT NOT NULL');
        DB::statement('ALTER TABLE approval ADD CONSTRAINT approval_id_admin_fkey FOREIGN KEY (id_admin) REFERENCES admin (id_admin) ON DELETE CASCADE ON UPDATE CASCADE');
    }
};
