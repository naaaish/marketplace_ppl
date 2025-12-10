<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Laporan - Seller</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap'); 
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .sidebar-scroll::-webkit-scrollbar { width: 6px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: rgba(255,255,255,0.2); border-radius: 3px; }
    </style>
</head>
<body class="text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <div class="w-64 bg-[#102C54] text-white flex-shrink-0 flex flex-col">
            <div class="p-6 flex flex-col items-center justify-center border-b border-blue-900/50">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-32 h-auto object-contain mb-2" onerror="this.style.display='none'">
                <span class="text-xs text-blue-200 font-medium tracking-wider uppercase">Seller Panel</span>
            </div>

            <nav class="flex-1 px-4 space-y-2 mt-4 sidebar-scroll overflow-y-auto">
                <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-th-large w-5"></i> Dashboard
                </a>
                
                <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-box w-5"></i> Produk Saya
                </a>
                
                <a href="{{ route('products.create') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-plus-circle w-5"></i> Tambah Produk
                </a>

                <a href="{{ route('seller.reports.index') }}" class="flex items-center gap-3 px-4 py-3 bg-white text-[#102C54] rounded-lg font-semibold shadow-md transition">
                    <i class="fas fa-file-pdf w-5"></i> Pusat Laporan
                </a>
            </nav>

            <div class="p-4 border-t border-blue-900/50">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center justify-center gap-2 text-red-300 hover:text-white hover:bg-red-600/20 w-full px-4 py-2.5 rounded-lg transition">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <header class="bg-white shadow-sm sticky top-0 z-20 border-b border-gray-100 px-8 py-4 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Pusat Laporan</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Unduh laporan operasional toko Anda dalam format PDF.</p>
                </div>
            </header>

            <main class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <a href="{{ route('seller.reports.stock_desc') }}" target="_blank" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-[#102C54] hover:shadow-md transition group">
                        <div class="flex items-center gap-4">
                            <div class="bg-blue-50 p-4 rounded-full group-hover:bg-blue-100 transition">
                                <i class="fas fa-file-alt text-[#102C54] text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">Laporan Stok</h3>
                                <p class="text-xs text-gray-500 mt-1">Urut Stok Terbanyak (SRS-12)</p>
                                
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('seller.reports.rating_desc') }}" target="_blank" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-[#102C54] hover:shadow-md transition group">
                        <div class="flex items-center gap-4">
                            <div class="bg-yellow-50 p-4 rounded-full group-hover:bg-yellow-100 transition">
                                <i class="fas fa-star text-yellow-600 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">Laporan Rating</h3>
                                <p class="text-xs text-gray-500 mt-1">Urut Rating Tertinggi (SRS-13)</p>
                                
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('seller.reports.stock_low') }}" target="_blank" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-red-500 hover:shadow-md transition group">
                        <div class="flex items-center gap-4">
                            <div class="bg-red-50 p-4 rounded-full group-hover:bg-red-100 transition">
                                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">Stok Kritis</h3>
                                <p class="text-xs text-gray-500 mt-1">Stok di bawah 5 (SRS-14)</p>
                                
                            </div>
                        </div>
                    </a>

                </div>
            </main>
        </div>
    </div>
</body>
</html>