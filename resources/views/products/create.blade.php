<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <style>
        /* Custom CSS seperti sebelumnya */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }
        
        /* Custom Scrollbar untuk Sidebar */
        .sidebar-scroll::-webkit-scrollbar { width: 6px; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background-color: rgba(255,255,255,0.2); border-radius: 3px; }
        
        /* Styling Form */
        .form-input { 
            width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; 
            border-radius: 6px; transition: all 0.3s; 
        }
        .form-input:focus { border-color: #102C54; outline: none; ring: 2px solid #102C54; }
        
        .upload-box:hover { border-color: #102C54; background-color: #eff6ff; }
        
        .toggle-switch { width: 44px; height: 22px; background: #cbd5e1; border-radius: 99px; position: relative; cursor: pointer; transition: 0.3s; }
        .toggle-switch.active { background: #22c55e; }
        .toggle-switch::after { content: ''; position: absolute; top: 2px; left: 2px; width: 18px; height: 18px; background: white; border-radius: 50%; transition: 0.3s; }
        .toggle-switch.active::after { left: 24px; }
    </style>
</head>
<body class="bg-gray-100 font-sans">

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
                <a href="{{ route('laporan.stok') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-box w-5"></i> Laporan Stok
                </a>
                <a href="{{ route('laporan.rating') }}" class="flex items-center gap-3 px-4 py-3 text-blue-100 hover:bg-blue-900 hover:text-white rounded-lg transition">
                    <i class="fas fa-star w-5"></i> Laporan Rating
                </a>
                <a href="{{ route('tambah.produk') }}" class="flex items-center gap-3 px-4 py-3 bg-white text-[#102C54] rounded-lg font-semibold shadow-md transition">
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
            
            <header class="bg-white shadow-sm p-6 sticky top-0 z-10 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">Tambah Produk</h2>
                <a href="{{ route('seller.dashboard') }}" class="text-gray-500 hover:text-[#102C54] text-sm font-medium">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </header>

            <main class="p-8">
                
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                        <p class="font-bold">Oops! Ada kesalahan:</p>
                        <ul class="list-disc ml-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="max-w-4xl mx-auto space-y-8">
                    @csrf

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Foto Produk</h3>
                        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg text-sm mb-4 flex items-start gap-2">
                            <i class="fas fa-exclamation-triangle mt-1"></i>
                            <span>Hindari menjual produk palsu atau melanggar hak cipta agar produk tidak dihapus.</span>
                        </div>

                        <div class="upload-box border-2 border-dashed border-gray-300 rounded-lg p-8 flex flex-col items-center justify-center cursor-pointer relative bg-gray-50 transition min-h-[200px]" onclick="document.getElementById('photoInput').click()">
                            <img id="imagePreview" class="hidden max-h-48 rounded-lg shadow-md object-contain">
                            <div id="uploadPlaceholder" class="text-center">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                <p class="text-sm font-medium text-gray-600">Klik untuk upload foto</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG (Max 2MB)</p>
                            </div>
                            <input type="file" id="photoInput" name="photo" class="hidden" accept="image/*" required onchange="previewImage(this)">
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Produk</h3>
                        
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="Contoh: Sepatu Sneakers Pria Kanvas Hitam" required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                                    <select name="category" class="form-input bg-white" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Fashion">Fashion</option>
                                        <option value="Elektronik">Elektronik</option>
                                        <option value="Makanan">Makanan & Minuman</option>
                                        <option value="Kecantikan">Kecantikan</option>
                                        <option value="Rumah Tangga">Rumah Tangga</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Harga (Rp) <span class="text-red-500">*</span></label>
                                    <input type="number" name="price" value="{{ old('price') }}" class="form-input" placeholder="0" min="0" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Stok Awal <span class="text-red-500">*</span></label>
                                    <input type="number" name="stock" value="{{ old('stock') }}" class="form-input" placeholder="0" min="0" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Berat (Gram) <span class="text-red-500">*</span></label>
                                    <input type="number" name="weight" value="{{ old('weight') }}" class="form-input" placeholder="Contoh: 500" min="0" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                                <textarea name="description" rows="4" class="form-input" placeholder="Jelaskan detail produkmu...">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 flex justify-between items-center">
                            <span>Variasi Produk</span>
                            <span class="text-xs font-normal text-gray-500">(Opsional)</span>
                        </h3>
                        
                        <div id="variants-container" class="space-y-4">
                            </div>
                        
                        <button type="button" onclick="addVariant()" class="mt-4 px-4 py-2 bg-gray-100 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-200 transition font-medium">
                            <i class="fas fa-plus mr-1"></i> Tambah Variasi
                        </button>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
                        
                        <div class="flex items-center gap-3">
                            <div class="toggle-switch active" id="statusToggle" onclick="toggleStatus()"></div>
                            <div>
                                <p class="text-sm font-bold text-gray-800" id="statusText">Aktif</p>
                                <p class="text-xs text-gray-500">Produk akan tampil di katalog.</p>
                            </div>
                            <input type="hidden" name="status" id="statusInput" value="active">
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('seller.dashboard') }}" class="px-6 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-medium transition">Batal</a>
                            <button type="submit" class="px-8 py-2 bg-[#102C54] text-white rounded-lg hover:bg-blue-900 font-bold shadow-lg transform hover:-translate-y-0.5 transition">Simpan Produk</button>
                        </div>
                    </div>

                </form>
            </main>
        </div>
    </div>

    <script>
        // Preview Image
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('uploadPlaceholder');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Toggle Status
        function toggleStatus() {
            const toggle = document.getElementById('statusToggle');
            const text = document.getElementById('statusText');
            const input = document.getElementById('statusInput');
            toggle.classList.toggle('active');
            if (toggle.classList.contains('active')) {
                text.textContent = 'Aktif';
                input.value = 'active';
                toggle.style.background = '#22c55e';
            } else {
                text.textContent = 'Nonaktif';
                input.value = 'inactive';
                toggle.style.background = '#cbd5e1';
            }
        }

        // Dynamic Variants
        let variantCount = 0;
        function addVariant() {
            const container = document.getElementById('variants-container');
            const html = `
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end bg-gray-50 p-4 rounded-lg border border-gray-200" id="variant-${variantCount}">
                    <div class="md:col-span-4">
                        <label class="text-xs text-gray-500 mb-1 block">Nama Variasi</label>
                        <input type="text" name="variants[${variantCount}][name]" placeholder="Merah - XL" class="form-input text-sm">
                    </div>
                    <div class="md:col-span-3">
                        <label class="text-xs text-gray-500 mb-1 block">Harga</label>
                        <input type="number" name="variants[${variantCount}][price]" placeholder="0" class="form-input text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs text-gray-500 mb-1 block">Stok</label>
                        <input type="number" name="variants[${variantCount}][stock]" placeholder="0" class="form-input text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs text-gray-500 mb-1 block">SKU</label>
                        <input type="text" name="variants[${variantCount}][sku]" placeholder="Kode" class="form-input text-sm">
                    </div>
                    <div class="md:col-span-1 text-right">
                        <button type="button" onclick="document.getElementById('variant-${variantCount}').remove()" class="text-red-500 hover:text-red-700 bg-white p-2 rounded border border-red-200 hover:bg-red-50">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
            variantCount++;
        }

        // --- SWEETALERT POPUP LOGIC ---
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#102C54',
                confirmButtonText: 'Oke, Lihat Daftar'
            }).then((result) => {
                // Redirect setelah klik Oke (Optional, kalau mau balik ke dashboard)
                if (result.isConfirmed) {
                    window.location.href = "{{ route('seller.dashboard') }}";
                }
            });
        @endif
    </script>
</body>
</html>