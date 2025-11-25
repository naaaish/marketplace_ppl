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
        'rating' => 'decimal:2',
    ];

    /**
     * Accessor untuk mendapatkan store_name dari seller
     */
    public function getStoreNameAttribute()
    {
        return $this->seller?->store_name;
    }

    /**
     * Accessor untuk mendapatkan province dari seller
     */
    public function getProvinceAttribute()
    {
        return $this->seller?->province;
    }

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
