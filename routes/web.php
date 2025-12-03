<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

// Grup Rute yang MEMERLUKAN LOGIN (Profile & Admin)
Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === AREA ADMIN ===
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // [TAMBAHKAN INI] Agar tombol 'Lihat Detail' berfungsi
    Route::get('/admin/seller/{id}', [AdminController::class, 'show'])->name('admin.show');

    Route::post('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/reject/{id}', [AdminController::class, 'reject'])->name('admin.reject');
    
    // [FIX] Tambahkan Rute Reject ini supaya tidak error
    Route::post('/admin/reject/{id}', [AdminController::class, 'reject'])->name('admin.reject');

    // === AREA PRODUCTS (Seller) ===
    // Route::resource('products', ProductController::class);
    // Daftar semua produk seller
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    
    // Form tambah produk baru
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    
    // Simpan produk baru ke database
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    
    // Lihat detail 1 produk
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    
    // Form edit produk
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    
    // Update produk yang sudah ada
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    
    // Hapus produk
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// =================================================================
// RUTE REGISTER TOKO
// =================================================================
Route::get('/register-seller', [SellerRegistrationController::class, 'create'])->name('seller.register');
// Ini "Mesin" penyimpanannya:
Route::post('/register-seller', [SellerRegistrationController::class, 'store'])->name('seller.store');


// =================================================================
// RUTE LOGIN & LOGOUT & AKTIVASI
// =================================================================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process'); // pastikan nama route ini sama dgn di form login
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Aktivasi Akun (Dari Link Email)
Route::get('/activate-account/{token}', [AuthController::class, 'showActivationForm'])->name('activation.form');
Route::post('/activate-account', [AuthController::class, 'activate'])->name('activation.process');

// Halaman Homepage setelah login
Route::get('/homepage', function () {
    return view('homepage');
});