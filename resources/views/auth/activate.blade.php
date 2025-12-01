<!DOCTYPE html>
<html lang="id">
<head>
    <title>Aktivasi Akun</title>
    </head>
<body>
    <div style="padding: 50px; text-align:center;">
        <h2>Halo, {{ $user->name }}</h2>
        <p>Selamat! Toko Anda telah disetujui. Silakan buat password untuk masuk.</p>

        <form action="{{ route('activation.process') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div style="margin-bottom: 10px;">
                <label>Password Baru</label><br>
                <input type="password" name="password" required>
            </div>

            <div style="margin-bottom: 10px;">
                <label>Konfirmasi Password</label><br>
                <input type="password" name="password_confirmation" required>
            </div>

            <button type="submit">Aktifkan Akun</button>
        </form>
    </div>
</body>
</html>