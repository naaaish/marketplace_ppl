<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seller extends Model
{
    use HasFactory;

    // Simple approach for now: allow mass assignment for everything
    protected $guarded = [];

    /**
     * A Seller belongs to a User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
