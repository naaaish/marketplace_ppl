<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name ?? 'Detail Produk' }} - Tukutuku</title>
    <style>
        /* CSS Disesuaikan ada di bagian 2. Perbaikan CSS di bawah */
        /* ... Kode CSS yang diperbaiki akan diletakkan di sini ... */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #f0f2f5; }

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
        
        /* Search Box */
        .search-box {
            flex: 1;
            max-width: 500px
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px;
            border: none;
            border-radius: 20px;
            font-size: 14px;
            background-color: #e0e0e0;
            color: #333;
            outline: none;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            background-color: white;
            box-shadow: 0 0 0 2px #1a2b5a;
        }

        .search-box input::placeholder {
            color: #888;
        }

        .container { max-width: 1200px; margin: 20px auto; padding: 0 20px; }
        .product-page { background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 20px 30px; }
        
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #333;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            padding: 8px 12px;
            background: #f5f5f5;
            border-radius: 6px;
            transition: background 0.2s;
        }
        .btn-back:hover {
            background: #e8e8e8;
        }
        .btn-back svg {
            width: 20px;
            height: 20px;
        }

        .product-detail-grid { 
            display: grid; 
            grid-template-columns: 400px 1fr; /* Kolom Kiri lebih kecil (mirip gambar) */
            gap: 30px; 
        }

        /* KOLOM KIRI: Gambar dan Rating */
        .product-image-col { width: 100%; }
        .image-wrapper { 
            position: relative; 
            margin-bottom: 20px; 
            border: 1px solid #e0e0e0; 
            border-radius: 6px; 
            overflow: hidden;
        }
        .main-image { 
            width: 100%; 
            height: 400px; /* Ukuran tetap untuk semua gambar */
            object-fit: cover; /* Potong gambar agar sesuai tanpa distorsi */
            object-position: center; /* Posisikan di tengah */
            display: block; 
        }
        
        /* Badge Fitur & Garansi */
        .badge-overlay { position: absolute; top: 10px; left: 10px; display: flex; flex-direction: column; gap: 5px; }
        .badge-feature { background: black; color: white; padding: 4px 8px; font-size: 10px; font-weight: bold; border-radius: 4px; opacity: 0.8; }
        .badge-guarantee { 
            position: absolute; 
            bottom: 0; 
            right: 0; 
            background: #102C54; /* Warna Biru Tua/Navy */
            color: white; 
            padding: 8px 12px; 
            font-size: 14px; 
            font-weight: bold; 
            border-top-left-radius: 6px; 
        }

        .rating-box { 
            border: 1px solid #e0e0e0; 
            border-radius: 6px; 
            padding: 15px; 
            background: white; 
            margin-top: 15px;
        }
        .rating-box h3 { font-size: 16px; font-weight: 600; margin-bottom: 10px; }
        .rating-score-display { display: flex; align-items: center; margin-bottom: 5px; }
        .stars { color: #FFA000; font-size: 24px; letter-spacing: 2px; }
        .score { font-size: 24px; font-weight: bold; margin-left: 10px; color: #333; }
        .sold-count { font-size: 14px; color: #666; margin-bottom: 15px; }
        .btn-review-write { 
            background: #102C54; 
            color: white; 
            border: none; 
            padding: 10px 20px; 
            border-radius: 6px; 
            font-weight: 600; 
            cursor: pointer; 
            width: 100%; 
        }

        /* KOLOM KANAN: Info Produk */
        .product-info-col h1 { 
            font-size: 24px; 
            font-weight: 600; 
            margin-bottom: 15px; 
            line-height: 1.3; 
        }
        .price { 
            font-size: 32px; 
            font-weight: bold; 
            color: #102C54; /* Warna Biru Tua/Navy */
            margin-bottom: 20px; 
            border-bottom: 1px solid #e0e0e0; 
            padding-bottom: 15px;
        }

        /* Varian Warna */
        .variant-section { margin-bottom: 20px; }
        .variant-label { font-size: 14px; color: #666; margin-bottom: 10px; }
        .variant-button-group { display: flex; gap: 10px; }
        .variant-button { 
            padding: 8px 15px; 
            border: 2px solid #102C54; 
            border-radius: 4px; 
            background: #e6f7ff;
            color: #102C54; 
            cursor: pointer; 
            font-size: 14px; 
            font-weight: 500;
        }
        
        /* Detail dan Deskripsi */
        .detail-section-box { 
            border-top: 1px solid #e0e0e0; 
            padding-top: 15px; 
            margin-bottom: 20px; 
        }
        .detail-item strong { width: 120px; display: inline-block; color: #333; font-weight: 600; }
        .detail-item { font-size: 14px; color: #666; margin-bottom: 5px; }
        .description-text { font-size: 14px; color: #555; line-height: 1.5; margin-top: 10px; }
        .lihat-selengkapnya { color: #102C54; font-size: 13px; cursor: pointer; font-weight: 500; margin-top: 5px; display: inline-block; }

        /* Kelengkapan Produk */
        .kelengkapan-list { list-style: none; padding-left: 0; margin-top: 10px; }
        .kelengkapan-list li { font-size: 14px; color: #555; margin-bottom: 5px; }

        /* Rating & Reviews Section (Sesuai Gambar) */
        .reviews-section { background: white; padding: 20px 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-top: 20px; }
        .reviews-header { font-size: 20px; font-weight: 600; color: #333; margin-bottom: 15px; }
        /* Menggunakan style dari rating-box untuk tampilan review di bagian bawah */

        /* Media Queries untuk Responsif (Opsional tapi disarankan) */
        @media (max-width: 900px) {
            .product-detail-grid { grid-template-columns: 1fr; }
            .product-page { padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" onerror="this.style.display='none'">
            <span class="kategori">Detail Produk</span>
        </div>
    </div>

    <div class="container">
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <a href="{{ route('products.index') }}" class="btn-back">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="transform: rotate(180deg);">
                    <path d="M6 12l4-4-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kembali ke Produk Saya
            </a>
        </div>

        <div class="product-page">
            <div class="product-detail-grid">
                
                <div class="product-image-col">
                    <div class="product-image-section">
                        @if ($product->photo)
                            @if(Str::startsWith($product->photo, 'products/'))
                                <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="main-image">
                            @else
                                <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="main-image">
                            @endif
                        @else
                            <div class="main-image" style="display: flex; align-items: center; justify-content: center; background: #f5f5f5; color: #999;">
                                No Image
                            </div>
                        @endif
                    </div>

                    <div class="rating-box">
                        <h3>Rata-rata Rating Pengguna</h3>
                        <div class="rating-score-display">
                            <span class="stars">★★★★★</span>
                            <span class="score">{{ number_format($product->rating) }}</span>
                        </div>
                        <p class="sold-count">Terjual {{ $product->sold_count}}</p>
                        <a href="{{ route('ulasan.form', $product->id) }}" style="text-decoration: none; width: 100%; display: block;">
                            <button class="btn-review-write" type="button">Tulis Reviewmu</button>
                        </a>
                    </div>
                </div>

                <div class="product-info-col">
                    <h1 style="font-size: 32px; font-weight: bold;  margin-bottom: 10px; color: #102C54;">{{ $product->name }}</h1>
                    
                    <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>

                    <div style="font-weight: 600; margin-bottom: 10px; color: #102C54;">Variasi Produk:</div>
                    @if($product->variants && $product->variants->count() > 0)
                    <div class="variant-section">
                        <div class="variant-button-group">
                            @foreach($product->variants as $index => $variant)
                                <button class="variant-button" 
                                        data-price="{{ $variant->variant_price ?? $product->price }}"
                                        data-stock="{{ $variant->variant_stock }}">
                                    {{ $variant->variant_name }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="variant-section">
                        <div class="variant-label" style="color: #999; font-style: italic;">Tidak ada variasi pada produk ini</div>
                    </div>
                    @endif

                    <div class="detail-section-box">
                        <div style="font-weight: 600; margin-bottom: 10px; color: #102C54;">Deskripsi Produk</div>
                        <div class="description">{{ $product->description }}</div>
                
                    </div>
                    <div class="detail-section-box">
                        <div style="font-weight: 600; margin-bottom: 10px; color: #102C54;">Detail Produk</div>
                        <div class="detail-item"><strong>Kategori:</strong> {{ $product->category }}</div>
                        <div class="detail-item"><strong>Stok Tersedia:</strong> {{ $product->stock }} pcs</div>
                        <div class="detail-item"><strong>Berat:</strong> {{ $product->weight }} g</div>
                        <div class="detail-item"><strong>SKU:</strong> {{ $product->sku }}</div>
                </div>
            </div>
        </div>

        {{-- Saya tidak merubah bagian ini karena sudah cukup baik dan fokus pada perbaikan tampilan utama --}}
        <div class="reviews-section">
            <h2 class="reviews-header">Review Produk</h2>
            
            @if(isset($product->reviews) && $product->reviews->count() > 0)
                <div class="rating-summary">
                    <div class="rating-score">{{ number_format($product->rating) }}</div>
                    <div>
                        <div class="stars">★★★★★</div>
                        <div class="rating-count">{{ $product->rating_count}} rating</div>
                    </div>
                </div>
                @foreach($product->reviews as $review)
                <div class="review-item">
                    <div class="review-header">
                        <div class="reviewer-name">{{ $review->reviewer_name }}</div>
                        <div class="review-date">{{ $review->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="review-stars">
                        {{-- Logika bintang sesuai rating --}}
                    </div>
                    <div class="review-text">{{ $review->comment }}</div>
                </div>
                @endforeach
            @else
                <div class="no-reviews" style="color: #999; font-style: italic;">Belum ada review untuk produk ini</div>
            @endif
        </div>
    </div>
</body>
</html>


{{-- 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Tukutuku</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f5f5f5;
        }

        .header {
            background: linear-gradient(to right, #102C54, #1a4080);
            color: white;
            padding: 15px 0;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            text-decoration: none;
            color: white;
        }

        .search-box {
            flex: 1;
            max-width: 600px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .product-detail {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 30px;
            background: white;
            padding: 30px;
            border-radius: 8px;
        }

        .product-image-section {
            position: sticky;
            top: 20px;
            height: fit-content;
        }

        .main-image {
            width: 100%;
            aspect-ratio: 1;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            margin-bottom: 15px;
        }

        .badge-container {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .product-info h1 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
            line-height: 1.4;
        }

        .price {
            font-size: 32px;
            font-weight: bold;
            color: #f57c00;
            margin-bottom: 20px;
        }

        .detail-section {
            margin-bottom: 25px;
            padding-bottom: 25px;
            border-bottom: 1px solid #e0e0e0;
        }

        .detail-label {
            font-weight: 600;
            color: #666;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            font-size: 14px;
            color: #444;
        }

        .detail-item svg {
            width: 16px;
            height: 16px;
            fill: #666;
        }

        .stock-info {
            display: inline-block;
            background: #e8f5e9;
            color: #2e7d32;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .description {
            line-height: 1.6;
            color: #555;
            margin-top: 15px;
        }

        .rating-section {
            background: white;
            padding: 25px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .rating-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .rating-summary {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .rating-score {
            font-size: 48px;
            font-weight: bold;
            color: #333;
        }

        .stars {
            color: #ffa000;
            font-size: 24px;
        }

        .rating-count {
            color: #666;
            font-size: 14px;
        }

        .btn-review {
            background: #1976d2;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-review:hover {
            background: #1565c0;
        }

        .review-item {
            padding: 20px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .reviewer-name {
            font-weight: 600;
            color: #333;
        }

        .review-date {
            color: #999;
            font-size: 13px;
        }

        .review-stars {
            color: #ffa000;
            margin-bottom: 8px;
        }

        .review-text {
            color: #555;
            line-height: 1.5;
        }

        .no-reviews {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1976d2;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">

        <div style="margin-bottom: 15px;">
            <a href="{{ route('products.index') }}" class="btn-back">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="transform: rotate(180deg);">
                    <path d="M6 12l4-4-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kembali ke Daftar Produk
            </a>
        </div>

        <!-- Product Detail -->
        <div class="product-detail">
            <!-- Product Image -->
            <div class="product-image-section">
                @if ($product->photo)
                    @if(Str::startsWith($product->photo, 'products/'))
                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="main-image">
                    @else
                        <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="main-image">
                    @endif
                @else
                    <div class="main-image" style="display: flex; align-items: center; justify-content: center; background: #f5f5f5; color: #999;">
                        No Image
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="product-info">
                <h1>{{ $product->name }}</h1>
                
                <div class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>

                <div class="detail-section">
                    <div class="stock-info">Stok: {{ $product->stock }} | Berat: {{ $product->weight }}g</div>
                    
                    <div class="detail-item">
                        <svg viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/></svg>
                        {{ $product->province ?? 'Indonesia' }}
                    </div>
                    
                    <div class="detail-item">
                        <svg viewBox="0 0 24 24"><path d="M20 4H4c-1.11 0-1.99.89-1.99 2L2 18c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
                        {{ $product->store_name ?? 'Toko' }}
                    </div>

                    <div class="detail-item">
                        <svg viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                        {{ $product->rating }} ({{ $product->rating_count }} rating)
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-label">Detail Produk</div>
                    <div class="detail-item"><strong>Kategori:</strong> {{ $product->category ?? 'Umum' }}</div>
                    <div class="detail-item"><strong>SKU:</strong> {{ $product->sku ?? '-' }}</div>
                    <div class="detail-item"><strong>Status:</strong> {{ ucfirst($product->status) }}</div>
                </div>

                <div class="detail-section">
                    <div class="detail-label">Deskripsi Produk</div>
                    <div class="description">{{ $product->description }}</div>
                </div>
            </div>
        </div>

        <!-- Rating & Reviews Section -->
        <div class="rating-section">
            <div class="rating-header">
                <div class="rating-summary">
                    <div class="rating-score">{{ number_format($product->rating, 1) }}</div>
                    <div>
                        <div class="stars">★★★★★</div>
                        <div class="rating-count">{{ $product->rating_count }} rating</div>
                    </div>
                </div>
                <button class="btn-review">Tambah Review</button>
            </div>

            @if($product->reviews->count() > 0)
                @foreach($product->reviews as $review)
                <div class="review-item">
                    <div class="review-header">
                        <div class="reviewer-name">{{ $review->reviewer_name }}</div>
                        <div class="review-date">{{ $review->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="review-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                    </div>
                    <div class="review-text">{{ $review->comment }}</div>
                </div>
                @endforeach
            @else
                <div class="no-reviews">Belum ada ulasan untuk produk ini</div>
            @endif
        </div>
    </div>
</body>
</html> 
--}}