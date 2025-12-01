<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi Akun - Marketplace PPL</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h2 { color: #1f2937; margin-bottom: 0.5rem; }
        p { color: #6b7280; margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1rem; text-align: left; }
        label { display: block; margin-bottom: 0.5rem; color: #374151; font-weight: bold; }
        input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-sizing: border-box; /* Penting biar gak melebar */
        }
        button {
            background-color: #102C54;
            color: white;
            padding: 0.75rem;
            width: 100%;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 1rem;
        }
        button:hover { background-color: #0d2345; }
        .error { color: red; font-size: 0.875rem; margin-top: 0.25rem; }
    </style>
</head>
<body>

    <div class="card">
        <h2>Halo, {{ $user->name }}!</h2>
        <p>Silakan buat password baru untuk mengaktifkan akun toko Anda.</p>

        @if ($errors->any())
            <div style="background-color: #fee2e2; color: #991b1b; padding: 10px; border-radius: 6px; margin-bottom: 15px; text-align: left;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('activation.process') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password" required placeholder="Minimal 8 karakter">
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required placeholder="Ketik ulang password">
            </div>

            <button type="submit">Simpan & Masuk</button>
        </form>
    </div>

</body>
</html>