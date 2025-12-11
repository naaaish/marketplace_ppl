<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users (karena ada user_id di controller)
            // onDelete('cascade') berarti jika user dihapus, data seller juga terhapus
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Data Toko
            $table->string('store_name');
            $table->text('store_description'); // Pakai text karena deskripsi bisa panjang
            
            // Data PIC (Penanggung Jawab)
            $table->string('pic_name');
            $table->string('pic_phone');
            $table->string('pic_email');
            $table->text('pic_address'); // Alamat biasanya panjang
            
            // Data Wilayah
            $table->string('province');
            $table->string('regency');
            $table->string('district'); // Kecamatan
            $table->string('village');  // Kelurahan
            $table->string('rt');
            $table->string('rw');
            
            // Data Dokumen & File
            $table->string('pic_ktp_number', 16)->unique(); // NIK harus unik & 16 digit
            $table->string('pic_photo_path');     // Lokasi file foto diri
            $table->string('pic_ktp_file_path');  // Lokasi file foto KTP
            
            // Status & Timestamps
            $table->string('status')->default('pending'); // Default status 'pending'
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};