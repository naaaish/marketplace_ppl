<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Route untuk AJAX Unique Check
Route::post('/check-unique', [SellerRegistrationController::class, 'checkUnique'])->name('check.unique');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // === AREA ADMIN ===
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/sellers', [AdminController::class, 'sellers'])->name('admin.sellers');
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
    
    // Update produk yang sudah ada
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    
    // Hapus produk
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Register Toko
Route::get('/register-seller', [SellerRegistrationController::class, 'create'])->name('seller.register');
Route::post('/register-seller', [SellerRegistrationController::class, 'store'])->name('seller.store');

// Login & Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/admin/report/status', [ReportController::class, 'reportSellersStatus'])->name('report.status');
Route::get('/admin/report/province', [ReportController::class, 'reportSellersProvince'])->name('report.province');

// Activation Account (Public)
Route::get('/activate-account/{token}', [AuthController::class, 'showActivationForm'])->name('activation.form');
Route::post('/activate-account', [AuthController::class, 'activate'])->name('activation.process');

Route::get('/homepage', function () {
    return view('homepage');
});