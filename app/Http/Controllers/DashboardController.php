<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Peminjaman;
use App\Models\LaporanKelayakan as Laporan;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard dengan data statistik.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Hitung jumlah seluruh fasilitas yang tersedia di tabel fasilitas
        $total_fasilitas = Fasilitas::count();

        // Hitung jumlah peminjaman yang sudah disetujui
        // Karena tabel peminjaman menggunakan kolom status_verifikasi, bukan status
        $sedang_dipinjam = Peminjaman::where('status_verifikasi', 'Disetujui')->count();

        // Hitung jumlah laporan yang masih menunggu tindak lanjut
        // Karena tabel laporan_kelayakan menggunakan kolom status_tindak_lanjut
        $total_laporan = Laporan::where('status_tindak_lanjut', 'Tindak Lanjut Baru')->count();

        // Kirim data statistik ke view dashboard menggunakan compact()
        return view('dashboard', compact('total_fasilitas', 'sedang_dipinjam', 'total_laporan'));
    }
}
