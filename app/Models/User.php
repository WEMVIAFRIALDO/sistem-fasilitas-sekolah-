<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // 1. Pengaturan Dasar Tabel & Primary Key Sesuai ERD
    protected $table = 'users';
    protected $primaryKey = 'id_user';

    /**
     * Atribut yang boleh diisi secara massal (Mass Assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nama_lengkap',
        'password',
        'role',
    ];

    /**
     * Atribut yang harus disembunyikan saat data diubah ke JSON (Demi Keamanan).
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Otomatis mengubah format data (Casting).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed', // Memastikan password otomatis aman tersandikan
    ];


    // =========================================================================
    // KELOMPOK LOGIKA RELASI ANTAR-TABEL
    // =========================================================================

    /**
     * Relasi: Satu User (Siswa/Guru) bisa mengajukan banyak transaksi peminjaman.
     */
    public function pengajuanPeminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_user_pemohon', 'id_user');
    }

    /**
     * Relasi: Satu User (khusus Admin) bisa memverifikasi banyak pengajuan peminjaman.
     */
    public function verifikasiPeminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_admin_verifikator', 'id_user');
    }

    /**
     * Relasi: Satu User (Siswa/Guru) bisa mengirim banyak laporan kerusakan fasilitas.
     */
    public function pengajuanLaporan()
    {
        return $this->hasMany(LaporanKelayakan::class, 'id_user_pemohon', 'id_user');
    }
}