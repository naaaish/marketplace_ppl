<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Seller;
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

        // 2. Buat Akun PENJUAL (Yang Sudah Aktif)
        $sellerUser = User::create([
            'name' => 'Siti Penjual',
            'email' => 'siti@toko.com',
            'password' => Hash::make('password'), // Password default: password
            'role' => 'seller',
            'email_verified_at' => now(),
        ]);

        // Buat Data Toko untuk Siti
        Seller::create([
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
            'status' => 'active', // Langsung aktif
            'verification_date' => now(),
        ]);
        
        // 3. Buat Akun PENJUAL (Yang Masih PENDING / Belum di-ACC)
        $pendingUser = User::create([
            'name' => 'Joko Pending',
            'email' => 'joko@pending.com',
            'password' => null, // Belum punya password
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
            'status' => 'pending', // Masih menunggu admin
        ]);
    }
}