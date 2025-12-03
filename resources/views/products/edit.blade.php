<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
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
            margin-bottom: 15px;
        }

        .btn-back:hover {
            background: #e0e0e0;
        }

        .header {
            background: white;
            padding: 20px 30px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin-bottom: 5px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .form-card {
            background: white;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-label.required::after {
            content: " *";
            color: #ff4d4f;
        }

        .form-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: #1890ff;
            box-shadow: 0 0 0 2px rgba(24, 144, 255, 0.1);
        }

        .form-textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            font-size: 14px;
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #1890ff;
            box-shadow: 0 0 0 2px rgba(24, 144, 255, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            font-size: 14px;
            background: white;
            cursor: pointer;
        }

        .form-select:focus {
            outline: none;
            border-color: #1890ff;
        }

        .photo-upload-area {
            border: 2px dashed #d9d9d9;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            background: #fafafa;
            cursor: pointer;
            transition: all 0.3s;
        }

        .photo-upload-area:hover {
            border-color: #1890ff;
            background: #f0f8ff;
        }

        .photo-upload-area input[type="file"] {
            display: none;
        }

        .current-photo {
            max-width: 300px;
            max-height: 300px;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .upload-icon {
            font-size: 48px;
            color: #d9d9d9;
            margin-bottom: 10px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .variations-container {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .variation-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: center;
        }

        .variation-item input {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-remove {
            padding: 8px 12px;
            background: #ff4d4f;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-remove:hover {
            background: #ff7875;
        }

        .btn-add-variation {
            padding: 8px 16px;
            background: #f0f0f0;
            color: #333;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
        }

        .btn-add-variation:hover {
            background: #e0e0e0;
            border-color: #1890ff;
            color: #1890ff;
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .btn-primary {
            padding: 12px 30px;
            background: #1890ff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #40a9ff;
        }

        .btn-secondary {
            padding: 12px 30px;
            background: white;
            color: #333;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            border-color: #1890ff;
            color: #1890ff;
        }

        .help-text {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        .radio-group {
            display: flex;
            gap: 20px;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .radio-item input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .radio-item label {
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="{{ route('products.index') }}" class="btn-back">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="transform: rotate(180deg);">
                <path d="M6 12l4-4-4-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Kembali ke Daftar Produk
        </a>

        <div class="header">
            <h1>Edit Produk</h1>
            <p>Perbarui informasi produk Anda</p>
        </div>

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Foto Produk -->
            <div class="form-card">
                <div class="section-title">Foto Produk</div>
                
                <div class="form-group">
                    <label class="form-label">Foto Utama Produk</label>
                    
                    @if ($product->photo)
                        <div style="margin-bottom: 15px;">
                            <img src="{{ asset('storage/' . $product->photo) }}" alt="Current Photo" class="current-photo">
                            <p class="help-text">Foto saat ini. Upload foto baru untuk menggantinya.</p>
                        </div>
                    @endif

                        <label for="photo" class="photo-upload-area">
                        <input type="file" id="photo" name="photo" accept="image/*">
                        <div class="upload-icon">📷</div>
                        <div style="color: #666; font-size: 14px;">
                            <strong>Klik untuk upload foto baru</strong>
                            <p class="help-text" style="margin-top: 8px;">Format: JPG, PNG, maksimal 2MB</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Informasi Dasar -->
            <div class="form-card">
                <div class="section-title">Informasi Dasar</div>

                <div class="form-group">
                    <label class="form-label required">Nama Produk</label>
                    <input type="text" name="name" class="form-input" value="{{ $product->name }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label required">Kategori</label>
                    <select name="category" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="elektronik" {{ $product->category == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="fashion" {{ $product->category == 'fashion' ? 'selected' : '' }}>Fashion</option>
                        <option value="makanan" {{ $product->category == 'makanan' ? 'selected' : '' }}>Makanan & Minuman</option>
                        <option value="kesehatan" {{ $product->category == 'kesehatan' ? 'selected' : '' }}>Kesehatan & Kecantikan</option>
                        <option value="rumah-tangga" {{ $product->category == 'rumah-tangga' ? 'selected' : '' }}>Rumah Tangga</option>
                        <option value="olahraga" {{ $product->category == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                        <option value="hobi" {{ $product->category == 'hobi' ? 'selected' : '' }}>Hobi & Koleksi</option>
                        <option value="lainnya" {{ $product->category == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label required">Harga Satuan (Rp)</label>
                        <input type="number" name="price" class="form-input" value="{{ $product->price }}" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label required">Berat (gram)</label>
                        <input type="number" name="weight" class="form-input" value="{{ $product->weight }}" min="0" required>
                        <p class="help-text">Berat untuk perhitungan ongkir</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label required">Deskripsi Produk</label>
                    <textarea name="description" class="form-textarea" required>{{ $product->description }}</textarea>
                    <p class="help-text">Jelaskan detail produk, spesifikasi, dan keunggulannya</p>
                </div>
            </div>

            <!-- Variasi Produk -->
            <div class="form-card">
                <div class="section-title">Variasi Produk</div>
                
                <div class="form-group">
                    <label class="form-label">Variasi (opsional)</label>
                    <p class="help-text" style="margin-bottom: 15px;">Contoh: Nama: "Ukuran S", Harga Tambahan: 5000, Stok: 10</p>
                    
                    <div class="variations-container" id="variationsContainer">
                        @if($product->variants && $product->variants->count() > 0)
                            @foreach($product->variants as $variant)
                                <div class="variation-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 10px; margin-bottom: 10px;">
                                    <input type="text" name="variant_names[]" placeholder="Nama variasi (cth: Ukuran S)" value="{{ $variant->name }}" style="padding: 8px 12px; border: 1px solid #d9d9d9; border-radius: 4px;">
                                    <input type="number" name="variant_prices[]" placeholder="Harga tambahan" value="{{ $variant->price_adjustment ?? 0 }}" style="padding: 8px 12px; border: 1px solid #d9d9d9; border-radius: 4px;">
                                    <input type="number" name="variant_stocks[]" placeholder="Stok" value="{{ $variant->stock ?? 0 }}" style="padding: 8px 12px; border: 1px solid #d9d9d9; border-radius: 4px;">
                                    <input type="hidden" name="variant_ids[]" value="{{ $variant->id }}">
                                    <button type="button" class="btn-remove" onclick="removeVariation(this)">✕</button>
                                </div>
                            @endforeach
                        @else
                            <div class="variation-item" style="display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 10px; margin-bottom: 10px;">
                                <input type="text" name="variant_names[]" placeholder="Nama variasi (cth: Ukuran S)" style="padding: 8px 12px; border: 1px solid #d9d9d9; border-radius: 4px;">
                                <input type="number" name="variant_prices[]" placeholder="Harga tambahan" value="0" style="padding: 8px 12px; border: 1px solid #d9d9d9; border-radius: 4px;">
                                <input type="number" name="variant_stocks[]" placeholder="Stok" value="0" style="padding: 8px 12px; border: 1px solid #d9d9d9; border-radius: 4px;">
                                <button type="button" class="btn-remove" onclick="removeVariation(this)">✕</button>
                            </div>
                        @endif
                    </div>
                    
                    <button type="button" class="btn-add-variation" onclick="addVariation()">+ Tambah Variasi</button>
                </div>
            </div>

            <!-- Stok & SKU -->
            <div class="form-card">
                <div class="section-title">Stok & SKU</div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label required">Stok Produk</label>
                        <input type="number" name="stock" class="form-input" value="{{ $product->stock }}" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">SKU (Stock Keeping Unit)</label>
                        <input type="text" name="sku" class="form-input" value="{{ $product->sku }}" placeholder="Contoh: PROD-001">
                        <p class="help-text">Kode unik untuk identifikasi produk</p>
                    </div>
                </div>
            </div>

            <!-- Status Produk -->
            <div class="form-card">
                <div class="section-title">Status Produk</div>

                <div class="form-group">
                    <label class="form-label required">Status</label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input type="radio" id="status_active" name="status" value="active" {{ $product->status == 'active' ? 'checked' : '' }} required>
                            <label for="status_active">Aktif (Ditampilkan)</label>
                        </div>
                        <div class="radio-item">
                            <input type="radio" id="status_inactive" name="status" value="inactive" {{ $product->status == 'inactive' ? 'checked' : '' }} required>
                            <label for="status_inactive">Nonaktif (Disembunyikan)</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rating (Read Only) -->
            <div class="form-card">
                <div class="section-title">Rating Produk</div>
                <div style="background: #f9f9f9; padding: 15px; border-radius: 4px; color: #666;">
                    <p style="margin-bottom: 5px;">
                        <strong style="color: #f59e0b; font-size: 24px;">{{ number_format($product->rating, 2) }}</strong>
                        <span style="color: #999;">/ 5.0</span>
                    </p>
                    <p style="font-size: 13px;">
                        {{ $product->rating_count }} rating dari pelanggan
                    </p>
                    <p class="help-text" style="margin-top: 8px;">
                        ℹ️ Rating tidak dapat diubah secara manual dan hanya diperbarui berdasarkan ulasan pelanggan
                    </p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('products.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        // Preview foto yang akan diupload
        document.getElementById('photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const currentPhotoDiv = document.querySelector('.current-photo')?.parentElement;
                    if (currentPhotoDiv) {
                        currentPhotoDiv.querySelector('img').src = event.target.result;
                    } else {
                        const photoArea = document.querySelector('.photo-upload-area');
                        const preview = document.createElement('div');
                        preview.style.marginBottom = '15px';
                        preview.innerHTML = `<img src="${event.target.result}" alt="Preview" class="current-photo"><p class="help-text">Preview foto baru</p>`;
                        photoArea.parentElement.insertBefore(preview, photoArea);
                    }
                }
                reader.readAsDataURL(file);
            }
        });

        // Fungsi untuk menambah variasi
        function addVariation() {
            const container = document.getElementById('variationsContainer');
            const newVariation = document.createElement('div');
            newVariation.className = 'variation-item';
            newVariation.style.cssText = 'display: grid; grid-template-columns: 2fr 1fr 1fr auto; gap: 10px; margin-bottom: 10px;';
            newVariation.innerHTML = `
                <input type="text" name="variant_names[]" placeholder="Nama variasi (cth: Ukuran S)" style="padding: 8px 12px; border: 1px solid #d9d9d9; border-radius: 4px;">
                <input type="number" name="variant_prices[]" placeholder="Harga tambahan" value="0" style="padding: 8px 12px; border: 1px solid #d9d9d9; border-radius: 4px;">
                <input type="number" name="variant_stocks[]" placeholder="Stok" value="0" style="padding: 8px 12px; border: 1px solid #d9d9d9; border-radius: 4px;">
                <button type="button" class="btn-remove" onclick="removeVariation(this)">✕</button>
            `;
            container.appendChild(newVariation);
        }

        // Fungsi untuk menghapus variasi
        function removeVariation(button) {
            const container = document.getElementById('variationsContainer');
            if (container.children.length > 1) {
                button.parentElement.remove();
            } else {
                alert('Minimal harus ada satu field variasi');
            }
        }

        // Format input harga dengan pemisah ribuan
        document.querySelector('input[name="price"]').addEventListener('input', function(e) {
            // Hapus karakter non-digit
            let value = this.value.replace(/\D/g, '');
            this.value = value;
        });
    </script>
</body>
</html>