<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Barryvdh\DomPDF\Facade\Pdf; // Import Library PDF
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // 1. Laporan Akun Penjual (SRS-MartPlace-09)
    public function reportSellersStatus()
    {
        // Logic Sorting: Aktif dulu (active), baru sisanya (pending, rejected)
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

        // Load View PDF (Landscape agar muat banyak)
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

    // 3. Laporan Produk Terjual per Kategori (SRS-MartPlace-11)
    public function reportProductsSoldByCategory()
    {
        // Future Implementation
    }
}