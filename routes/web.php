<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

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

    // === AREA PRODUCTS ===
    Route::resource('products', ProductController::class);
});

// Register Toko
Route::get('/register-seller', [SellerRegistrationController::class, 'create'])->name('seller.register');
Route::post('/register-seller', [SellerRegistrationController::class, 'store'])->name('seller.store');

// Login & Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Activation Account (Public)
Route::get('/activate-account/{token}', [AuthController::class, 'showActivationForm'])->name('activation.form');
Route::post('/activate-account', [AuthController::class, 'activate'])->name('activation.process');

Route::get('/homepage', function () {
    return view('homepage');
});

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');