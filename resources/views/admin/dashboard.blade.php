<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Platform Owner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">
        
        <div class="w-64 bg-[#102C54] text-white flex-shrink-0 flex flex-col">
                    
                    <div class="p-6 flex flex-col items-center justify-center border-b border-blue-900/50">
                        <img src="{{ asset('img/logo.png') }}" 
                            alt="Logo" 
                            class="w-40 h-auto object-contain mb-2" 
                            onerror="this.style.display='none'">
                            
                        <span class="text-xs text-blue-200 font-medium tracking-wider uppercase">Admin Panel</span>
                    </div>

            <nav class="flex-1 px-4 space-y-2 mt-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-white text-[#102C54] rounded-lg font-semibold shadow-md">
                    <i class="fas fa-th-large"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.sellers') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-users"></i>
                    Manajemen Penjual
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-box"></i>
                    Manajemen Produk
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-chart-bar"></i>
                    Laporan
                </a>
            </nav>

            <div class="p-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 text-red-300 hover:text-red-100 w-full px-4 py-2">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto">
            <header class="bg-white shadow-sm p-6 flex justify-between items-center sticky top-0 z-10">
                <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
                <div class="flex items-center gap-4">
                    <div class="text-right hidden md:block">
                        <p class="text-sm font-semibold text-gray-700">Halo, Platform Owner!</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <div class="w-10 h-10 bg-[#102C54] rounded-full flex items-center justify-center text-white font-bold">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </header>

            <main class="p-8">
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <i class="fas fa-user-check text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Total Penjual (Aktif)</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalSellersActive }}</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                            <i class="fas fa-user-times text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Penjual (Tidak Aktif)</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalSellersInactive }}</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                            <i class="fas fa-clock text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Perlu Verifikasi</p>
                            <div class="flex items-end gap-2">
                                <p class="text-2xl font-bold text-gray-800">{{ $pendingCount }}</p>
                                <span class="text-xs text-red-500 font-bold mb-1">Baru</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <i class="fas fa-users text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-semibold">Total Pengunjung</p>
                            <p class="text-2xl font-bold text-gray-800">{{ number_format($totalVisitors) }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-sm font-bold text-gray-700 mb-4 bg-gray-50 p-2 rounded">Sebaran Produk per Kategori</h3>
                        <div class="h-64 flex justify-center">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="text-sm font-bold text-gray-700 mb-4 bg-gray-50 p-2 rounded">Sebaran Toko per Propinsi</h3>
                        <div class="h-64">
                            <canvas id="provinceChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="font-bold text-gray-700">Verifikasi Penjual Baru</h3>
                            <a href="{{ route('admin.sellers') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                                    <tr>
                                        <th class="px-6 py-3 font-medium">Nama Toko</th>
                                        <th class="px-6 py-3 font-medium">Nama PIC</th>
                                        <th class="px-6 py-3 font-medium">Tanggal Daftar</th>
                                        <th class="px-6 py-3 font-medium text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm text-gray-700">
                                    @forelse($recentSellers as $seller)
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-semibold">{{ $seller->store_name }}</td>
                                        <td class="px-6 py-4">{{ $seller->pic_name }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $seller->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center gap-2">
                                                <a href="{{ route('admin.show', $seller->id) }}" class="px-3 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700">Lihat</a>
                                                
                                                <form method="POST" action="{{ route('admin.approve', $seller->id) }}" onsubmit="return confirm('Yakin approve?')">
                                                    @csrf
                                                    <button class="px-3 py-1 bg-green-500 text-white rounded text-xs hover:bg-green-600">Setuju</button>
                                                </form>

                                                <form method="POST" action="{{ route('admin.reject', $seller->id) }}" onsubmit="return confirm('Yakin tolak?')">
                                                    @csrf
                                                    <button class="px-3 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600">Tolak</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-400">Tidak ada pendaftar baru.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 h-fit">
                        <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">Download Laporan (PDF)</h3>
                        <div class="space-y-3">
                            <button class="w-full flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition text-gray-700 border">
                                <i class="fas fa-file-download text-[#102C54]"></i>
                                <span class="text-sm font-medium">Laporan Akun Penjual</span>
                            </button>
                            <button class="w-full flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition text-gray-700 border">
                                <i class="fas fa-file-download text-[#102C54]"></i>
                                <span class="text-sm font-medium">Laporan Penjual per Propinsi</span>
                            </button>
                            <button class="w-full flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition text-gray-700 border">
                                <i class="fas fa-file-download text-[#102C54]"></i>
                                <span class="text-sm font-medium">Laporan Produk dan Rating</span>
                            </button>
                        </div>
                    </div>

                </div>

            </main>
        </div>
    </div>

    <script>
        // Data dari Controller Laravel
        const categoryLabels = {!! json_encode($productsPerCategory->keys()) !!};
        const categoryData = {!! json_encode($productsPerCategory->values()) !!};
        
        const provinceLabels = {!! json_encode($sellersPerProvince->keys()) !!};
        const provinceData = {!! json_encode($sellersPerProvince->values()) !!};

        // 1. Pie Chart (Kategori)
        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'doughnut',
            data: {
                labels: categoryLabels.length ? categoryLabels : ['Fashion', 'Elektronik', 'Makanan'], // Dummy jika kosong
                datasets: [{
                    data: categoryData.length ? categoryData : [10, 20, 15],
                    backgroundColor: ['#102C54', '#3B82F6', '#93C5FD', '#E2E8F0'],
                    borderWidth: 0
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // 2. Bar Chart (Propinsi)
        const ctxProvince = document.getElementById('provinceChart').getContext('2d');
        new Chart(ctxProvince, {
            type: 'bar',
            data: {
                labels: provinceLabels.length ? provinceLabels : ['Jawa Barat', 'DKI Jakarta', 'Jawa Timur'],
                datasets: [{
                    label: 'Jumlah Toko',
                    data: provinceData.length ? provinceData : [50, 40, 30],
                    backgroundColor: '#102C54',
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { display: false } }
            }
        });
    </script>

</body>
</html>