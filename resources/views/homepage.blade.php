<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tukutuku - Homepage</title>
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

        /* Warna Utama Tukutuku */
        :root {
            --tukutuku-blue-dark: #102C54;
            --tukutuku-blue-light: #1b497eff;
            --tukutuku-yellow: #ffd700;
        }

        /* Header */
        .header {
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
        }

        .search-bar input {
            width: 100%;
            padding: 12px 20px;
            border: none;
            border-radius: 25px;
            font-size: 15px;
            background: rgba(255,255,255,0.95);
        }

        .search-bar input::placeholder {
            color: #999;
        }

        /* AUTH BUTTONS */
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

        /* Hero Section */
        .hero-section {
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
            max-width: 1300px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-content {
            flex: 1;
            text-align: left;
            z-index: 10;
        }

        .hero-image {
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
            font-size: 36px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .hero-section p {
            font-size: 16px;
            margin-bottom: 25px;
            opacity: 0.95;
        }

        .btn-daftar {
            background: white;
            color: var(--tukutuku-blue-dark);
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .btn-daftar:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }

        /* Kategori Section */
        .kategori-section {
            padding: 40px;
            max-width: 1300px;
            margin: 0 auto;
        }

        .kategori-section h2 {
            font-size: 24px;
            color: var(--tukutuku-blue-dark);
            margin-bottom: 30px;
            font-weight: 700;
        }

        .kategori-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .kategori-card {
            background: white;
            border-radius: 10px;
            padding: 20px 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            text-decoration: none;
            color: inherit;
            display: block;
            border: 2px solid transparent; 
        }
        
        /* CSS untuk Kategori yang sedang aktif/dipilih */
        .kategori-card.active-category {
            border: 2px solid var(--tukutuku-blue-light);
            box-shadow: 0 0 0 3px rgba(27, 73, 126, 0.2);
        }

        .kategori-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        
        .kategori-icon {
            width: 80px; 
            height: 80px; 
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kategori-icon img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        .kategori-name {
            font-size: 13px;
            font-weight: 600;
            color: #444;
            line-height: 1.3;
        }

        /* Product Grid (Scroll Vertikal) */
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
            height: 3.2em;
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
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                gap: 10px;
            }

            /* Product Grid di Mobile */
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
            <input type="text" placeholder="Cari di tukutuku">
        </div>

        <div class="auth-buttons">
            <button class="btn-login" onclick="window.location.href='/login'">Masuk</button>
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
            
            {{-- Kategori "Semua Produk" DITAMBAHKAN KEMBALI --}}
            <a href="#" class="kategori-card active-category" data-category="all">
                <div class="kategori-icon">
                    {{-- Placeholder Icon --}}
                    <img src="{{ asset('img/Logo Banner.png') }}" alt="Semua Produk" onerror="this.onerror=null; this.src='{{ asset('img/placeholder-kategori.png') }}'">
                </div>
                <div class="kategori-name">Semua<br>Produk</div>
            </a>
            {{-- Akhir Kategori "Semua Produk" --}}

            {{-- Kategori telah disinkronkan dengan nama data-category pada produk --}}
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
            
            {{-- Produk Utama (data-category sudah disinkronkan) --}}
            
            <a href="/produk/dompet" class="product-card" data-category="Tas Pria">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/dompet.png') }}" alt="Tas Pria">
                </div>
                <div class="product-details">
                    <p class="product-name">Dompet Kulit Pria Lipat Tiga</p>
                    <p class="product-price">Rp 150.000</p>
                </div>
            </a>
            
            <a href="/produk/headphone" class="product-card" data-category="Handphone-Aksesoris">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/headphone.png') }}" alt="Handphone & Aksesoris">
                </div>
                <div class="product-details">
                    <p class="product-name">Headphone Bluetooth Noise Cancelling Q20i</p>
                    <p class="product-price">Rp 499.000</p>
                </div>
            </a>

            <a href="/produk/jaket-denim" class="product-card" data-category="Pakaian">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/jaketdenim.png') }}" alt="Pakaian">
                </div>
                <div class="product-details">
                    <p class="product-name">Jaket Denim Basic Pria - Blue Wash</p>
                    <p class="product-price">Rp 320.000</p>
                </div>
            </a>

            <a href="/produk/jam-tangan" class="product-card" data-category="Jam Tangan">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/jamtangan.png') }}" alt="Jam Tangan">
                </div>
                <div class="product-details">
                    <p class="product-name">Jam Tangan Analog Pria Rantai</p>
                    <p class="product-price">Rp 210.000</p>
                </div>
            </a>
            
            <a href="/produk/kemeja-batik" class="product-card" data-category="Pakaian">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/kemejabatik.png') }}" alt="Pakaian">
                </div>
                <div class="product-details">
                    <p class="product-name">Kemeja Batik Lengan Panjang Modern</p>
                    <p class="product-price">Rp 185.000</p>
                </div>
            </a>

            <a href="/produk/keripik" class="product-card" data-category="makanan">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/keripik.png') }}" alt="Makanan">
                </div>
                <div class="product-details">
                    <p class="product-name">Keripik Singkong Balado Pedas Manis</p>
                    <p class="product-price">Rp 15.000</p>
                </div>
            </a>

            <a href="/produk/kopi" class="product-card" data-category="minuman">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/kopi.png') }}" alt="Minuman">
                </div>
                <div class="product-details">
                    <p class="product-name">Biji Kopi Arabika Gayo Specialty</p>
                    <p class="product-price">Rp 75.000</p>
                </div>
            </a>

            <a href="/produk/madu" class="product-card" data-category="kesehatan">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/madu.png') }}" alt="Madu">
                </div>
                <div class="product-details">
                    <p class="product-name">Madu Murni Hutan Multiflora</p>
                    <p class="product-price">Rp 95.000</p>
                </div>
            </a>

            <a href="/produk/sneakers" class="product-card" data-category="Sepatu">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/sneakers.png') }}" alt="Sepatu">
                </div>
                <div class="product-details">
                    <p class="product-name">Sepatu Sneakers Casual Unisex</p>
                    <p class="product-price">Rp 280.000</p>
                </div>
            </a>
            
            <a href="/produk/teh-hijau" class="product-card" data-category="minuman">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/tehhijau.png') }}" alt="Minuman">
                </div>
                <div class="product-details">
                    <p class="product-name">Teh Hijau Celup Original Organik</p>
                    <p class="product-price">Rp 30.000</p>
                </div>
            </a>

            {{-- Produk Tambahan --}}
            
            <a href="/produk/tas-kulit" class="product-card" data-category="Tas Pria">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/taskulit.png') }}" alt="Tas Pria">
                </div>
                <div class="product-details">
                    <p class="product-name">Tas Kulit Pria - Vintage Brown</p>
                    <p class="product-price">Rp 450.000</p>
                </div>
            </a>
            
            <a href="/produk/serum-wajah" class="product-card" data-category="Perawatan & Kecantikan">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/serum.png') }}" alt="Perawatan & Kecantikan">
                </div>
                <div class="product-details">
                    <p class="product-name">Serum Wajah Anti Aging dengan Vitamin C</p>
                    <p class="product-price">Rp 129.000</p>
                </div>
            </a>
            
            <a href="/produk/snack-pedas" class="product-card" data-category="makanan">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/makaroni.png') }}" alt="Makanan">
                </div>
                <div class="product-details">
                    <p class="product-name">Makaroni Ngehe Level 5 (Ekstra Pedas)</p>
                    <p class="product-price">Rp 12.000</p>
                </div>
            </a>

            <a href="/produk/gorden" class="product-card" data-category="perlengkapan-rumah">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/gordenjendela.png') }}" alt="Perlengkapan Rumah">
                </div>
                <div class="product-details">
                    <p class="product-name">Gorden Jendela Minimalis Blackout</p>
                    <p class="product-price">Rp 79.000</p>
                </div>
            </a>

            <a href="/produk/botol-susu" class="product-card" data-category="bayi">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/botolsusu.png') }}" alt="Perlengkapan Bayi">
                </div>
                <div class="product-details">
                    <p class="product-name">Botol Susu Bayi Anti Kolik Set 3 Pcs</p>
                    <p class="product-price">Rp 155.000</p>
                </div>
            </a>
            
            <a href="/produk/oli" class="product-card" data-category="otomotif">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/olimotor.png') }}" alt="Otomotif">
                </div>
                <div class="product-details">
                    <p class="product-name">Oli Mesin Motor Synthetic 10W-40</p>
                    <p class="product-price">Rp 65.000</p>
                </div>
            </a>

            <a href="/produk/mouse" class="product-card" data-category="komputer-aksesoris">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/mousewireless.png') }}" alt="Komputer & Aksesoris">
                </div>
                <div class="product-details">
                    <p class="product-name">Mouse Wireless Silent Optic Ergonomis</p>
                    <p class="product-price">Rp 55.000</p>
                </div>
            </a>
            
            <a href="/produk/vitamin-c" class="product-card" data-category="kesehatan">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/suplemenvitamin.png') }}" alt="Kesehatan">
                </div>
                <div class="product-details">
                    <p class="product-name">Suplemen Vitamin C 500mg Jaga Imunitas</p>
                    <p class="product-price">Rp 45.000</p>
                </div>
            </a>

            <a href="/produk/tas-backpack-wanita" class="product-card" data-category="Tas Wanita">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/tasransel.png') }}" alt="Tas Wanita">
                </div>
                <div class="product-details">
                    <p class="product-name">Tas Ransel Wanita Fashion Korea</p>
                    <p class="product-price">Rp 190.000</p>
                </div>
            </a>

            <a href="/produk/kacamata-hitam" class="product-card" data-category="Aksesoris Fashion">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/kacamatahitam.png') }}" alt="Aksesoris Fashion">
                </div>
                <div class="product-details">
                    <p class="product-name">Kacamata Hitam Aviator Polarized</p>
                    <p class="product-price">Rp 85.000</p>
                </div>
            </a>
            
            {{-- Tambahan Produk Lagi --}}

            <a href="/produk/blender-portable" class="product-card" data-category="perlengkapan-rumah">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/blandermini.png') }}" alt="Perlengkapan Rumah">
                </div>
                <div class="product-details">
                    <p class="product-name">Blender Portable Mini Juicer USB</p>
                    <p class="product-price">Rp 99.000</p>
                </div>
            </a>

            <a href="/produk/air-fryer" class="product-card" data-category="perlengkapan-rumah">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/airfrayer.png') }}" alt="Perlengkapan Rumah">
                </div>
                <div class="product-details">
                    <p class="product-name">Air Fryer Digital Kapasitas 4 Liter</p>
                    <p class="product-price">Rp 599.000</p>
                </div>
            </a>

            <a href="/produk/powerbank" class="product-card" data-category="Handphone-Aksesoris">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/powerbank.png') }}" alt="Handphone & Aksesoris">
                </div>
                <div class="product-details">
                    <p class="product-name">Powerbank Fast Charging 20000mAh</p>
                    <p class="product-price">Rp 180.000</p>
                </div>
            </a>

            <a href="/produk/keyboard-mekanik" class="product-card" data-category="komputer-aksesoris">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/keyboardrgb.png') }}" alt="Komputer & Aksesoris">
                </div>
                <div class="product-details">
                    <p class="product-name">Keyboard Mekanik RGB Gaming TKL</p>
                    <p class="product-price">Rp 420.000</p>
                </div>
            </a>

            <a href="/produk/biskuit-coklat" class="product-card" data-category="makanan">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/biskuitcoklat.png') }}" alt="Makanan">
                </div>
                <div class="product-details">
                    <p class="product-name">Biskuit Coklat Crispy Aneka Rasa</p>
                    <p class="product-price">Rp 25.000</p>
                </div>
            </a>

            <a href="/produk/susu-uht" class="product-card" data-category="minuman">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/susufullcream.png') }}" alt="Minuman">
                </div>
                <div class="product-details">
                    <p class="product-name">Susu UHT Full Cream 1 Liter</p>
                    <p class="product-price">Rp 17.500</p>
                </div>
            </a>

            <a href="/produk/parfum-pria" class="product-card" data-category="Perawatan & Kecantikan">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/parfumpria.png') }}" alt="Perawatan & Kecantikan">
                </div>
                <div class="product-details">
                    <p class="product-name">Parfum Pria EDT Woody Citrus 100ml</p>
                    <p class="product-price">Rp 160.000</p>
                </div>
            </a>

            <a href="/produk/lip-tint" class="product-card" data-category="Perawatan & Kecantikan">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/liptintkorea.png') }}" alt="Perawatan & Kecantikan">
                </div>
                <div class="product-details">
                    <p class="product-name">Lip Tint Korea Tahan Lama - Shade Merah</p>
                    <p class="product-price">Rp 59.000</p>
                </div>
            </a>
            
            <a href="/produk/stroller-bayi" class="product-card" data-category="bayi">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/strollerbayi.png') }}" alt="Perlengkapan Bayi">
                </div>
                <div class="product-details">
                    <p class="product-name">Stroller Bayi Lipat Ringan dan Kuat</p>
                    <p class="product-price">Rp 850.000</p>
                </div>
            </a>

            <a href="/produk/helm-motor" class="product-card" data-category="otomotif">
                <div class="product-image-wrapper">
                    <img src="{{ asset('img/helmfullface.png') }}" alt="Otomotif">
                </div>
                <div class="product-details">
                    <p class="product-name">Helm Motor Full Face Sni - Matte Black</p>
                    <p class="product-price">Rp 350.000</p>
                </div>
            </a>

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