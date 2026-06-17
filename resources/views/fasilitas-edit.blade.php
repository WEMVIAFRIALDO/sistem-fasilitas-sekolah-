@extends('layouts.app')

@section('title', 'Edit Fasilitas')

@section('content')
<div style="max-width:720px; margin:32px auto; padding:24px; background:#f5f7fb; border-radius:16px; box-shadow:0 18px 45px rgba(24,39,75,0.08);">
    <div style="background:#ffffff; padding:28px; border-radius:16px; border:1px solid #e5e7eb;">
        <h1 style="font-size:1.75rem; font-weight:700; color:#111827; margin-bottom:16px;">Edit Fasilitas</h1>
        <p style="color:#4b5563; margin-bottom:24px;">Perbarui data fasilitas yang ingin diubah.</p>

        <form method="POST" action="{{ route('fasilitas.update', $fasilitas->id) }}" style="display:grid; gap:18px;">
            @csrf
            @method('PUT')

            <div style="display:flex; flex-direction:column; gap:8px;">
                <label for="nama_barang" style="font-weight:600; color:#374151;">Nama Barang</label>
                <input id="nama_barang" name="nama_barang" type="text" value="{{ old('nama_barang', $fasilitas->nama_barang) }}" placeholder="Masukkan nama barang" required style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; background:#f9fafb; color:#111827; outline:none; transition:border-color .2s ease;" onfocus="this.style.borderColor='#16a34a'" onblur="this.style.borderColor='#d1d5db'" />
                @error('nama_barang')<span style="color:#dc2626; font-size:0.9rem;">{{ $message }}</span>@enderror
            </div>

            <div style="display:flex; flex-direction:column; gap:8px;">
                <label for="ruangan" style="font-weight:600; color:#374151;">Ruangan</label>
                <input id="ruangan" name="ruangan" type="text" value="{{ old('ruangan', $fasilitas->ruangan) }}" placeholder="Masukkan ruangan" required style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; background:#f9fafb; color:#111827; outline:none; transition:border-color .2s ease;" onfocus="this.style.borderColor='#16a34a'" onblur="this.style.borderColor='#d1d5db'" />
                @error('ruangan')<span style="color:#dc2626; font-size:0.9rem;">{{ $message }}</span>@enderror
            </div>

            <div style="display:flex; flex-direction:column; gap:8px;">
                <label for="kode_barang" style="font-weight:600; color:#374151;">Kode Barang</label>
                <input id="kode_barang" name="kode_barang" type="text" value="{{ old('kode_barang', $fasilitas->kode_barang) }}" placeholder="Masukkan kode barang" required style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; background:#f9fafb; color:#111827; outline:none; transition:border-color .2s ease;" onfocus="this.style.borderColor='#16a34a'" onblur="this.style.borderColor='#d1d5db'" />
                @error('kode_barang')<span style="color:#dc2626; font-size:0.9rem;">{{ $message }}</span>@enderror
            </div>

            <div style="display:flex; flex-direction:column; gap:8px;">
                <label for="status" style="font-weight:600; color:#374151;">Status</label>
                <select id="status" name="status" required style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; background:#f9fafb; color:#111827; outline:none; transition:border-color .2s ease;" onfocus="this.style.borderColor='#16a34a'" onblur="this.style.borderColor='#d1d5db'">
                    <option value="" disabled {{ old('status', $fasilitas->status) ? '' : 'selected' }}>Pilih status</option>
                    <option value="Tersedia" {{ old('status', $fasilitas->status) === 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Sedang Dipinjam" {{ old('status', $fasilitas->status) === 'Sedang Dipinjam' ? 'selected' : '' }}>Sedang Dipinjam</option>
                    <option value="Dilaporkan Rusak" {{ old('status', $fasilitas->status) === 'Dilaporkan Rusak' ? 'selected' : '' }}>Dilaporkan Rusak</option>
                </select>
                @error('status')<span style="color:#dc2626; font-size:0.9rem;">{{ $message }}</span>@enderror
            </div>

            <button type="submit" style="width:fit-content; padding:12px 24px; border:none; border-radius:12px; background:#16a34a; color:#ffffff; font-weight:700; cursor:pointer; transition:background .2s ease;">Update Data</button>
        </form>
    </div>
</div>
@endsection
