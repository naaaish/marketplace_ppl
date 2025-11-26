<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun ADMIN
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@tokoku.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // 2. Buat Akun PEMBELI (User Biasa)
        $buyer = User::create([
            'name' => 'Budi Pembeli',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
            'email_verified_at' => now(),
        ]);

        // 3. Buat Akun PENJUAL (Yang Sudah Aktif)
        $sellerUser = User::create([
            'name' => 'Siti Penjual',
            'email' => 'siti@toko.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'email_verified_at' => now(),
        ]);

        // Buat Data Toko untuk Siti
        $seller = Seller::create([
            'user_id' => $sellerUser->id,
            'store_name' => 'Toko Berkah Siti',
            'store_description' => 'Menjual aneka kebutuhan pokok.',
            'pic_name' => 'Siti Aminah',
            'pic_phone' => '081234567890',
            'pic_email' => 'siti@toko.com',
            'pic_address' => 'Jl. Mawar No. 10',
            'rt' => '001',
            'rw' => '002',
            'village' => 'Sukamaju',
            'regency' => 'Jakarta Selatan',
            'province' => 'DKI Jakarta',
            'pic_ktp_number' => '3174000000000001',
            'status' => 'active',
            'verification_date' => now(),
        ]);
        
        // 4. Buat Akun PENJUAL (Yang Masih PENDING)
        $pendingUser = User::create([
            'name' => 'Joko Pending',
            'email' => 'joko@pending.com',
            'password' => null,
            'role' => 'seller',
        ]);

        Seller::create([
            'user_id' => $pendingUser->id,
            'store_name' => 'Toko Belum Jadi',
            'pic_name' => 'Joko Susilo',
            'pic_phone' => '08987654321',
            'pic_email' => 'joko@pending.com',
            'pic_address' => 'Jl. Melati No. 5',
            'rt' => '005',
            'rw' => '005',
            'village' => 'Sukamiskin',
            'regency' => 'Bandung',
            'province' => 'Jawa Barat',
            'pic_ktp_number' => '3274000000000002',
            'status' => 'pending',
        ]);

        // 5. BUAT PRODUK-PRODUK
        $products = [
            [
                'seller_id' => $seller->id,
                'name' => 'Kacamata Fashion Polarized',
                'description' => 'Kacamata fashion dengan lensa polarized UV protection',
                'category' => 'Aksesoris Fashion',
                'price' => 125000,
                'stock' => 50,
                'image' => '🕶️',
                'sold' => 250
            ],
            [
                'seller_id' => $seller->id,
                'name' => 'Jam Tangan Couple Premium',
                'description' => 'Jam tangan couple dengan desain elegan',
                'category' => 'Jam Tangan',
                'price' => 350000,
                'stock' => 30,
                'image' => '⌚',
                'sold' => 180
            ],
            [
                'seller_id' => $seller->id,
                'name' => 'Sepatu Sneakers Sport',
                'description' => 'Sepatu olahraga nyaman untuk aktivitas sehari-hari',
                'category' => 'Sepatu',
                'price' => 285000,
                'stock' => 40,
                'image' => '👟',
                'sold' => 420
            ],
            [
                'seller_id' => $seller->id,
                'name' => 'Tas Ransel Canvas Premium',
                'description' => 'Tas ransel canvas berkualitas tinggi',
                'category' => 'Tas Pria',
                'price' => 195000,
                'stock' => 25,
                'image' => '🎒',
                'sold' => 310
            ],
            [
                'seller_id' => $seller->id,
                'name' => 'Tas Wanita Kulit Sintetis',
                'description' => 'Tas wanita elegant dari kulit sintetis premium',
                'category' => 'Tas Wanita',
                'price' => 275000,
                'stock' => 20,
                'image' => '👜',
                'sold' => 165
            ],
            [
                'seller_id' => $seller->id,
                'name' => 'Serum Wajah Whitening',
                'description' => 'Serum wajah untuk mencerahkan kulit',
                'category' => 'Perawatan & Kecantikan',
                'price' => 145000,
                'stock' => 100,
                'image' => '💄',
                'sold' => 580
            ],
            [
                'seller_id' => $seller->id,
                'name' => 'Smartphone Android 5G',
                'description' => 'Smartphone 5G dengan performa tinggi',
                'category' => 'Handphone & Aksesoris',
                'price' => 2850000,
                'stock' => 15,
                'image' => '📱',
                'sold' => 95
            ],
            [
                'seller_id' => $seller->id,
                'name' => 'Susu UHT Kemasan 1L',
                'description' => 'Susu UHT segar dan bergizi',
                'category' => 'Minuman',
                'price' => 18000,
                'stock' => 200,
                'image' => '🥛',
                'sold' => 1250
            ],
            [
                'seller_id' => $seller->id,
                'name' => 'Snack Keripik Pedas',
                'description' => 'Keripik pedas renyah dan nikmat',
                'category' => 'Makanan',
                'price' => 25000,
                'stock' => 150,
                'image' => '🍟',
                'sold' => 890
            ],
            [
                'seller_id' => $seller->id,
                'name' => 'Set Peralatan Dapur',
                'description' => 'Set lengkap peralatan dapur berkualitas',
                'category' => 'Perlengkapan Rumah',
                'price' => 165000,
                'stock' => 35,
                'image' => '🍴',
                'sold' => 230
            ],
            [
                'seller_id' => $seller->id,
                'name' => 'Popok Bayi Premium',
                'description' => 'Popok bayi lembut dan anti bocor',
                'category' => 'Perlengkapan Bayi',
                'price' => 95000,
                'stock' => 80,
                'image' => '👶',
                'sold' => 650
            ],
            [
                'seller_id' => $seller->id,
                'name' => 'Helm Full Face SNI',
                'description' => 'Helm full face standar SNI untuk keamanan berkendara',
                'category' => 'Otomotif',
                'price' => 425000,
                'stock' => 20,
                'image' => '🏍️',
                'sold' => 280
            ],
        ];

        foreach ($products as $productData) {
            $product = Product::create($productData);

            // Buat beberapa review untuk setiap produk
            for ($i = 0; $i < rand(3, 8); $i++) {
                Review::create([
                    'product_id' => $product->id,
                    'user_id' => $buyer->id,
                    'rating' => rand(4, 5),
                    'comment' => 'Produk bagus sesuai deskripsi, pengiriman cepat!'
                ]);
            }
        }
    }
}