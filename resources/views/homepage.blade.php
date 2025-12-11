<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tukutuku - Homepage</title>
    <style>
        /* CSS Utama & Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        /* Warna Utama Tukutuku (Diambil dari Code Kedua) */
        :root {
            --tukutuku-blue-dark: #102C54;
            --tukutuku-blue-light: #1b497eff;
            --tukutuku-yellow: #ffd700;
        }

        /* Header */
        .header {
            /* Mengambil warna dari :root di code kedua, lebih konsisten */
            background-color: var(--tukutuku-blue-dark); 
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
            position: relative;
        }

        .search-form {
            position: relative;
            width: 100%;
        }

        .search-bar input {
            width: 100%;
            padding: 12px 50px 12px 20px;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            background: rgba(255,255,255,0.95);
        }

        .search-bar input::placeholder {
            color: #999;
        }

        .search-bar input:focus {
            outline: none;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            /* Menggunakan warna dari :root di code kedua */
            background: var(--tukutuku-blue-dark); 
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

        .search-btn:hover {
            background: #2d5a8f;
        }

        .search-btn svg {
            width: 18px;
            height: 18px;
            fill: white;
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

        /* Hero Section */
        .hero-section {
            /* Menggunakan warna dari :root di code kedua */
            background: var(--tukutuku-blue-light); 
            padding: 60px 40px;
            margin: 30px 40px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
            /* Tambahan dari code kedua */
            max-width: 1300px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-content {
            flex: 1;
            text-align: left;
            /* Tambahan dari code kedua */
            z-index: 10;
        }

        .hero-image {
            /* Perbaikan posisi dari code kedua */
            position: absolute;
            right: 0; 
            bottom: 0;
            max-width: 300px;
            height: auto;
            object-fit: contain;
            opacity: 0.8;
            z-index: 5;
        }

        .hero-section h1 {
            /* Disesuaikan dari code kedua agar tidak terlalu besar di desktop */
            font-size: 36px; 
            margin-bottom: 10px;
            font-weight: 700;
        }

        .hero-section p {
            /* Disesuaikan dari code kedua */
            font-size: 16px; 
            margin-bottom: 25px;
            opacity: 0.95;
        }

        /* AUTH BUTTONS (Ditambahkan dari Code Kedua) */
        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn-login, .btn-register {
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid white;
            transition: 0.3s;
        }

        .btn-login {
            background: transparent;
            color: white;
            border-color: white;
        }
        
        .btn-register {
            background: white; 
            color: var(--tukutuku-blue-dark);
            border: none;
        }

        .btn-login:hover {
            background: rgba(255,255,255,0.1);
        }
        .btn-register:hover {
            background: var(--tukutuku-yellow);
        }
        /* END AUTH BUTTONS */

        /* Kategori Section */
        .kategori-section {
            padding: 40px;
            /* Disesuaikan dari code kedua */
            max-width: 1300px;
            margin: 0 auto;
        }

        .kategori-section h2 {
            /* Disesuaikan dari code kedua */
            font-size: 24px;
            color: var(--tukutuku-blue-dark);
            margin-bottom: 30px;
            font-weight: 700;
        }

        .kategori-grid {
            /* Disesuaikan dari code kedua */
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .kategori-card {
            background: white;
            /* Disesuaikan dari code kedua */
            border-radius: 10px;
            padding: 20px 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            text-decoration: none;
            color: inherit;
            display: block;
            /* Ditambahkan dari code kedua */
            border: 2px solid transparent; 
        }
        
        /* CSS untuk Kategori yang sedang aktif/dipilih (Ditambahkan dari Code Kedua) */
        .kategori-card.active-category {
            border: 2px solid var(--tukutuku-blue-light);
            box-shadow: 0 0 0 3px rgba(27, 73, 126, 0.2);
        }

        .kategori-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        
        .kategori-icon {
            /* Disesuaikan dari code kedua */
            width: 80px; 
            height: 80px; 
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kategori-icon img {
            /* Disesuaikan dari code kedua */
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        .kategori-name {
            /* Disesuaikan dari code kedua */
            font-size: 13px;
            font-weight: 600;
            color: #444;
            line-height: 1.3;
        }

        /* Product Grid (Scroll Vertikal) - Ditambahkan dari Code Kedua */
        .product-scroll-section {
            max-width: 1300px;
            margin: 0 auto 50px;
            padding: 0 40px;
        }

        .product-scroll-section h2 {
            font-size: 24px;
            color: var(--tukutuku-blue-dark);
            margin-bottom: 20px;
            font-weight: 700;
        }
        
        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
            padding-bottom: 10px;
            overflow-x: hidden;
            min-height: 300px;
        }
        
        .product-card {
            width: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
            text-decoration: none;
            color: #333;
            transition: transform 0.2s;
            cursor: pointer;
            display: block; 
        }

        /* Kelas untuk menyembunyikan produk saat difilter */
        .product-card.hidden {
            display: none;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }

        .product-image-wrapper {
            width: 100%;
            height: 160px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 1px solid #eee;
        }

        .product-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 10px;
        }

        .product-details {
            padding: 10px;
            text-align: left;
        }

        .product-name {
            font-size: 13px;
            font-weight: 500;
            height: 3.2em; /* 2 baris teks */
            overflow: hidden;
            line-height: 1.6;
            margin-bottom: 5px;
        }

        .product-price {
            font-size: 15px;
            font-weight: 700;
            color: #ff5722;
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

            .hero-section {
                margin: 20px;
                padding: 40px 20px;
                flex-direction: column;
                text-align: center;
            }

            .hero-content {
                text-align: center;
            }

            .hero-image {
                position: static;
                transform: none;
                margin-top: 20px;
                max-width: 200px;
            }

            .hero-section h1 {
                font-size: 32px;
            }

            .kategori-section, .product-scroll-section {
                padding: 20px;
            }

            .kategori-grid {
                /* Disesuaikan dari code kedua */
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                gap: 10px;
            }

            /* Product Grid di Mobile (Disesuaikan dari code kedua) */
            .product-container {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-section">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo" onerror="this.style.display='none'">
            <a href="#kategori" class="kategori-link">Kategori</a>
        </div>

        <div class="search-bar">
            {{-- Form ini mengirim data ke route 'search' dengan metode GET --}}
            <form action="{{ route('search') }}" method="GET" class="search-form">
                {{-- Input name="q" Wajib ada agar controller bisa membaca keyword --}}
                <input type="text" name="q" placeholder="Cari di tukutuku" value="{{ request('q') }}" required>
                
                <button type="submit" class="search-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                </button>
            </form>
        </div>

        <div class="auth-buttons">
            @if(Auth::check())
                <button class="btn-login" onclick="window.location.href='/dashboard'">Dashboard</button>
            @else
                <button class="btn-login" onclick="window.location.href='/login'">Masuk</button>
            @endif
        </div>
    </div>

    <div class="hero-section">
        <div class="hero-content">
            <h1>Jual di tukutuku</h1>
            <p>buka tokomu sendiri, raih jutaan pembeli</p>
            <button class="btn-daftar" onclick="window.location.href='/register-seller'">Daftar Sekarang</button>
        </div>
        <img src="{{ asset('img/Logo Banner.png') }}" alt="Banner" class="hero-image" onerror="this.style.display='none'">
    </div>

    <div class="kategori-section" id="kategori">
        <h2>Kategori Pilihan</h2>

        <div class="kategori-grid">
            
            <a href="#" class="kategori-card active-category" data-category="all">
                <div class="kategori-icon">
                    <img src="{{ asset('img/Logo Banner.png') }}" alt="Semua Produk" onerror="this.onerror=null; this.src='{{ asset('img/placeholder-kategori.png') }}'">
                </div>
                <div class="kategori-name">Semua<br>Produk</div>
            </a>

            <a href="#" class="kategori-card" data-category="Aksesoris Fashion">
                <div class="kategori-icon">
                    <img src="{{ asset('img/aksesorisfashion.png') }}" alt="Aksesoris Fashion" onerror="this.onerror=null; this.src='{{ asset('img/placeholder-kategori.png') }}'">
                </div>
                <div class="kategori-name">Aksesoris<br>Fashion</div>
            </a>

            <a href="#" class="kategori-card" data-category="Jam Tangan">
                <div class="kategori-icon">
                    <img src="{{ asset('img/jamtangan.png') }}" alt="Jam Tangan" onerror="this.onerror=null; this.src='{{ asset('img/placeholder-kategori.png') }}'">
                </div>
                <div class="kategori-name">Jam<br>Tangan</div>
            </a>

            <a href="#" class="kategori-card" data-category="Sepatu">
                <div class="kategori-icon">
                    <img src="{{ asset('img/sneakers.png') }}" alt="Sepatu" onerror="this.onerror=null; this.src='{{ asset('img/placeholder-kategori.png') }}'">
                </div>
                <div class="kategori-name">Sepatu</div>
            </a>

            <a href="#" class="kategori-card" data-category="Tas Pria">
                <div class="kategori-icon">
                    <img src="{{ asset('img/taskulit.png') }}" alt="Tas Pria" onerror="this.onerror=null; this.src='{{ asset('img/placeholder-kategori.png') }}'">
                </div>
                <div class="kategori-name">Tas Pria</div>
            </a>

            <a href="#" class="kategori-card" data-category="Tas Wanita">
                <div class="kategori-icon">
                    <img src="{{ asset('img/dompet.png') }}" alt="Tas Wanita" onerror="this.onerror=null; this.src='{{ asset('img/placeholder-kategori.png') }}'">
                </div>
                <div class="kategori-name">Tas Wanita</div>
            </a>

            <a href="#" class="kategori-card" data-category="Perawatan & Kecantikan">
                <div class="kategori-icon">
                    <img src="{{ asset('img/perawatankecantikan.png') }}" alt="Perawatan & Kecantikan">
                </div>
                <div class="kategori-name">Perawatan<br>& Kecantikan</div>
            </a>

            <a href="#" class="kategori-card" data-category="Handphone-Aksesoris">
                <div class="kategori-icon">
                    <img src="{{ asset('img/headphone.png') }}" alt="Handphone & Aksesoris" onerror="this.onerror=null; this.src='{{ asset('img/placeholder-kategori.png') }}'">
                </div>
                <div class="kategori-name">Handphone<br>& Aksesoris</div>
            </a>

            <a href="#" class="kategori-card" data-category="minuman">
                <div class="kategori-icon">
                    <img src="{{ asset('img/tehhijau.png') }}" alt="Minuman" onerror="this.onerror=null; this.src='{{ asset('img/placeholder-kategori.png') }}'">
                </div>
                <div class="kategori-name">Minuman</div>
            </a>

            <a href="#" class="kategori-card" data-category="makanan">
                <div class="kategori-icon">
                    <img src="{{ asset('img/keripik.png') }}" alt="Makanan" onerror="this.onerror=null; this.src='{{ asset('img/placeholder-kategori.png') }}'">
                </div>
                <div class="kategori-name">Makanan</div>
            </a>

            <a href="#" class="kategori-card" data-category="perlengkapan-rumah">
                <div class="kategori-icon">
                    <img src="{{ asset('img/perlengkapanrumah.png') }}" alt="Perlengkapan Rumah">
                </div>
                <div class="kategori-name">Perlengkapan<br>Rumah</div>
            </a>

            <a href="#" class="kategori-card" data-category="bayi">
                <div class="kategori-icon">
                    <img src="{{ asset('img/perlengkapanbayi.png') }}" alt="Perlengkapan Bayi">
                </div>
                <div class="kategori-name">Perlengkapan<br>Bayi</div>
            </a>

            <a href="#" class="kategori-card" data-category="otomotif">
                <div class="kategori-icon">
                    <img src="{{ asset('img/otomotif.png') }}" alt="Otomotif">
                </div>
                <div class="kategori-name">Otomotif</div>
            </a>

            <a href="#" class="kategori-card" data-category="komputer-aksesoris">
                <div class="kategori-icon">
                    <img src="{{ asset('img/komputeraksesoris.png') }}" alt="Komputer & Aksesoris">
                </div>
                <div class="kategori-name">Komputer<br>& Aksesoris</div>
            </a>

            <a href="#" class="kategori-card" data-category="kesehatan">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kesehatan.png') }}" alt="Kesehatan">
                </div>
                <div class="kategori-name">Kesehatan</div>
            </a>

            <a href="#" class="kategori-card" data-category="Pakaian">
                <div class="kategori-icon">
                    <img src="{{ asset('img/pakaian.png') }}" alt="Pakaian">
                </div>
                <div class="kategori-name">Pakaian</div>
            </a>

        </div>
    </div>
    
    <div class="product-scroll-section">
        <h2 id="productTitle">Produk Pilihan untuk Anda</h2>

        <div class="product-container" id="productContainer">
            
            {{-- LOOPING OTOMATIS DARI DATABASE --}}
            @if(isset($products) && count($products) > 0)
                @foreach($products as $product)
                    {{-- Link menuju detail produk berdasarkan ID --}}
                    <a href="{{ route('public.product.show', $product->id) }}" class="product-card" data-category="{{ $product->category }}">
                        
                        <div class="product-image-wrapper">
                            {{-- Logika Gambar: Cek apakah gambar upload-an sendiri atau dummy --}}
                            @if($product->photo)
                                @if(Str::startsWith($product->photo, 'products/'))
                                     {{-- Jika gambar hasil upload sendiri --}}
                                     <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}">
                                @else
                                     {{-- Jika gambar dummy/bawaan seeder --}}
                                     <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}">
                                @endif
                            @else
                                {{-- Gambar cadangan jika tidak ada foto --}}
                                <img src="https://via.placeholder.com/200x200?text=No+Image" alt="No Image">
                            @endif
                        </div>

                        <div class="product-details">
                            <p class="product-name">{{ $product->name }}</p>
                            <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            
                            {{-- Info Tambahan Rating --}}
                            <div style="font-size: 11px; color: #888; margin-top: 5px; display: flex; justify-content: space-between;">
                                <span style="color: #ffc107;">★ {{ number_format($product->rating ?? 0, 1) }}</span>
                                <span>Stok: {{ $product->stock }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                {{-- TAMPILAN JIKA PRODUK KOSONG --}}
                <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #666;">
                    <p>Belum ada produk yang tersedia saat ini.</p>
                </div>
            @endif

        </div>
    </div>

    {{-- Script untuk Fungsionalitas Tombol dan Filter Kategori --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const categoryCards = document.querySelectorAll('.kategori-card');
            const productCards = document.querySelectorAll('.product-card');
            const productTitle = document.getElementById('productTitle');

            categoryCards.forEach(card => {
                card.addEventListener('click', (event) => {
                    event.preventDefault();

                    // 1. Ambil kategori yang diklik
                    const selectedCategory = card.getAttribute('data-category');
                    const categoryName = card.querySelector('.kategori-name').textContent.replace('<br>', ' ').trim();

                    // 2. Update kelas active pada kategori card
                    categoryCards.forEach(c => c.classList.remove('active-category'));
                    card.classList.add('active-category');

                    // 3. Update judul produk
                    if (selectedCategory === 'all') {
                        productTitle.textContent = 'Produk Pilihan untuk Anda';
                    } else {
                        productTitle.textContent = `Produk Kategori ${categoryName}`;
                    }
                    
                    // 4. Filter produk
                    productCards.forEach(product => {
                        // Pastikan data-category di produk sesuai dengan yang ada di database
                        const productCategory = product.getAttribute('data-category');
                        
                        if (selectedCategory === 'all' || productCategory === selectedCategory) {
                            product.classList.remove('hidden');
                        } else {
                            product.classList.add('hidden');
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>