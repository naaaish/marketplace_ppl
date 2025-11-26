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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained()->onDelete('cascade');
            
            // Informasi Produk Utama
            $table->string('name'); // Nama Produk
            $table->text('description')->nullable(); // Deskripsi Produk
            $table->decimal('price', 15, 2); // Harga Satuan
            $table->integer('weight')->default(0); // Berat (gram)
            
            // Kategori
            $table->string('category')->nullable();
            
            // Rating (akan diupdate dari review)
            $table->decimal('rating', 3, 2)->default(0.00); // Rating 0.00 - 5.00
            $table->integer('rating_count')->default(0); // Jumlah pemberi rating
            
            // Media
            $table->string('photo')->nullable(); // Foto Produk
            $table->string('video_path')->nullable(); // Path video
            
            // Stock & SKU
            $table->integer('stock')->default(0);
            $table->string('sku')->nullable();
            
            // Status Produk
            $table->enum('status', ['active', 'inactive'])->default('active');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
