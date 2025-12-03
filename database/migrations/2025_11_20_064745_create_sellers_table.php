<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerRegistrationController extends Controller
{
    public function create()
    {
        return view('seller.register');
    }

    // --- PROSES SIMPAN ---
    public function store(Request $request)
    {
        // 1. VALIDASI (Wajib ditaruh paling atas!)
        // Ini penjaga gawangnya. Kalau NIK sama, dia stop di sini & kirim pesan error.
        $validated = $request->validate([
            'store_name'        => 'required|string|max:255',
            'store_description' => 'required|string',
            'pic_name'          => 'required|string|max:255',
            'pic_phone'         => 'required|string',
            'pic_address'       => 'required|string',
            'province'          => 'required|string',
            'regency'           => 'required|string',
            'district'          => 'nullable|string', 
            'village'           => 'nullable|string', 
            'rt'                => 'required|string',
            'rw'                => 'required|string',
            'pic_photo'         => 'required|image|max:2048',
            'pic_ktp_file'      => 'required|image|max:2048',
            
            // CEK UNIK (PENTING):
            // unique:users,email -> Cek tabel users kolom email
            'pic_email'         => 'required|email|unique:users,email', 
            
            // unique:sellers,pic_ktp_number -> Cek tabel sellers kolom pic_ktp_number
            'pic_ktp_number'    => 'required|string|size:16|unique:sellers,pic_ktp_number',
        ], [
            // Pesan Error Custom (Biar enak dibaca user)
            'pic_email.unique' => 'Email ini sudah terdaftar! Gunakan email lain.',
            'pic_ktp_number.unique' => 'NIK ini sudah terdaftar! Mohon periksa kembali.',
            'pic_ktp_number.size' => 'NIK harus berjumlah 16 digit.',
        ]);

        // --- Kalau lolos validasi di atas, baru kode di bawah ini jalan ---

        // 2. Upload File
        $photoPath = $request->file('pic_photo')->store('seller_photos', 'public');
        $ktpPath = $request->file('pic_ktp_file')->store('seller_ktps', 'public');

        // 3. Buat User Baru
        $user = User::create([
            'name' => $request->pic_name,
            'email' => $request->pic_email,
            'password' => Hash::make('password123'), // Password default
            'role' => 'seller',
        ]);

        // 4. Simpan Seller
        Seller::create([
            'user_id'           => $user->id,
            'store_name'        => $request->store_name,
            'store_description' => $request->store_description,
            'pic_name'          => $request->pic_name,
            'pic_phone'         => $request->pic_phone,
            'pic_email'         => $request->pic_email,
            'pic_address'       => $request->pic_address,
            'province'          => $request->province,
            'regency'           => $request->regency,
            'district'          => $request->input('district', '-'),
            'village'           => $request->input('village', '-'),
            'rt'                => $request->rt,
            'rw'                => $request->rw,
            'pic_ktp_number'    => $request->pic_ktp_number,
            'pic_photo_path'    => $photoPath, 
            'pic_ktp_file_path' => $ktpPath,   
            'status'            => 'pending',
        ]);

        // 5. Redirect Sukses
        return redirect()->route('login')->with('success_register', 'Registrasi berhasil! Silakan tunggu verifikasi admin.');
    }

    // --- CEK DUPLIKAT (AJAX) ---
    public function checkUnique(Request $request)
    {
        $type = $request->type;
        $value = $request->value;
        $exists = false;

        if ($type === 'email') {
            $exists = User::where('email', $value)->exists();
        } elseif ($type === 'nik') {
            $exists = Seller::where('pic_ktp_number', $value)->exists(); 
        }

        return response()->json(['exists' => $exists]);
    }
}