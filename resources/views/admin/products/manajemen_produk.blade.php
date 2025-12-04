<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">
        
        <div class="w-64 bg-[#102C54] text-white flex-shrink-0 flex flex-col">
            <div class="p-6 flex flex-col items-center justify-center border-b border-blue-900/50">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-40 h-auto object-contain mb-2" onerror="this.style.display='none'">
                <span class="text-xs text-blue-200 font-medium tracking-wider uppercase">Admin Panel</span>
            </div>
            <nav class="flex-1 px-4 space-y-2 mt-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
                <a href="{{ route('admin.sellers') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-users"></i> Manajemen Penjual
                </a>
                <a href="{{ route('admin.products') }}" class="flex items-center gap-3 px-4 py-3 bg-white text-[#102C54] rounded-lg font-semibold shadow-md">
                    <i class="fas fa-box"></i> Manajemen Produk
                </a>
                <a href="{{ route('admin.reports') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-chart-bar"></i> Laporan
                </a>
            </nav>
            <div class="p-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-red-300 hover:text-red-100 w-full px-4 py-2"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white shadow-sm p-6 sticky top-0 z-10">
                <h2 class="text-2xl font-bold text-gray-800">Manajemen Produk</h2>
                <p class="text-sm text-gray-500">Daftar seluruh produk dari semua toko.</p>
            </header>

            <main class="p-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4">Produk</th>
                                    <th class="px-6 py-4">Kategori</th>
                                    <th class="px-6 py-4">Harga</th>
                                    <th class="px-6 py-4">Stok</th>
                                    <th class="px-6 py-4">Toko</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($products as $product)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gray-200 rounded-md overflow-hidden">
                                                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover" onerror="this.style.display='none'">
                                            </div>
                                            {{ $product->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">{{ $product->category }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        @if($product->stock < 5)
                                            <span class="text-red-600 font-bold">{{ $product->stock }} (Low)</span>
                                        @else
                                            {{ $product->stock }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            {{ $product->seller->store_name ?? 'Unknown' }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">Belum ada produk terdaftar.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>