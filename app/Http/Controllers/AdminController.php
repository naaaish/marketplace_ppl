<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\User;
use App\Mail\SellerApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    /**
     * 1. Menampilkan Halaman Dashboard Admin
     * (Fungsi ini yang tadi hilang)
     */
    public function index() {
        // Ambil data seller yang statusnya 'pending' beserta data user-nya
        $pendingSellers = Seller::where('status', 'pending')->with('user')->get();
        
        return view('admin.dashboard', compact('pendingSellers'));
    }

    /**
     * 2. Proses ACC (Verifikasi) + Kirim Email
     */
    public function approve($id) {
        $seller = Seller::findOrFail($id);
        
        /** @var \App\Models\User $user */
        $user = $seller->user;

        // A. Generate Token Aktivasi
        $token = Str::random(60);
        $user->update(['activation_token' => $token]);

        // B. Update Status Toko jadi Active
        $seller->update([
            'status' => 'active', 
            'verification_date' => now()
        ]);

        // C. Siapkan Link Aktivasi
        $link = route('activation.form', $token);

        // D. Kirim Email (Dengan Error Handling biar gak crash kalau internet mati)
        try {
            Mail::to($user->email)->send(new SellerApproved($user, $link));
            $pesan = "Seller disetujui & Email aktivasi terkirim!";
        } catch (\Exception $e) {
            Log::error("Gagal kirim email: " . $e->getMessage());
            $pesan = "Seller disetujui, tapi GAGAL kirim email (Cek Log). Link manual: " . $link;
        }

        return back()->with('success', $pesan);
    }
    
    /**
     * 3. Proses Tolak (Reject)
     */
    public function reject($id) {
        $seller = Seller::findOrFail($id);
        $seller->update(['status' => 'rejected']);
        
        return back()->with('success', 'Pendaftaran toko ditolak.');
    }
}