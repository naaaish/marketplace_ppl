<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk Saya</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        /* Import Font */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        
        /* Sidebar Scrollbar */
        .sidebar-scroll::-webkit-scrollbar { width: 6px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: rgba(255,255,255,0.2); border-radius: 3px; }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: #f1f5f9;
        }

        .product-info { padding: 15px; }

        .product-name {
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
            color: #1e293b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-size: 16px;
            color: #102C54;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .product-stock { font-size: 12px; color: #64748b; }

        .product-actions {
            padding: 10px 15px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            gap: 8px;
            background-color: #f8fafc;
        }

        /* Style Umum Tombol Kecil */
        .btn-small {
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 6px;
            text-decoration: none;
            border: 1px solid #cbd5e1;
            background: white;
            color: #475569;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .btn-small:hover {
            border-color: #102C54;
            color: #102C54;
            background-color: #eff6ff;
        }

        /* Style Khusus Tombol Hapus (Merah saat hover) */
        .btn-delete:hover {
            border-color: #ef4444 !important;
            color: #ef4444 !important;
            background-color: #fef2f2 !important;
        }

        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-active { background: #dcfce7; color: #166534; }
        .status-inactive { background: #f1f5f9; color: #64748b; }

        .success-message {
            background: #dcfce7; color: #166534; padding: 12px 20px; 
            border-radius: 8px; margin-bottom: 20px; border: 1px solid #bbf7d0;
        }
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
                
                <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-4 py-3 bg-white text-[#102C54] rounded-lg font-semibold shadow-md transition">
                    <i class="fas fa-box w-5"></i> Produk Saya
                </a>
                
                <a href="{{ route('products.create') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-plus-circle w-5"></i> Tambah Produk
                </a>

                <a href="{{ route('seller.reports.index') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-file-pdf w-5"></i> Pusat Laporan
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
            
            <header class="bg-white shadow-sm sticky top-0 z-20 border-b border-gray-100 px-8 py-4 flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Produk</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Kelola semua produk toko Anda di sini.</p>
                </div>
                <div>
                    <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 bg-[#102C54] hover:bg-blue-900 text-white px-5 py-2.5 rounded-lg font-medium transition shadow-md">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </a>
                </div>
            </header>

            <main class="p-8">

                @if (session('success'))
                    <div class="success-message flex items-center gap-2">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="products-grid">
                    @forelse ($products as $product)
                        <div class="product-card group">
                            <div class="relative overflow-hidden">
                                @if ($product->photo)
                                    @if(Str::startsWith($product->photo, 'products/'))
                                        <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->name }}" class="product-image group-hover:scale-105 transition duration-300">
                                    @else
                                        <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="product-image group-hover:scale-105 transition duration-300">
                                    @endif
                                @else
                                    <div class="product-image flex items-center justify-center text-gray-400 bg-gray-100">
                                        <i class="fas fa-image text-3xl"></i>
                                    </div>
                                @endif
                                
                                <div class="absolute top-2 right-2">
                                    <span class="status-badge {{ $product->status == 'active' ? 'status-active' : 'status-inactive' }} shadow-sm">
                                        {{ $product->status == 'active' ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="product-info">
                                <div class="product-name" title="{{ $product->name }}">{{ $product->name }}</div>
                                <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                
                                <div class="flex items-center justify-between mt-2">
                                    <div class="product-stock">
                                        <i class="fas fa-box text-xs mr-1"></i> Stok: <b>{{ $product->stock }}</b>
                                    </div>
                                    <div class="text-xs text-yellow-500 font-medium">
                                        <i class="fas fa-star"></i> {{ number_format($product->rating ?? 0, 1) }}
                                    </div>
                                </div>

                                <div class="mt-2 text-xs text-gray-400 flex items-center gap-1">
                                    <i class="fas fa-tag"></i> {{ $product->category ?? 'Umum' }}
                                </div>
                            </div>
                            
                            <div class="product-actions">
                                <a href="{{ route('products.edit', $product) }}" class="btn-small">
                                    <i class="fas fa-edit mb-1"></i> Edit
                                </a>
                                <a href="{{ route('products.show', $product) }}" class="btn-small">
                                    <i class="fas fa-eye mb-1"></i> Lihat
                                </a>
                                
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="flex-1" id="delete-form-{{ $product->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-small btn-delete w-full" onclick="confirmDelete({{ $product->id }})">
                                        <i class="fas fa-trash mb-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full flex flex-col items-center justify-center p-12 bg-white rounded-xl border-2 border-dashed border-gray-300 text-center">
                            <div class="bg-gray-50 p-4 rounded-full mb-4">
                                <i class="fas fa-box-open text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-600">Belum ada produk</h3>
                            <p class="text-gray-400 mt-1 mb-6">Mulai tambahkan produk pertama Anda sekarang.</p>
                            <a href="{{ route('products.create') }}" class="px-6 py-2 bg-[#102C54] text-white rounded-lg hover:bg-blue-900 transition shadow-md">
                                + Tambah Produk
                            </a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </main>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Produk yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',     
                cancelButtonColor: '#3085d6',   
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Cari form berdasarkan ID dan submit
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>

</body>
</html>