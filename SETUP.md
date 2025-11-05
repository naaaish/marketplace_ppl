# 🚀 Panduan Setup Project: Marketplace PPL

Panduan lengkap setup project **marketplace_ppl** untuk tim developer.
Proyek ini di-host menggunakan **Laravel Herd**.

## 📋 Prasyarat

Pastikan perangkat lunak berikut sudah terpasang di komputer Anda:

### Wajib Ada:
* ✅ **Laravel Herd** (Otomatis mengurus Nginx, PHP 8.2+, dan Composer)
* ✅ **Git** ([Download](https://git-scm.com/))
* ✅ **Node.js 18+** ([Download](https://nodejs.org/))
* ✅ **Visual Studio Code** (Recommended editor)

### Check Prasyarat (via Terminal):
```bash
# Cek versi Git
git --version

# Cek versi Node & NPM
node --version
npm --version

# Cek versi PHP (dikelola oleh Herd)
php --version

# Cek versi Composer (dikelola oleh Herd)
composer --version
```

---

## 🔥 Quick Setup (5 Menit)

### STEP 1: Clone Project
Buka terminal Anda dan masuk ke folder `Herd` Anda.

```bash
# Masuk ke direktori Herd Anda (sesuaikan path jika perlu)
cd C:\Users\Naila\Herd

# Clone repository dari GitHub
git clone https://github.com/naaaish/marketplace_ppl.git

# Masuk ke folder proyek
cd marketplace_ppl
```

### STEP 2: Install Dependencies
Install semua package PHP (Composer) dan JavaScript (NPM).

```bash
composer install
npm install
```

### STEP 3: Environment Setup
Konfigurasi file `.env` yang berisi semua rahasia aplikasi.

```bash
# Salin file .env.example menjadi .env
copy .env.example .env

# Generate application key baru
php artisan key:generate
```

### STEP 4: Database Setup (via Herd)

Ini adalah bagian termudah dengan Herd!

1.  Pastikan aplikasi **Laravel Herd** Anda sedang berjalan.
2.  Herd **secara otomatis** membuat database baru untuk setiap proyek di folder `Herd` Anda. Database bernama `marketplace_ppl` seharusnya sudah dibuatkan untuk Anda.
3.  Buka file `.env` Anda dan pastikan konfigurasinya adalah default Herd:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marketplace_ppl
DB_USERNAME=root
DB_PASSWORD=
```
*(Pastikan `DB_DATABASE` sama dengan nama folder Anda).*

### STEP 5: Run Migrations
Jalankan migrasi untuk membuat struktur tabel di database (termasuk tabel `users` dari Breeze).

```bash
php artisan migrate
```
*(Jika Anda ingin menambahkan data dummy, jalankan: `php artisan migrate --seed`)*

### STEP 6: Storage Link
Buat symlink agar file di `storage/app/public` bisa diakses dari `public/storage`.

```bash
php artisan storage:link
```

---

## 💻 Menjalankan Proyek

### 1. Akses Website (PENTING: Gunakan Herd)
Dengan Herd, Anda **TIDAK PERLU** menjalankan `php artisan serve`.

Cukup buka browser Anda dan kunjungi URL yang sudah diamankan oleh Herd:
**http://marketplace_ppl.test**

### 2. Menjalankan Aset Frontend (CSS/JS)
Untuk meng-compile file CSS dan JavaScript (dibuat oleh Breeze), buka terminal **TERPISAH** dan jalankan:

```bash
npm run dev
```
Biarkan terminal ini tetap berjalan selama Anda melakukan *coding* frontend.

---

## ✅ Verification Checklist

Pastikan semua berfungsi:

* [ ] Aplikasi Herd berjalan.
* [ ] Website bisa diakses di **http://marketplace_ppl.test**.
* [ ] Halaman menampilkan link **"Log in"** dan **"Register"** (dari Breeze).
* [ ] Anda bisa **Register** (mendaftar) akun baru.
* [ ] Anda bisa **Log in** (masuk) dengan akun yang baru dibuat.
* [ ] Anda bisa melihat halaman *Dashboard* setelah login.

---

## 🛠️ Development Workflow

### Daily Development (Git Flow):
```bash
# 1. Selalu update dari branch 'main'
git pull origin main

# 2. Buat branch baru untuk fitur Anda
git checkout -b feature/nama-fitur-baru

# 3. (Mulai coding...)

# 4. Setelah selesai, commit perubahan Anda
git add .
git commit -m "Add: Menambahkan fitur X"
# (Gunakan: 'Add:', 'Fix:', 'Update:', 'Remove:')

# 5. Push branch Anda ke GitHub
git push origin feature/nama-fitur-baru

# 6. Buka GitHub dan buat "Pull Request"
```

### Server & Assets:
* **Backend Server**: Dijalankan otomatis oleh Herd. Akses di `http://marketplace_ppl.test`.
* **Frontend Assets**: Jalankan `npm run dev` di terminal terpisah.

---

## 🚨 Troubleshooting

### ❌ Error: "Class '...' not found" atau "View [...] not found"
Bersihkan cache Laravel.
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### ❌ Error: Database connection refused
1.  Pastikan aplikasi **Laravel Herd** Anda berjalan.
2.  Cek file `.env` Anda, pastikan `DB_USERNAME=root` dan `DB_PASSWORD=` (kosong).

### ❌ Error: "404 Not Found" di Halaman
```bash
php artisan route:clear
```

### ❌ Error: npm install failed
```bash
# Hapus cache npm
npm cache clean --force

# Hapus node_modules dan package-lock.json
rm -rf node_modules
rm package-lock.json

# Coba install lagi
npm install
```

---

## 📂 Project Structure (Important Files)

```
marketplace_ppl/
├── app/
│ ├── Http/Controllers/ # Logika untuk request (Controller)
│ ├── Models/           # Representasi tabel database (Model)
│ └── ...
├── database/
│ ├── migrations/       # Struktur tabel database
│ └── seeders/          # Data dummy (sample)
├── resources/
│ ├── views/            # Halaman HTML (File .blade.php)
│ ├── js/               # File JavaScript
│ └── css/              # File CSS
├── routes/
│ └── web.php           # Daftar semua URL/Rute website
├── .env                  # File konfigurasi (DB, API Keys)
└── README.md             # Info umum proyek (ini file yang lain)
```

---

## 🎨 Code Standards

### Naming Conventions:
* **Controller**: `ProductController.php` (PascalCase, singular)
* **Model**: `Product.php` (PascalCase, singular)
* **Migration**: `2025_01_01_000000_create_products_table.php`
* **Route Name**: `products.index` (snake_case, plural)
* **View**: `products/index.blade.php` (folder plural)

### Git Commit Messages:
* **`Add:`** Menambah fitur baru atau file baru.
* **`Fix:`** Memperbaiki bug.
* **`Update:`** Modifikasi kecil pada fitur yang ada.
* **`Remove:`** Menghapus kode atau file.
* **`Refactor:`** Merapikan kode tanpa mengubah fungsionalitas.

---

## 📞 Help & Support

### Resources:
* 📖 **Laravel Docs**: https://laravel.com/docs
* 📖 **Breeze Docs**: https://laravel.com/docs/starter-kits#laravel-breeze
* 💬 **Project Issues**: https://github.com/naaaish/marketplace_ppl/issues