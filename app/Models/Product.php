<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'name',
        'description',
        'category',
        'price',
        'stock',
        'image',
        'sold',
        'status'
    ];

    // Relasi ke Seller
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    // Relasi ke Reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Hitung rata-rata rating
    public function averageRating()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    // Hitung jumlah review
    public function reviewCount()
    {
        return $this->reviews()->count();
    }
}