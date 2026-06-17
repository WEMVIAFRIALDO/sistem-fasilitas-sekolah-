<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKelayakan extends Model
{
    protected $table = 'laporan_kelayakan';
    protected $primaryKey = 'id_laporan';
    protected $guarded = ['id_laporan'];

    public function pemohon()
    {
        return $this->belongsTo(User::class, 'id_user_pemohon', 'id_user');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'id_admin_verifikator', 'id_user');
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'id_fasilitas', 'id_fasilitas');
    }
}