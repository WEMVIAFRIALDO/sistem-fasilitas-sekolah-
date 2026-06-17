<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    // Mengamankan nama tabel
    protected $table = 'fasilitas';
    
    // Sesuaikan dengan nama kolom id bawaan migration
    protected $primaryKey = 'id';
    
    // Amankan kolom id saja, sisanya bebas diisi
    protected $guarded = ['id'];

    // Relasi: Satu fasilitas bisa memiliki banyak riwayat peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_fasilitas', 'id');
    }

    // Relasi: Satu fasilitas bisa memiliki banyak riwayat kerusakan
    public function laporanKelayakan()
    {
        return $this->hasMany(LaporanKelayakan::class, 'id_fasilitas', 'id');
    }
}