<?php

use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\NotifikasiController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JenisSuratController;
use App\Http\Controllers\Admin\PermohonanController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\KelolaAkunController;
use App\Http\Controllers\User\PermohonanUserController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Route;

// =========================================================
// PUBLIC ROUTES — tidak perlu login
// =========================================================
Route::get('/',                 [PublicController::class, 'home'])        ->name('home');
Route::get('/profil',           [ProfilController::class, 'index'])       ->name('profil');
Route::get('/layanan',          fn () => view('layanan'))                 ->name('layanan');
Route::get('/demografi',        [PublicController::class, 'demografi'])   ->name('demografi');
Route::get('/berita',           [PublicController::class, 'berita'])      ->name('berita');
Route::get('/berita/{slug}',    [PublicController::class, 'detailBerita'])->name('berita.detail');

// Backward compat — redirect URL lama
Route::redirect('/informasi',         '/demografi', 301);
Route::redirect('/informasi/berita',  '/berita',    301);

// Chatbot AI
Route::post('/api/chatbot/ask', [ChatbotController::class, 'ask'])->name('chatbot.ask');

// =========================================================
// ADMIN AREA
// =========================================================
Route::prefix('admin')->group(function () {
    
    Route::get('/', fn () => redirect()->route('admin.login'));

    Route::get('/login',  [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);

    Route::middleware('auth.admin')->group(function () {

        // Notifikasi
        Route::get('notifikasi',            [NotifikasiController::class, 'index'])   ->name('admin.notifikasi');
        Route::post('notifikasi/mark-read', [NotifikasiController::class, 'markRead'])->name('admin.notifikasi.read');

        // Statistik Demografi
        Route::get('statistik-demografi',  [StatistikController::class, 'edit'])  ->name('admin.statistik.edit');
        Route::put('statistik-demografi',  [StatistikController::class, 'update'])->name('admin.statistik.update');

        // Dashboard
        Route::get('/dashboard',                    [DashboardController::class, 'index'])           ->name('admin.dashboard');
        Route::get('/dashboard/permohonan-bulan',   [DashboardController::class, 'permohonanBulan']) ->name('admin.dashboard.permohonan-bulan');
        Route::post('/logout',                      [AdminLoginController::class, 'logout'])          ->name('admin.logout');
        Route::get('/ganti-password',               [AdminLoginController::class, 'showChangePassword'])->name('admin.password.form');
        Route::post('/ganti-password',              [AdminLoginController::class, 'changePassword'])   ->name('admin.password.update');

        Route::resource('jenis-surat', JenisSuratController::class);

        // Permohonan Admin
        Route::get( 'permohonan',                 [PermohonanController::class, 'index'])           ->name('permohonan.index');
        Route::get( 'permohonan/{id}',            [PermohonanController::class, 'show'])            ->name('permohonan.show');
        Route::put( 'permohonan/{id}/approve',    [PermohonanController::class, 'approve'])         ->name('permohonan.approve');
        Route::put( 'permohonan/{id}/reject',     [PermohonanController::class, 'reject'])          ->name('permohonan.reject');
        Route::put( 'permohonan/{id}/update-data',[PermohonanController::class, 'updateData'])      ->name('permohonan.updateData');
        Route::put( 'permohonan/{id}/keterangan', [PermohonanController::class, 'updateKeterangan'])->name('permohonan.keterangan');
        Route::get( 'permohonan/{id}/print',      [PermohonanController::class, 'print'])           ->name('permohonan.print');

        Route::resource('berita-admin', BeritaController::class)->except(['show']);

        // Kelola Akun Masyarakat
        Route::get(   'kelola-akun',               [KelolaAkunController::class, 'index'])        ->name('kelola-akun.index');
        Route::post(  'kelola-akun',               [KelolaAkunController::class, 'store'])        ->name('kelola-akun.store');
        Route::get(   'kelola-akun-export',        [KelolaAkunController::class, 'export'])       ->name('kelola-akun.export');
        Route::get(   'kelola-akun/{id}',          [KelolaAkunController::class, 'show'])         ->name('kelola-akun.show');
        Route::patch( 'kelola-akun/{id}/toggle',   [KelolaAkunController::class, 'toggleStatus']) ->name('kelola-akun.toggle');
        Route::patch( 'kelola-akun/{id}/password', [KelolaAkunController::class, 'resetPassword'])->name('kelola-akun.reset-password');
        Route::delete('kelola-akun/{id}',          [KelolaAkunController::class, 'destroy'])      ->name('kelola-akun.destroy');

        // Master Data
        Route::get('master-data', fn() => view('Admin.master-data.index'))->name('admin.master-data');

        // Pengaturan
        Route::get( 'pengaturan', [PengaturanController::class, 'edit'])  ->name('admin.pengaturan.edit');
        Route::put( 'pengaturan', [PengaturanController::class, 'update'])->name('admin.pengaturan.update');
    });
});

// =========================================================
// USER AREA — wajib login
// =========================================================
Route::middleware('auth')->group(function () {

    Route::prefix('user')->name('user.')->group(function () {

        // route form/{slug} harus di atas route {id}
        Route::get( 'permohonan/form/{slug}', [PermohonanUserController::class, 'form'])       ->name('permohonan.form');
        Route::post('permohonan/form/{slug}', [PermohonanUserController::class, 'storeSurat']) ->name('permohonan.store.surat');

        Route::get(   'permohonan',        [PermohonanUserController::class, 'index'])   ->name('permohonan.index');
        Route::get(   'permohonan/{id}',   [PermohonanUserController::class, 'show'])    ->name('permohonan.show');
        Route::delete('permohonan/{id}',   [PermohonanUserController::class, 'destroy']) ->name('permohonan.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])  ->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';