<?php
// Lokasi: app/Http/Controllers/TokoController.php

namespace App\Http\Controllers;

use App\Models\Toko; // <-- 1. Impor Model Toko Anda
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- 2. Impor untuk mengambil ID pengguna

class TokoController extends Controller
{
    /**
     * Menampilkan halaman formulir registrasi toko.
     * Ini dijalankan oleh rute GET /toko/register
     */
    public function create()
    {
        // Arahkan ke file view yang kita buat di resources/views/toko/register.blade.php
        return view('toko.register'); 
    }

    /**
     * Menyimpan data toko baru ke database.
     * Ini dijalankan oleh rute POST /toko/register
     */
    public function store(Request $request)
    {
        // 1. Validasi (Sederhana, bisa Anda kembangkan)
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'nama_pic' => 'required|string|max:255',
            'no_hp_pic' => 'required|string',
            'email_pic' => 'required|email',
            'alamat_pic' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
            'kelurahan' => 'required|string',
            'kabupaten_kota' => 'required|string',
            'propinsi' => 'required|string',
            'no_ktp_pic' => 'required|string',
            'foto_pic' => 'required|image|max:2048', // max 2MB
            'file_ktp_pic' => 'required|image|max:2048', // max 2MB
        ]);

        // 2. Upload File Foto PIC
        // File akan disimpan di storage/app/public/foto_pic
        $pathFoto = $request->file('foto_pic')->store('public/foto_pic');
        // Bersihkan nama path agar bisa diakses
        $pathFoto = str_replace("public/", "", $pathFoto);


        // 3. Upload File KTP
        // File akan disimpan di storage/app/public/ktp
        $pathKTP = $request->file('file_ktp_pic')->store('public/ktp');
        // Bersihkan nama path agar bisa diakses
        $pathKTP = str_replace("public/", "", $pathKTP);
        

        // 4. Simpan semua data ke database
        Toko::create([
            'user_id' => Auth::id(), // <-- Ambil ID pengguna yang sedang login
            'nama_toko' => $request->nama_toko,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'nama_pic' => $request->nama_pic,
            'no_hp_pic' => $request->no_hp_pic,
            'email_pic' => $request->email_pic,
            'alamat_pic' => $request->alamat_pic,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'kelurahan' => $request->kelurahan,
            'kabupaten_kota' => $request->kabupaten_kota,
            'propinsi' => $request->propinsi,
            'no_ktp_pic' => $request->no_ktp_pic,
            'foto_pic' => $pathFoto,     // Simpan path hasil upload
            'file_ktp_pic' => $pathKTP,  // Simpan path hasil upload
        ]);

        // 5. Redirect pengguna setelah berhasil
        return redirect()->route('dashboard')->with('status', 'Toko berhasil didaftarkan!');
    }
}