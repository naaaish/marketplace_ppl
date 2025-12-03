<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjual</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
        }

        .sidebar {
            background: #003366;
            min-height: 100vh;
            width: 280px;
            position: fixed;
            left: 0;
            top: 0;
            padding: 20px;
            color: white;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 40px;
        }

        .logo-box {
            width: 55px;
            height: 55px;
            background: #001a33;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-image {
            width: 70%;
            height: 70%;
            object-fit: contain;
        }

        .logo-title {
            font-weight: bold;
            line-height: 1.1;
        }

        .logo-title .line1 {
            font-size: 20px;
            color: white;
        }

        .logo-title .line2 {
            font-size: 22px;
            color: #FDC500;
        }

        .menu-item {
            padding: 15px 20px;
            margin-bottom: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .menu-item.active {
            background: white;
            color: #003366;
            font-weight: 600;
        }

        .menu-item i {
            width: 20px;
        }

        .logout-item {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            margin-bottom: 0;
        }

        .main-content {
            margin-left: 280px;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .header h1 { 
            font-size: 28px; 
            color: #003366; 
            margin: 0; 
        }

        .header-right { 
            display: flex; 
            align-items: center; 
            gap: 20px; 
        }

        .notification-btn {
            position: relative;
            background: white;
            border: 1px solid #e5e7eb;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f3f4f6;
            padding: 8px 15px;
            border-radius: 25px;
            cursor: pointer;
        }

        .alert-box {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border-left: 4px solid #ef4444;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .alert-box h3 {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .alert-box p {
            margin: 0;
        }

        .chart-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-box {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .chart-box h3 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #003366;
        }

        .rating-container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .rating-container h3 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #003366;
        }

        .rating-bars {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .bar-container {
            flex: 1;
            text-align: center;
        }

        .bar {
            width: 100%;
            background: linear-gradient(180deg, #fbbf24 0%, #f59e0b 100%);
            border-radius: 8px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 10px;
            color: white;
            font-weight: bold;
        }

        .bar-label {
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            margin-top: 8px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo">
            <div class="logo-box">
                <img src="{{ asset('img/logo.png') }}" class="logo-image" alt="Logo" onerror="this.style.display='none'">
            </div>
            <div class="logo-title">
                <span class="line1">tuku</span><br>
                <span class="line2">tukU</span>
            </div>
        </div>

        <a href="{{ route('seller.dashboard') }}" class="menu-item active">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        <a href="{{ route('laporan.stok') }}" class="menu-item">
            <i class="fas fa-box"></i> Laporan Stok
        </a>

        <a href="{{ route('laporan.rating') }}" class="menu-item">
            <i class="fas fa-chart-bar"></i> Laporan Rating
        </a>

        <a href="{{ route('tambah.produk') }}" class="menu-item">
            <i class="fas fa-plus-circle"></i> Tambah Produk
        </a>

        <a href="{{ route('logout') }}" class="menu-item logout-item">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>

    <div class="main-content">

        <div class="header">
            <h1>Dashboard Penjual</h1>

            <div class="header-right">
                <button class="notification-btn" onclick="showNotifications()">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>

                <div class="user-profile" onclick="showUserMenu()">
                    <span>Halo, Penjual!</span>
                    <div class="user-avatar"><i class="fas fa-user"></i></div>
                </div>
            </div>
        </div>

        <div class="alert-box">
            <div>
                <h3>Peringatan Stok Rendah!</h3>
                <p>Welcome HD Pro — Sisa stok 1</p>
            </div>

            <button class="btn btn-danger" onclick="window.location.href='{{ route('unduh.laporan') }}'">
                Unduh Laporan PDF
            </button>
        </div>

        <div class="chart-container">
            <div class="chart-box">
                <h3>Sebaran Jumlah Stok Produk</h3>
                <canvas id="stockChart"></canvas>
            </div>

            <div class="chart-box">
                <h3>Distribusi Stok Produk</h3>
                <canvas id="pieChart"></canvas>
            </div>
        </div>

        <div class="rating-container">
            <h3>Sebaran Rating Produk</h3>

            <div class="rating-bars">
                <div class="bar-container">
                    <div class="bar" style="height:120px;">5★</div>
                    <div class="bar-label">Inara Timur</div>
                </div>

                <div class="bar-container">
                    <div class="bar" style="height:160px;">5★</div>
                    <div class="bar-label">Inara Tengah</div>
                </div>

                <div class="bar-container">
                    <div class="bar" style="height:140px;">5★</div>
                    <div class="bar-label">Inara Esme</div>
                </div>

                <div class="bar-container">
                    <div class="bar" style="height:110px;">5★</div>
                    <div class="bar-label">Ofel Larasati</div>
                </div>

                <div class="bar-container">
                    <div class="bar" style="height:90px;">5★</div>
                    <div class="bar-label">Bale 89</div>
                </div>

                <div class="bar-container">
                    <div class="bar" style="height:130px;">5★</div>
                    <div class="bar-label">Larasya</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const stockChart = new Chart(document.getElementById('stockChart'), {
            type: 'bar',
            data: {
                labels: ['Inara Timur','Inara Tengah','Inara Esme','Ofel Larasati','Bale 89','Larasya'],
                datasets: [{
                    data: [45,80,65,50,35,60],
                    backgroundColor: '#3b82f6',
                    borderRadius: 8
                }]
            },
            options: { plugins: { legend: { display: false } } }
        });

        const pieChart = new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: [],
                datasets: [{
                    data: [245,214,167,141,120,124],
                    backgroundColor: ['#3b82f6','#ef4444','#eab308','#22c55e','#a855f7','#ec4899']
                }]
            },
            options: { plugins: { legend: { display: false } } }
        });

        function showNotifications(){
            alert("Anda memiliki 3 notifikasi baru.");
        }

        function showUserMenu(){
            if(confirm("Ingin logout?")){
                window.location.href = "{{ route('logout') }}";
            }
        }
    </script>

</body>
</html>