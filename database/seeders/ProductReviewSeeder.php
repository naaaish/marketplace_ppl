<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductReview;
use Faker\Factory as Faker;

class ProductReviewSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. Ambil Produk & User
        $products = Product::all();
        $users = User::where('role', 'buyer')->orWhere('role', 'seller')->get();

        // Buat user dummy jika kurang
        if ($users->count() < 5) {
            User::factory(10)->create(['role' => 'buyer']);
            $users = User::where('role', 'buyer')->get();
        }

        if ($products->isEmpty()) {
            $this->command->info('Tidak ada produk. Jalankan ProductSeeder dulu!');
            return;
        }

        // 2. Daftar Provinsi Indonesia
        $daftarProvinsi = [
            'ACEH', 'SUMATERA UTARA', 'SUMATERA BARAT', 'RIAU', 'JAMBI', 
            'SUMATERA SELATAN', 'BENGKULU', 'LAMPUNG', 'KEPULAUAN BANGKA BELITUNG', 'KEPULAUAN RIAU',
            'DKI JAKARTA', 'JAWA BARAT', 'JAWA TENGAH', 'DI YOGYAKARTA', 'JAWA TIMUR', 'BANTEN',
            'BALI', 'NUSA TENGGARA BARAT', 'NUSA TENGGARA TIMUR',
            'KALIMANTAN BARAT', 'KALIMANTAN TENGAH', 'KALIMANTAN SELATAN', 'KALIMANTAN TIMUR', 'KALIMANTAN UTARA',
            'SULAWESI UTARA', 'SULAWESI TENGAH', 'SULAWESI SELATAN', 'SULAWESI TENGGARA', 'GORONTALO', 'SULAWESI BARAT',
            'MALUKU', 'MALUKU UTARA',
            'PAPUA BARAT', 'PAPUA', 'PAPUA SELATAN', 'PAPUA TENGAH', 'PAPUA PEGUNUNGAN', 'PAPUA BARAT DAYA'
        ];

        // 3. Loop Isi Review
        foreach ($products as $product) {
            $jumlahReview = rand(3, 8); 

            for ($i = 0; $i < $jumlahReview; $i++) {
                $user = $users->random();
                
                // Ambil & Update Provinsi User
                $provinsiRandom = $daftarProvinsi[array_rand($daftarProvinsi)];
                $user->province = $provinsiRandom;
                $user->save(); 

                // Simpan Review (HANYA KOLOM YANG ADA)
                ProductReview::create([
                    'product_id' => $product->id,
                    'user_id'    => $user->id,
                    'rating'     => rand(3, 5),
                    'comment'    => $faker->sentence(10),
                    'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                ]);
            }
        }
    }
}