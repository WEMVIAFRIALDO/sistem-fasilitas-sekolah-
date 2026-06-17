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
        // Memaksa nama tabel menjadi laporan_kelayakan
        Schema::create('laporan_kelayakan', function (Blueprint $table) {
            $table->id('id_laporan'); // Primary Key

            // 1. Kolom Foreign Key
            $table->unsignedBigInteger('id_user_pemohon'); // Siswa/Guru yang melapor
            $table->unsignedBigInteger('id_fasilitas'); // Barang yang rusak
            $table->unsignedBigInteger('id_admin_verifikator')->nullable(); // Admin yang menindaklanjuti

            // 2. Kolom Data Pengaduan
            $table->text('deskripsi_kerusakan');
            $table->string('bukti_file_path')->nullable(); // Tempat menyimpan nama file foto/kamera
            $table->date('tanggal_lapor');
            
            // Status awal otomatis saat laporan dikirim
            $table->enum('status_tindak_lanjut', ['Tindak Lanjut Baru', 'Sedang Diproses', 'Selesai'])->default('Tindak Lanjut Baru');

            $table->timestamps();

            // 3. Relasi Antar-Tabel
            $table->foreign('id_user_pemohon')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_fasilitas')->references('id')->on('fasilitas')->onDelete('cascade');
            $table->foreign('id_admin_verifikator')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kelayakan');
    }
};