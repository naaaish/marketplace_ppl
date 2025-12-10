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

        /* Header dengan Search Bar */
        .header {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5a8f 100%);
            padding: 20px 40px;
            display: flex;
            align-items: center;
            gap: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .logo {
            height: 50px;
            cursor: pointer;
        }

        .search-bar-header {
            flex: 1;
            max-width: 600px;
            position: relative;
        }

        .search-form-header {
            position: relative;
            width: 100%;
        }

        .search-bar-header input {
            width: 100%;
            padding: 12px 50px 12px 20px;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            background: rgba(255,255,255,0.95);
        }

        .search-bar-header input:focus {
            outline: none;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .search-btn-header {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: #1e3a5f;
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }

        .search-btn-header:hover {
            background: #2d5a8f;
        }

        .search-btn-header svg {
            width: 18px;
            height: 18px;
            fill: white;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .search-header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .search-header h1 {
            font-size: 24px;
            color: #1e3a5f;
            margin-bottom: 10px;
        }

        .search-info {
            color: #666;
            font-size: 14px;
        }

        .main-content {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 20px;
        }

        /* Sidebar Filter */
        .filter-sidebar {
            background: white;
            border-radius: 10px;
            padding: 20px;
            height: fit-content;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            sticky: top;
            top: 20px;
        }

        .filter-section {
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .filter-section:last-child {
            border-bottom: none;
        }

        .filter-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e3a5f;
            margin-bottom: 12px;
        }

        .filter-option {
            display: block;
            padding: 8px 0;
            color: #333;
            text-decoration: none;
            transition: color 0.2s;
        }

        .filter-option:hover {
            color: #2d5a8f;
        }

        .filter-option.active {
            color: #2d5a8f;
            font-weight: 600;
        }

        .price-inputs {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
        }

        .price-input-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .price-label {
            font-size: 13px;
            color: #666;
            min-width: 35px;
        }

        .price-input {
            flex: 1;
            padding: 8px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .price-input:focus {
            outline: none;
            border-color: #2d5a8f;
        }

        .apply-btn {
            width: 100%;
            padding: 10px;
            background: #2d5a8f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .apply-btn:hover {
            background: #1e3a5f;
        }

        /* Products Grid */
        .products-section {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .sort-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .sort-options {
            display: flex;
            gap: 15px;
        }

        .sort-btn {
            padding: 8px 15px;
            background: transparent;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            color: #666;
            text-decoration: none;
            display: inline-block;
        }

        .sort-btn:hover {
            border-color: #2d5a8f;
            color: #2d5a8f;
        }

        .sort-btn.active {
            background: #2d5a8f;
            color: white;
            border-color: #2d5a8f;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .product-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-3px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #f9f9f9;
        }

        .product-info {
            padding: 15px;
        }

        .product-name {
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .product-price {
            font-size: 18px;
            font-weight: 700;
            color: #2d5a8f;
            margin-bottom: 8px;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            color: #666;
        }

        .star {
            color: #ffa500;
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .no-results h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
            padding: 20px 0;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #666;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: #2d5a8f;
            color: white;
            border-color: #2d5a8f;
        }

        .pagination .active {
            background: #2d5a8f;
            color: white;
            border-color: #2d5a8f;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                padding: 15px 20px;
                gap: 15px;
            }

            .search-bar-header {
                max-width: 100%;
            }

            .main-content {
                grid-template-columns: 1fr;
            }

            .filter-sidebar {
                display: none;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 15px;
            }

            .sort-options {
                flex-wrap: wrap;
                gap: 8px;
            }

            .sort-btn {
                font-size: 12px;
                padding: 6px 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Header dengan Search Bar -->
    <div class="header">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo" onclick="window.location.href='/'">
        
        <div class="search-bar-header">
            <form action="{{ route('search') }}" method="GET" class="search-form-header">
                <input type="text" name="q" placeholder="Cari di tukutuku" value="{{ $query ?? '' }}">
                <button type="submit" class="search-btn-header">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="search-header">
            <h1>
                @if($query)
                    Hasil pencarian untuk "{{ $query }}"
                @elseif($category)
                    Kategori: {{ $category }}
                @else
                    Semua Produk
                @endif
            </h1>
            <div class="search-info">
                Ditemukan {{ $products->total() }} produk
            </div>
        </div>

        <div class="main-content">
            <!-- Filter Sidebar -->
            <div class="filter-sidebar">
                <form action="{{ route('search') }}" method="GET">
                    @if($query)
                        <input type="hidden" name="q" value="{{ $query }}">
                    @endif

                    <!-- Category Filter -->
                    <div class="filter-section">
                        <div class="filter-title">Kategori</div>
                        <a href="{{ route('search', array_merge(request()->except('category'), [])) }}" 
                           class="filter-option {{ !$category ? 'active' : '' }}">
                            Semua Kategori
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('search', array_merge(request()->except('category'), ['category' => $cat])) }}" 
                               class="filter-option {{ $category == $cat ? 'active' : '' }}">
                                {{ $cat }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Price Range Filter -->
                    <div class="filter-section">
                        <div class="filter-title">Rentang Harga</div>
                        <div class="price-inputs">
                            <div class="price-input-wrapper">
                                <span class="price-label">Min:</span>
                                <input type="text" name="min_price" placeholder="0" class="price-input" 
                                       value="{{ $minPrice ? number_format($minPrice, 0, ',', '.') : '' }}" 
                                       id="minPrice" inputmode="numeric">
                            </div>
                            <div class="price-input-wrapper">
                                <span class="price-label">Max:</span>
                                <input type="text" name="max_price" placeholder="999.999.999" class="price-input" 
                                       value="{{ $maxPrice ? number_format($maxPrice, 0, ',', '.') : '' }}" 
                                       id="maxPrice" inputmode="numeric">
                            </div>
                        </div>
                        <button type="submit" class="apply-btn">Terapkan</button>
                    </div>
                </form>
            </div>

            <!-- Products Section -->
            <div class="products-section">
                <div class="sort-bar">
                    <span style="color: #666; font-size: 14px;">Urutkan:</span>
                    <div class="sort-options">
                        <a href="{{ route('search', array_merge(request()->except('sort'), ['sort' => 'relevance'])) }}" 
                           class="sort-btn {{ $sort == 'relevance' ? 'active' : '' }}">
                            Relevan
                        </a>
                        <a href="{{ route('search', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}" 
                           class="sort-btn {{ $sort == 'newest' ? 'active' : '' }}">
                            Terbaru
                        </a>
                        <a href="{{ route('search', array_merge(request()->except('sort'), ['sort' => 'price_low'])) }}" 
                           class="sort-btn {{ $sort == 'price_low' ? 'active' : '' }}">
                            Termurah
                        </a>
                        <a href="{{ route('search', array_merge(request()->except('sort'), ['sort' => 'price_high'])) }}" 
                           class="sort-btn {{ $sort == 'price_high' ? 'active' : '' }}">
                            Termahal
                        </a>
                        <a href="{{ route('search', array_merge(request()->except('sort'), ['sort' => 'popular'])) }}" 
                           class="sort-btn {{ $sort == 'popular' ? 'active' : '' }}">
                            Terpopuler
                        </a>
                    </div>
                </div>

                @if($products->count() > 0)
                    <div class="products-grid">
                        @foreach($products as $product)
                            <a href="/produk/{{ $product->id }}" class="product-card">
                                <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="product-image">
                                <div class="product-info">
                                    <div class="product-name">{{ $product->name }}</div>
                                    <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                    <div class="product-rating">
                                        <span class="star">★</span>
                                        {{ number_format($product->rating, 1) }} 
                                        ({{ $product->rating_count }})
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="pagination">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="no-results">
                        <h2>Tidak ada produk ditemukan</h2>
                        <p>Coba kata kunci lain atau ubah filter pencarian</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Format input harga dengan titik sebagai separator ribuan
        function formatPrice(input) {
            let value = input.value.replace(/\D/g, ''); // Hapus semua karakter non-digit
            if (value) {
                value = parseInt(value).toLocaleString('id-ID'); // Format dengan titik
            }
            input.value = value;
        }

        // Event listener untuk format otomatis saat mengetik
        document.getElementById('minPrice').addEventListener('input', function(e) {
            formatPrice(e.target);
        });

        document.getElementById('maxPrice').addEventListener('input', function(e) {
            formatPrice(e.target);
        });

        // Sebelum submit, convert ke angka murni
        document.querySelector('.filter-sidebar form').addEventListener('submit', function(e) {
            let minPrice = document.getElementById('minPrice');
            let maxPrice = document.getElementById('maxPrice');
            
            if (minPrice.value) {
                minPrice.value = minPrice.value.replace(/\./g, ''); // Hapus titik
            }
            if (maxPrice.value) {
                maxPrice.value = maxPrice.value.replace(/\./g, ''); // Hapus titik
            }
        });
    </script>
</body>
</html>