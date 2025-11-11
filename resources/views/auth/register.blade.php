<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftarkan Toko Anda</title>
    <style>
        /* Reset dasar dan font */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            /* Latar belakang halaman yang halus, tidak putih polos */
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            min-height: 100vh;
        }

        /* Kontainer form utama - ini adalah "kartu" */
        .form-container {
            width: 100%;
            max-width: 1000px; /* Cukup lebar untuk split-screen */
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Penting untuk border-radius */
            display: flex;
        }

        /* * SISI KIRI: Bagian Dekorasi/Motif 
         */
        .form-decoration {
            flex: 1; /* Mengambil setengah bagian */
            background: linear-gradient(160deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Efek motif garis diagonal halus (opsional) */
            background-image: 
                linear-gradient(160deg, #667eea 0%, #764ba2 100%),
                linear-gradient(45deg, rgba(255, 255, 255, 0.05) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.05) 50%, rgba(255, 255, 255, 0.05) 75%, transparent 75%, transparent);
            background-size: 100%, 30px 30px;
        }

        .form-decoration h2 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .form-decoration p {
            font-size: 18px;
            line-height: 1.6;
            opacity: 0.9;
        }
        
        /* * SISI KANAN: Bagian Konten/Formulir 
         */
        .form-content {
            flex: 1.5; /* Sedikit lebih lebar dari sisi kiri */
            padding: 40px 50px;
            overflow-y: auto; /* Jika form terlalu panjang */
        }

        .form-content h3 {
            font-size: 24px;
            color: #333;
            margin-bottom: 8px;
            font-weight: 700;
        }
        
        .form-content > p {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
        }

        /* * Tata letak GRID untuk formulir 
         * Ini akan membuat formnya jadi 2 kolom
         */
        #registrationForm {
            display: grid;
            grid-template-columns: 1fr 1fr; /* 2 kolom sama lebar */
            gap: 20px; /* Jarak antar field */
        }
        
        /* Grup form (label + input) */
        .form-group {
            margin-bottom: 0; /* Diatur oleh 'gap' */
        }

        /* Class helper agar field bisa memanjang 2 kolom */
        .form-group.span-2 {
            grid-column: span 2;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 16px;
            color: #34495e;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        /* Input file yang lebih baik */
        input[type="file"] {
            padding: 8px;
        }
        input[type="file"]::file-selector-button {
            background-color: #f0f0f0;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            color: #555;
            cursor: pointer;
            margin-right: 10px;
            font-weight: 600;
            transition: background-color 0.2s ease;
        }
        input[type="file"]::file-selector-button:hover {
            background-color: #e0e0e0;
        }
        
        textarea {
            min-height: 100px;
            resize: vertical;
        }

        /* Efek 'focus' yang lebih berwarna */
        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 8px rgba(102, 126, 234, 0.2);
        }

        /* Tombol Submit */
        button[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px; /* Jarak ekstra sebelum tombol */
        }

        button[type="submit"]:hover {
            background-color: #5a6fdc;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 800px) {
            .form-container {
                flex-direction: column;
            }
            .form-content {
                padding: 30px 25px;
            }
            /* Ubah grid jadi 1 kolom di HP */
            #registrationForm {
                grid-template-columns: 1fr;
            }
            .form-group.span-2 {
                grid-column: span 1;
            }
        }

    </style>
</head>
<body>

    <div class="form-container">
        
        <div class="form-decoration">
            <h2>Mulai Perjalanan Anda</h2>
            <p>Daftarkan toko Anda hari ini dan jangkau jutaan pelanggan baru. Prosesnya cepat dan mudah!</p>
        </div>

        <div class="form-content">
            <h3>Daftarkan Toko Anda</h3>
            <p>Isi data di bawah ini untuk menjadi penjual.</p>

            <form method="POST" action="{{ route('toko.store') }}" enctype="multipart/form-data" id="registrationForm">
                @csrf

                <div class="form-group span-2">
                    <label for="nama_toko">Nama Toko</label>
                    <input id="nama_toko" type="text" name="nama_toko" required autofocus>
                </div>

                <div class="form-group span-2">
                    <label for="deskripsi_singkat">Deskripsi Singkat Toko</label>
                    <textarea id="deskripsi_singkat" name="deskripsi_singkat"></textarea>
                </div>

                <div class="form-group">
                    <label for="nama_pic">Nama PIC</label>
                    <input id="nama_pic" type="text" name="nama_pic" required>
                </div>

                <div class="form-group">
                    <label for="no_hp_pic">No Handphone PIC</label>
                    <input id="no_hp_pic" type="text" name="no_hp_pic" required>
                </div>

                <div class="form-group span-2">
                    <label for="email_pic">Email PIC</label>
                    <input id="email_pic" type="email" name="email_pic" required>
                </div>

                <div class="form-group span-2">
                    <label for="alamat_pic">Alamat (Nama Jalan) PIC</label>
                    <input id="alamat_pic" type="text" name="alamat_pic" required>
                </div>

                <div class="form-group">
                    <label for="rt">RT</label>
                    <input id="rt" type="text" name="rt" required>
                </div>

                <div class="form-group">
                    <label for="rw">RW</label>
                    <input id="rw" type="text" name="rw" required>
                </div>

                <div classs="form-group">
                    <label for="kelurahan">Nama Kelurahan</label>
                    <input id="kelurahan" type="text" name="kelurahan" required>
                </div>

                <div class="form-group">
                    <label for="kabupaten_kota">Kabupaten/Kota</label>
                    <input id="kabupaten_kota" type="text" name="kabupaten_kota" required>
                </div>
                
                <div class="form-group span-2">
                    <label for="provinsi">Provinsi</label>
                    <input id="provinsi" type="text" name="provinsi" required>
                </div>

                <div class="form-group span-2">
                    <label for="no_ktp_pic">No. KTP PIC</label>
                    <input id="no_ktp_pic" type="text" name="no_ktp_pic" required>
                </div>

                <div class="form-group">
                    <label for="foto_pic">Foto PIC</label>
                    <input id="foto_pic" type="file" name="foto_pic" required>
                </div>

                <div class="form-group">
                    <label for="file_ktp_pic">File Upload KTP PIC</label>
                    <input id="file_ktp_pic" type="file" name="file_ktp_pic" required>
                </div>

                <div class="form-group span-2">
                    <button type="submit">
                        Daftar Sebagai Penjual
                    </button>
                </div>
            </form>
        </div>

    </div>

</body>
</html>