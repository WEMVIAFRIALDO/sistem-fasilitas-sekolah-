<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Beritahu Laravel nama tabel yang benar
    protected $table = 'peminjaman';
    
    // Beritahu Laravel nama Primary Key-nya
    protected $primaryKey = 'id_peminjaman';

    // Izinkan semua kolom diisi secara massal
    protected $guarded = [];
}