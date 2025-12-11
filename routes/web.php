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
use App\Models\Product; 
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Bisa Diakses Siapa Saja)
|--------------------------------------------------------------------------
*/

// 1. Halaman Utama (Homepage) - Kini mengambil data dari Database
Route::get('/', function () {
    // Ambil semua produk terbaru dari database
    $products = Product::latest()->get(); 
    return view('homepage', compact('products'));
});

// 2. Route Detail Produk (Publik)
// Menggunakan method 'show' milik ProductController tapi diakses lewat URL publik
Route::get('/product/{product}', [ProductController::class, 'show'])->name('public.product.show');

// 3. Register & Login
Route::get('/register-seller', [SellerRegistrationController::class, 'create'])->name('seller.register');
Route::post('/register-seller', [SellerRegistrationController::class, 'store'])->name('seller.store');
Route::post('/check-unique', [SellerRegistrationController::class, 'checkUnique'])->name('check.unique'); // AJAX

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/activate-account/{token}', [AuthController::class, 'showActivationForm'])->name('activation.form');
Route::post('/activate-account', [AuthController::class, 'activate'])->name('activation.process');

// Route untuk membuka halaman tulis ulasan berdasarkan ID Produk
Route::get('/produk/{id}/tulis-ulasan', function ($id) {
    $product = \App\Models\Product::findOrFail($id);
    return view('ulasan', compact('product'));
})->name('ulasan.form');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // DASHBOARD REDIRECT
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('seller.dashboard'); 
    })->name('dashboard');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // AREA ADMIN
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/sellers', [AdminController::class, 'sellers'])->name('sellers');
        Route::get('/seller/{id}', [AdminController::class, 'show'])->name('show');
        Route::post('/approve/{id}', [AdminController::class, 'approve'])->name('approve');
        Route::post('/reject/{id}', [AdminController::class, 'reject'])->name('reject');
        Route::get('/products', [AdminController::class, 'products'])->name('products');
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports'); 
    });

    // ADMIN REPORTS GROUP
    Route::prefix('admin/report')->name('report.')->group(function() {
        Route::get('/status', [ReportController::class, 'reportSellersStatus'])->name('status');
        Route::get('/province', [ReportController::class, 'reportSellersProvince'])->name('province');
        Route::get('/products-rating', [ReportController::class, 'reportProductsRating'])->name('products_rating');
    });

    // AREA SELLER
    Route::prefix('seller')->name('seller.')->group(function () {
        Route::get('/dashboard', function () { return view('seller.dashboard'); })->name('dashboard');
        Route::get('/unduh-laporan', [ReportController::class, 'downloadSellerReport'])->name('unduh.laporan');

        // Laporan Seller
        Route::prefix('reports')->name('reports.')->group(function() {
            Route::get('/', [ReportController::class, 'sellerReportsIndex'])->name('index'); 
            Route::get('/stock-desc', [ReportController::class, 'reportStockDesc'])->name('stock_desc');
            Route::get('/rating-desc', [ReportController::class, 'reportRatingDesc'])->name('rating_desc');
            Route::get('/stock-low', [ReportController::class, 'reportStockLow'])->name('stock_low');
        });

        // Route Penyelamat/Alias
        Route::get('/pusat-laporan', [ReportController::class, 'sellerReportsIndex'])->name('reports'); 
        Route::get('/laporan-typo-fix', [ReportController::class, 'reportStockDesc'])->name('report.stock_desc');
    });

    // MANAJEMEN PRODUK (Seller) - Menggunakan Resource
    // Ini otomatis membuat route: products.index, products.create, products.store, products.show (untuk seller), dll.
    Route::resource('products', ProductController::class);
    
    // Route Manual (Penyelamat jika resource error di view tertentu)
    Route::get('/seller/tambah-produk-manual', [ProductController::class, 'create'])->name('tambah.produk');
});

Route::get('/', function () {
    $products = \App\Models\Product::latest()->get();
    return view('homepage', compact('products'));
});

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');