<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class KatalogController extends Controller
{
    public function index()
    {
        // Debug: Cek jumlah produk di database
        $totalProducts = Product::count();
        $activeProducts = Product::where('status', 'active')->count();
        
        echo "Total Products: " . $totalProducts . "<br>";
        echo "Active Products: " . $activeProducts . "<br><br>";
        
        // Ambil produk tanpa relasi dulu
        $productsData = Product::where('status', 'active')->get();
        
        echo "Products Retrieved: " . $productsData->count() . "<br><br>";
        
        // Tampilkan data mentah
        dd($productsData->toArray());
    }
}