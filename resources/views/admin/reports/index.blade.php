<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Laporan - Admin</title>
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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-white text-[#102C54] rounded-lg font-semibold shadow-md">
                    <i class="fas fa-th-large w-5"></i> Dashboard
                </a>
                
                <a href="{{ route('admin.sellers') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-users w-5"></i> Manajemen Penjual
                </a>
                
                <a href="{{ route('admin.reports') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-chart-bar w-5"></i> Laporan
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
                <h2 class="text-2xl font-bold text-gray-800">Pusat Laporan</h2>
                <p class="text-sm text-gray-500">Unduh laporan operasional marketplace.</p>
            </header>

            <main class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <a href="{{ route('report.status') }}" target="_blank" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-[#102C54] hover:shadow-md transition group">
                        <div class="flex items-center gap-4">
                            <div class="bg-blue-50 p-4 rounded-full group-hover:bg-blue-100 transition">
                                <i class="fas fa-download text-[#102C54] text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">Akun Penjual</h3>
                                <p class="text-sm text-gray-500">Berdasarkan Status (Aktif/Tidak)</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('report.province') }}" target="_blank" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-[#102C54] hover:shadow-md transition group">
                        <div class="flex items-center gap-4">
                            <div class="bg-blue-50 p-4 rounded-full group-hover:bg-blue-100 transition">
                                <i class="fas fa-download text-[#102C54] text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">Lokasi Toko</h3>
                                <p class="text-sm text-gray-500">Berdasarkan Propinsi</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('report.products_rating') }}" target="_blank" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:border-[#102C54] hover:shadow-md transition group">
                        <div class="flex items-center gap-4">
                            <div class="bg-blue-50 p-4 rounded-full group-hover:bg-blue-100 transition">
                                <i class="fas fa-download text-[#102C54] text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-lg">Produk & Rating</h3>
                                <p class="text-sm text-gray-500">Berdasarkan Rating Tertinggi</p>
                            </div>
                        </div>
                    </a>
                </div>
            </main>
        </div>
    </div>
</body>
</html>