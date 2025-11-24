<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    // Tampilkan Dashboard Admin (List Pending)
    public function index() {
        // Ambil seller yang pending, beserta data user-nya
        // Pastikan di Model Seller sudah ada method user() !!
        $pendingSellers = Seller::where('status', 'pending')->with('user')->get();
        
        return view('admin.dashboard', compact('pendingSellers'));
    }

    // Approve Seller
    public function approve($id) {
        $seller = Seller::findOrFail($id);
        
        // Ambil User pemilik toko ini
        /** @var \App\Models\User $user */
        $user = $seller->user; 

        // 1. Buat Token Aktivasi
        $token = Str::random(60);
        $user->update(['activation_token' => $token]);

        // 2. Update Status Toko jadi Active
        $seller->update([
            'status' => 'active', 
            'verification_date' => now()
        ]);

        // 3. Log Linknya (karena belum ada kirim email beneran)
        $link = route('activation.form', $token);
        
        Log::info("==========================================");
        Log::info("LINK AKTIVASI USER: " . $user->email);
        Log::info($link);
        Log::info("==========================================");

        return back()->with('success', "Seller disetujui! Link aktivasi ada di terminal/log.");
    }

    // Reject Seller
    public function reject($id) {
        $seller = Seller::findOrFail($id);
        $seller->update(['status' => 'rejected']);
        
        return back()->with('success', 'Pendaftaran toko ditolak.');
    }
}