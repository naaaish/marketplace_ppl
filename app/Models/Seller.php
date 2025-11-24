<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $guarded = ['id']; // Supaya semua kolom bisa diisi

    // --- TAMBAHKAN INI ---
    // Ini memberitahu Laravel bahwa setiap Seller "milik" satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}