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
        // Pastikan user punya relasi seller, jika tidak (misal admin), handle error atau redirect
        if (!auth()->user()->seller) {
            return redirect()->back()->with('error', 'Akun Anda bukan penjual.');
        }

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
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|integer|min:0',
            'photo' => 'required|image|max:2048', // Max 2MB
            'status' => 'required|in:active,inactive',
        ]);

        try {
            // 2. Upload Gambar
            $imagePath = null;
            if ($request->hasFile('photo')) {
                // Simpan ke folder: storage/app/public/products
                $imagePath = $request->file('photo')->store('products', 'public');
            }

            // 3. Simpan Produk Utama
            // Pastikan relasi seller sudah benar
            $sellerId = auth()->user()->seller->id; 

            $product = Product::create([
                'seller_id' => $sellerId,
                'name' => $request->name,
                'category' => $request->category,
                'price' => $request->price,
                'stock' => $request->stock,
                'weight' => $request->weight,
                'description' => $request->description,
                'image' => $imagePath, // Sesuaikan dengan kolom DB Anda ('image' atau 'photo')
                'status' => $request->status,
            ]);

            // 4. Simpan Variasi (Jika ada)
            if ($request->has('variants')) {
                foreach ($request->variants as $variant) {
                    if (isset($variant['name']) && $variant['name']) { 
                        $product->variants()->create([
                            // Mapping Nama Input -> Nama Kolom Database
                            'variant_name'  => $variant['name'],
                            'variant_price' => $variant['price'] ?? $product->price,
                            'variant_stock' => $variant['stock'] ?? 0,
                            'variant_sku'   => $variant['sku'] ?? null,
                        ]);
                    }
                }
            }

            // 5. Redirect dengan Pesan Sukses
            return redirect()->route('tambah.produk')->with('success', 'Produk berhasil ditambahkan!');

        } catch (\Exception $e) {
            // Jika error, kembalikan dengan pesan error
            return back()->withInput()->withErrors(['msg' => 'Gagal menyimpan: ' . $e->getMessage()]);
        }
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
        // Hapus file foto utama
        if ($product->image) { // Ganti 'main_photo' jadi 'image' sesuai store
            Storage::disk('public')->delete($product->image);
        }
        
        // Hapus produk (variasi & review akan ikut terhapus jika cascade di database aktif)
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}