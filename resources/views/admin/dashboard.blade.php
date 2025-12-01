<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Penjual - Admin</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Scrollbar kustom agar terlihat di desktop */
        ::-webkit-scrollbar { height: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

    <nav class="bg-slate-900 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-2 font-bold text-xl">
                    <i class="fa-solid fa-shield-cat text-blue-400"></i> Admin Panel
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-sm bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Verifikasi Penjual Baru</h1>
                <p class="text-sm text-gray-500 mt-1">Daftar antrian toko yang menunggu persetujuan.</p>
            </div>
            
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-sm" role="alert">
                <span class="block sm:inline"><i class="fas fa-check mr-1"></i> {{ session('success') }}</span>
            </div>
            @endif
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-sm text-left text-gray-500">
                    
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-bold whitespace-nowrap">Info Toko</th>
                            <th scope="col" class="px-6 py-4 font-bold whitespace-nowrap">Kontak PIC</th>
                            <th scope="col" class="px-6 py-4 font-bold whitespace-nowrap">Dokumen</th>
                            <th scope="col" class="px-6 py-4 font-bold whitespace-nowrap text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse($pendingSellers as $seller)
                        <tr class="bg-white hover:bg-gray-50 transition duration-150">
                            
                            <td class="px-6 py-4 align-top whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-lg">
                                        {{ substr($seller->store_name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $seller->store_name }}</div>
                                        <div class="text-xs text-gray-500 truncate max-w-[200px]" title="{{ $seller->store_description }}">
                                            {{ Str::limit($seller->store_description, 30) }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 align-top whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $seller->pic_name }}</div>
                                <div class="text-xs text-gray-500 mb-1">{{ $seller->pic_phone }}</div>
                                <div class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $seller->pic_email }}
                                </div>
                            </td>

                            <td class="px-6 py-4 align-middle whitespace-nowrap">
                                <button class="flex items-center gap-2 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-md text-xs font-semibold transition">
                                    <i class="fa-regular fa-id-card"></i> Lihat KTP
                                </button>
                            </td>

                            <td class="px-6 py-4 align-middle text-center whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-2">
                                    
                                    <a href="{{ route('admin.show', $seller->id) }}" class="text-gray-500 hover:text-gray-700 p-2 hover:bg-gray-100 rounded-lg transition" title="Lihat Detail">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>

                                    <form action="{{ route('admin.reject', $seller->id) }}" method="POST" onsubmit="return confirm('Tolak pendaftaran ini?');">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-1 bg-white border border-red-300 text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-md text-xs font-bold transition shadow-sm">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.approve', $seller->id) }}" method="POST" onsubmit="return confirm('Setujui pendaftaran ini?');">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-md text-xs font-bold transition shadow-md">
                                            <i class="fas fa-check"></i> Terima
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-300"></i>
                                    <p>Tidak ada data pengajuan baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-200 text-xs text-gray-500">
                
            </div>
        </div>
    </div>

</body>
</html>