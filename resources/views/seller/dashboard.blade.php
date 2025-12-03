<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjual - Tuku</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Custom Font */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen overflow-hidden">
        
        <div class="w-64 bg-[#102C54] text-white flex-shrink-0 flex flex-col">
            
            <div class="p-6 flex flex-col items-center justify-center border-b border-blue-900/50">
                <img src="{{ asset('img/logo.png') }}" 
                     alt="Logo" 
                     class="w-32 h-auto object-contain mb-2" 
                     onerror="this.style.display='none'">
                <span class="text-xs text-blue-200 font-medium tracking-wider uppercase">Seller Panel</span>
            </div>

            <nav class="flex-1 px-4 space-y-2 mt-4">
                
                <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-white text-[#102C54] rounded-lg font-semibold shadow-md transition">
                    <i class="fas fa-th-large w-5"></i> Dashboard
                </a>

                <a href="{{ route('laporan.stok') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-box w-5"></i> Laporan Stok
                </a>

                <a href="{{ route('laporan.rating') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-star w-5"></i> Laporan Rating
                </a>

                <a href="{{ route('tambah.produk') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-plus-circle w-5"></i> Tambah Produk
                </a>

            </nav>

            <div class="p-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 text-red-300 hover:text-red-100 hover:bg-white/10 w-full px-4 py-2 rounded-lg transition">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <header class="bg-white shadow-sm p-6 flex justify-between items-center sticky top-0 z-10">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard Penjual</h2>
                    <p class="text-sm text-gray-500">Ringkasan aktivitas toko Anda.</p>
                </div>

                <div class="flex items-center gap-4">
                    <button onclick="showNotifications()" class="relative p-2 bg-gray-50 rounded-lg hover:bg-gray-100 border border-gray-200 transition">
                        <i class="fas fa-bell text-gray-600"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full">3</span>
                    </button>

                    <div class="flex items-center gap-3 px-4 py-2 bg-gray-50 rounded-full border border-gray-200 cursor-pointer hover:bg-gray-100 transition" onclick="showUserMenu()">
                        <div class="w-8 h-8 bg-[#102C54] rounded-full flex items-center justify-center text-white text-xs">
                            <i class="fas fa-user"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Halo, Penjual!</span>
                    </div>
                </div>
            </header>

            <main class="p-8">

                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg flex justify-between items-center mb-8 shadow-sm">
                    <div>
                        <h3 class="font-bold text-red-700">Peringatan Stok Rendah!</h3>
                        <p class="text-sm text-red-600">Produk "Welcome HD Pro" sisa stok: 1</p>
                    </div>
                    <button onclick="window.location.href='{{ route('unduh.laporan') }}'" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition shadow-sm">
                        <i class="fas fa-file-download mr-2"></i> Unduh Laporan
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="font-bold text-gray-700 mb-4">Sebaran Jumlah Stok Produk</h3>
                        <canvas id="stockChart"></canvas>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                        <h3 class="font-bold text-gray-700 mb-4">Distribusi Stok Produk</h3>
                        <div class="h-64 flex justify-center">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-700 mb-6">Sebaran Rating Produk</h3>
                    
                    <div class="flex items-end justify-between h-48 gap-2">
                        <div class="flex flex-col items-center w-full group">
                            <div class="w-full bg-gradient-to-t from-yellow-500 to-yellow-400 rounded-t-lg flex items-end justify-center text-white text-xs font-bold pb-2 transition-all group-hover:opacity-80" style="height: 60%;">5★</div>
                            <span class="text-xs text-gray-500 mt-2 text-center">Inara Timur</span>
                        </div>
                        <div class="flex flex-col items-center w-full group">
                            <div class="w-full bg-gradient-to-t from-yellow-500 to-yellow-400 rounded-t-lg flex items-end justify-center text-white text-xs font-bold pb-2 transition-all group-hover:opacity-80" style="height: 80%;">5★</div>
                            <span class="text-xs text-gray-500 mt-2 text-center">Inara Tengah</span>
                        </div>
                        <div class="flex flex-col items-center w-full group">
                            <div class="w-full bg-gradient-to-t from-yellow-500 to-yellow-400 rounded-t-lg flex items-end justify-center text-white text-xs font-bold pb-2 transition-all group-hover:opacity-80" style="height: 70%;">5★</div>
                            <span class="text-xs text-gray-500 mt-2 text-center">Inara Esme</span>
                        </div>
                        <div class="flex flex-col items-center w-full group">
                            <div class="w-full bg-gradient-to-t from-yellow-500 to-yellow-400 rounded-t-lg flex items-end justify-center text-white text-xs font-bold pb-2 transition-all group-hover:opacity-80" style="height: 55%;">5★</div>
                            <span class="text-xs text-gray-500 mt-2 text-center">Ofel Larasati</span>
                        </div>
                        <div class="flex flex-col items-center w-full group">
                            <div class="w-full bg-gradient-to-t from-yellow-500 to-yellow-400 rounded-t-lg flex items-end justify-center text-white text-xs font-bold pb-2 transition-all group-hover:opacity-80" style="height: 45%;">5★</div>
                            <span class="text-xs text-gray-500 mt-2 text-center">Bale 89</span>
                        </div>
                        <div class="flex flex-col items-center w-full group">
                            <div class="w-full bg-gradient-to-t from-yellow-500 to-yellow-400 rounded-t-lg flex items-end justify-center text-white text-xs font-bold pb-2 transition-all group-hover:opacity-80" style="height: 65%;">5★</div>
                            <span class="text-xs text-gray-500 mt-2 text-center">Larasya</span>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        // Chart: Stock
        const stockChart = new Chart(document.getElementById('stockChart'), {
            type: 'bar',
            data: {
                labels: ['Inara Timur','Inara Tengah','Inara Esme','Ofel Larasati','Bale 89','Larasya'],
                datasets: [{
                    data: [45,80,65,50,35,60],
                    backgroundColor: '#3b82f6',
                    borderRadius: 6
                }]
            },
            options: { 
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Chart: Pie
        const pieChart = new Chart(document.getElementById('pieChart'), {
            type: 'doughnut',
            data: {
                labels: ['Inara Timur','Inara Tengah','Inara Esme','Ofel Larasati','Bale 89','Larasya'],
                datasets: [{
                    data: [245,214,167,141,120,124],
                    backgroundColor: ['#3b82f6','#ef4444','#eab308','#22c55e','#a855f7','#ec4899'],
                    borderWidth: 0
                }]
            },
            options: { 
                responsive: true,
                cutout: '70%',
                plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8 } } } 
            }
        });

        // Notifications
        function showNotifications(){
            // Menggunakan SweetAlert jika ada, atau alert biasa
            if(typeof Swal !== 'undefined') {
                Swal.fire({ icon: 'info', title: 'Notifikasi', text: 'Anda memiliki 3 notifikasi baru.' });
            } else {
                alert("Anda memiliki 3 notifikasi baru.");
            }
        }

        // User Menu / Logout Confirm
        function showUserMenu(){
            if(confirm("Ingin logout dari panel penjual?")){
                document.querySelector('form[action="{{ route('logout') }}"]').submit();
            }
        }
    </script>

</body>
</html>