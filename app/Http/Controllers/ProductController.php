<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil semua produk dengan relasi reviews dan seller
        $products = Product::with(['reviews.user', 'seller'])
            ->where('status', 'active')
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'category' => $product->category,
                    'price' => $product->price,
                    'stock' => $product->stock,
                    'image' => $product->image,
                    'sold' => $product->sold,
                    'rating' => round($product->averageRating(), 1),
                    'review_count' => $product->reviewCount(),
                    'store_name' => $product->seller->store_name,
                    'sample_review' => $product->reviews->first()->comment ?? 'Belum ada review',
                ];
            });

        // Ambil kategori unik
        $categories = Product::where('status', 'active')
            ->distinct()
            ->pluck('category');

        return view('katalog-produk', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with(['reviews.user', 'seller'])->findOrFail($id);
        
        return view('detail-produk', compact('product'));
    }
}