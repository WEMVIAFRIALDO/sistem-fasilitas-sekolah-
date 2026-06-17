<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fasilitas; // Pastikan ini sesuai dengan nama modelmu
use Faker\Factory as Faker;

class FasilitasSeeder extends Seeder
{
    public function run()
    {
        // Gunakan Faker bahasa Indonesia
        $faker = Faker::create('id_ID');

        // Daftar kemungkinan nama barang dan ruangan agar terlihat realistis
        $pilihanBarang = ['Meja Siswa', 'Kursi Kayu', 'Papan Tulis Whiteboard', 'Proyektor Epson', 'AC Panasonic', 'Kipas Angin Dinding', 'Lemari Arsip', 'Laptop Lenovo', 'PC Rakitan', 'Router MikroTik', 'Rak Buku', 'Sapu Lantai'];
        $pilihanRuangan = ['Ruang Kelas 10A', 'Ruang Kelas 11B', 'Ruang Kelas 12C', 'Lab Komputer', 'Perpustakaan', 'Ruang Guru', 'Ruang Kepala Sekolah', 'Gudang Sarpras', 'Lab Bahasa'];

        // Looping untuk membuat 150 data
        for ($i = 1; $i <= 150; $i++) {
            Fasilitas::create([
                'nama_barang' => $faker->randomElement($pilihanBarang),
                // Membuat kode barang unik (contoh: BRG-0015)
                'kode_barang' => 'BRG-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'ruangan'     => $faker->randomElement($pilihanRuangan),
                // Kita buat peluang 'Tersedia' lebih banyak daripada yang Rusak/Dipinjam
                'status'      => $faker->randomElement(['Tersedia', 'Tersedia', 'Tersedia', 'Sedang Dipinjam', 'Rusak']),
            ]);
        }
    }
}