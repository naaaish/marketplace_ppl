<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // <--- PASTIKAN INI ADA
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SellerRegistrationController extends Controller
{
    // ... (fungsi create dan checkUnique biarkan saja) ...
    public function create()
    {
        return view('seller.register');
    }

    public function checkUnique(Request $request)
    {
        $type = $request->type;
        $value = $request->value;

        if ($type == 'email') {
            $exists = User::where('email', $value)->exists();
        } elseif ($type == 'nik') {
            $exists = Seller::where('pic_ktp_number', $value)->exists();
        } else {
            return response()->json(['exists' => false]);
        }

        return response()->json(['exists' => $exists]);
    }

    // --- FUNGSI STORE VERSI BARU (SESUAI REQUEST) ---
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'store_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'pic_name' => 'required', // Nama PIC Wajib
            'pic_ktp_number' => 'required|unique:sellers,pic_ktp_number',
            'pic_photo' => 'required|image|max:2048',
            'pic_ktp_file' => 'required|image|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // 2. Upload File
            $photoPath = $request->file('pic_photo')->store('sellers/photos', 'public');
            $ktpPath = $request->file('pic_ktp_file')->store('sellers/ktp', 'public');

            // 3. LOGIC NAMA USER DARI EMAIL
            // Contoh: choconamoroll@gmail.com -> choconamoroll
            $userNameFromEmail = Str::before($request->email, '@'); 

            // 4. Buat User Baru
            $user = User::create([
                'name' => $userNameFromEmail, // <--- ISI DENGAN USERNAME EMAIL
                'email' => $request->email,
                'password' => Hash::make(Str::random(16)),
                'role' => 'seller',
                'activation_token' => Str::random(60),
            ]);

            // 5. Buat Data Seller
            Seller::create([
                'user_id' => $user->id,
                'store_name' => $request->store_name,
                'store_description' => $request->store_description,
                'pic_name' => $request->pic_name, // <--- INI TETAP NAMA LENGKAP PIC
                'pic_phone' => $request->pic_phone,
                'pic_email' => $request->pic_email,
                'pic_address' => $request->pic_address,
                'province' => $request->province,
                'regency' => $request->regency,
                'district' => $request->district ?? '-',
                'village' => $request->village ?? '-',
                'rt' => $request->rt,
                'rw' => $request->rw,
                'pic_ktp_number' => $request->pic_ktp_number,
                'pic_photo_path' => $photoPath,
                'pic_ktp_path' => $ktpPath,
                'status' => 'pending',
            ]);

            DB::commit();

            // Flash Message untuk Login nanti (Opsional karena pakai AJAX)
            // session()->flash('success_register', 'Pendaftaran berhasil! Cek email untuk verifikasi.');
            
            return response()->json([
                'status' => 'success',
                'message' => 'Registrasi berhasil.'
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error("Register Error: " . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal: ' . $e->getMessage()
            ], 500);
        }
    }
}