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
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        
        // 14 DATA REGISTRASI
        $table->string('store_name');
        $table->text('store_description')->nullable();
        $table->string('pic_name');
        $table->string('pic_phone');
        $table->string('pic_email'); 
        $table->text('pic_address');
        $table->string('rt', 5);
        $table->string('rw', 5);
        $table->string('village');
        $table->string('regency');
        $table->string('province');
        $table->string('pic_ktp_number');
        $table->string('pic_photo_path')->nullable();
        $table->string('pic_ktp_file_path')->nullable();

        // STATUS & VERIFIKASI
        $table->enum('status', ['pending', 'active', 'rejected'])->default('pending');
        $table->dateTime('verification_date')->nullable();
        
        $table->timestamps();
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
