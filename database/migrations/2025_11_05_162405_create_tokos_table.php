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
        Schema::create('tokos', function (Blueprint $table) {
            $table->id();
            
            // Link ke tabel users (siapa pemilik toko ini)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // 14 Elemen Data Anda
            $table->string('nama_toko');
            $table->text('deskripsi_singkat')->nullable();
            $table->string('nama_pic');
            $table->string('no_hp_pic');
            $table->string('email_pic');
            $table->string('alamat_pic'); // Nama Jalan
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan');
            $table->string('kabupaten_kota');
            $table->string('propinsi');
            $table->string('no_ktp_pic');
            $table->string('foto_pic'); // Path ke file setelah di-upload
            $table->string('file_ktp_pic'); // Path ke file setelah di-upload
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tokos');
    }
};
