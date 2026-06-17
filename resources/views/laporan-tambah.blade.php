@extends('layouts.app')

@section('title', 'Lapor Kerusakan')

@section('content')
<div style="padding: 20px; max-width: 600px; margin: 0 auto;">
    <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h2 style="color: #1f2937; margin-top: 0;">Form Laporan Kerusakan</h2>
        <p style="color: #6b7280; margin-bottom: 20px;">Silakan isi detail fasilitas yang mengalami kerusakan beserta buktinya.</p>

        {{-- ⚠️ MANTRA SAKTI UPLOAD: enctype="multipart/form-data" --}}
        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Pilih Fasilitas</label>
                <select name="id_fasilitas" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
                    <option value="">-- Pilih Barang --</option>
                    @foreach($fasilitas as $f)
                        {{-- ✅ INI YANG DIUBAH: Tambah lokasi ruangan --}}
                        <option value="{{ $f->id }}">{{ $f->nama_barang }} - Lokasi: {{ $f->ruangan }} (Kode: {{ $f->kode_barang }})</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Tanggal Lapor</label>
                <input type="date" name="tanggal_lapor" required style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Deskripsi Kerusakan</label>
                <textarea name="deskripsi_kerusakan" rows="4" required placeholder="Contoh: Kaki meja patah, proyektor mati total..." style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px;"></textarea>
            </div>

            {{-- ⚠️ INI KOTAK UPLOAD FOTONYA --}}
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Foto Bukti Kerusakan (Opsional)</label>
                <input type="file" name="foto" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; background: #f9fafb;">
                <small style="color: #6b7280; display: block; margin-top: 5px;">Format: JPG, JPEG, PNG. Maksimal ukuran: 2MB.</small>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: #ef4444; color: white; padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; width: 100%;">
                    Kirim Laporan
                </button>
                <a href="{{ route('laporan') }}" style="background: #e5e7eb; color: #374151; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; text-align: center; width: 100%;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection