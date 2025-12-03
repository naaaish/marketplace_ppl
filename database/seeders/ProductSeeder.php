<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Seller;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // hapus semua data produk yang ada
        // DB::table('products')->truncate();

        // Ambil semua seller yang ada
        $sellers = Seller::all();
        
        if ($sellers->isEmpty()) {
            $this->command->info('No sellers found. Please create sellers first.');
            return;
        }

        $products = [
            [
                'name' => 'Kemeja Batik Pria',
                'description' => 'Kemeja batik pria berkualitas tinggi dengan motif modern. Cocok untuk acara formal maupun kasual. Bahan katun halus, nyaman dipakai seharian.',
                'price' => 250000,
                'weight' => 300,
                'category' => 'Fashion',
                'stock' => 50,
                'sku' => 'BTK-001',
                'photo' => 'img/kemejabatik.png',
            ],
            [
                'name' => 'Tas Kulit Asli',
                'description' => 'Tas kulit asli 100% handmade dengan desain minimalis dan elegan. Dilengkapi dengan banyak slot kartu dan compartment untuk barang-barang penting.',
                'price' => 450000,
                'weight' => 500,
                'category' => 'Fashion',
                'stock' => 25,
                'sku' => 'TSK-002',
                'photo' => 'img/taskulit.png',
            ],
            [
                'name' => 'Kopi Arabika Gayo',
                'description' => 'Kopi arabika dari dataran tinggi Gayo, Aceh. Roasting medium dengan aroma fruity dan rasa yang smooth. Cocok untuk pecinta kopi specialty.',
                'price' => 75000,
                'weight' => 250,
                'category' => 'Makanan & Minuman',
                'stock' => 100,
                'sku' => 'KOP-003',
                'photo' => 'img/kopi.png',
            ],
            [
                'name' => 'Sepatu Sneakers Casual Pria',
                'description' => 'Sepatu sneakers casual dengan desain modern dan nyaman. Sol karet berkualitas tinggi, upper canvas breathable. Tersedia berbagai ukuran.',
                'price' => 320000,
                'weight' => 800,
                'category' => 'Fashion',
                'stock' => 40,
                'sku' => 'SPT-004',
                'photo' => 'img/sneakers.png',
            ],
            [
                'name' => 'Madu Hutan Asli',
                'description' => 'Madu hutan murni 100% dari hutan Kalimantan. Tidak ada campuran gula atau bahan kimia. Khasiat tinggi untuk kesehatan.',
                'price' => 125000,
                'weight' => 600,
                'category' => 'Makanan & Minuman',
                'stock' => 60,
                'sku' => 'MDU-005',
                'photo' => 'img/madu.png',
            ],
            [
                'name' => 'Dompet Kulit',
                'description' => 'Dompet kulit asli dengan teknologi RFID blocking untuk keamanan kartu kredit/debit. Slim design, muat banyak kartu.',
                'price' => 180000,
                'weight' => 150,
                'category' => 'Fashion',
                'stock' => 75,
                'sku' => 'DMP-006',
                'photo' => 'img/dompet.png',
            ],
            [
                'name' => 'Keripik Singkong',
                'description' => 'Keripik singkong renyah dengan rasa pedas manis yang unik. Cocok untuk camilan atau oleh-oleh khas daerah.',
                'price' => 35000,
                'weight' => 200,
                'category' => 'Makanan & Minuman',
                'stock' => 150,
                'sku' => 'KRP-007',
                'photo' => 'img/keripik.png',
            ],
            [
                'name' => 'Jam Tangan Pria Minimalist',
                'description' => 'Jam tangan pria dengan desain minimalis dan elegan. Tali kulit berkualitas, mesin quartz akurat. Cocok untuk daily wear.',
                'price' => 290000,
                'weight' => 200,
                'category' => 'Aksesoris',
                'stock' => 30,
                'sku' => 'JAM-008',
                'photo' => 'img/jamtangan.png',
            ],
            [
                'name' => 'Jaket Denim Pria Vintage',
                'description' => 'Jaket denim vintage style dengan detail ripped yang stylish. Bahan denim premium, fit regular. Cocok untuk gaya kasual.',
                'price' => 385000,
                'weight' => 600,
                'category' => 'Fashion',
                'stock' => 35,
                'sku' => 'JKT-009',
                'photo' => 'img/jaketdenim.png',
            ],
            [
                'name' => 'Teh Hijau Premium',
                'description' => 'Teh hijau premium dari perkebunan teh terbaik. Kaya antioksidan, cocok untuk diet dan kesehatan. Aroma harum dan rasa segar.',
                'price' => 45000,
                'weight' => 100,
                'category' => 'Makanan & Minuman',
                'stock' => 120,
                'sku' => 'TEH-010',
                'photo' => 'img/tehhijau.png',
            ],
        ];

        foreach ($products as $productData) {
            // Random seller
            $seller = $sellers->random();
            
            Product::create([
                'seller_id' => $seller->id,
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'weight' => $productData['weight'],
                'category' => $productData['category'],
                'stock' => $productData['stock'],
                'sku' => $productData['sku'],
                'photo' => $productData['photo'], // Menggunakan foto dari array
                'video_path' => null,
                'rating' => rand(40, 50) / 10, // Random 4.0 - 5.0
                'rating_count' => rand(10, 100),
                'status' => 'active',
            ]);
        }

        $this->command->info('10 products created successfully!');
    }
}

