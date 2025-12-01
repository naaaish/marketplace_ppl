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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            // Nama Variasi (contoh: "Merah - XL", "Hitam - M")
            $table->string('variant_name');
            
            // Harga khusus untuk variasi ini (opsional, jika berbeda dari harga utama)
            $table->decimal('variant_price', 15, 2)->nullable();
            
            // Stock khusus untuk variasi ini
            $table->integer('variant_stock')->default(0);
            
            // SKU khusus untuk variasi
            $table->string('variant_sku')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
