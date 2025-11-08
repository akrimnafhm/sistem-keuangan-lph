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
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Redirect root URL to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard route (requires authentication)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); // 'verified' middleware removed if email verification is not needed

// Routes accessible only after login
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pelaku Usaha routes
    Route::resource('pelaku-usaha', PelakuUsahaController::class);
    Route::get('/get-cities', [PelakuUsahaController::class, 'getCities'])->name('get.cities');

    // Password verification AJAX route
    Route::post('/password/verify', [PasswordVerificationController::class, 'verify'])->name('password.verify');

    // Admin-specific routes
    Route::middleware('can:admin')->group(function () {
        // User management routes
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::get('alokasi-biaya', [KonfigurasiBiayaController::class, 'show'])->name('alokasi-biaya.show');
        Route::get('alokasi-biaya/edit', [KonfigurasiBiayaController::class, 'edit'])->name('alokasi-biaya.edit');
        Route::put('alokasi-biaya', [KonfigurasiBiayaController::class, 'update'])->name('alokasi-biaya.update');
        Route::get('pengaturan-biaya-audit', [PengaturanBiayaAuditController::class, 'index'])->name('pengaturan-biaya-audit.index');
        Route::get('pengaturan-biaya-audit/{wilayah}/edit', [PengaturanBiayaAuditController::class, 'edit'])->name('pengaturan-biaya-audit.edit');
        Route::put('pengaturan-biaya-audit/{wilayah}', [PengaturanBiayaAuditController::class, 'update'])->name('pengaturan-biaya-audit.update');

        // Route Pengaturan Wilayah (masih di-comment)
        // Route::resource('pengaturan-wilayah', WilayahController::class)->except(['create', 'store', 'destroy']);
    });
});

require __DIR__.'/auth.php';