<?php

use App\Http\Controllers\Admin\NotifikasiController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JenisSuratController;
use App\Http\Controllers\Admin\PermohonanController;
use App\Http\Controllers\Admin\InformasiKelurahanController;
use App\Http\Controllers\Admin\KependudukanController;
use App\Http\Controllers\User\PermohonanUserController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// =========================================================
// PUBLIC ROUTES — tidak perlu login
// =========================================================
Route::get('/',                 [PublicController::class, 'home'])        ->name('home');
Route::get('/profil',           fn () => view('profil'))                  ->name('profil');
Route::get('/layanan',          fn () => view('layanan'))                 ->name('layanan');
Route::get('/informasi',        [PublicController::class, 'informasi'])   ->name('informasi');
Route::get('/informasi/berita', [PublicController::class, 'berita'])      ->name('informasi.berita');
Route::get('/informasi/berita/{slug}', [PublicController::class, 'detailBerita'])->name('informasi.berita.detail');
Route::get('/kontak',           fn () => view('kontak'))                  ->name('kontak');

// =========================================================
// ADMIN AREA
// =========================================================
Route::prefix('admin')->group(function () {

    Route::get('/login',  [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {

        // Notifikasi (polling API)
        Route::get('notifikasi',            [NotifikasiController::class, 'index'])   ->name('admin.notifikasi');
        Route::post('notifikasi/mark-read', [NotifikasiController::class, 'markRead'])->name('admin.notifikasi.read');

        // Statistik Demografi
        Route::get('statistik-demografi',  [StatistikController::class, 'edit'])  ->name('admin.statistik.edit');
        Route::put('statistik-demografi',  [StatistikController::class, 'update'])->name('admin.statistik.update');

        // ✅ Dashboard sekarang pakai controller agar bisa kirim data ke view
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::resource('jenis-surat', JenisSuratController::class);

        Route::get('permohonan',              [PermohonanController::class, 'index'])  ->name('permohonan.index');
        Route::get('permohonan/{id}',         [PermohonanController::class, 'show'])   ->name('permohonan.show');
        Route::put('permohonan/{id}/approve', [PermohonanController::class, 'approve'])->name('permohonan.approve');
        Route::put('permohonan/{id}/reject',  [PermohonanController::class, 'reject']) ->name('permohonan.reject');
        Route::get('/permohonan/{id}/print',  [PermohonanController::class, 'print'])  ->name('permohonan.print');
        Route::post('/upload-ttd',            [PermohonanController::class, 'uploadTtd'])->name('admin.upload-ttd');

        Route::resource('informasi-admin', InformasiKelurahanController::class);

        // Kependudukan
        Route::get('kependudukan',                 [KependudukanController::class, 'index'])       ->name('kependudukan.index');
        Route::post('kependudukan',                [KependudukanController::class, 'store'])       ->name('kependudukan.store');
        Route::get('kependudukan/{id}',            [KependudukanController::class, 'show'])        ->name('kependudukan.show');
        Route::patch('kependudukan/{id}/toggle',   [KependudukanController::class, 'toggleStatus'])->name('kependudukan.toggle');
        Route::delete('kependudukan/{id}',         [KependudukanController::class, 'destroy'])     ->name('kependudukan.destroy');
    });
});

// =========================================================
// USER AREA — wajib login (permohonan & profil)
// =========================================================
Route::middleware('auth')->group(function () {

    Route::prefix('user')->name('user.')->group(function () {
        Route::resource('permohonan', PermohonanUserController::class);
    });

    Route::get('/profile',  [ProfileController::class, 'edit'])  ->name('profile.edit');
    Route::put('/profile',  [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';