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
            background: linear-gradient(135deg, #2d5a8f 0%, #1e3a5f 100%);
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
        }

        .hero-content {
            flex: 1;
            text-align: left;
        }

        .hero-image {
            position: absolute;
            right: 80px;
            top: 50%;
            transform: translateY(-50%);
            max-width: 250px;
            max-height: 200px;
            object-fit: contain;
        }

        .hero-section h1 {
            font-size: 42px;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .hero-section p {
            font-size: 18px;
            margin-bottom: 25px;
            opacity: 0.95;
        }

        .btn-daftar {
            background: white;
            color: #1e3a5f;
            padding: 14px 35px;
            border: none;
            border-radius: 25px;
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
            max-width: 1400px;
            margin: 0 auto;
        }

        .kategori-section h2 {
            font-size: 32px;
            color: #1e3a5f;
            margin-bottom: 30px;
            font-weight: 700;
        }

        .kategori-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 25px;
        }

        .kategori-card {
            background: white;
            border-radius: 12px;
            padding: 25px 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .kategori-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .kategori-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kategori-icon img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .kategori-name {
            font-size: 15px;
            font-weight: 600;
            color: #1e3a5f;
            line-height: 1.4;
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

            .kategori-section {
                padding: 20px;
            }

            .kategori-grid {
                grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo-section">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo" onerror="this.style.display='none'">
            <a href="#kategori" class="kategori-link">Kategori</a>
        </div>
        
        <div class="search-bar">
            <input type="text" placeholder="Cari di tukutuku">
        </div>
        
        <div class="user-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <h1>Jual di tukutuku</h1>
            <p>buka tokomu sendiri, raih jutaan pembeli</p>
            <button class="btn-daftar" onclick="window.location.href='/daftar'">Daftar Sekarang</button>
        </div>
        <img src="{{ asset('img/Logo Banner.png') }}" alt="Banner" class="hero-image" onerror="this.style.display='none'">
    </div>

    <!-- Kategori Section -->
    <div class="kategori-section" id="kategori">
        <h2>Kategori Pilihan</h2>
        <div class="kategori-grid">
            <a href="/kategori/aksesoris-fashion" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/aksesoris-fashion.png') }}" alt="Aksesoris Fashion">
                </div>
                <div class="kategori-name">Aksesoris<br>Fashion</div>
            </a>

            <a href="/kategori/jam-tangan" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/jam-tangan.png') }}" alt="Jam Tangan">
                </div>
                <div class="kategori-name">Jam<br>Tangan</div>
            </a>

            <a href="/kategori/sepatu" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/sepatu.png') }}" alt="Sepatu">
                </div>
                <div class="kategori-name">Sepatu</div>
            </a>

            <a href="/kategori/tas-pria" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/tas-pria.png') }}" alt="Tas Pria">
                </div>
                <div class="kategori-name">Tas Pria</div>
            </a>

            <a href="/kategori/tas-wanita" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/tas-wanita.png') }}" alt="Tas Wanita">
                </div>
                <div class="kategori-name">Tas Wanita</div>
            </a>

            <a href="/kategori/perawatan-kecantikan" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/perawatan-kecantikan.png') }}" alt="Perawatan & Kecantikan">
                </div>
                <div class="kategori-name">Perawatan<br>& Kecantikan</div>
            </a>

            <a href="/kategori/handphone-aksesoris" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/handphone-aksesoris.png') }}" alt="Handphone & Aksesoris">
                </div>
                <div class="kategori-name">Handphone<br>& Aksesoris</div>
            </a>

            <a href="/kategori/minuman" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/minuman.png') }}" alt="Minuman">
                </div>
                <div class="kategori-name">Minuman</div>
            </a>

            <a href="/kategori/makanan" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/makanan.png') }}" alt="Makanan">
                </div>
                <div class="kategori-name">Makanan</div>
            </a>

            <a href="/kategori/perlengkapan-rumah" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/perlengkapan-rumah.png') }}" alt="Perlengkapan Rumah">
                </div>
                <div class="kategori-name">Perlengkapan<br>Rumah</div>
            </a>

            <a href="/kategori/perlengkapan-bayi" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/perlengkapan-bayi.png') }}" alt="Perlengkapan Bayi">
                </div>
                <div class="kategori-name">Perlengkapan<br>Bayi</div>
            </a>

            <a href="/kategori/otomotif" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/otomotif.png') }}" alt="Otomotif">
                </div>
                <div class="kategori-name">Otomotif</div>
            </a>

            <a href="/kategori/komputer-aksesoris" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/komputer-aksesoris.png') }}" alt="Komputer & Aksesoris">
                </div>
                <div class="kategori-name">Komputer<br>& Aksesoris</div>
            </a>

            <a href="/kategori/kesehatan" class="kategori-card">
                <div class="kategori-icon">
                    <img src="{{ asset('img/kategori/kesehatan.png') }}" alt="Kesehatan">
                </div>
                <div class="kategori-name">Kesehatan</div>
            </a>
        </div>
    </div>
</body>
</html>