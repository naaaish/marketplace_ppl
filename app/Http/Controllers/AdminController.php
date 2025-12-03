<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product; 
use App\Models\User; // <--- PENTING: Import User
use App\Mail\SellerApproved;
use App\Mail\SellerRejected; // <--- PENTING: Import Mail Rejected
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB; 

class AdminController extends Controller
{
    /**
     * 1. Halaman DASHBOARD (Statistik & Chart)
     */
    public function index() {
        // A. Statistik Card
        $totalSellersActive = Seller::where('status', 'active')->count();
        $totalSellersInactive = Seller::where('status', '!=', 'active')->where('status', '!=', 'pending')->count();
        $pendingCount = Seller::where('status', 'pending')->count();
        $totalVisitors = 2800; // Data dummy

        // B. List Verifikasi Terbaru
        $recentSellers = Seller::where('status', 'pending')->latest()->take(5)->get();

        // C. Chart Produk per Kategori
        $productsPerCategory = Product::select('category', DB::raw('count(*) as total'))
                                        ->groupBy('category')
                                        ->pluck('total', 'category'); 

        // D. Chart Toko per Provinsi
        $sellersPerProvince = Seller::select('province', DB::raw('count(*) as total'))
                                        ->groupBy('province')
                                        ->pluck('total', 'province');

        return view('admin.dashboard', compact(
            'totalSellersActive', 
            'totalSellersInactive', 
            'pendingCount', 
            'totalVisitors',
            'recentSellers',
            'productsPerCategory',
            'sellersPerProvince'
        ));
    }

    /**
     * 2. Halaman MANAJEMEN PENJUAL (List Lengkap)
     */
    public function sellers() {
        $sellers = Seller::with('user')->latest()->get();
        return view('admin.sellers.index', compact('sellers'));
    }

    /**
     * 3. Detail Seller
     */
    public function show($id) {
         $seller = Seller::findOrFail($id);
         return view('admin.sellers.show', compact('seller'));
    }

    /**
     * 4. Approve (Setuju & Kirim Email Link Password)
     */
    public function approve($id) {
        $seller = Seller::findOrFail($id);
        $user = $seller->user;

        // Generate Token
        $token = Str::random(60);
        $user->update(['activation_token' => $token]);

        // Update Status Seller
        $seller->update([
            'status' => 'active', 
            'verification_date' => now()
        ]);

        // Generate Link
        $link = route('activation.form', $token);

        // Kirim Email
        try {
            Mail::to($user->email)->send(new SellerApproved($user, $link));
            $pesan = "Seller disetujui & Email aktivasi terkirim!";
        } catch (\Exception $e) {
            Log::error("Gagal kirim email approve: " . $e->getMessage());
            $pesan = "Seller disetujui, tapi GAGAL kirim email (Cek Log).";
        }

        return back()->with('success', $pesan);
    }
    
    /**
     * 5. Reject (Tolak & Kirim Email Penolakan)
     */
    public function reject($id) {
        $seller = Seller::findOrFail($id);
        
        // 1. Update Status jadi Rejected
        $seller->update(['status' => 'rejected']);
        
        // 2. Ambil Usernya
        $user = $seller->user;

        // 3. Kirim Email Penolakan
        if ($user && $user->email) {
            try {
                // Pastikan class SellerRejected sudah di-import di atas
                Mail::to($user->email)->send(new SellerRejected($user));
                $pesan = "Pendaftaran toko ditolak dan email notifikasi terkirim.";
            } catch (\Exception $e) {
                Log::error("Gagal kirim email reject: " . $e->getMessage());
                $pesan = "Toko ditolak, tapi email notifikasi gagal terkirim.";
            }
        } else {
            $pesan = "Pendaftaran toko ditolak.";
        }
        
        return back()->with('success', $pesan);
    }
}