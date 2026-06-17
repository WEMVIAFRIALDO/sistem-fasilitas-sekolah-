<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;
use App\Models\Peminjaman;

class PeminjamanController extends Controller
{
    // 1. Menampilkan daftar semua peminjaman
    public function index()
    {
        $data_peminjaman = Peminjaman::join('fasilitas', 'peminjaman.id_fasilitas', '=', 'fasilitas.id')
            ->join('users', 'peminjaman.id_user_pemohon', '=', 'users.id_user')
            ->select('peminjaman.*', 'fasilitas.nama_barang', 'users.nama_lengkap')
            ->orderBy('peminjaman.created_at', 'desc')
            ->get();

        return view('peminjaman', compact('data_peminjaman'));
    }

    // 2. Menampilkan halaman form pengajuan
    public function create()
    {
        $fasilitas_tersedia = Fasilitas::where('status', 'Tersedia')->get();
        return view('peminjaman-tambah', compact('fasilitas_tersedia'));
    }

    // 3. Menyimpan data dari form
    public function store(Request $request)
    {
        $request->validate([
            'id_fasilitas' => 'required',
            'tanggal_peminjaman' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_peminjaman',
            'durasi_sewa' => 'required|string',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        Peminjaman::create([
            'id_user_pemohon' => auth()->user()->id_user,
            'id_fasilitas' => $request->id_fasilitas,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_kembali' => $request->tanggal_kembali,
            'durasi_sewa' => $request->durasi_sewa,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status_verifikasi' => 'Pending',
        ]);

        return redirect()->route('peminjaman')->with('success', 'Pengajuan peminjaman berhasil dikirim!');
    }

    // 4. FUNGSI VERIFIKASI (UNTUK ADMIN)
    public function verifikasi(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Update status berdasarkan tombol yang ditekan admin
        $peminjaman->update([
            'status_verifikasi' => $request->status,
            'id_admin_verifikator' => auth()->user()->id_user,
        ]);

        // LOGIKA CERDAS PENGATUR STATUS BARANG
        if ($request->status == 'Disetujui') {
            // Jika di-ACC, barang jadi 'Sedang Dipinjam' (Sesuai database PHPMyAdmin)
            Fasilitas::where('id', $peminjaman->id_fasilitas)->update(['status' => 'Sedang Dipinjam']);
            
        } elseif ($request->status == 'Selesai' || $request->status == 'Ditolak') {
            // Jika dikembalikan (Selesai) ATAU pengajuan Ditolak, barang otomatis 'Tersedia' kembali
            Fasilitas::where('id', $peminjaman->id_fasilitas)->update(['status' => 'Tersedia']);
        }

        return redirect()->route('peminjaman')->with('success', 'Status peminjaman berhasil diperbarui!');
    }

    // 5. ✅ FUNGSI BARU: PENGEMBALIAN BARANG LANGSUNG
    public function kembali($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Ubah status peminjaman menjadi 'Selesai' (Sesuai dengan logika databasemu)
        $peminjaman->update([
            'status_verifikasi' => 'Selesai' 
        ]);

        // Logika Sakti: Kembalikan status fasilitas menjadi 'Tersedia'
        Fasilitas::where('id', $peminjaman->id_fasilitas)->update([
            'status' => 'Tersedia'
        ]);

        return redirect()->route('peminjaman')->with('success', 'Barang berhasil dikembalikan dan fasilitas siap dipinjam lagi!');
    }
}