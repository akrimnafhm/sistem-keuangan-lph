<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelakuUsahaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordVerificationController;
use App\Http\Controllers\KonfigurasiBiayaController;
use App\Http\Controllers\PengaturanBiayaAuditController;

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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Routes accessible only after login
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Password verification AJAX route
    Route::post('/password/verify', [PasswordVerificationController::class, 'verify'])->name('password.verify');

    // --- Rute Pelaku Usaha (Untuk semua user yang login) ---
    // Pindahkan 'get-cities' ke sini karena 'create' dan 'edit' membutuhkannya
    Route::get('/get-cities', [PelakuUsahaController::class, 'getCities'])->name('get.cities');


    // --- Admin-specific routes ---
    Route::middleware('can:admin')->group(function () {
        
        // User management routes
        Route::resource('users', UserController::class); // Menggunakan resource lebih bersih
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        
        // Konfigurasi Biaya routes
        Route::get('alokasi-biaya', [KonfigurasiBiayaController::class, 'show'])->name('alokasi-biaya.show');
        Route::get('alokasi-biaya/edit', [KonfigurasiBiayaController::class, 'edit'])->name('alokasi-biaya.edit');
        Route::put('alokasi-biaya', [KonfigurasiBiayaController::class, 'update'])->name('alokasi-biaya.update');
        
        // Pengaturan Biaya Audit routes
        Route::get('pengaturan-biaya-audit', [PengaturanBiayaAuditController::class, 'index'])->name('pengaturan-biaya-audit.index');
        Route::get('pengaturan-biaya-audit/{province}/edit', [PengaturanBiayaAuditController::class, 'edit'])->name('pengaturan-biaya-audit.edit');
        Route::put('pengaturan-biaya-audit/{province}', [PengaturanBiayaAuditController::class, 'update'])->name('pengaturan-biaya-audit.update');

        // --- PERBAIKAN: ---
        // Pindahkan Route::resource ke dalam grup admin
        // Ini akan secara otomatis melindungi SEMUA 7 rute (index, create, store, show, edit, update, destroy)
        Route::resource('pelaku-usaha', PelakuUsahaController::class);
        
        // HAPUS RUTE MANUAL YANG DUPLIKAT DI BAWAH INI
        // Route::post('/pelaku-usaha', [PelakuUsahaController::class, 'store'])->name('pelaku-usaha.store');
        // Route::get('/pelaku-usaha/{pelakuUsaha}', [PelakuUsahaController::class, 'show'])->name('pelaku-usaha.show');
        // Route::get('/pelaku-usaha/{pelakuUsaha}/edit', [PelakuUsahaController::class, 'edit'])->name('pelaku-usaha.edit');
    });
});

require __DIR__.'/auth.php';