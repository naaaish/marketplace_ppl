<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjual - TukuTuku</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Custom Font */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        
        /* Custom Scrollbar Sidebar */
        .sidebar-scroll::-webkit-scrollbar { width: 5px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: rgba(255,255,255,0.2); border-radius: 10px; }
    </style>
</head>
<body class="text-gray-800">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-[#102C54] text-white flex-shrink-0 flex flex-col transition-all duration-300">
            
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

                <a href="{{ route('seller.reports') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-file-pdf w-5"></i> Pusat Laporan
                </a>
            </nav>

            <div class="p-4 border-t border-blue-800/50 bg-[#0d2445]">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center justify-center gap-2 text-red-300 hover:text-white hover:bg-red-600/20 w-full px-4 py-2.5 rounded-lg transition duration-200 group">
                        <i class="fas fa-sign-out-alt group-hover:rotate-180 transition-transform duration-300"></i> 
                        <span class="font-medium">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <header class="bg-white shadow-sm sticky top-0 z-20 border-b border-gray-100 px-8 py-4 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard Toko</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Pantau performa tokomu hari ini.</p>
                </div>

                <div class="flex items-center gap-4">
                    <button class="relative p-2.5 bg-gray-50 rounded-full hover:bg-gray-100 border border-gray-200 text-gray-600 hover:text-[#102C54] transition">
                        <i class="fas fa-bell"></i>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-[10px] font-bold w-4 h-4 flex items-center justify-center rounded-full border-2 border-white">3</span>
                    </button>

                    <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
                        <div class="text-right hidden md:block">
                            <p class="text-sm font-bold text-gray-700">{{ Auth::user()->name ?? 'Seller' }}</p>
                            <p class="text-xs text-gray-500">
                                {{ Auth::user()->seller->store_name ?? 'Toko Saya' }}
                            </p>
                        </div>
                        <div class="w-10 h-10 bg-gradient-to-br from-[#102C54] to-blue-600 rounded-full flex items-center justify-center text-white shadow-md">
                            <i class="fas fa-store"></i>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-8 max-w-7xl mx-auto w-full">

                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl flex flex-col md:flex-row justify-between items-center mb-8 shadow-sm gap-4">
                    <div class="flex items-start gap-4">
                        <div class="bg-red-100 p-2 rounded-full text-red-600">
                            <i class="fas fa-exclamation-triangle text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-red-800">Perhatian: Stok Menipis!</h3>
                            <p class="text-sm text-red-600 mt-1">Beberapa produkmu memiliki stok kurang dari 5. Segera lakukan restock.</p>
                        </div>
                    </div>
                    <a href="{{ route('seller.reports.stock_low') }}" class="whitespace-nowrap px-4 py-2 bg-red-600 text-white text-sm font-bold rounded-lg hover:bg-red-700 transition shadow-md flex items-center gap-2">
                        <i class="fas fa-file-download"></i> Unduh Laporan Stok Kritis
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Produk</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-1">124</h3>
                            </div>
                            <div class="p-3 bg-blue-50 rounded-xl text-blue-600"><i class="fas fa-box text-2xl"></i></div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Stok</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-1">1,450</h3>
                            </div>
                            <div class="p-3 bg-green-50 rounded-xl text-green-600"><i class="fas fa-cubes text-2xl"></i></div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Rating Toko</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-1">4.8</h3>
                            </div>
                            <div class="p-3 bg-yellow-50 rounded-xl text-yellow-500"><i class="fas fa-star text-2xl"></i></div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-chart-bar text-blue-500"></i> Sebaran Jumlah Stok
                        </h3>
                        <div class="relative h-64 w-full">
                            <canvas id="stockChart"></canvas>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-chart-pie text-purple-500"></i> Distribusi Kategori Produk
                        </h3>
                        <div class="relative h-64 w-full flex justify-center">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-thumbs-up text-yellow-500"></i> Produk Rating Tertinggi
                        </h3>
                        <a href="{{ route('seller.reports.rating_desc') }}" class="text-sm text-blue-600 font-medium hover:underline">Lihat Laporan Lengkap</a>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 items-end h-48">
                        <div class="flex flex-col items-center group cursor-pointer">
                            <div class="w-full bg-gradient-to-t from-yellow-400 to-yellow-300 rounded-t-lg shadow-sm flex items-end justify-center pb-2 text-white font-bold text-xs transition-all duration-300 group-hover:bg-yellow-500" style="height: 60%;">4.5</div>
                            <p class="text-[10px] text-gray-500 mt-2 text-center font-medium truncate w-full">Inara Timur</p>
                        </div>
                        <div class="flex flex-col items-center group cursor-pointer">
                            <div class="w-full bg-gradient-to-t from-yellow-400 to-yellow-300 rounded-t-lg shadow-sm flex items-end justify-center pb-2 text-white font-bold text-xs transition-all duration-300 group-hover:bg-yellow-500" style="height: 90%;">5.0</div>
                            <p class="text-[10px] text-gray-500 mt-2 text-center font-medium truncate w-full">Inara Tengah</p>
                        </div>
                        <div class="flex flex-col items-center group cursor-pointer">
                            <div class="w-full bg-gradient-to-t from-yellow-400 to-yellow-300 rounded-t-lg shadow-sm flex items-end justify-center pb-2 text-white font-bold text-xs transition-all duration-300 group-hover:bg-yellow-500" style="height: 75%;">4.8</div>
                            <p class="text-[10px] text-gray-500 mt-2 text-center font-medium truncate w-full">Inara Esme</p>
                        </div>
                        <div class="flex flex-col items-center group cursor-pointer">
                            <div class="w-full bg-gradient-to-t from-yellow-400 to-yellow-300 rounded-t-lg shadow-sm flex items-end justify-center pb-2 text-white font-bold text-xs transition-all duration-300 group-hover:bg-yellow-500" style="height: 50%;">4.2</div>
                            <p class="text-[10px] text-gray-500 mt-2 text-center font-medium truncate w-full">Ofel Larasati</p>
                        </div>
                        <div class="flex flex-col items-center group cursor-pointer">
                            <div class="w-full bg-gradient-to-t from-yellow-400 to-yellow-300 rounded-t-lg shadow-sm flex items-end justify-center pb-2 text-white font-bold text-xs transition-all duration-300 group-hover:bg-yellow-500" style="height: 40%;">3.8</div>
                            <p class="text-[10px] text-gray-500 mt-2 text-center font-medium truncate w-full">Bale 89</p>
                        </div>
                        <div class="flex flex-col items-center group cursor-pointer">
                            <div class="w-full bg-gradient-to-t from-yellow-400 to-yellow-300 rounded-t-lg shadow-sm flex items-end justify-center pb-2 text-white font-bold text-xs transition-all duration-300 group-hover:bg-yellow-500" style="height: 65%;">4.6</div>
                            <p class="text-[10px] text-gray-500 mt-2 text-center font-medium truncate w-full">Larasya</p>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Chart: Stock (Bar Chart)
            const ctxStock = document.getElementById('stockChart');
            if (ctxStock) {
                new Chart(ctxStock, {
                    type: 'bar',
                    data: {
                        labels: ['Inara Timur','Inara Tengah','Inara Esme','Ofel Larasati','Bale 89','Larasya'],
                        datasets: [{
                            label: 'Stok Barang',
                            data: [45,80,65,50,35,60],
                            backgroundColor: '#3b82f6',
                            borderRadius: 4,
                            barPercentage: 0.6
                        }]
                    },
                    options: { 
                        responsive: true,
                        maintainAspectRatio: false, 
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { 
                                beginAtZero: true, 
                                grid: { borderDash: [5, 5], color: '#f1f5f9' },
                                ticks: { font: { size: 11 } }
                            },
                            x: { 
                                grid: { display: false },
                                ticks: { font: { size: 11 } }
                            }
                        }
                    }
                });
            }

            // Chart: Pie (Doughnut)
            const ctxPie = document.getElementById('pieChart');
            if (ctxPie) {
                new Chart(ctxPie, {
                    type: 'doughnut',
                    data: {
                        labels: ['Fashion', 'Elektronik', 'Makanan', 'Hobi', 'Kesehatan', 'Lainnya'],
                        datasets: [{
                            data: [35, 25, 20, 10, 5, 5],
                            backgroundColor: ['#102C54', '#3B82F6', '#60A5FA', '#93C5FD', '#BFDBFE', '#E2E8F0'],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: { 
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '70%',
                        plugins: { 
                            legend: { 
                                position: 'right', 
                                labels: { usePointStyle: true, boxWidth: 8, font: { size: 11 } } 
                            } 
                        } 
                    }
                });
            }
        });
    </script>

</body>
</html>