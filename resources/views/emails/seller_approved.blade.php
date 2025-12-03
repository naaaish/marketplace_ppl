<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Disetujui</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { background-color: #fff; padding: 20px; border-radius: 8px; max-width: 600px; margin: auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .button { background-color: #102C54; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 20px; }
        h1 { color: #102C54; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat, {{ $user->name }}!</h1>
        <p>Pendaftaran toko Anda di <strong>Marketplace PPL</strong> telah disetujui oleh Admin.</p>
        <p>Langkah terakhir, silakan buat password untuk akun Anda dengan mengklik tombol di bawah ini:</p>
        
        <center>
            <a href="{{ $url }}" class="button">Aktifkan Akun & Buat Password</a>
        </center>

        <p style="margin-top: 30px; font-size: 12px; color: #888;">
            Jika tombol tidak berfungsi, salin link ini ke browser Anda:<br>
            {{ $url }}
        </p>
    </div>
</body>
</html>