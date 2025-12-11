<?php

namespace App\Http\Controllers;

use App\Models\Product; // Pastikan model Product di-import
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil semua produk yang statusnya 'active' dan lakukan paginasi
        $products = Product::where('status', 'active')
                           ->latest() // Tampilkan yang terbaru duluan
                           ->paginate(12); 

        // Anda mungkin juga ingin mengambil data kategori, dll.
        $categories = \App\Models\Category::all(); // Contoh jika ada model Category

        return view('welcome', compact('products', 'categories')); 
        // Nama view mungkin berbeda (misal: 'home.index' atau 'catalog.index')
    }
}