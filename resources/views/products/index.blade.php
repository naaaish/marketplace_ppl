<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk Saya</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #f0f2f5; }

        .container {
            max-width: 1200px; margin: 20px auto; padding: 0 20px;
        }

        /* .header {
            background: white;
            padding: 20px 30px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        } */
        /* Header Styling */
        .header {
            background-color: #1a2b5a; /* Warna biru tua seperti gambar */
            padding: 12px 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-content {
            display: flex;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            gap: 20px;
        }
        
        .header-content img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }
        .kategori { font-size: 16px; font-weight: 500; color: #ffffff; cursor: pointer; }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #f0f0f0;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
        }

        .btn-back:hover {
            background: #e0e0e0;
        }

        .btn-add {
            padding: 10px 20px;
            background: #1890ff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
        }

        .btn-add:hover {
            background: #40a9ff;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: translateY(-4px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #f0f0f0;
        }

        .product-info {
            padding: 15px;
        }

        .product-name {
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
            color: #333;
        }

        .product-price {
            font-size: 18px;
            color: #ff6b00;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .product-stock {
            font-size: 13px;
            color: #666;
        }

        .product-actions {
            padding: 10px 15px;
            border-top: 1px solid #f0f0f0;
            display: flex;
            gap: 10px;
        }

        .btn-small {
            padding: 6px 12px;
            font-size: 13px;
            border-radius: 4px;
            text-decoration: none;
            border: 1px solid #d9d9d9;
            background: white;
            color: #333;
            cursor: pointer;
        }

        .btn-small:hover {
            border-color: #1890ff;
            color: #1890ff;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-active {
            background: #e6f7e6;
            color: #52c41a;
        }

        .status-inactive {
            background: #f5f5f5;
            color: #999;
        }

        .success-message {
            background: #e6f7e6;
            color: #52c41a;
            padding: 12px 20px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    {{-- header --}}
    <div class="header">
        <div class="header-content">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" onerror="this.style.display='none'">
            <span class="kategori">Produk Saya</span>
            {{-- <div class="search-box">
                <input type="text" placeholder="Cari di tukutuku">
            </div> --}}
        </div>
    </div>

    <div class="container">
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <a href="{{ route('dashboard') }}" class="btn-back">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="transform: rotate(180deg);">
                    <path d="M6 12l4-4-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kembali ke Dashboard
            </a>
            <a href="{{ route('products.create') }}" class="btn-add">+ Tambah Produk</a>
        </div>

        @if (session('success'))
            <div class="success-message">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="products-grid">
            @forelse ($products as $product)
                <div class="product-card">
                    @if ($product->photo)
                        @if(Str::startsWith($product->photo, 'products/'))
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="product-image">
                        @else
                            <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="product-image">
                        @endif
                    @else
                        <div class="product-image" style="display: flex; align-items: center; justify-content: center; color: #999;">
                            No Image
                        </div>
                    @endif
                    
                    <div class="product-info">
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        <div class="product-stock">
                            Stok: {{ $product->stock }} | Berat: {{ $product->weight }}g
                        </div>
                        <div style="font-size: 12px; color: #666; margin-top: 5px;">
                            📍 {{ $product->province ?? 'Tidak ada lokasi' }}
                        </div>
                        <div style="font-size: 12px; color: #666; margin-top: 3px;">
                            🏪 {{ $product->store_name ?? 'Toko' }}
                        </div>
                        <div style="font-size: 12px; color: #f59e0b; margin-top: 3px;">
                            ⭐ {{ number_format($product->rating, 2) }} ({{ $product->rating_count }} rating)
                        </div>
                        <div style="margin-top: 8px;">
                            <span class="status-badge {{ $product->status == 'active' ? 'status-active' : 'status-inactive' }}">
                                {{ $product->status == 'active' ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="product-actions">
                        <a href="{{ route('products.edit', $product) }}" class="btn-small">Edit</a>
                        <a href="{{ route('products.show', $product) }}" class="btn-small">Lihat</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;" 
                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-small" style="color: #ff4d4f; border-color: #ffccc7;">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px; background: white; border-radius: 8px;">
                    <h3 style="color: #999;">Belum ada produk</h3>
                    <p style="color: #ccc; margin-top: 10px;">Mulai tambahkan produk pertama Anda</p>
                </div>
            @endforelse
        </div>

        <div style="margin-top: 30px;">
            {{ $products->links() }}
        </div>
    </div>
</body>
</html>
