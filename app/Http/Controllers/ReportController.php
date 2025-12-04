<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Product;
use App\Models\ProductReview; // <--- WAJIB IMPORT MODEL REVIEW
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // 1. Laporan Akun Penjual (SRS-MartPlace-09)
    public function reportSellersStatus()
    {
        // Logic Sorting: Aktif, pending, rejected
        $sellers = Seller::with('user')
            ->orderByRaw("FIELD(status, 'active', 'pending', 'rejected')")
            ->get();

        $data = [
            'title' => 'Laporan Daftar Akun Penjual Berdasarkan Status',
            'code' => 'SRS-MartPlace-09',
            'sellers' => $sellers,
            'pemroses' => Auth::user()->name ?? 'Admin', 
            'tanggal' => now()->format('d-m-Y'),
        ];

        $pdf = Pdf::loadView('admin.reports.sellers_status', $data)->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Akun_Penjual_Status.pdf');
    }

    // 2. Laporan Penjual per Propinsi (SRS-MartPlace-10)
    public function reportSellersProvince()
    {
        // Logic Sorting: Berdasarkan Abjad Propinsi (A-Z)
        $sellers = Seller::with('user')
            ->orderBy('province', 'asc')
            ->get();

        $data = [
            'title' => 'Laporan Daftar Toko Berdasarkan Lokasi Propinsi',
            'code' => 'SRS-MartPlace-10',
            'sellers' => $sellers,
            'pemroses' => Auth::user()->name ?? 'Admin',
            'tanggal' => now()->format('d-m-Y'),
        ];

        $pdf = Pdf::loadView('admin.reports.sellers_province', $data)->setPaper('a4', 'portrait');
        return $pdf->download('Laporan_Toko_Propinsi.pdf');
    }

    // 3. Laporan Produk Berdasarkan Rating (SRS-MartPlace-11)
    // PERBAIKAN: Mengambil data Review agar bisa dapat propinsi pemberi rating
    public function reportProductsRating()
    {
        // Ambil semua data review
        // Relasi: 
        // - product.seller (Untuk ambil Nama Toko)
        // - user (Untuk ambil Propinsi Pemberi Rating)
        
        $reviews = ProductReview::with(['product.seller', 'user'])
            ->orderByDesc('rating') // Urutkan rating 5 ke 1
            ->get();

        $data = [
            'title' => 'Laporan Daftar Produk Berdasarkan Rating',
            'code' => 'SRS-MartPlace-11',
            'reviews' => $reviews, // Kirim data reviews, bukan products
            'pemroses' => Auth::user()->name ?? 'Admin',
            'tanggal' => now()->format('d-m-Y'),
        ];

        $pdf = Pdf::loadView('admin.reports.products_rating', $data)->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Produk_Rating.pdf');
    }
}