<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'variant_name',
        'variant_price',
        'variant_stock',
        'variant_sku',
    ];

    protected $casts = [
        'variant_price' => 'decimal:2',
        'variant_stock' => 'integer',
    ];

    /**
     * Relasi ke Product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
