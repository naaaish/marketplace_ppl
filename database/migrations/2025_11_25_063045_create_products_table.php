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
            
            // Media
            $table->string('main_photo')->nullable(); // Foto Utama
            $table->json('photos')->nullable(); // Array path foto tambahan (foto 2-5)
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
