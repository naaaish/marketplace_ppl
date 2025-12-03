<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_name',
        'store_description',
        'pic_name',
        'pic_phone',
        'pic_email',
        'pic_address',
        'rt',
        'rw',
        'village',
        'regency',
        'province',
        'pic_ktp_number', 
        'pic_photo_path', 
        'pic_ktp_file_path',
        'status',
        'verification_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}