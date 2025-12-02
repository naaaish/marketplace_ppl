<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - Tukutuku</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a8f 100%);
            padding: 20px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 30px;
            min-width: 200px;
        }

        .logo {
            height: 50px;
            max-width: 200px;
            object-fit: contain;
            cursor: pointer;
        }

        .kategori-link {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background 0.3s;
            margin-left: 50px;
        }

        .kategori-link:hover {
            background: rgba(255,255,255,0.1);
        }

        .search-bar {
            flex: 1;
            max-width: 600px;
            margin: 0 30px;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 50px 12px 20px;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            background: rgba(255,255,255,0.95);
            transition: all 0.2s;
        }

        .search-bar input:focus {
            outline: 2px solid rgba(255,255,255,0.3);
            background: white;
        }

        .search-bar input::placeholder {
            color: #999;
        }

        .user-icon {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .user-icon:hover {
            transform: scale(1.05);
        }

        .user-icon svg {
            width: 24px;
            height: 24px;
            fill: #1e3a5f;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            padding: 20px 40px;
            margin: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .filter-header h3 {
            color: #1e3a5f;
            font-size: 18px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 2fr 1.5fr 1fr 1fr 1fr auto;
            gap: 15px;
            align-items: end;
        }

        .filter-group label {
            display: block;
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d9d9d9;
            border-radius: 6px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #1e3a5f;
        }

        .btn-filter {
            padding: 10px 25px;
            background: #1e3a5f;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-filter:hover {
            background: #2d5a8f;
        }

        .btn-reset {
            padding: 10px 25px;
            background: #ff4d4f;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-reset:hover {
            background: #ff7875;
        }

        /* Results Section */
        .results-section {
            padding: 20px 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .results-info {
            font-size: 16px;
            color: #666;
        }

        .results-info strong {
            color: #1e3a5f;
            font-weight: 600;
        }

        .active-filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .filter-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            background: #e6f7ff;
            color: #1e3a5f;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
        }

        .filter-tag button {
            background: none;
            border: none;
            color: #1e3a5f;
            cursor: pointer;
            font-size: 16px;
            line-height: 1;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .product-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: #f0f0f0;
        }

        .product-info {
            padding: 15px;
        }

        .product-name {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price {
            font-size: 18px;
            color: #ff6b00;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .product-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #999;
            margin-bottom: 5px;
        }

        .product-stock {
            color: #52c41a;
            font-weight: 500;
        }

        .product-rating {
            color: #fadb14;
            font-size: 12px;
        }

        .product-store {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: white;
            border-radius: 10px;
            margin: 20px 0;
        }

        .empty-state svg {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 22px;
            color: #1e3a5f;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #999;
            font-size: 15px;
            margin-bottom: 20px;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 40px;
            padding-bottom: 40px;
        }

        .pagination a,
        .pagination span {
            padding: 10px 15px;
            background: white;
            border: 1px solid #d9d9d9;
            border-radius: 6px;
            color: #1e3a5f;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .pagination a:hover {
            background: #e6f7ff;
            border-color: #1e3a5f;
        }

        .pagination .active {
            background: #1e3a5f;
            color: white;
            border-color: #1e3a5f;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                padding: 15px 20px;
            }

            .logo-section {
                width: 100%;
                justify-content: space-between;
            }

            .kategori-link {
                margin-left: 0;
            }

            .search-bar {
                max-width: 100%;
                margin: 0;
            }

            .filter-section {
                margin: 15px 20px;
                padding: 15px;
            }

            .filter-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .results-section {
                padding: 15px 20px;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 15px;
            }

            .product-image {
                height: 160px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo-section">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo" onclick="window.location.href='/homepage'" onerror="this.style.display='none'">
            <a href="/homepage#kategori" class="kategori-link">Kategori</a>
        </div>
        
        <form action="{{ route('products.search') }}" method="GET" class="search-bar">
            <div style="position: relative; display: flex; align-items: center;">
                <input type="text" 
                       name="q" 
                       placeholder="Cari produk di tukutuku..." 
                       value="{{ request('q') }}">
                
                <button type="submit" 
                        style="position: absolute; right: 10px; background: transparent; border: none; cursor: pointer; padding: 8px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1e3a5f" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                </button>
            </div>
        </form>
        
        <div class="user-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-header">
            <h3>Filter Pencarian</h3>
        </div>
        <form action="{{ route('products.search') }}" method="GET">
            <div class="filter-grid">
                <div class="filter-group">
                    <label>Kategori</label>
                    <select name="category">
                        <option value="">Semua Kategori</option>
                        <option value="fashion" {{ request('category') === 'fashion' ? 'selected' : '' }}>Fashion</option>
                        <option value="elektronik" {{ request('category') === 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="makanan" {{ request('category') === 'makanan' ? 'selected' : '' }}>Makanan & Minuman</option>
                        <option value="kecantikan" {{ request('category') === 'kecantikan' ? 'selected' : '' }}>Kecantikan</option>
                        <option value="rumah" {{ request('category') === 'rumah' ? 'selected' : '' }}>Rumah Tangga</option>
                        <option value="olahraga" {{ request('category') === 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                        <option value="alat-tulis" {{ request('category') === 'alat-tulis' ? 'selected' : '' }}>Alat Tulis</option>
                        <option value="lainnya" {{ request('category') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Urutkan</label>
                    <select name="sort">
                        <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Terpopuler</option>
                        <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Harga Min</label>
                    <input type="number" name="min_price" placeholder="0" value="{{ request('min_price') }}" min="0">
                </div>

                <div class="filter-group">
                    <label>Harga Max</label>
                    <input type="number" name="max_price" placeholder="0" value="{{ request('max_price') }}" min="0">
                </div>

                <input type="hidden" name="q" value="{{ request('q') }}">

                <button type="submit" class="btn-filter">🔍 Cari</button>

                @if(request()->hasAny(['q', 'category', 'min_price', 'max_price', 'sort']))
                    <a href="{{ route('products.index') }}" class="btn-reset">✕ Reset</a>
                @endif
            </div>
        </form>
    </div>

    <!-- Results Section -->
    <div class="results-section">
        <!-- Results Header -->
        <div class="results-header">
            <div class="results-info">
                @if(request('q'))
                    Menampilkan hasil untuk "<strong>{{ request('q') }}</strong>" 
                @else
                    Menampilkan semua produk
                @endif
                <span>({{ $products->total() }} produk ditemukan)</span>
            </div>
        </div>

        <!-- Active Filters -->
        @if(request()->hasAny(['category', 'min_price', 'max_price']))
        <div class="active-filters">
            @if(request('category'))
                <span class="filter-tag">
                    Kategori: {{ ucfirst(request('category')) }}
                    <button onclick="window.location.href='{{ route('products.search', array_merge(request()->except('category'))) }}'">×</button>
                </span>
            @endif
            
            @if(request('min_price'))
                <span class="filter-tag">
                    Min: Rp {{ number_format(request('min_price'), 0, ',', '.') }}
                    <button onclick="window.location.href='{{ route('products.search', array_merge(request()->except('min_price'))) }}'">×</button>
                </span>
            @endif
            
            @if(request('max_price'))
                <span class="filter-tag">
                    Max: Rp {{ number_format(request('max_price'), 0, ',', '.') }}
                    <button onclick="window.location.href='{{ route('products.search', array_merge(request()->except('max_price'))) }}'">×</button>
                </span>
            @endif
        </div>
        @endif

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="products-grid">
                @foreach($products as $product)
                    <a href="{{ route('products.show', $product) }}" class="product-card">
                        @if($product->photo)
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="product-image">
                        @else
                            <div class="product-image" style="display: flex; align-items: center; justify-content: center; color: #ccc;">
                                Tidak ada gambar
                            </div>
                        @endif
                        
                        <div class="product-info">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            
                            <div class="product-meta">
                                <span class="product-stock">Stok: {{ $product->stock ?? 0 }}</span>
                                <span class="product-rating">⭐ {{ number_format($product->rating, 1) }}</span>
                            </div>
                            
                            @if($product->seller)
                                <div class="product-store">{{ $product->seller->store_name }}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination">
                {{ $products->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                </svg>
                <h3>Produk Tidak Ditemukan</h3>
                <p>Maaf, tidak ada produk yang sesuai dengan pencarian Anda.</p>
                <a href="{{ route('products.index') }}" class="btn-filter">Lihat Semua Produk</a>
            </div>
        @endif
    </div>
</body>
</html>