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

        /* * SISI KIRI: Bagian Dekorasi/Branding */
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
            width: 250px; 
            height: auto;
            margin-bottom: 25px;
        }

        .form-decoration p {
            font-size: 18px;
            line-height: 1.6;
            opacity: 0.9;
            max-width: 300px;
        }
        
        /* * SISI KANAN: Bagian Konten/Formulir */
        .form-content {
            flex: 1;
            padding: 40px 50px;
            overflow-y: auto; 
        }

        .form-content h2 {
            font-size: 28px;
            color: #222;
            margin-bottom: 10px;
            font-weight: 700;
            text-align: center;
        }

        .form-content h3 {
            font-size: 16px;       
            color: #555;          
            margin-bottom: 30px;  
            font-weight: 400;     
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
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
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 16px;
            color: #34495e;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        
        textarea {
            min-height: 90px;
            resize: vertical;
        }

        input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 16px;
            color: #34495e;
            background-color: #fdfdfd;
            cursor: pointer;
            transition: border-color 0.2s ease;
        }
        input[type="file"]::file-selector-button {
            background-color: #e9ecef;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            color: #343a40;
            cursor: pointer;
            margin-right: 15px;
            font-weight: 600;
            transition: background-color 0.2s ease;
        }
        input[type="file"]::file-selector-button:hover {
            background-color: #dee2e6;
        }

        /* Focus effect */
        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus,
        input[type="file"]:focus {
            outline: none;
            border-color: #102C54;
            box-shadow: 0 0 0 3px rgba(16, 44, 84, 0.25);
        }

        /* Tata letak grid untuk input yang berdampingan */
        .grid-half {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #1a4a8c; /* Warna utama */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 25px;
        }

        button[type="submit"]:hover {
            background-color: #102C54; /* Warna saat hover */
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(16, 44, 84, 0.3);
        }

        /* Responsive untuk layar kecil */
        @media (max-width: 900px) {
            .form-container {
                flex-direction: column;
                min-height: auto;
            }
            .form-decoration {
                flex: 0 0 auto;
                padding: 40px 20px;
                order: -1;
            }
            .form-content {
                padding: 30px 25px;
            }
            .grid-half {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        
        <div class="form-decoration">
            <img src="{{ asset('img/logo.png') }}" alt="tukutuku Logo" class="logo">
            
            <p>Lebih dari sekadar marketplace. Kami adalah partner setia untuk pertumbuhan bisnismu.</p>
        </div>

        <div class="form-content">
            <h2>Daftarkan Toko Anda</h2>
            <h3>Isi formulir di bawah untuk mendaftar sebagai penjual</h3>

            <form method="POST" action="/toko/store" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="nama_toko">Nama Toko</label>
                    <input id="nama_toko" type="text" name="nama_toko" placeholder="Contoh: Toko Berkah Jaya" required autofocus>
                </div>

                <div class="form-group">
                    <label for="deskripsi_singkat">Deskripsi Singkat Toko</label>
                    <textarea id="deskripsi_singkat" name="deskripsi_singkat" placeholder="Jelaskan sedikit tentang tokomu..."></textarea>
                </div>

                <div class="form-group grid-half">
                    <div>
                        <label for="nama_pic">Nama PIC</label>
                        <input id="nama_pic" type="text" name="nama_pic" placeholder="Nama Lengkap PIC" required>
                    </div>
                    <div>
                        <label for="no_hp_pic">No Handphone PIC</label>
                        <input id="no_hp_pic" type="text" name="no_hp_pic" placeholder="Contoh: 0812XXXXXXXX" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email_pic">Email PIC</label>
                    <input id="email_pic" type="email" name="email_pic" placeholder="Contoh: email@contoh.com" required>
                </div>

                <div class="form-group">
                    <label for="alamat_pic">Alamat (Nama Jalan) PIC</label>
                    <input id="alamat_pic" type="text" name="alamat_pic" placeholder="Nama Jalan, Nomor Rumah" required>
                </div>

                <div class="form-group grid-half">
                    <div>
                        <label for="rt">RT</label>
                        <input id="rt" type="text" name="rt" placeholder="Contoh: 001" required>
                    </div>
                    <div>
                        <label for="rw">RW</label>
                        <input id="rw" type="text" name="rw" placeholder="Contoh: 002" required>
                    </div>
                </div>

                <div class="form-group grid-half">
                    <div>
                        <label for="kelurahan">Nama Kelurahan</label>
                        <input id="kelurahan" type="text" name="kelurahan" placeholder="Contoh: Merdeka" required>
                    </div>
                    <div>
                        <label for="kabupaten_kota">Kabupaten/Kota</label>
                        <input id="kabupaten_kota" type="text" name="kabupaten_kota" placeholder="Contoh: Bandung" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="propinsi">Propinsi</label>
                    <input id="propinsi" type="text" name="propinsi" placeholder="Contoh: Jawa Barat" required>
                </div>

                <div class="form-group">
                    <label for="no_ktp_pic">No. KTP PIC</label>
                    <input id="no_ktp_pic" type="text" name="no_ktp_pic" placeholder="Nomor Induk Kependudukan (NIK)" required>
                </div>

                <div class="form-group grid-half">
                    <div>
                        <label for="foto_pic">Foto PIC</label>
                        <input id="foto_pic" type="file" name="foto_pic" required>
                    </div>
                    <div>
                        <label for="file_ktp_pic">File Upload KTP PIC</label>
                        <input id="file_ktp_pic" type="file" name="file_ktp_pic" required>
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

</body>
</html>