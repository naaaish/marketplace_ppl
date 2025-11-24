<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Verifikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar Admin -->
    <nav class="bg-[#0f172a] text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2 text-xl font-bold">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Admin Panel</span>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-sm bg-red-600 hover:bg-red-700 px-3 py-1 rounded transition">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mx-auto p-6">
        
        <!-- Judul -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Verifikasi Penjual Baru</h1>

        <!-- Notifikasi Sukses -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Daftar Penjual -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nama Toko
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            PIC & Kontak
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Email (Akun)
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Dokumen
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingSellers as $seller)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap font-bold">
                                        {{ $seller->store_name }}
                                    </p>
                                    <p class="text-gray-500 text-xs">{{ Str::limit($seller->store_description, 30) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $seller->pic_name }}</p>
                            <p class="text-gray-500 text-xs">{{ $seller->pic_phone }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $seller->pic_email }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <!-- Tombol Dummy untuk melihat dokumen (bisa dikembangkan nanti) -->
                            <span class="relative inline-block px-3 py-1 font-semibold text-blue-900 leading-tight cursor-pointer hover:opacity-75">
                                <span aria-hidden class="absolute inset-0 bg-blue-200 opacity-50 rounded-full"></span>
                                <span class="relative text-xs">Lihat KTP/Foto</span>
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex gap-2">
                                <!-- Tombol ACC -->
                                <form action="{{ route('admin.approve', $seller->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-xs shadow transition duration-200 flex items-center gap-1">
                                        <i class="fa-solid fa-check"></i> Terima
                                    </button>
                                </form>

                                <!-- Tombol Tolak (Opsional, belum ada rute reject di web.php) -->
                                <!-- 
                                <form action="{{ route('admin.reject', $seller->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-xs shadow transition duration-200 flex items-center gap-1">
                                        <i class="fa-solid fa-xmark"></i> Tolak
                                    </button>
                                </form> 
                                -->
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 border-b border-gray-200 bg-white text-sm text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <i class="fa-regular fa-folder-open text-4xl mb-2 text-gray-300"></i>
                                <p>Tidak ada pendaftaran toko baru yang menunggu verifikasi.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>