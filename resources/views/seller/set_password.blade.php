<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Buat Password - Tukutuku</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;padding:24px}</style>
</head>
<body>
    <h2>Buat Password untuk akun penjual</h2>
    <p>Toko: <strong>{{ $seller->store_name }}</strong></p>

    <form method="POST" action="{{ route('seller.set_password_store', ['seller' => $seller->id, 'signature' => request()->query('signature')]) }}">
        @csrf
        <div>
            <label for="password">Password</label><br>
            <input id="password" name="password" type="password" required minlength="8">
        </div>
        <div>
            <label for="password_confirmation">Konfirmasi Password</label><br>
            <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8">
        </div>
        <br>
        <button type="submit">Buat Password & Masuk</button>
    </form>
</body>
</html>
