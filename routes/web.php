<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelakuUsahaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordVerificationController; // Jangan lupa import ini

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
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password'); // Route reset password user

        // Route Pengaturan Wilayah (masih di-comment)
        // Route::resource('pengaturan-wilayah', WilayahController::class)->except(['create', 'store', 'destroy']);
    });
});

require __DIR__.'/auth.php';