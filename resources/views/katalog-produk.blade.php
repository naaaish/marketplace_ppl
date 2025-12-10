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

    <header class="text-white shadow-lg bg-[#102C54]">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center p-2">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-full h-full object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                        <svg class="w-7 h-7 text-[#102C54] hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight">tukutuku</h1>
                        <p class="text-xs text-blue-200">Marketplace Terpercaya</p>
                    </div>
                </a>
                
                <div class="flex-1 max-w-2xl mx-8 hidden md:block">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari produk di tukutuku..." 
                               class="w-full px-4 py-2.5 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-inner">
                        <svg class="absolute right-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                @auth
                    <div class="flex items-center gap-3">
                        <span class="text-sm hidden sm:block">Halo, <b>{{ Auth::user()->name }}</b></span>
                        <div class="relative group">
                            <button class="bg-white text-[#102C54] p-2.5 rounded-full hover:bg-blue-50 transition shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </button>
                            
                            <div class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 z-50 border border-gray-100 text-sm">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-[#102C54]">Dashboard Admin</a>
                                @elseif(Auth::user()->role === 'seller')
                                    <a href="{{ route('seller.dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-[#102C54]">Dashboard Toko</a>
                                @else
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-[#102C54]">Profil Saya</a>
                                @endif
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 hover:text-[#102C54]">Pesanan Saya</a>
                                <hr class="my-2 border-gray-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="px-4 py-2 text-white hover:text-blue-200 transition font-medium">
                            Masuk
                        </a>
                        <a href="{{ route('seller.register') }}" class="px-5 py-2 bg-white text-[#102C54] rounded-lg font-bold hover:bg-blue-50 transition shadow-sm">
                            Daftar
                        </a>
                    </div>
                @endauth
            </div>
            
            <div class="mt-4 md:hidden">
                <input type="text" placeholder="Cari di tukutuku..." class="w-full px-4 py-2 rounded-lg text-gray-800">
            </div>
        </div>
    </header>

    <div class="bg-[#102C54] text-white mt-1 shadow-inner">
        <div class="container mx-auto px-4 py-10">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-3">Jual di tukutuku</h2>
                    <p class="text-blue-100 text-base md:text-lg mb-6">Buka tokomu sendiri, raih jutaan pembeli potensial.</p>
                    
                    <a href="{{ route('seller.register') }}" 
                        class="inline-block bg-white text-[#102C54] px-8 py-3 rounded-lg font-bold hover:bg-blue-50 transition shadow-lg transform hover:-translate-y-1">
                        Mulai Berjualan
                    </a>
                </div>
                <div class="text-8xl opacity-20 hidden md:block rotate-12">
                    <i class="fas fa-store"></i> 🛒
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-[#102C54]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                Kategori Pilihan
            </h3>
            <div class="flex flex-wrap gap-2" id="categoryButtons">
                <button onclick="filterCategory('Semua')" class="category-btn px-5 py-2 rounded-full text-sm font-semibold transition bg-[#102C54] text-white shadow-md" data-category="Semua">
                    Semua
                </button>
                @foreach($categories ?? [] as $category)
                <button onclick="filterCategory('{{ $category }}')" class="category-btn px-5 py-2 rounded-full text-sm font-medium transition bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-800" data-category="{{ $category }}">
                    {{ $category }}
                </button>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="productsGrid">
            @forelse($products ?? [] as $product)
            <div class="product-card bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group border border-gray-100 hover:border-blue-200" data-category="{{ $product['category'] }}" data-name="{{ strtolower($product['name']) }}">
                
                <div class="relative h-48 overflow-hidden bg-gray-100">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @if(isset($product['stock']) && $product['stock'] < 5)
                        <span class="absolute top-2 right-2 bg-red-500 text-white text-[10px] font-bold px-2 py-1 rounded">Stok Terbatas</span>
                    @endif
                </div>
                
                <div class="p-4 flex flex-col h-full">
                    <div class="mb-2">
                        <span class="text-[10px] font-bold text-[#102C54] bg-blue-50 px-2.5 py-1 rounded-full border border-blue-100 uppercase tracking-wide">
                            {{ $product['category'] }}
                        </span>
                    </div>
                    
                    <h3 class="font-bold text-gray-800 text-base mb-1 line-clamp-2 h-12 leading-snug group-hover:text-[#102C54] transition">
                        {{ $product['name'] }}
                    </h3>
                    
                    <p class="text-xl font-bold text-[#102C54] mb-3">
                        Rp {{ number_format($product['price'], 0, ',', '.') }}
                    </p>

                    <div class="flex items-center justify-between mb-3 text-xs">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            <span class="font-bold text-gray-700">{{ $product['rating'] }}</span>
                            <span class="text-gray-400">|</span>
                            <span class="text-gray-500">{{ $product['review_count'] }} ulasan</span>
                        </div>
                        <div class="text-gray-500 font-medium">
                            {{ $product['sold'] }} Terjual
                        </div>
                    </div>

                    <div class="border-t border-gray-100 my-2"></div>

                    @if(isset($product['sample_review']))
                    <div class="bg-gray-50 rounded p-2 mb-3 flex-grow">
                        <p class="text-[11px] text-gray-600 italic line-clamp-2">"{{ $product['sample_review'] }}"</p>
                    </div>
                    @endif

                    <button class="w-full bg-[#102C54] text-white py-2.5 rounded-lg font-semibold hover:bg-[#0c2142] transition shadow-md mt-auto flex items-center justify-center gap-2">
                        <span>Lihat Detail</span>
                    </button>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center">
                <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-600">Belum ada produk</h3>
                <p class="text-gray-500">Silakan cek kembali nanti.</p>
            </div>
            @endforelse
        </div>
    </div>

    <script>
        function filterCategory(category) {
            // Update button styles
            document.querySelectorAll('.category-btn').forEach(btn => {
                if (btn.dataset.category === category) {
                    // Active State (Brand Color)
                    btn.className = 'category-btn px-5 py-2 rounded-full text-sm font-semibold transition bg-[#102C54] text-white shadow-md transform scale-105';
                } else {
                    // Inactive State
                    btn.className = 'category-btn px-5 py-2 rounded-full text-sm font-medium transition bg-gray-100 text-gray-600 hover:bg-gray-200 hover:text-gray-800';
                }
            });

            // Filter products
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                if (category === 'Semua' || product.dataset.category === category) {
                    product.style.display = 'flex'; // Use flex to maintain layout logic
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
                    product.style.display = 'flex';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>