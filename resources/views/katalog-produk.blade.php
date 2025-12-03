{{-- resources/views/katalog-produk.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Tukutuku Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
<!-- Header -->
<header class="text-white shadow-lg" style="background: linear-gradient(to right, #102C54, #1a4080);">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center gap-3">
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
                
                <div class="flex-1 max-w-2xl mx-8">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari di tukutuku" 
                               class="w-full px-4 py-2.5 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <svg class="absolute right-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Cek apakah user sudah login atau belum -->
                @auth
                    <!-- Jika sudah login, tampilkan menu user -->
                    <div class="flex items-center gap-3">
                        <span class="text-sm">Halo, {{ Auth::user()->name }}</span>
                        <div class="relative group">
                            <button class="bg-white text-blue-700 p-2.5 rounded-full hover:bg-blue-50 transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                                @if(Auth::user()->role === 'admin')
                                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Dashboard Admin</a>
                                @elseif(Auth::user()->role === 'seller')
                                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Dashboard Toko</a>
                                @else
                                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profil Saya</a>
                                @endif
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Pesanan Saya</a>
                                <hr class="my-2">
                                <form method="POST" action="#">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Jika belum login, tampilkan tombol Login -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-white hover:text-blue-200 transition">
                            Masuk
                        </a>
                        <a href="{{ route('seller.register') }}" class="px-6 py-2 bg-white text-blue-700 rounded-lg font-semibold hover:bg-blue-50 transition">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </header>

<!-- Banner -->
<div class="mt-6 text-white" style="background: linear-gradient(to right, #102C54, #1a4080);">
    <div class="container mx-auto px-4 py-12">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-4xl font-bold mb-3">Jual di tukutuku</h2>
                <p class="text-blue-100 text-lg mb-6">buka tokomu sendiri, raih jutaan pembeli</p>
                
                <!-- Button Daftar Sebagai Penjual -->
                <a href="{{ route('seller.register') }}" 
                class="inline-block bg-white text-blue-700 px-8 py-3 rounded-lg font-bold text-lg hover:bg-blue-50 transition shadow-lg">
                Daftar Sekarang
            </a>
            </div>
            <div class="text-6xl">🛒</div>
        </div>
    </div>
</div>

    <div class="container mx-auto px-4 py-12">
        <!-- Categories -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Kategori Pilihan</h3>
            <div class="flex flex-wrap gap-2" id="categoryButtons">
                <button onclick="filterCategory('Semua')" class="category-btn px-4 py-2 rounded-lg font-medium transition bg-blue-700 text-white" data-category="Semua">
                    Semua
                </button>
                @foreach($categories ?? [] as $category)
                <button onclick="filterCategory('{{ $category }}')" class="category-btn px-4 py-2 rounded-lg font-medium transition bg-gray-100 text-gray-700 hover:bg-gray-200" data-category="{{ $category }}">
                    {{ $category }}
                </button>
                @endforeach
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="productsGrid">
            @foreach($products ?? [] as $product)
            <div class="product-card bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden group" data-category="{{ $product['category'] }}" data-name="{{ strtolower($product['name']) }}">
                <div class="relative h-48 overflow-hidden bg-gray-100">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                
                <div class="p-4">
                    <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded">
                        {{ $product['category'] }}
                    </span>
                    
                    <h3 class="font-bold text-gray-800 mt-2 mb-1 line-clamp-2 h-12">
                        {{ $product['name'] }}
                    </h3>
                    
                    <p class="text-2xl font-bold text-blue-700 mb-3">
                        Rp {{ number_format($product['price'], 0, ',', '.') }}
                    </p>

                    <!-- Rating & Reviews -->
                    <div class="flex items-center justify-between mb-3 pb-3 border-b">
                        <div class="flex items-center gap-2">
                            <div class="flex items-center gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $product['rating'])
                                    <svg class="w-3.5 h-3.5 fill-yellow-400 text-yellow-400" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                    </svg>
                                    @else
                                    <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                    </svg>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-sm font-semibold text-gray-700">
                                {{ $product['rating'] }}
                            </span>
                        </div>
                        <div class="flex items-center gap-1 text-gray-500">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                            <span class="text-xs">({{ $product['review_count'] }})</span>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                            {{ $product['review_count'] }} Ulasan
                        </span>
                        <span class="text-green-600 font-semibold">
                            {{ $product['sold'] }} Terjual
                        </span>
                    </div>

                    <!-- Sample Reviews -->
                    <div class="bg-gray-50 rounded-lg p-3 mb-3">
                        <p class="text-xs text-gray-600 italic mb-1">
                            "{{ $product['sample_review'] }}"
                        </p>
                        <p class="text-xs text-gray-500">- Pembeli Terverifikasi</p>
                    </div>

                    <button class="w-full bg-blue-700 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-800 transition">
                        Lihat Detail
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    <script>
        // Filter by category
        function filterCategory(category) {
            // Update button styles
            document.querySelectorAll('.category-btn').forEach(btn => {
                if (btn.dataset.category === category) {
                    btn.className = 'category-btn px-4 py-2 rounded-lg font-medium transition bg-blue-700 text-white';
                } else {
                    btn.className = 'category-btn px-4 py-2 rounded-lg font-medium transition bg-gray-100 text-gray-700 hover:bg-gray-200';
                }
            });

            // Filter products
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                if (category === 'Semua' || product.dataset.category === category) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const products = document.querySelectorAll('.product-card');
            
            products.forEach(product => {
                const productName = product.dataset.name;
                const productCategory = product.dataset.category.toLowerCase();
                
                if (productName.includes(searchTerm) || productCategory.includes(searchTerm)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>