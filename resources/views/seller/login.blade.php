<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Tukutuku</title>
    <!-- Menggunakan Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans min-h-screen flex items-center justify-center p-4">

    <!-- Container Utama (Card Terbagi Dua) -->
    <div class="flex w-full max-w-4xl bg-white rounded-2xl shadow-2xl overflow-hidden min-h-[500px]">
        
        <!-- BAGIAN KIRI (BIRU) - Logo & Teks -->
        <div class="hidden md:flex w-1/2 bg-[#0f172a] text-white p-12 flex-col justify-center items-center text-center relative">
            <!-- Konten Tengah -->
            <div class="relative z-10">
                <div class="flex flex-col items-center justify-center gap-4 mb-6">
                    <!-- GANTI LOGO DI SINI -->
                    <!-- Jika logo ada di public/img/logo.png -->
                    <img src="{{ asset('img/logo.png') }}" alt="tukutuku" class="h-20 w-auto object-contain drop-shadow-lg">
                    
                    <!-- Atau pakai Text/Icon jika gambar belum siap -->
                    <!-- <i class="fa-solid fa-horse-head text-6xl"></i>
                    <span class="text-4xl font-bold tracking-tighter">tukutuku</span> -->
                </div>
                
                <div class="h-1 w-20 bg-blue-500 mx-auto mb-6 rounded-full"></div>
                <p class="text-blue-100 text-lg font-medium leading-relaxed">
                    Masuk untuk mengelola akunmu
                </p>
            </div>
            
            <!-- Hiasan background samar -->
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-blue-400 to-transparent"></div>
        </div>

        <!-- BAGIAN KANAN (PUTIH) - Form Login -->
        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center bg-white">
            
            <div class="mb-8 text-center md:text-left">
                <h3 class="text-2xl font-bold text-[#0f172a]">Selamat Datang</h3>
                <p class="text-gray-500 text-sm mt-1">Silakan masukkan detail akun Anda</p>
            </div>

            <!-- Pesan Status Session (Breeze) -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form Login (Mengarah ke route('login') bawaan Breeze) -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- 1. Email -->
                <div class="mb-5">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition duration-200 placeholder-gray-400 bg-gray-50"
                        placeholder="contoh@email.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- 2. Password -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-gray-700 text-sm font-bold">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-blue-900 hover:underline font-semibold">Lupa Password?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-transparent transition duration-200 placeholder-gray-400 bg-gray-50"
                        placeholder="********">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4 mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-900 shadow-sm focus:ring-blue-900" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                    </label>
                </div>

                <!-- Tombol Masuk -->
                <button type="submit" 
                    class="w-full bg-[#0f172a] text-white font-bold py-3.5 px-4 rounded-lg hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-opacity-50 transition duration-300 shadow-lg transform hover:-translate-y-0.5">
                    Masuk Sekarang
                </button>

                <!-- Link Daftar -->
                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-500">
                        Belum punya akun? 
                        <!-- INI MENGARAH KE REGISTER TOKO (FORM CANTIK ANDA) -->
                        <a href="{{ route('seller.register') }}" class="text-[#0f172a] font-bold hover:underline transition">Daftar Sebagai Penjual</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>