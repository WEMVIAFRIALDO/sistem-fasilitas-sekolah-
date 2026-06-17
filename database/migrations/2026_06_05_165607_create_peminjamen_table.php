<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('id_peminjaman'); 
            
            // Kolom penghubung ke tabel lain
            $table->unsignedBigInteger('id_user_pemohon'); 
            $table->unsignedBigInteger('id_fasilitas');
            $table->unsignedBigInteger('id_admin_verifikator')->nullable(); 

            // Kolom detail transaksi
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_kembali');
            $table->string('durasi_sewa');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('status_verifikasi', ['Pending', 'Disetujui', 'Ditolak'])->default('Pending');
            $table->timestamps();

            // Kunci Relasi (Pastikan id_user ke users, dan id ke fasilitas)
            $table->foreign('id_user_pemohon')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_fasilitas')->references('id')->on('fasilitas')->onDelete('cascade');
            $table->foreign('id_admin_verifikator')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};