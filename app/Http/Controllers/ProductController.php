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
            // 1. Proteksi: Pastikan user hanya bisa edit produknya sendiri
            if ($product->seller_id !== auth()->user()->seller->id) {
                abort(403, 'Anda tidak memiliki akses untuk mengedit produk ini.');
            }

            try {
                // 2. Validasi
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
                    // Input variasi (yang akan difilter, tapi perlu divalidasi)
                    'variant_names' => 'nullable|array',
                    'variant_prices' => 'nullable|array',
                    'variant_stocks' => 'nullable|array',
                    'variant_ids' => 'nullable|array',
                ], [
                    'name.required' => 'Nama produk wajib diisi',
                    'price.required' => 'Harga wajib diisi',
                    'weight.required' => 'Berat wajib diisi',
                    'stock.required' => 'Stok wajib diisi',
                ]);

                // 3. Handle upload foto baru
                if ($request->hasFile('photo')) {
                    // Hapus foto lama
                    if ($product->photo && Storage::disk('public')->exists($product->photo)) {
                        Storage::disk('public')->delete($product->photo);
                    }
                    // Upload foto baru
                    $validated['photo'] = $request->file('photo')->store('products/photos', 'public');
                }

                // 4. Pisahkan data produk utama dari variasi (PENCEGAHAN QUERYEXCEPTION)
                $productData = collect($validated)->except([
                    'variant_names', 
                    'variant_prices', 
                    'variant_stocks', 
                    'variant_ids',
                ])->toArray();

                // 5. Update data produk utama
                $product->update($productData);

                // 6. Handle Product Variants (Update, Create, Delete)
                if ($request->has('variant_names') && is_array($request->variant_names)) {
                    
                    $keepIds = array_filter($request->variant_ids ?? []);
                    
                    // Hapus variants yang DIBUANG dari form (ID-nya tidak ada di $keepIds)
                    $product->variants()->whereNotIn('id', $keepIds)->delete();
                    
                    // Loop untuk update atau create variants baru/yang sudah ada
                    foreach ($request->variant_names as $index => $variantName) {
                        
                        if (empty($variantName)) {
                            continue;
                        }

                        $variantData = [
                            'variant_name' => $variantName,
                            'variant_price' => $request->variant_prices[$index] ?? 0,
                            'variant_stock' => $request->variant_stocks[$index] ?? 0,
                        ];

                        $variantId = $request->variant_ids[$index] ?? null;

                        if ($variantId && ProductVariant::where('id', $variantId)->exists()) {
                            // Update existing variant
                            ProductVariant::where('id', $variantId)->update($variantData);
                        } else {
                            // Create new variant
                            $product->variants()->create($variantData + ['variant_sku' => null]);
                        }
                    }
                } else {
                    // Jika tidak ada variant yang dikirim, hapus semua variants yang ada
                    $product->variants()->delete();
                }

                // 7. Redirect Sukses
                return redirect()
                    ->route('products.index')
                    ->with('success', 'Produk berhasil diperbarui!');
                    
            } catch (\Exception $e) {
                return back()->withInput()->withErrors(['msg' => 'Gagal menyimpan: ' . $e->getMessage()]);
            }
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