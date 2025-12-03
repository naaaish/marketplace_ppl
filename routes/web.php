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

        // Jika Seller / User Biasa
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
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/sellers', [AdminController::class, 'sellers'])->name('admin.sellers');
    Route::get('/admin/seller/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::post('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/reject/{id}', [AdminController::class, 'reject'])->name('admin.reject');
    // --- ROUTE LAPORAN PDF ---
    Route::get('/admin/report/status', [ReportController::class, 'reportSellersStatus'])->name('report.status');
    Route::get('/admin/report/province', [ReportController::class, 'reportSellersProvince'])->name('report.province');

    // === AREA PRODUCTS ===
    Route::resource('products', ProductController::class);
});

// Register Toko
Route::get('/register-seller', [SellerRegistrationController::class, 'create'])->name('seller.register');
Route::post('/register-seller', [SellerRegistrationController::class, 'store'])->name('seller.store');

// Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Laporan Admin (duplikasi kamu — tetap dipertahankan)
Route::get('/admin/report/status', [ReportController::class, 'reportSellersStatus'])->name('report.status');
Route::get('/admin/report/province', [ReportController::class, 'reportSellersProvince'])->name('report.province');

// Aktivasi Akun
Route::get('/activate-account/{token}', [AuthController::class, 'showActivationForm'])->name('activation.form');
Route::post('/activate-account', [AuthController::class, 'activate'])->name('activation.process');

// Homepage
Route::get('/homepage', function () {
    return view('homepage');
});