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
        // Pastikan user hanya bisa edit produknya sendiri
        if ($product->seller_id !== auth()->user()->seller->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit produk ini.');
        }

        return view('products.edit', compact('product'));
    }

    /**
     * Update produk
     */
    public function update(Request $request, Product $product)
    {
        // Pastikan user hanya bisa edit produknya sendiri
        if ($product->seller_id !== auth()->user()->seller->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit produk ini.');
        }

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'variant_names' => 'nullable|array',
            'variant_prices' => 'nullable|array',
            'variant_stocks' => 'nullable|array',
            'variant_ids' => 'nullable|array',
        ], [
            'name.required' => 'Nama produk wajib diisi',
            'price.required' => 'Harga wajib diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'weight.required' => 'Berat wajib diisi',
            'stock.required' => 'Stok wajib diisi',
            'status.required' => 'Status produk wajib dipilih',
            'photo.image' => 'File harus berupa gambar',
            'photo.mimes' => 'Format foto harus jpeg, jpg, atau png',
            'photo.max' => 'Ukuran foto maksimal 2MB',
        ]);

        // Handle upload foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($product->photo && Storage::disk('public')->exists($product->photo)) {
                Storage::disk('public')->delete($product->photo);
            }
            
            // Upload foto baru
            $validated['photo'] = $request->file('photo')->store('products/photos', 'public');
        }

        // Update data produk
        $product->update($validated);

        // Handle Product Variants
        if ($request->has('variant_names') && is_array($request->variant_names)) {
            // Ambil ID variants yang akan dipertahankan
            $keepIds = array_filter($request->variant_ids ?? []);
            
            // Hapus variants yang tidak ada di form (yang dihapus user)
            if (count($keepIds) > 0) {
                $product->variants()->whereNotIn('id', $keepIds)->delete();
            } else {
                // Jika tidak ada ID yang dipertahankan, hapus semua variants lama
                $product->variants()->delete();
            }

            // Loop untuk update atau create variants
            foreach ($request->variant_names as $index => $variantName) {
                // Skip jika nama variant kosong
                if (empty($variantName)) {
                    continue;
                }

                $variantData = [
                    'variant_name' => $variantName,
                    'variant_price' => $request->variant_prices[$index] ?? 0,
                    'variant_stock' => $request->variant_stocks[$index] ?? 0,
                ];

                // Cek apakah ini update variant yang sudah ada atau create baru
                if (isset($request->variant_ids[$index]) && !empty($request->variant_ids[$index])) {
                    // Update existing variant
                    ProductVariant::where('id', $request->variant_ids[$index])
                        ->where('product_id', $product->id)
                        ->update($variantData);
                } else {
                    // Create new variant
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'variant_name' => $variantName,
                        'variant_price' => $request->variant_prices[$index] ?? 0,
                        'variant_stock' => $request->variant_stocks[$index] ?? 0,
                        'variant_sku' => null, // Bisa ditambahkan jika perlu
                    ]);
                }
            }
        } else {
            // Jika tidak ada variant yang dikirim, hapus semua variants
            $product->variants()->delete();
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Hapus produk
     */
    public function destroy(Product $product)
    {
        // Pastikan user hanya bisa hapus produknya sendiri
        if ($product->seller_id !== auth()->user()->seller->id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus produk ini.');
        }

        // Hapus file foto
        if ($product->photo && Storage::disk('public')->exists($product->photo)) {
            Storage::disk('public')->delete($product->photo);
        }
        
        // Hapus video jika ada
        if ($product->video_path && Storage::disk('public')->exists($product->video_path)) {
            Storage::disk('public')->delete($product->video_path);
        }

        // Hapus variants
        $product->variants()->delete();

        // Hapus produk
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}