<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #333;
        }

        .subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .warning-box {
            background: #fff9e6;
            border: 1px solid #ffe066;
            border-radius: 6px;
            padding: 12px 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: start;
            gap: 10px;
        }

        .warning-box svg {
            flex-shrink: 0;
            margin-top: 2px;
        }

        .warning-text {
            font-size: 13px;
            color: #666;
        }

        .warning-text a {
            color: #52c41a;
            text-decoration: none;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #333;
            font-size: 14px;
        }

        .form-label.required::after {
            content: " *";
            color: #ff4d4f;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            background: #f0f0f0;
            border-radius: 4px;
            font-size: 12px;
            margin-left: 8px;
            font-weight: normal;
        }

        .badge.beta {
            background: #e6f7ff;
            color: #1890ff;
        }

        .helper-text {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #40a9ff;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .upload-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
            margin-top: 10px;
        }

        .upload-box {
            border: 2px dashed #d9d9d9;
            border-radius: 6px;
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
            min-height: 200px;
        }

        .upload-box:hover {
            border-color: #40a9ff;
            background: #f0f7ff;
        }

        .upload-box svg {
            margin-bottom: 8px;
        }

        .upload-box span {
            font-size: 14px;
            color: #999;
        }

        .upload-box input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            top: 0;
            left: 0;
        }

        .file-list {
            margin-top: 15px;
            padding: 15px;
            background: #fafafa;
            border-radius: 4px;
            max-height: 300px;
            overflow-y: auto;
        }

        .file-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            background: white;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            margin-bottom: 8px;
        }

        .file-item:last-child {
            margin-bottom: 0;
        }

        .file-icon {
            width: 32px;
            height: 32px;
            background: #e6f7ff;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .file-name {
            flex: 1;
            font-size: 13px;
            color: #333;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .file-size {
            font-size: 12px;
            color: #999;
            flex-shrink: 0;
        }

        .upload-box.main {
            grid-column: span 1;
            grid-row: span 1;
        }

        .upload-box.main span {
            font-size: 14px;
        }

        .upload-note {
            font-size: 12px;
            color: #666;
            margin-top: 10px;
            line-height: 1.6;
        }

        .video-upload {
            margin-top: 20px;
        }

        .video-box {
            border: 2px dashed #d9d9d9;
            border-radius: 6px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }

        .video-box:hover {
            border-color: #40a9ff;
            background: #f0f7ff;
        }

        .video-box input[type="file"] {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            top: 0;
            left: 0;
        }

        .toggle-switch {
            position: relative;
            width: 44px;
            height: 22px;
            background: #00000040;
            border-radius: 22px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .toggle-switch.active {
            background: #52c41a;
        }

        .toggle-switch::after {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            background: white;
            border-radius: 50%;
            top: 2px;
            left: 2px;
            transition: left 0.3s;
        }

        .toggle-switch.active::after {
            left: 24px;
        }

        .status-row {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #f0f0f0;
        }

        .btn {
            padding: 10px 30px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid #d9d9d9;
            background: white;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #1890ff;
            border-color: #1890ff;
            color: white;
        }

        .btn-primary:hover {
            background: #40a9ff;
        }

        .btn-secondary {
            background: white;
            border-color: #d9d9d9;
            color: #333;
        }

        .btn-secondary:hover {
            border-color: #40a9ff;
            color: #40a9ff;
        }

        .error-message {
            background: #fff2f0;
            border: 1px solid #ffccc7;
            color: #cf1322;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .variants-section {
            margin-top: 20px;
        }

        .variant-item {
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 10px;
            background: #fafafa;
        }

        .variant-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 10px;
            align-items: end;
        }

        .btn-add-variant {
            margin-top: 10px;
            padding: 8px 16px;
            background: #f0f0f0;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-add-variant:hover {
            background: #e6e6e6;
        }

        .btn-remove {
            padding: 8px 12px;
            background: #fff2f0;
            border: 1px solid #ffccc7;
            color: #cf1322;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #f0f0f0;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
        }

        .btn-back:hover {
            background: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div style="margin-bottom: 15px;">
            <a href="{{ route('dashboard') }}" class="btn-back">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="transform: rotate(180deg);">
                    <path d="M6 12l4-4-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
        
        <h1>Tambah Produk</h1>
        <p class="subtitle">Isi data produk (nama, harga, berat, deskripsi).</p>

        @if ($errors->any())
            <div class="error-message">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Upload Produk Section -->
            <div class="section">
                <h2 class="section-title">Upload Produk</h2>
                
                <div class="warning-box">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <circle cx="8" cy="8" r="7" stroke="#faad14" stroke-width="2"/>
                        <path d="M8 4v5M8 11v1" stroke="#faad14" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    <div class="warning-text">
                        Hindari berjualan produk palsu/melanggar Hak Kekayaan Intelektual, supaya produkmu tidak dihapus.
                    </div>
                </div>

                <!-- Foto Produk -->
                <div class="form-group">
                    <label class="form-label required">Foto Produk <span class="badge">Wajib</span></label>
                    <div class="upload-note">Format gambar .jpg .jpeg .png dan ukuran minimum 300 x 300px (Untuk gambar optimal gunakan ukuran minimum 700 x 700 px).</div>
                    
                    <div class="upload-grid">
                        <div class="upload-box main" id="uploadBox" style="min-height: 150px; padding: 20px;">
                            <img id="imagePreview" style="display: none; max-width: 120px; max-height: 120px; object-fit: cover; border-radius: 8px;">
                            <div id="uploadPlaceholder" style="display: flex; flex-direction: column; align-items: center;">
                                <svg width="48" height="48" viewBox="0 0 64 64" fill="#999">
                                    <path d="M32 20l-12 12h8v12h8v-12h8l-12-12zm-16 28h32v4H16v-4z"/>
                                </svg>
                                <span style="margin-top: 10px; font-size: 13px;">Klik atau seret foto produk di sini</span>
                                <span style="font-size: 11px; color: #bbb; margin-top: 5px;">Format: JPG, JPEG, PNG (Max 2MB)</span>
                            </div>
                            <input type="file" id="photoInput" name="photo" accept="image/jpeg,image/jpg,image/png" required onchange="previewImage(this)">
                        </div>
                    </div>
                    
                    <div class="upload-note" style="margin-top: 15px;">
                        Pilih foto produk yang menarik untuk meningkatkan minat pembeli.
                    </div>
                </div>

                {{-- <!-- Video Produk -->
                <div class="video-upload">
                    <label class="form-label">Video Produk <span class="badge beta">BETA</span></label>
                    <div class="upload-note">Format video .mp4 dan .mov. Disarankan durasi maks. 120 detik dan ukuran maks. 20MB.</div>
                    
                    <div class="video-box">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="#999">
                            <rect x="8" y="12" width="32" height="24" rx="2" stroke="#999" stroke-width="2" fill="none"/>
                            <path d="M20 18v12l10-6-10-6z" fill="#999"/>
                        </svg>
                        <div style="margin-top: 10px; color: #999;">Video</div>
                        <input type="file" name="video" accept="video/mp4,video/mov">
                    </div>
                    
                    <div class="upload-note" style="margin-top: 10px;">
                        Pastikan videomu sesuai dengan 
                    </div>
                </div> --}}
            </div>

            <!-- Informasi Produk Section -->
            <div class="section">
                <h2 class="section-title">Informasi Produk</h2>
                
                <div class="form-group">
                    <label class="form-label required" for="name">Nama Produk</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" 
                           placeholder="Contoh: Sepatu Pria Hitam + Toko/store (Merek) + Kanvas Hitam (Keterangan)"
                           maxlength="70" required>
                    <div class="helper-text">Tips: Jenis Produk + Merek Produk + Keterangan Tambahan</div>
                    <div class="helper-text" style="text-align: right;">0/70</div>
                </div>

                <div class="form-group">
                    <label class="form-label required" for="category">Kategori</label>
                    <select id="category" name="category" required>
                        <option value="">Pilih Kategori</option>
                        <option value="fashion">Fashion</option>
                        <option value="elektronik">Elektronik</option>
                        <option value="makanan">Makanan & Minuman</option>
                        <option value="kecantikan">Kecantikan</option>
                        <option value="rumah">Rumah Tangga</option>
                        <option value="olahraga">Olahraga</option>
                        <option value="olahraga">Alat Tulis</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label required" for="price">Harga Satuan</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" 
                           placeholder="Masukkan harga" min="0" step="0.01" required>
                </div>

                <div class="form-group">
                    <label class="form-label required" for="weight">Berat</label>
                    <input type="number" id="weight" name="weight" value="{{ old('weight') }}" 
                           placeholder="Masukkan berat dalam gram" min="1" required>
                    <div class="helper-text">Berat produk dalam gram (contoh: 500 untuk 500 gram)</div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Deskripsi</label>
                    <textarea id="description" name="description" placeholder="Tuliskan deskripsi produk secara detail...">{{ old('description') }}</textarea>
                </div>
            </div>

            <!-- Variasi Produk (Opsional) -->
            <div class="section">
                <h2 class="section-title">Variasi Produk <span style="font-size: 14px; color: #999; font-weight: normal;">(Opsional)</span></h2>
                
                <div id="variants-container" class="variants-section">
                    <!-- Variasi akan ditambahkan di sini -->
                </div>
                
                <button type="button" class="btn-add-variant" onclick="addVariant()">+ Tambah Variasi</button>
            </div>

            <!-- Pengelolaan Produk Section -->
            <div class="section">
                <h2 class="section-title">Pengelolaan Produk</h2>
                
                <div class="form-group">
                    <label class="form-label">Status Produk</label>
                    <div class="status-row">
                        <div class="toggle-switch active" id="statusToggle" onclick="toggleStatus()"></div>
                        <span id="statusText">Nonaktif</span>
                    </div>
                    <div class="helper-text">Jika status aktif, produkmu dapat dicari oleh calon pembeli.</div>
                    <input type="hidden" name="status" id="statusInput" value="active">
                </div>

                <div class="form-group">
                    <label class="form-label required" for="stock">Stok Produk</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" 
                           placeholder="Masukkan jumlah stok" min="0" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="sku">SKU (Stock Keeping Unit)</label>
                    <input type="text" id="sku" name="sku" value="{{ old('sku') }}" 
                           placeholder="Masukkan SKU">
                    <div class="helper-text">Gunakan kode unik SKU jika kamu ingin menandai produkmu.</div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="btn-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Simpan & Tambah Baru</button>
            </div>
        </form>
    </div>

    <script>
        let variantCount = 0;

        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('uploadPlaceholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                };
                
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
                placeholder.style.display = 'flex';
            }
        }

        function addVariant() {
            const container = document.getElementById('variants-container');
            const variantHtml = `
                <div class="variant-item" id="variant-${variantCount}">
                    <div class="variant-grid">
                        <div>
                            <label class="form-label" style="margin-bottom: 5px;">Nama Variasi</label>
                            <input type="text" name="variants[${variantCount}][name]" placeholder="Contoh: Merah - XL">
                        </div>
                        <div>
                            <label class="form-label" style="margin-bottom: 5px;">Harga</label>
                            <input type="number" name="variants[${variantCount}][price]" placeholder="Harga" min="0" step="0.01">
                        </div>
                        <div>
                            <label class="form-label" style="margin-bottom: 5px;">Stok</label>
                            <input type="number" name="variants[${variantCount}][stock]" placeholder="Stok" min="0" value="0">
                        </div>
                        <div>
                            <label class="form-label" style="margin-bottom: 5px;">SKU</label>
                            <input type="text" name="variants[${variantCount}][sku]" placeholder="SKU">
                        </div>
                        <div>
                            <label class="form-label" style="margin-bottom: 5px;">&nbsp;</label>
                            <button type="button" class="btn-remove" onclick="removeVariant(${variantCount})">Hapus</button>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', variantHtml);
            variantCount++;
        }

        function removeVariant(id) {
            document.getElementById(`variant-${id}`).remove();
        }

        function toggleStatus() {
            const toggle = document.getElementById('statusToggle');
            const text = document.getElementById('statusText');
            const input = document.getElementById('statusInput');
            
            toggle.classList.toggle('active');
            
            if (toggle.classList.contains('active')) {
                text.textContent = 'Aktif';
                input.value = 'active';
            } else {
                text.textContent = 'Nonaktif';
                input.value = 'inactive';
            }
        }

        // Initialize status text
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('statusToggle');
            const text = document.getElementById('statusText');
            if (toggle.classList.contains('active')) {
                text.textContent = 'Aktif';
            }
        });
    </script>
</body>
</html>
