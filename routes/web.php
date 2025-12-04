<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', function () {
    return view('homepage');
});

// Route untuk AJAX Unique Check
Route::post('/check-unique', [SellerRegistrationController::class, 'checkUnique'])->name('check.unique');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        
        // Cek Role User yang sedang login
        if (Auth::user()->role === 'admin') {
            // Jika Admin, pindah ke Dashboard Admin
            return redirect()->route('admin.dashboard');
        }

        // Jika Seller, boleh buka Dashboard biasa
        return view('seller.dashboard');
        
    })->middleware(['verified'])->name('dashboard');

    // Profile User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | AREA ADMIN
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/sellers', [AdminController::class, 'sellers'])->name('admin.sellers');
    Route::get('/admin/seller/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::post('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/reject/{id}', [AdminController::class, 'reject'])->name('admin.reject');
    
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::resource('products', ProductController::class);

    // Laporan PDF Admin
    Route::get('/admin/report/status', [ReportController::class, 'reportSellersStatus'])->name('report.status');
    Route::get('/admin/report/province', [ReportController::class, 'reportSellersProvince'])->name('report.province');
    Route::get('/admin/report/products-rating', [ReportController::class, 'reportProductsRating'])->name('report.products_rating');

    /*
    |--------------------------------------------------------------------------
    | AREA PRODUCTS
    |--------------------------------------------------------------------------
    */
    Route::resource('products', ProductController::class);

    /*
    |--------------------------------------------------------------------------
    | AREA PENJUAL / SELLER
    |--------------------------------------------------------------------------
    */

    // Dashboard Penjual
    Route::get('/seller/dashboard', function () {
        return view('seller.dashboard');
    })->name('seller.dashboard');

    // Laporan Stok
    Route::get('/seller/laporan-stok', function () {
        return view('seller.laporanStok');
    })->name('laporan.stok');

    // Laporan Rating
    Route::get('/seller/laporan-rating', function () {
        return view('seller.laporanRating');
    })->name('laporan.rating');

    // Tambah Produk
    Route::get('/seller/tambah-produk', [ProductController::class, 'create'])->name('tambah.produk');


    // MANAJEMEN PRODUK (ADMIN)
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');

    // HALAMAN LAPORAN (ADMIN)
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');

    // Unduh PDF Laporan
    Route::get('/seller/unduh-laporan', [ReportController::class, 'downloadSellerReport'])
        ->name('unduh.laporan');
});

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

// Register Toko
Route::get('/register-seller', [SellerRegistrationController::class, 'create'])->name('seller.register');
Route::post('/register-seller', [SellerRegistrationController::class, 'store'])->name('seller.store');

// Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// // Laporan Admin 
// Route::get('/admin/report/status', [ReportController::class, 'reportSellersStatus'])->name('report.status');
// Route::get('/admin/report/province', [ReportController::class, 'reportSellersProvince'])->name('report.province');

// Aktivasi Akun
Route::get('/activate-account/{token}', [AuthController::class, 'showActivationForm'])->name('activation.form');
Route::post('/activate-account', [AuthController::class, 'activate'])->name('activation.process');

// Homepage
Route::get('/homepage', function () {
    return view('homepage');
});