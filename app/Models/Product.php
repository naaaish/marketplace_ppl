<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'price' => 'decimal:2',
        'weight' => 'integer',
        'stock' => 'integer',
        'rating' => 'decimal:2',
        'rating_count' => 'integer',
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

    /**
     * Relasi ke Product Reviews
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }
}