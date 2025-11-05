<h2>Daftarkan Toko Anda</h2>
<p>Isi data di bawah ini untuk menjadi penjual.</p>

<form method="POST" action="{{ route('toko.store') }}" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="nama_toko">Nama Toko</label><br>
        <input id="nama_toko" type="text" name="nama_toko" required autofocus>
    </div>

    <div style="margin-top: 10px;">
        <label for="deskripsi_singkat">Deskripsi Singkat Toko</label><br>
        <textarea id="deskripsi_singkat" name="deskripsi_singkat"></textarea>
    </div>

    <div style="margin-top: 10px;">
        <label for="nama_pic">Nama PIC</label><br>
        <input id="nama_pic" type="text" name="nama_pic" required>
    </div>

    <div style="margin-top: 10px;">
        <label for="no_hp_pic">No Handphone PIC</label><br>
        <input id="no_hp_pic" type="text" name="no_hp_pic" required>
    </div>

    <div style="margin-top: 10px;">
        <label for="email_pic">Email PIC</label><br>
        <input id="email_pic" type="email" name="email_pic" required>
    </div>

    <div style="margin-top: 10px;">
        <label for="alamat_pic">Alamat (Nama Jalan) PIC</label><br>
        <input id="alamat_pic" type="text" name="alamat_pic" required>
    </div>

    <div style="margin-top: 10px;">
        <label for="rt">RT</label><br>
        <input id="rt" type="text" name="rt" required>
    </div>

    <div style="margin-top: 10px;">
        <label for="rw">RW</label><br>
        <input id="rw" type="text" name="rw" required>
    </div>

    <div style="margin-top: 10px;">
        <label for="kelurahan">Nama Kelurahan</label><br>
        <input id="kelurahan" type="text" name="kelurahan" required>
    </div>

    <div style="margin-top: 10px;">
        <label for="kabupaten_kota">Kabupaten/Kota</label><br>
        <input id="kabupaten_kota" type="text" name="kabupaten_kota" required>
    </div>

    <div style="margin-top: 10px;">
        <label for="propinsi">Propinsi</label><br>
        <input id="propinsi" type="text" name="propinsi" required>
    </div>

    <div style="margin-top: 10px;">
        <label for="no_ktp_pic">No. KTP PIC</label><br>
        <input id="no_ktp_pic" type="text" name="no_ktp_pic" required>
    </div>

    <div style="margin-top: 10px;">
        <label for="foto_pic">Foto PIC</label><br>
        <input id="foto_pic" type="file" name="foto_pic" required>
    </div>

    <div style="margin-top: 10px;">
        <label for="file_ktp_pic">File Upload KTP PIC</label><br>
        <input id="file_ktp_pic" type="file" name="file_ktp_pic" required>
    </div>

    <div style="margin-top: 15px;">
        <button type="submit">
            Daftar Sebagai Penjual
        </button>
    </div>
</form>