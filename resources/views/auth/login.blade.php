<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Marketplace PPL</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-container {
            display: flex;
            background: white;
            width: 900px;
            height: 550px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        /* Sisi Kiri (Gelap) */
        .left-side {
            flex: 1;
            background-color: #102C54; /* Warna Biru Gelap sesuai gambar */
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }
        .left-side img {
            width: 150px;
            margin-bottom: 20px;
        }
        .left-side h3 {
            font-weight: 400;
            opacity: 0.9;
            font-size: 16px;
        }
        /* Sisi Kanan (Form) */
        .right-side {
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right-side h2 {
            margin-bottom: 5px;
            color: #333;
        }
        .right-side p {
            color: #777;
            font-size: 14px;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
            font-size: 14px;
        }
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: #102C54;
            outline: none;
        }
        .btn-primary {
            width: 100%;
            padding: 14px;
            background-color: #102C54;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }
        .btn-primary:hover {
            background-color: #0d2345;
        }
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 14px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .footer-link {
            margin-top: 20px;
            text-align: center;
            font-size: 14px;
        }
        .footer-link a {
            color: #102C54;
            font-weight: bold;
            text-decoration: none;
        }
        
        /* Responsive Mobile */
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                width: 90%;
                height: auto;
            }
            .left-side {
                padding: 30px;
            }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- SISI KIRI -->
        <div class="left-side">
            <!-- Ganti src ini dengan path logo kamu -->
            <img src="{{ asset('img/logo.png') }}" alt="Logo" onerror="this.style.display='none'">
            <br>
            <h3>Masuk untuk mengelola akunmu</h3>
        </div>

        <!-- SISI KANAN -->
        <div class="right-side">
            <h2>Selamat Datang</h2>
            <p>Silakan masukkan detail akun Anda</p>

            <!-- Notifikasi Sukses (Hijau) -->
            @if(session('success'))
                <div class="alert alert-success">
                    <strong>Berhasil!</strong> {{ session('success') }}
                </div>
            @endif

            <!-- Notifikasi Error (Merah) -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <!-- FORM LOGIN -->
            <!-- Pastikan action mengarah ke route 'login.process' atau 'login' sesuai web.php -->
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required autofocus>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="********" required>
                </div>

                <div class="form-group">
                    <label style="font-weight: normal;">
                        <input type="checkbox" name="remember"> Ingat saya
                    </label>
                </div>

                <!-- TOMBOL SUBMIT (PENTING: Harus type="submit" & di dalam form) -->
                <button type="submit" class="btn-primary">Masuk Sekarang</button>
            </form>

            <div class="footer-link">
                Belum punya akun? <a href="{{ route('seller.register') }}">Daftar Sebagai Penjual</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Cek apakah ada session 'success_register' dari controller
        @if(session('success_register'))
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil!',
                text: '{{ session('success_register') }}',
                confirmButtonText: 'Oke, Siap Login',
                confirmButtonColor: '#102C54', // Sesuaikan warna tema
                background: '#fff',
                iconColor: '#102C54'
            });
        @endif

        // Opsional: Cek error login biasa
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        @endif
    </script>



</body>
</html>
