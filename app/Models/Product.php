<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'photos' => 'array', // Auto convert JSON ke array
    ];

    /**
     * Relasi ke Seller
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    /**
     * Relasi ke Product Variants
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }
}
