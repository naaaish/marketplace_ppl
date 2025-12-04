<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            // Hapus kolom manual karena sudah diganti user_id
            $table->dropColumn([
                'reviewer_name', 
                'reviewer_email', 
                'reviewer_phone', 
                'reviewer_province'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('product_reviews', function (Blueprint $table) {
            // Kembalikan jika di-rollback (opsional)
            $table->string('reviewer_name')->nullable();
            $table->string('reviewer_email')->nullable();
            $table->string('reviewer_phone')->nullable();
            $table->string('reviewer_province')->nullable();
        });
    }
};