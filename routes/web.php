<?php

use Illuminate\Support\Facades\Route;

// TAMBAHKAN SEMUA INI UNTUK MEMPERBAIKI ERROR MERAH
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TokoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// --- RUTE AUTENTIKASI MANUAL ---
// (Garis merah di sini akan hilang)
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');


// --- RUTE YANG PERLU LOGIN ---
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rute Profile (Garis merah di sini akan hilang)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute Registrasi Toko
    Route::get('/toko/register', [TokoController::class, 'create'])->name('toko.register');
    Route::post('/toko/register', [TokoController::class, 'store'])->name('toko.store');
    
});