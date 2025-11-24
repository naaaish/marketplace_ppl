<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellerRegisterController extends Controller
{
    /**
     * Menampilkan formulir pendaftaran (View 14 data).
     */
    public function showForm()
    {
        return view('seller.register');
    }

    /**
     * Menyimpan data pendaftaran ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Data (Sesuai SRS-01)
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_description' => 'nullable|string',
            'pic_name' => 'required|string|max:255',
            'pic_phone' => 'required|string|max:20',
            'pic_email' => 'required|email|unique:users,email', // Email harus unik di tabel users
            'pic_address' => 'required|string',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'village' => 'required|string',
            'regency' => 'required|string',
            'province' => 'required|string',
            'pic_ktp_number' => 'required|string|size:16|unique:sellers,pic_ktp_number', // NIK unik di tabel sellers
            'pic_photo_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pic_ktp_file_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Upload File
        // Simpan di folder 'public/uploads/sellers'
        $fotoPath = $request->file('pic_photo_path')->store('uploads/sellers/photos', 'public');
        $ktpPath = $request->file('pic_ktp_file_path')->store('uploads/sellers/ktp', 'public');

        // 3. Buat Akun User (Role: Seller, Password: NULL/Kosong)
        // User ini belum bisa login karena passwordnya null
        $user = User::create([
            'name' => $request->pic_name,
            'email' => $request->pic_email,
            'role' => 'seller',
            'password' => null, // Password diisi nanti saat aktivasi dari email
        ]);

        // 4. Buat Data Seller (Status: Pending)
        Seller::create([
            'user_id' => $user->id,
            'store_name' => $request->store_name,
            'store_description' => $request->store_description,
            'pic_name' => $request->pic_name,
            'pic_phone' => $request->pic_phone,
            'pic_email' => $request->pic_email,
            'pic_address' => $request->pic_address,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'village' => $request->village,
            'regency' => $request->regency,
            'province' => $request->province,
            'pic_ktp_number' => $request->pic_ktp_number,
            'pic_photo_path' => $fotoPath,
            'pic_ktp_file_path' => $ktpPath,
            'status' => 'pending', // Menunggu verifikasi admin
            'verification_date' => null
        ]);

        // 5. Redirect ke Halaman Login dengan Pesan Sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Data Anda sedang diverifikasi oleh Admin. Cek email Anda secara berkala.');
    }
}
