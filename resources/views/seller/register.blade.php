<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftarkan Toko Anda</title>
    <style>
        /* Reset dasar dan font */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .form-container {
            width: 100%;
            max-width: 1100px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            min-height: 700px;
        }
        /* SISI KIRI: Dekorasi */
        .form-decoration {
            flex: 0 0 40%;
            background: linear-gradient(135deg, #102C54 50%, #43679b 100%);
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .form-decoration .logo {
            width: 250px; height: auto; margin-bottom: 25px;
        }
        .form-decoration p {
            font-size: 18px; line-height: 1.6; opacity: 0.9; max-width: 300px;
        }
        /* SISI KANAN: Form */
        .form-content {
            flex: 1; padding: 40px 50px; overflow-y: auto;
        }
        .form-content h2 {
            font-size: 28px; color: #222; margin-bottom: 10px; font-weight: 700; text-align: center;
        }
        .form-content h3 {
            font-size: 16px; color: #555; margin-bottom: 30px; font-weight: 400; text-align: center;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block; font-weight: 600; margin-bottom: 8px; color: #555; font-size: 14px;
        }
        input[type="text"], input[type="email"], textarea {
            width: 100%; padding: 12px 15px;
            border: 1px solid #ced4da; border-radius: 8px;
            font-size: 16px; color: #34495e;
            transition: border-color 0.2s ease;
        }
        textarea { min-height: 90px; resize: vertical; }
        input[type="file"] {
            width: 100%; padding: 12px;
            border: 1px solid #ced4da; border-radius: 8px;
            background-color: #fdfdfd;
        }
        input:focus, textarea:focus {
            outline: none; border-color: #102C54; box-shadow: 0 0 0 3px rgba(16, 44, 84, 0.25);
        }
        .grid-half {
            display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
        }
        button[type="submit"] {
            width: 100%; padding: 15px;
            background-color: #102C54; color: white;
            border: none; border-radius: 8px;
            font-size: 17px; font-weight: 700; cursor: pointer;
            transition: all 0.3s ease; margin-top: 25px;
        }
        button[type="submit"]:hover {
            background-color: #1a4a8c; transform: translateY(-2px);
        }
        .alert-error {
            background-color: #ffebee; color: #c62828; padding: 10px; border-radius: 6px; margin-bottom: 20px; font-size: 14px;
        }
        @media (max-width: 900px) {
            .form-container { flex-direction: column; }
            .form-decoration { padding: 40px 20px; order: -1; }
            .grid-half { grid-template-columns: 1fr; gap: 15px; }
        }
    </style>
</head>
<body>

    <div class="form-container">
        
        <div class="form-decoration">
            <!-- Pastikan gambar ada di public/img/logo.png -->
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo" onerror="this.style.display='none'">
            <h2>Marketplace PPL</h2>
            <br>
            <p>Lebih dari sekadar marketplace. Kami adalah partner setia untuk pertumbuhan bisnismu.</p>
        </div>

        <div class="form-content">
            <h2>Daftarkan Toko Anda</h2>
            <h3>Isi formulir di bawah untuk mendaftar sebagai penjual</h3>

            <!-- Tampilkan Error Validasi Jika Ada -->
            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- PERBAIKAN: Action mengarah ke route 'seller.store' -->
            <form method="POST" action="{{ route('seller.store') }}" enctype="multipart/form-data" onsubmit="syncUserData()">
                @csrf
                
                <!-- INPUT HIDDEN UNTUK TABEL USERS (Wajib ada karena Controller memintanya) -->
                <!-- Nilainya akan diambil otomatis dari input PIC via Javascript di bawah -->
                <input type="hidden" name="name" id="user_name">
                <input type="hidden" name="email" id="user_email">

                <div class="form-group">
                    <label for="store_name">Nama Toko</label>
                    <!-- PERBAIKAN: name="store_name" sesuai controller -->
                    <input id="store_name" type="text" name="store_name" value="{{ old('store_name') }}" placeholder="Contoh: Toko Berkah Jaya" required autofocus>
                </div>

                <div class="form-group">
                    <label for="store_description">Deskripsi Singkat Toko</label>
                    <!-- PERBAIKAN: name="store_description" -->
                    <textarea id="store_description" name="store_description" placeholder="Jelaskan sedikit tentang tokomu...">{{ old('store_description') }}</textarea>
                </div>

                <div class="form-group grid-half">
                    <div>
                        <label for="pic_name">Nama PIC</label>
                        <!-- PERBAIKAN: name="pic_name" -->
                        <input id="pic_name" type="text" name="pic_name" value="{{ old('pic_name') }}" placeholder="Nama Lengkap PIC" required oninput="syncUserData()">
                    </div>
                    <div>
                        <label for="pic_phone">No Handphone PIC</label>
                        <!-- PERBAIKAN: name="pic_phone" -->
                        <input id="pic_phone" type="text" name="pic_phone" value="{{ old('pic_phone') }}" placeholder="Contoh: 0812XXXXXXXX" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pic_email">Email PIC (Digunakan untuk Login)</label>
                    <!-- PERBAIKAN: name="pic_email" -->
                    <input id="pic_email" type="email" name="pic_email" value="{{ old('pic_email') }}" placeholder="Contoh: email@contoh.com" required oninput="syncUserData()">
                </div>

                <div class="form-group">
                    <label for="pic_address">Alamat (Nama Jalan) PIC</label>
                    <!-- PERBAIKAN: name="pic_address" -->
                    <input id="pic_address" type="text" name="pic_address" value="{{ old('pic_address') }}" placeholder="Nama Jalan, Nomor Rumah" required>
                </div>

                <div class="form-group grid-half">
                    <div>
                        <label for="rt">RT</label>
                        <input id="rt" type="text" name="rt" value="{{ old('rt') }}" placeholder="001" required>
                    </div>
                    <div>
                        <label for="rw">RW</label>
                        <input id="rw" type="text" name="rw" value="{{ old('rw') }}" placeholder="002" required>
                    </div>
                </div>

                <div class="form-group grid-half">
                    <div>
                        <label for="village">Nama Kelurahan</label>
                        <!-- PERBAIKAN: name="village" -->
                        <input id="village" type="text" name="village" value="{{ old('village') }}" placeholder="Contoh: Merdeka" required>
                    </div>
                    <div>
                        <label for="regency">Kabupaten/Kota</label>
                        <!-- PERBAIKAN: name="regency" -->
                        <input id="regency" type="text" name="regency" value="{{ old('regency') }}" placeholder="Contoh: Bandung" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="province">Propinsi</label>
                    <!-- PERBAIKAN: name="province" -->
                    <input id="province" type="text" name="province" value="{{ old('province') }}" placeholder="Contoh: Jawa Barat" required>
                </div>

                <div class="form-group">
                    <label for="pic_ktp_number">No. KTP PIC</label>
                    <!-- PERBAIKAN: name="pic_ktp_number" -->
                    <input id="pic_ktp_number" type="text" name="pic_ktp_number" value="{{ old('pic_ktp_number') }}" placeholder="NIK (16 digit)" required maxlength="16" pattern="\d{16}" oninput="validateKTP(this)">
                    <small id="ktp_error" style="color:#c62828; display:none; font-size:13px;">Nomor KTP harus tepat 16 digit.</small>
                </div>

                <div class="form-group grid-half">
                    <div>
                        <label for="pic_photo">Foto PIC</label>
                        <!-- PERBAIKAN: name="pic_photo" -->
                        <input id="pic_photo" type="file" name="pic_photo">
                    </div>
                    <div>
                        <label for="pic_ktp_file">File Upload KTP PIC</label>
                        <!-- PERBAIKAN: name="pic_ktp_file" -->
                        <input id="pic_ktp_file" type="file" name="pic_ktp_file">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit">
                        Daftar Sebagai Penjual
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Sederhana: Menyalin Nama & Email PIC ke Hidden Input User -->
    <script>
        function syncUserData() {
            // Ambil nilai dari input PIC
            const picName = document.getElementById('pic_name').value;
            const picEmail = document.getElementById('pic_email').value;

            // Masukkan ke input hidden User
            document.getElementById('user_name').value = picName;
            document.getElementById('user_email').value = picEmail;
        }
    </script>

    <script>
    function validateKTP(i){const e=document.getElementById('ktp_error');i.value=i.value.replace(/\D/g,'');if(i.value.length!==16){e.style.display='block';i.setCustomValidity("Nomor KTP harus 16 digit.");}else{e.style.display='none';i.setCustomValidity("");}}
    </script>

</body>
</html>