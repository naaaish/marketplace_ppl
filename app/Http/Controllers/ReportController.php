<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Product;
use App\Models\ProductReview; 
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // 0. Halaman Pusat Laporan Seller (View HTML)
    public function sellerReportsIndex() {
        return view('seller.reports.index');
    }

   // -------------------------------------------------------------------------
    // BAGIAN SELLER
    // -------------------------------------------------------------------------

    // 1. Laporan Stok (Load view: stock_desc)
    public function reportStockDesc()
    {
        $sellerId = Auth::user()->seller->id;
        
        $products = Product::where('seller_id', $sellerId)
            ->orderBy('stock', 'desc')
            ->get();

        $data = [
            'title'    => 'Laporan Daftar Produk Berdasarkan Stok',
            'code'     => 'SRS-MartPlace-12',
            'products' => $products,
            'pemroses' => Auth::user()->name,
            'tanggal'  => now()->format('d F Y'),
        ];
        
        // Panggil FILE SPESIFIK
        $pdf = Pdf::loadView('seller.reports.stock_desc', $data)->setPaper('a4', 'portrait');
        return $pdf->download('Laporan_Stok_Terbanyak.pdf'); 
    }

    // 2. Laporan Rating (Load view: rating_desc)
    public function reportRatingDesc()
    {
        $sellerId = Auth::user()->seller->id;

        $products = Product::where('seller_id', $sellerId)
            ->orderByDesc('rating') 
            ->get();

        $data = [
            'title'    => 'Laporan Daftar Produk Berdasarkan Rating',
            'code'     => 'SRS-MartPlace-13',
            'products' => $products,
            'pemroses' => Auth::user()->name,
            'tanggal'  => now()->format('d F Y'),
        ];

        // Panggil FILE SPESIFIK
        $pdf = Pdf::loadView('seller.reports.rating_desc', $data)->setPaper('a4', 'portrait');
        return $pdf->download('Laporan_Rating_Produk.pdf');
    }

    // 3. Laporan Stok Kritis (Load view: stock_low)
    public function reportStockLow()
    {
        $sellerId = Auth::user()->seller->id;

        $products = Product::where('seller_id', $sellerId)
            ->where('stock', '<', 5) 
            ->orderBy('stock', 'asc')
            ->get();

        $data = [
            'title'    => 'Laporan Daftar Produk Stok Kritis',
            'code'     => 'SRS-MartPlace-14',
            'products' => $products,
            'pemroses' => Auth::user()->name,
            'tanggal'  => now()->format('d F Y'),
        ];

        // Panggil 
        $pdf = Pdf::loadView('seller.reports.stock_low', $data)->setPaper('a4', 'portrait');
        return $pdf->download('Laporan_Stok_Kritis.pdf');
    }


    // -------------------------------------------------------------------------
    // BAGIAN ADMIN 
    // -------------------------------------------------------------------------

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
    public function reportProductsRating()
    {
        $reviews = ProductReview::with(['product.seller', 'user'])
            ->orderByDesc('rating') // Urutkan rating 5 ke 1
            ->get();

        $data = [
            'title' => 'Laporan Daftar Produk Berdasarkan Rating',
            'code' => 'SRS-MartPlace-11',
            'reviews' => $reviews, 
            'pemroses' => Auth::user()->name ?? 'Admin',
            'tanggal' => now()->format('d-m-Y'),
        ];

        $pdf = Pdf::loadView('admin.reports.products_rating', $data)->setPaper('a4', 'landscape');
        return $pdf->download('Laporan_Produk_Rating.pdf');
    }
}