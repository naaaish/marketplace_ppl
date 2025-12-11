<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes (FINAL FIXED VERSION)
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', function () {
    return view('homepage');
});

// Route untuk AJAX Unique Check
Route::post('/check-unique', [SellerRegistrationController::class, 'checkUnique'])->name('check.unique');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. DASHBOARD REDIRECT
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('seller.dashboard'); 
    })->name('dashboard');

    // 2. PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. AREA ADMIN (DASHBOARD & MANAJEMEN)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/sellers', [AdminController::class, 'sellers'])->name('sellers');
        Route::get('/seller/{id}', [AdminController::class, 'show'])->name('show');
        Route::post('/approve/{id}', [AdminController::class, 'approve'])->name('approve');
        Route::post('/reject/{id}', [AdminController::class, 'reject'])->name('reject');
        Route::get('/products', [AdminController::class, 'products'])->name('products');
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports'); 
        
    });

    // 4. AREA LAPORAN ADMIN 
    Route::prefix('admin/report')->name('report.')->group(function() {
        Route::get('/status', [ReportController::class, 'reportSellersStatus'])->name('status');
        Route::get('/province', [ReportController::class, 'reportSellersProvince'])->name('province');
        Route::get('/products-rating', [ReportController::class, 'reportProductsRating'])->name('products_rating');
    });
    
    // Halaman index laporan admin 
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');


    // 5. AREA SELLER (PENJUAL)
    Route::prefix('seller')->name('seller.')->group(function () {
        
        // Dashboard Penjual
        Route::get('/dashboard', function () {
            return view('seller.dashboard');
        })->name('dashboard');

        // Unduh PDF
        Route::get('/unduh-laporan', [ReportController::class, 'downloadSellerReport'])->name('unduh.laporan');

        // === GROUP LAPORAN SELLER ===
        // Menggunakan Controller untuk semua route agar data $title terkirim
        Route::prefix('reports')->name('reports.')->group(function() {
            
            // 1. Halaman Index Laporan (Menu Kotak-kotak)
            Route::get('/', [ReportController::class, 'sellerReportsIndex'])->name('index'); 

            // 2. Laporan PDF
            Route::get('/stock-desc', [ReportController::class, 'reportStockDesc'])->name('stock_desc');
            Route::get('/rating-desc', [ReportController::class, 'reportRatingDesc'])->name('rating_desc');
            Route::get('/stock-low', [ReportController::class, 'reportStockLow'])->name('stock_low');
        });

        // === ROUTE PENYELAMAT / ALIAS (Dashboard Seller) ===
        
        // Mengatasi Sidebar Dashboard yang memanggil 'route('seller.reports')'
        Route::get('/pusat-laporan', [ReportController::class, 'sellerReportsIndex'])->name('reports'); 

        // Mengatasi Typo di file index.blade.php: 'seller.report.stock_desc'
        Route::get('/laporan-typo-fix', [ReportController::class, 'reportStockDesc'])->name('report.stock_desc');
    });

    // 6. ROUTE LEGACY 
    
    
    Route::get('/seller/laporan-stok-legacy', [ReportController::class, 'reportStockDesc'])->name('laporan.stok');

    Route::get('/seller/laporan-rating-legacy', [ReportController::class, 'reportRatingDesc'])->name('laporan.rating');

    // Agar tidak error "Route [tambah.produk] not defined"
    Route::get('/seller/tambah-produk-manual', [ProductController::class, 'create'])
        ->name('tambah.produk');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
        ->name('products.edit');

    // 7. MANAJEMEN PRODUK (Resource Utama)
    Route::resource('products', ProductController::class);
    
});

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/register-seller', [SellerRegistrationController::class, 'create'])->name('seller.register');
Route::post('/register-seller', [SellerRegistrationController::class, 'store'])->name('seller.store');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/activate-account/{token}', [AuthController::class, 'showActivationForm'])->name('activation.form');
Route::post('/activate-account', [AuthController::class, 'activate'])->name('activation.process');
Route::get('/ulasan', function () { return view('ulasan'); });
Route::post('/submit-ulasan', [ReviewController::class, 'submit'])->name('review.submit');