<?php
// Lokasi: app/Models/Toko.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- Impor ini

class Toko extends Model
{
    use HasFactory;

    /**
     * Izinkan semua kolom diisi (Cara mudah untuk proyek sederhana).
     * Ini mencegah "Mass Assignment Exception" saat Anda menyimpan 14 data.
     */
    protected $guarded = [];

    /**
     * Relasi: Toko ini milik siapa?
     * Mendefinisikan bahwa satu Toko 'milik' satu User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}