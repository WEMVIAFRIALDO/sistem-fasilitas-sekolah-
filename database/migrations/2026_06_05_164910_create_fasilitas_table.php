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
        Schema::create('fasilitas', function (Blueprint $table) {
            // ID Bawaan Laravel
            $table->id();
            
            // 4 Kolom Baru yang kita butuhkan untuk desain Grid tadi
            $table->string('nama_barang');
            $table->string('ruangan');
            $table->string('kode_barang')->unique();
            $table->enum('status', ['Tersedia', 'Sedang Dipinjam', 'Dilaporkan Rusak'])->default('Tersedia');
            
            // Pembuat otomatis created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};