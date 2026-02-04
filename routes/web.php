<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelakuUsahaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordVerificationController;
use App\Http\Controllers\KonfigurasiBiayaController;
use App\Http\Controllers\PengaturanBiayaAuditController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\RekapitulasiBiayaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root URL to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard route (requires authentication)
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Routes accessible only after login
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Password verification AJAX route
    Route::post('/password/verify', [PasswordVerificationController::class, 'verify'])->name('password.verify');

    // --- Rute Pelaku Usaha ---
    Route::get('/get-cities', [PelakuUsahaController::class, 'getCities'])->name('get.cities');

    // --- Admin-specific routes ---
    Route::middleware('can:admin')->group(function () {
        // User management routes
        Route::resource('users', UserController::class);
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');

        // Konfigurasi Biaya routes
        Route::get('alokasi-biaya', [KonfigurasiBiayaController::class, 'show'])->name('alokasi-biaya.show');
        Route::get('alokasi-biaya/edit', [KonfigurasiBiayaController::class, 'edit'])->name('alokasi-biaya.edit');
        Route::put('alokasi-biaya', [KonfigurasiBiayaController::class, 'update'])->name('alokasi-biaya.update');

        // Pengaturan Biaya Audit routes
        Route::get('pengaturan-biaya-audit', [PengaturanBiayaAuditController::class, 'index'])->name('pengaturan-biaya-audit.index');
        Route::get('pengaturan-biaya-audit/{province}/edit', [PengaturanBiayaAuditController::class, 'edit'])->middleware('password.confirm')->name('pengaturan-biaya-audit.edit');
        Route::put('pengaturan-biaya-audit/{province}', [PengaturanBiayaAuditController::class, 'update'])->middleware('password.confirm')->name('pengaturan-biaya-audit.update');
    });

    // --- Resources accessible to authenticated users ---

    // 1. Pelaku Usaha
    Route::resource('pelaku-usaha', PelakuUsahaController::class);

    // 2. Rekapitulasi Biaya (INI YANG TADI KURANG)
    Route::resource('rekapitulasi', RekapitulasiBiayaController::class);

    // 3. Auditors (Sebaiknya di dalam auth agar aman)
    Route::resource('auditors', AuditorController::class);

    Route::prefix('rekapitulasi')->group(function () {
        Route::get('/', [RekapitulasiBiayaController::class, 'index'])->name('rekapitulasi.index');
        Route::get('/create', [RekapitulasiBiayaController::class, 'create'])->name('rekapitulasi.create');
        Route::post('/', [RekapitulasiBiayaController::class, 'store'])->name('rekapitulasi.store');
        Route::get('/{id}/edit', [RekapitulasiBiayaController::class, 'edit'])->name('rekapitulasi.edit');
        Route::put('/{id}', [RekapitulasiBiayaController::class, 'update'])->name('rekapitulasi.update');
        Route::get('/{id}/pdf', [RekapitulasiBiayaController::class, 'downloadPdf'])->name('rekapitulasi.pdf');
        Route::get('/{id}', [RekapitulasiBiayaController::class, 'show'])->name('rekapitulasi.show');
    });

});

require __DIR__ . '/auth.php';