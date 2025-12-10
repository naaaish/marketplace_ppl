<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Penjual - Tuku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <button type="submit" class="flex items-center gap-2 text-red-300 hover:text-red-100 w-full px-4 py-2">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <header class="bg-white shadow-sm p-6 flex justify-between items-center sticky top-0 z-10">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Penjual</h2>
                    <p class="text-sm text-gray-500">Kelola pendaftaran dan data toko.</p>
                </div>
                
                @if(session('success'))
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({ 
                            icon: 'success', 
                            title: 'Berhasil', 
                            text: "{{ session('success') }}", 
                            confirmButtonColor: '#102C54' 
                        });
                    });
                </script>
                @endif
            </header>

            <main class="p-8">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-bold whitespace-nowrap">Info Toko</th>
                                    <th scope="col" class="px-6 py-4 font-bold whitespace-nowrap">Kontak PIC</th>
                                    <th scope="col" class="px-6 py-4 font-bold whitespace-nowrap">Status</th>
                                    <th scope="col" class="px-6 py-4 font-bold whitespace-nowrap text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($sellers as $seller)
                                <tr class="bg-white hover:bg-gray-50 transition duration-150">
                                    
                                    <td class="px-6 py-4 align-top whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-lg">
                                                {{ substr($seller->store_name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900">{{ $seller->store_name }}</div>
                                                <div class="text-xs text-gray-500 truncate max-w-[150px]" title="{{ $seller->store_description }}">
                                                    {{ Str::limit($seller->store_description, 20) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 align-top whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $seller->pic_name }}</div>
                                        <div class="text-xs text-gray-500 mb-1">{{ $seller->pic_phone }}</div>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $seller->pic_email }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 align-middle">
                                        @if($seller->status == 'pending')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Perlu Verifikasi</span>
                                        @elseif($seller->status == 'active')
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">{{ ucfirst($seller->status) }}</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 align-middle text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center space-x-2">
                                            
                                            <a href="{{ route('admin.show', $seller->id) }}" class="text-gray-500 hover:text-gray-700 p-2 hover:bg-gray-100 rounded-lg transition" title="Lihat Detail">
                                                <i class="fas fa-eye text-lg"></i>
                                            </a>

                                            @if($seller->status == 'pending')
                                                <form action="{{ route('admin.reject', $seller->id) }}" method="POST" onsubmit="confirmAction(event, this, 'Tolak pendaftaran ini?', 'warning', '#d33', 'Ya, Tolak')">
                                                    @csrf
                                                    <button type="submit" class="flex items-center gap-1 bg-white border border-red-300 text-red-600 hover:bg-red-50 px-3 py-1.5 rounded-md text-xs font-bold transition shadow-sm" title="Tolak">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.approve', $seller->id) }}" method="POST" onsubmit="confirmAction(event, this, 'Setujui pendaftaran ini?', 'question', '#102C54', 'Ya, Setujui')">
                                                    @csrf
                                                    <button type="submit" class="flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-md text-xs font-bold transition shadow-md" title="Setujui">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-300"></i>
                                            <p>Belum ada data penjual.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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
                    form.submit(); // Lanjutkan submit manual
                }
            });
        }
    </script>
</body>
</html>