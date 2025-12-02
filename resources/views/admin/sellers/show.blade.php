<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penjual - {{ $seller->store_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <a href="{{ route('admin.sellers') }}" class="flex items-center gap-3 px-4 py-3 bg-white text-[#102C54] rounded-lg font-semibold shadow-md">
                    <i class="fas fa-users"></i> Manajemen Penjual
                </a>
                <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-box"></i> Manajemen Produk
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-chart-bar"></i> Laporan
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
            
            <header class="bg-white shadow-sm p-6 sticky top-0 z-10">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.sellers') }}" class="text-gray-500 hover:text-[#102C54] transition">
                            <i class="fas fa-arrow-left text-xl"></i>
                        </a>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Detail Penjual</h2>
                            <p class="text-sm text-gray-500">Verifikasi data lengkap toko.</p>
                        </div>
                    </div>

                    <div>
                        @if($seller->status == 'pending')
                            <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-800 font-bold border border-yellow-200">
                                <i class="fas fa-clock mr-2"></i> Perlu Verifikasi
                            </span>
                        @elseif($seller->status == 'active')
                            <span class="px-4 py-2 rounded-full bg-green-100 text-green-800 font-bold border border-green-200">
                                <i class="fas fa-check-circle mr-2"></i> Aktif
                            </span>
                        @else
                            <span class="px-4 py-2 rounded-full bg-red-100 text-red-800 font-bold border border-red-200">
                                <i class="fas fa-times-circle mr-2"></i> Ditolak
                            </span>
                        @endif
                    </div>
                </div>
            </header>

            <main class="p-8">
                @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 text-center">
                            <div class="w-32 h-32 mx-auto bg-gray-200 rounded-full overflow-hidden border-4 border-white shadow-lg mb-4">
                                <img src="{{ asset('storage/' . str_replace('public/', '', $seller->pic_photo_path)) }}" 
                                    alt="Foto PIC" 
                                    class="w-full h-full object-cover"
                                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($seller->pic_name) }}&background=random'">
                                     
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $seller->pic_name }}</h3>
                            <p class="text-sm text-gray-500 mb-4">Penanggung Jawab (PIC)</p>
                            
                            <div class="flex justify-center gap-2 mb-4">
                                <a href="mailto:{{ $seller->pic_email }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100" title="Email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $seller->pic_phone) }}" target="_blank" class="p-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100" title="WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>

                            @if($seller->status == 'pending')
                            <div class="border-t pt-4 mt-2 space-y-2">
                                <form action="{{ route('admin.approve', $seller->id) }}" method="POST" onsubmit="confirmAction(event, this, 'Setujui pendaftaran ini?', 'question', '#102C54', 'Ya, Setujui')">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition shadow-md">
                                        <i class="fas fa-check mr-2"></i> Setujui
                                    </button>
                                </form>
                                <form action="{{ route('admin.reject', $seller->id) }}" method="POST" onsubmit="confirmAction(event, this, 'Tolak pendaftaran ini?', 'warning', '#d33', 'Ya, Tolak')">
                                    @csrf
                                    <button type="submit" class="w-full bg-white border border-red-500 text-red-600 hover:bg-red-50 font-bold py-2 px-4 rounded-lg transition">
                                        <i class="fas fa-times mr-2"></i> Tolak
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>

                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h4 class="font-bold text-gray-800 mb-4 border-b pb-2">Kontak Info</h4>
                            <ul class="space-y-3 text-sm">
                                <li class="flex items-start">
                                    <i class="fas fa-envelope w-6 text-gray-400 mt-1"></i>
                                    <span class="text-gray-600 break-all">{{ $seller->pic_email }}</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-phone w-6 text-gray-400 mt-1"></i>
                                    <span class="text-gray-600">{{ $seller->pic_phone }}</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-id-card w-6 text-gray-400 mt-1"></i>
                                    <div>
                                        <span class="block text-gray-500 text-xs">NIK</span>
                                        <span class="text-gray-800 font-mono">{{ $seller->pic_ktp_number }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-6">
                        
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-bold text-[#102C54] mb-4 flex items-center">
                                <i class="fas fa-store mr-2"></i> Informasi Toko
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="text-xs text-gray-500 uppercase font-semibold">Nama Toko</label>
                                    <p class="text-lg font-medium text-gray-900">{{ $seller->store_name }}</p>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 uppercase font-semibold">Tanggal Daftar</label>
                                    <p class="text-base text-gray-700">{{ $seller->created_at->format('d M Y, H:i') }} WIB</p>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="text-xs text-gray-500 uppercase font-semibold">Deskripsi Toko</label>
                                    <p class="text-gray-700 bg-gray-50 p-3 rounded-lg border mt-1">{{ $seller->store_description }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-bold text-[#102C54] mb-4 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2"></i> Alamat Lengkap
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div class="md:col-span-2">
                                    <label class="text-xs text-gray-500 font-semibold">Alamat Jalan</label>
                                    <p class="font-medium">{{ $seller->pic_address }}</p>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 font-semibold">Provinsi</label>
                                    <p>{{ $seller->province }}</p>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 font-semibold">Kabupaten/Kota</label>
                                    <p>{{ $seller->regency }}</p>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 font-semibold">Kecamatan</label>
                                    <p>{{ $seller->district }}</p>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 font-semibold">Kelurahan</label>
                                    <p>{{ $seller->village }}</p>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 font-semibold">RT / RW</label>
                                    <p>{{ $seller->rt }} / {{ $seller->rw }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-bold text-[#102C54] mb-4 flex items-center">
                                <i class="fas fa-file-contract mr-2"></i> Dokumen Pendukung (KTP)
                            </h3>
                                <img src="{{ asset('storage/' . str_replace(['public/', 'storage/'], '', $seller->pic_ktp_path)) }}" 
                                    alt="Scan KTP" 
                                    class="max-h-80 max-w-full rounded shadow-md object-contain hover:scale-105 transition-transform duration-300 cursor-pointer"
                                    onclick="window.open(this.src, '_blank')">
                            </div>
                            <p class="text-center text-xs text-gray-500 mt-2"><i class="fas fa-search-plus"></i> Klik gambar untuk memperbesar</p>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function confirmAction(event, form, title, icon, btnColor, btnText) {
            event.preventDefault(); // Stop form submit
            Swal.fire({
                title: title,
                text: "Pastikan data sudah dicek dengan benar.",
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: btnColor,
                cancelButtonColor: '#6b7280',
                confirmButtonText: btnText,
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); 
                }
            });
        }
    </script>
</body>
</html>