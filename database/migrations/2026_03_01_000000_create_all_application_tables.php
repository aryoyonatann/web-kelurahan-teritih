<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration dokumentasi — mencerminkan struktur database asli
 * yang dibuat manual di MySQL.
 *
 * PERHATIAN: File ini HANYA untuk dokumentasi dan setup environment baru.
 * Jangan jalankan php artisan migrate di environment yang sudah ada datanya.
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── 1. ADMIN ──────────────────────────────────────────────────────────
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id_admin');
            $table->string('nama_admin', 100);
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('remember_token', 100)->nullable();
        });

        // ── 2. USERS (masyarakat) ─────────────────────────────────────────────
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('nama', 100);
            $table->string('nik', 20)->unique();
            $table->text('alamat');
            $table->string('no_hp', 15);
            $table->string('email', 255)->nullable()->unique();
            $table->string('tempat_lahir', 255)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('rt', 10)->nullable();
            $table->string('rw', 10)->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('password', 255);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->enum('status', ['aktif', 'blokir'])->default('aktif');
            $table->dateTime('last_login_at')->nullable();
        });

        // ── 3. PENGATURAN ─────────────────────────────────────────────────────
        Schema::create('pengaturan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kunci', 255)->unique();
            $table->text('nilai')->nullable();
        });

        // ── 4. JENIS SURAT ────────────────────────────────────────────────────
        Schema::create('jenis_surat', function (Blueprint $table) {
            $table->increments('id_jenis_surat');
            $table->string('nama_surat', 100);
            $table->string('slug', 50)->nullable()->unique();
            $table->tinyInteger('is_custom')->default(0);
            $table->char('template', 1)->nullable();
            $table->json('field_config')->nullable();   // kolom lama (legacy)
            $table->string('icon', 50)->nullable();
            $table->string('warna', 20)->nullable();
            $table->tinyInteger('aktif')->nullable()->default(1);
            $table->string('deskripsi', 255)->nullable();
            $table->string('kode_klasifikasi', 20)->nullable();
            $table->string('kode_surat', 20)->nullable();
            $table->text('template_pembuka')->nullable();
            $table->text('template_isi')->nullable();
            $table->text('template_penutup')->nullable();
            $table->json('fields_config')->nullable();  // kolom baru (aktif dipakai)
        });

        // ── 5. PERMOHONAN SURAT ───────────────────────────────────────────────
        Schema::create('permohonan_surat', function (Blueprint $table) {
            $table->increments('id_permohonan');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_jenis_surat');
            $table->string('nama_pemohon', 255)->nullable();
            $table->string('nik_pemohon', 20)->nullable();
            $table->text('alamat_pemohon')->nullable();
            $table->dateTime('tanggal_pengajuan');
            $table->text('keperluan');
            $table->json('data_tambahan')->nullable();
            $table->text('keterangan_admin')->nullable();
            $table->string('nomor_surat', 100)->nullable();

            $table->foreign('id_user')
                  ->references('id_user')->on('users')
                  ->onDelete('cascade');

            $table->foreign('id_jenis_surat')
                  ->references('id_jenis_surat')->on('jenis_surat')
                  ->onDelete('restrict');
        });

        // ── 6. PERSYARATAN (dokumen upload) ───────────────────────────────────
        Schema::create('persyaratan', function (Blueprint $table) {
            $table->increments('id_persyaratan');
            $table->unsignedInteger('id_permohonan');
            $table->string('nama_file', 255);
            $table->string('jenis_dokumen', 50)->nullable();
            $table->string('path_file', 255);
            $table->dateTime('uploaded_at');

            $table->foreign('id_permohonan')
                  ->references('id_permohonan')->on('permohonan_surat')
                  ->onDelete('cascade');
        });

        // ── 7. APPROVAL ───────────────────────────────────────────────────────
        Schema::create('approval', function (Blueprint $table) {
            $table->increments('id_approval');
            $table->unsignedInteger('id_permohonan');
            $table->unsignedInteger('id_admin');
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'siap_diambil', 'selesai'])
                  ->default('pending');
            $table->dateTime('tanggal_approval');
            $table->text('catatan')->nullable();
            $table->timestamp('tanggal_siap_diambil')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();

            $table->foreign('id_permohonan')
                  ->references('id_permohonan')->on('permohonan_surat')
                  ->onDelete('cascade');

            $table->foreign('id_admin')
                  ->references('id_admin')->on('admin')
                  ->onDelete('restrict');
        });

        // ── 8. BERITA ─────────────────────────────────────────────────────────
        Schema::create('berita', function (Blueprint $table) {
            $table->increments('id_berita');
            $table->string('judul', 255);
            $table->string('slug', 300)->nullable()->unique();
            $table->string('kategori', 100);
            $table->text('isi');
            $table->text('ringkasan')->nullable();
            $table->dateTime('tanggal_publish')->nullable();
            $table->unsignedInteger('id_admin')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->string('gambar', 255)->nullable();
            $table->integer('views')->default(0);

            $table->foreign('id_admin')
                  ->references('id_admin')->on('admin')
                  ->onDelete('set null');
        });

        // ── 9. PENDUDUK ───────────────────────────────────────────────────────
        Schema::create('penduduk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nik', 16)->unique();
            $table->string('no_kk', 16)->nullable()->index();
            $table->string('nama', 150);
            $table->enum('jenis_kelamin', ['L', 'P'])->index();
            $table->date('tanggal_lahir');
            $table->enum('agama', [
                'Islam', 'Kristen Protestan', 'Katolik',
                'Hindu', 'Buddha', 'Konghucu', 'Kepercayaan Lainnya',
            ])->default('Islam')->index();
            $table->enum('status_kawin', ['Belum Kawin', 'Kawin', 'Janda/Duda'])
                  ->default('Belum Kawin');
            $table->enum('pendidikan', [
                'Belum Sekolah (PAUD/TK)', 'Sedang Sekolah (7-18 Thn)',
                'Tidak Tamat/Lainnya', 'SD/Sederajat', 'SMP/Sederajat',
                'SMA/Sederajat', 'Diploma (D1-D3)', 'Sarjana (S1)', 'Pascasarjana (S2/S3)',
            ])->default('SMA/Sederajat');
            $table->string('pekerjaan', 50)->default('Wiraswasta');
            $table->enum('hubungan_keluarga', ['Kepala Keluarga', 'Istri', 'Anak Kandung', 'Ibu'])
                  ->default('Anak Kandung');
            $table->string('rt', 10)->index();
            $table->string('rw', 10)->index();
            $table->string('alamat', 255)->nullable();
            $table->smallInteger('tahun_data')->default(2026)->index();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        // ── 10. STATISTIK DEMOGRAFI ───────────────────────────────────────────
        Schema::create('statistik_demografi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kunci', 100)->unique();
            $table->string('label', 200);
            $table->bigInteger('nilai')->default(0);
            $table->string('nilai_teks', 255)->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    public function down(): void
    {
        // Urutan drop harus kebalikan dari create (foreign key constraint)
        Schema::dropIfExists('statistik_demografi');
        Schema::dropIfExists('penduduk');
        Schema::dropIfExists('berita');
        Schema::dropIfExists('approval');
        Schema::dropIfExists('persyaratan');
        Schema::dropIfExists('permohonan_surat');
        Schema::dropIfExists('jenis_surat');
        Schema::dropIfExists('pengaturan');
        Schema::dropIfExists('users');
        Schema::dropIfExists('admin');
    }
};
