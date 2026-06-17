@extends('layouts.app')

@section('title', 'Form Pengajuan Peminjaman')

@section('content')
<div style="max-width:720px; margin:32px auto; padding:24px; background:#f5f7fb; border-radius:16px; box-shadow:0 18px 45px rgba(24,39,75,0.08);">
    <div style="background:#ffffff; padding:28px; border-radius:16px; border:1px solid #e5e7eb;">
        <h1 style="font-size:1.75rem; font-weight:700; color:#111827; margin-bottom:16px;">Form Pengajuan Peminjaman</h1>
        <p style="color:#4b5563; margin-bottom:24px;">Isi data peminjaman dengan lengkap untuk ajukan fasilitas.</p>

        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: bold; border-left: 5px solid #10b981;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('peminjaman.store') }}" style="display:grid; gap:18px;">
            @csrf

            <div style="display:flex; flex-direction:column; gap:8px;">
                <label for="id_fasilitas" style="font-weight:600; color:#374151;">Pilih Fasilitas</label>
                <select id="id_fasilitas" name="id_fasilitas" required style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; background:#f9fafb; color:#111827; outline:none; transition:border-color .2s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#d1d5db'">
                    <option value="" disabled selected>Pilih fasilitas</option>
                    @foreach($fasilitas_tersedia as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>
                @error('id_fasilitas')<span style="color:#dc2626; font-size:0.9rem;">{{ $message }}</span>@enderror
            </div>

            <div style="display:flex; flex-direction:column; gap:8px;">
                <label for="tanggal_peminjaman" style="font-weight:600; color:#374151;">Tanggal Peminjaman</label>
                <input id="tanggal_peminjaman" name="tanggal_peminjaman" type="date" value="{{ old('tanggal_peminjaman') }}" required style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; background:#f9fafb; color:#111827; outline:none; transition:border-color .2s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#d1d5db'" />
                @error('tanggal_peminjaman')<span style="color:#dc2626; font-size:0.9rem;">{{ $message }}</span>@enderror
            </div>

            <div style="display:flex; flex-direction:column; gap:8px;">
                <label for="tanggal_kembali" style="font-weight:600; color:#374151;">Tanggal Kembali</label>
                <input id="tanggal_kembali" name="tanggal_kembali" type="date" value="{{ old('tanggal_kembali') }}" required style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; background:#f9fafb; color:#111827; outline:none; transition:border-color .2s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#d1d5db'" />
                @error('tanggal_kembali')<span style="color:#dc2626; font-size:0.9rem;">{{ $message }}</span>@enderror
            </div>

            <div style="display:flex; flex-direction:column; gap:8px;">
                <label for="jam_mulai" style="font-weight:600; color:#374151;">Jam Mulai</label>
                <input id="jam_mulai" name="jam_mulai" type="time" value="{{ old('jam_mulai') }}" required style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; background:#f9fafb; color:#111827; outline:none; transition:border-color .2s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#d1d5db'" />
                @error('jam_mulai')<span style="color:#dc2626; font-size:0.9rem;">{{ $message }}</span>@enderror
            </div>

            <div style="display:flex; flex-direction:column; gap:8px;">
                <label for="jam_selesai" style="font-weight:600; color:#374151;">Jam Selesai</label>
                <input id="jam_selesai" name="jam_selesai" type="time" value="{{ old('jam_selesai') }}" required style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; background:#f9fafb; color:#111827; outline:none; transition:border-color .2s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#d1d5db'" />
                @error('jam_selesai')<span style="color:#dc2626; font-size:0.9rem;">{{ $message }}</span>@enderror
            </div>

            <div style="display:flex; flex-direction:column; gap:8px;">
                <label for="durasi_sewa" style="font-weight:600; color:#374151;">Durasi Sewa</label>
                <input id="durasi_sewa" name="durasi_sewa" type="text" value="{{ old('durasi_sewa') }}" placeholder="Contoh: 2 Jam" required style="width:100%; padding:12px 14px; border:1px solid #d1d5db; border-radius:12px; background:#f9fafb; color:#111827; outline:none; transition:border-color .2s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#d1d5db'" />
                @error('durasi_sewa')<span style="color:#dc2626; font-size:0.9rem;">{{ $message }}</span>@enderror
            </div>

            <button type="submit" style="width:fit-content; padding:12px 24px; border:none; border-radius:12px; background:#2563eb; color:#ffffff; font-weight:700; cursor:pointer; transition:background .2s ease;">Ajukan Peminjaman</button>
        </form>
    </div>
</div>
@endsection