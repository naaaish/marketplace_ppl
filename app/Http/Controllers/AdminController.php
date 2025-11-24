<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; 

class AdminController extends Controller
{
    // 1. Menampilkan Halaman Dashboard Admin (Daftar Pending)
    public function index() {
        // Ambil hanya seller yang statusnya 'pending'
        $pendingSellers = Seller::where('status', 'pending')->with('user')->get();
        
        return view('admin.dashboard', compact('pendingSellers'));
    }

    // 2. Proses ACC (Verifikasi)
    public function approve($id) {
        // Cari seller berdasarkan ID
        $seller = Seller::findOrFail($id);
        $user = $seller->user;

        // Generate Token Aktivasi untuk Email
        $token = Str::random(60);
        $user->update(['activation_token' => $token]);

        // Update Status jadi Active & Isi Tanggal Verifikasi
        $seller->update([
            'status' => 'active', 
            'verification_date' => now()
        ]);

        // SIMULASI KIRIM EMAIL (Cek Link di Terminal / Log)
        $link = route('activation.form', $token);
        
        // Kita catat di Log biar gampang dicopy
        Log::info("=== EMAIL AKTIVASI UNTUK {$user->email} ===");
        Log::info("Link: " . $link);
        Log::info("===========================================");

        return back()->with('success', "Penjual {$seller->store_name} berhasil disetujui! Link aktivasi ada di Log.");
    }
    
    // 3. Proses Tolak (Opsional)
    public function reject($id) {
        $seller = Seller::findOrFail($id);
        $seller->update(['status' => 'rejected']);
        return back()->with('success', 'Penjual ditolak.');
    }
}