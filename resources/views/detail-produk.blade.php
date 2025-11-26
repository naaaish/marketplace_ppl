<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Tukutuku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Header yang sama dengan katalog -->
    <header class="bg-gradient-to-r from-blue-900 to-blue-700 text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('katalog.produk') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center">
                        <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">tukutuku</h1>
                        <p class="text-xs text-blue-200">Marketplace Terpercaya</p>
                    </div>
                </a>
                
                @auth
                <div class="flex items-center gap-3">
                    <span class="text-sm">Halo, {{ Auth::user()->name }}</span>
                    <button class="bg-white text-blue-700 p-2.5 rounded-full hover:bg-blue-50 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </button>
                </div>
                @else
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-white hover:text-blue-200 transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-white text-blue-700 rounded-lg font-semibold hover:bg-blue-50 transition">
                        Daftar
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- Detail Produk -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Gambar Produk -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl h-96 flex items-center justify-center text-9xl">
                    {{ $product->image }}
                </div>

                <!-- Info Produk -->
                <div>
                    <span class="text-sm font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded">
                        {{ $product->category }}
                    </span>
                    <h1 class="text-3xl font-bold text-gray-800 mt-4 mb-2">
                        {{ $product->name }}
                    </h1>
                    <p class="text-4xl font-bold text-blue-700 mb-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div class="flex items-center gap-4 mb-6 pb-6 border-b">
                        <div class="flex items-center gap-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($product->averageRating()))
                                <svg class="w-5 h-5 fill-yellow-400 text-yellow-400" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                </svg>
                                @else
                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                </svg>
                                @endif
                            @endfor
                            <span class="text-lg font-semibold">{{ round($product->averageRating(), 1) }}</span>
                        </div>
                        <span class="text-gray-500">{{ $product->reviewCount() }} Ulasan</span>
                        <span class="text-green-600 font-semibold">{{ $product->sold }} Terjual</span>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-bold text-gray-800 mb-2">Deskripsi Produk</h3>
                        <p class="text-gray-600">{{ $product->description }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-bold text-gray-800 mb-2">Informasi Toko</h3>
                        <p class="text-gray-600">{{ $product->seller->store_name }}</p>
                    </div>

                    @auth
                    <button class="w-full bg-blue-700 text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition text-lg">
                        Beli Sekarang
                    </button>
                    @else
                    <a href="{{ route('login') }}" class="block w-full bg-blue-700 text-white py-3 rounded-lg font-semibold hover:bg-blue-800 transition text-lg text-center">
                        Login untuk Membeli
                    </a>
                    @endauth
                </div>
            </div>

            <!-- Reviews -->
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6">Ulasan Pembeli</h2>
                <div class="space-y-4">
                    @foreach($product->reviews as $review)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="font-semibold">{{ $review->user->name }}</span>
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                    <svg class="w-4 h-4 fill-yellow-400" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                    </svg>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p class="text-gray-600">{{ $review->comment }}</p>
                        <span class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>