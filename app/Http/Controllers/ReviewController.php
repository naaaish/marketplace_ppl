<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Memproses pengiriman form ulasan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request)
    {
        // --- Logika Pemrosesan Data Ulasan ---
        
        // 1. Ambil data dari form
        $rating = $request->input('rating');
        $comment = $request->input('comment');
        $productId = $request->input('product_id');

        // 2. Cek dan dapatkan nama file (untuk notifikasi)
        $fotoName = $request->hasFile('foto') ? $request->file('foto')->getClientOriginalName() : 'Tidak ada foto';
        $videoName = $request->hasFile('video') ? $request->file('video')->getClientOriginalName() : 'Tidak ada video';

        // ************
        // LOGIKA NYATA DI SINI: Validasi, Simpan ke Database, Pindahkan File (store)
        // ************

        // 3. Buat pesan sukses
        $mediaStatus = [];
        if ($fotoName !== 'Tidak ada foto') {
            $mediaStatus[] = "Foto: {$fotoName}";
        }
        if ($videoName !== 'Tidak ada video') {
            $mediaStatus[] = "Video: {$videoName}";
        }
        
        $message = "Ulasan berhasil dikirim! (ID Produk: {$productId}, Rating: {$rating})";
        if (!empty($mediaStatus)) {
            $message .= ". Media: " . implode(' dan ', $mediaStatus);
        }

        // 4. Redirect kembali ke halaman ulasan dengan pesan sukses
        return redirect('/ulasan')->with('success', $message);
    }
}