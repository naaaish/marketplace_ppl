<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController; // Pastikan ini di-import
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Hanya bisa diakses setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup Rute yang MEMERLUKAN LOGIN
Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Area Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
});

// =================================================================
// RUTE REGISTER TOKO (Form Cantik 14 Data)
// =================================================================
// Taruh DI LUAR middleware 'auth' jika ingin tamu bisa daftar
Route::get('/register-seller', [SellerRegistrationController::class, 'create'])->name('seller.register');
Route::post('/register-seller', [SellerRegistrationController::class, 'store'])->name('seller.store');

// Timpa rute register bawaan agar mengarah ke form toko juga (Opsional)
Route::get('/register', [SellerRegistrationController::class, 'create'])->name('register');
Route::post('/register', [SellerRegistrationController::class, 'store']);


// =================================================================
// RUTE LOGIN & LOGOUT & AKTIVASI (MANUAL via AuthController)
// =================================================================

// Perhatikan: Di sini kita pakai 'showLogin', BUKAN 'loginView'
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Aktivasi Akun (Dari Link Email)
Route::get('/activate-account/{token}', [AuthController::class, 'showActivationForm'])->name('activation.form');
Route::post('/activate-account', [AuthController::class, 'activate'])->name('activation.process');

// Matikan auth.php bawaan Breeze agar tidak bentrok
// require __DIR__.'/auth.php';