<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk
     */
    public function index()
    {
        $products = Product::with('seller', 'variants')
            ->where('seller_id', auth()->user()->seller->id)
            ->latest()
            ->paginate(10);
        
        return view('products.index', compact('products'));
    }

    /**
     * Tampilkan form tambah produk
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|integer|min:1',
            'category' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100',
            
            // Upload files (single photo)
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'video' => 'nullable|mimes:mp4,mov|max:20480', // 20MB
            
            // Variasi (opsional)
            'variants' => 'nullable|array',
            'variants.*.name' => 'required_with:variants|string',
            'variants.*.price' => 'nullable|numeric',
            'variants.*.stock' => 'required_with:variants|integer|min:0',
            'variants.*.sku' => 'nullable|string',
        ], [
            'name.required' => 'Nama produk wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'weight.required' => 'Berat wajib diisi',
            'stock.required' => 'Stok wajib diisi',
            'photo.required' => 'Foto produk wajib diupload',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'Format foto harus jpeg, jpg, atau png',
            'photo.max' => 'Ukuran foto maksimal 2MB',
        ]);

        // Upload foto
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('products/photos', 'public');
        }

        // Upload video
        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('products/videos', 'public');
        }

        // Buat produk
        $product = Product::create([
            'seller_id' => auth()->user()->seller->id,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'weight' => $validated['weight'],
            'category' => $validated['category'],
            'stock' => $validated['stock'],
            'sku' => $validated['sku'],
            'photo' => $photoPath,
            'video_path' => $videoPath,
            'rating' => 0.00, // Default rating
            'rating_count' => 0, // Default jumlah rating
            'status' => 'active', // Default aktif
        ]);

        // Simpan variasi jika ada
        if ($request->has('variants') && is_array($request->variants)) {
            foreach ($request->variants as $variant) {
                if (!empty($variant['name'])) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'variant_name' => $variant['name'],
                        'variant_price' => $variant['price'] ?? null,
                        'variant_stock' => $variant['stock'] ?? 0,
                        'variant_sku' => $variant['sku'] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail produk
     */
    public function show(Product $product)
    {
        $product->load('variants', 'seller', 'reviews');
        return view('products.show', compact('product'));
    }

    /**
     * Tampilkan form edit produk
     */
    public function edit(Product $product)
    {
        $product->load('variants');
        return view('products.edit', compact('product'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|integer|min:1',
            'category' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Hapus produk
     */
    public function destroy(Product $product)
    {
        // Hapus file foto
        if ($product->main_photo) {
            Storage::disk('public')->delete($product->main_photo);
        }
        
        if ($product->photos) {
            foreach ($product->photos as $photo) {
                Storage::disk('public')->delete($photo);
            }
        }
        
        if ($product->video_path) {
            Storage::disk('public')->delete($product->video_path);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}
