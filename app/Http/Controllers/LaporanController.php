<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;
use App\Models\LaporanKelayakan;

class LaporanController extends Controller
{
    // 1. Menampilkan daftar laporan
    public function index()
    {
        $data_laporan = LaporanKelayakan::join('fasilitas', 'laporan_kelayakan.id_fasilitas', '=', 'fasilitas.id')
            ->join('users', 'laporan_kelayakan.id_user_pemohon', '=', 'users.id_user')
            // ✅ INI YANG DIUBAH: Tambah 'fasilitas.ruangan' agar bisa dipanggil di view
            ->select('laporan_kelayakan.*', 'fasilitas.nama_barang', 'fasilitas.ruangan', 'users.nama_lengkap')
            ->orderBy('laporan_kelayakan.created_at', 'desc')
            ->get();

        return view('laporan', compact('data_laporan'));
    }

    // 2. Menampilkan form lapor barang rusak
    public function create()
    {
        $fasilitas = Fasilitas::all(); 
        return view('laporan-tambah', compact('fasilitas'));
    }

    // 3. Menyimpan laporan & foto ke database
    public function store(Request $request)
    {
        $request->validate([
            'id_fasilitas' => 'required',
            'deskripsi_kerusakan' => 'required|string',
            'tanggal_lapor' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $path_foto = null;
        if ($request->hasFile('foto')) {
            $path_foto = $request->file('foto')->store('laporan', 'public');
        }

        LaporanKelayakan::create([
            'id_user_pemohon' => auth()->user()->id_user,
            'id_fasilitas' => $request->id_fasilitas,
            'deskripsi_kerusakan' => $request->deskripsi_kerusakan,
            'tanggal_lapor' => $request->tanggal_lapor,
            'status_tindak_lanjut' => 'Tindak Lanjut Baru', 
            'foto' => $path_foto, 
        ]);

        Fasilitas::where('id', $request->id_fasilitas)->update(['status' => 'Rusak']);

        return redirect()->route('laporan')->with('success', 'Laporan & Foto berhasil dikirim!');
    }

    // 4. Update status tindak lanjut (Khusus Admin)
    public function updateStatus(Request $request, $id)
    {
        // Cari laporan berdasarkan id_laporan
        $laporan = LaporanKelayakan::where('id_laporan', $id)->first();

        // Update status di tabel laporan
        $laporan->update([
            'status_tindak_lanjut' => $request->status_tindak_lanjut
        ]);

        // 🔥 LOGIKA SAKTI KE-2: Kalau statusnya "Selesai", kembalikan barang jadi "Tersedia"
        if ($request->status_tindak_lanjut == 'Selesai') {
            Fasilitas::where('id', $laporan->id_fasilitas)->update(['status' => 'Tersedia']);
        }

        return redirect()->route('laporan')->with('success', 'Status laporan berhasil diperbarui!');
    }
}