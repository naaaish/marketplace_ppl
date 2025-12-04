<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'reviewer_name',
        'reviewer_email',
        'reviewer_phone',
        'reviewer_province',
        'rating',
        'comment',
    ];

    /**
     * Relasi ke Product (Barang yang direview)
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi ke User (Pemberi Review)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}