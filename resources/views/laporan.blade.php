@extends('layouts.app')

@section('title', 'Laporan Kerusakan')

@section('content')
<div class="w-full space-y-6 p-6 md:p-8">
    <!-- Header Section -->
    <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-3xl font-black text-amber-950 flex items-center gap-3 drop-shadow-sm">
                <span class="text-4xl">🛠️</span> Data Laporan Kerusakan
            </h1>
            <p class="mt-2 text-sm font-medium text-amber-900/60">Laporkan kerusakan agar tim perawatan dapat menindaklanjuti secara cepat.</p>
        </div>
        
        {{-- HAK AKSES: Selain Admin (Siswa/Guru) boleh Lapor Barang --}}
        @if(auth()->user()->role != 'Admin')
        <a href="{{ route('laporan.tambah') }}" class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-amber-500 to-orange-500 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-amber-500/30 hover:from-amber-600 hover:to-orange-600 hover:-translate-y-1 transition-all duration-300">
            <span class="text-xl leading-none">+</span>
            Lapor Barang Rusak
        </a>
        @endif
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="rounded-2xl border border-emerald-300 bg-gradient-to-r from-emerald-50 to-teal-50 px-6 py-4 text-sm text-emerald-800 shadow-md flex items-center gap-4">
        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <span class="font-extrabold tracking-wide">{{ session('success') }}</span>
    </div>
    @endif

    <!-- Card Table Container (Amber Premium UI) -->
    <div class="rounded-[2.5rem] border-4 border-white bg-white shadow-[0_20px_50px_-12px_rgba(245,158,11,0.15)] overflow-hidden">
        
        
        <!-- CARD TOOLBAR LAPORAN -->
        <div class="bg-gradient-to-r from-amber-500 via-amber-500 to-orange-500 px-8 py-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

            <div class="relative z-10 w-full sm:w-96">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="text-amber-500 font-bold text-lg">🔍</span>
                </div>
                <input type="text" id="searchInput" placeholder="Cari laporan kerusakan..." class="w-full pl-12 pr-4 py-3 rounded-2xl border-0 bg-white/95 text-sm font-bold text-slate-800 focus:outline-none focus:bg-white focus:ring-4 focus:ring-amber-300/50 shadow-inner transition-all placeholder:text-slate-400">
            </div>
            
            <select id="statusFilter" class="relative z-10 inline-flex items-center gap-2 rounded-2xl border border-white/30 bg-white/20 backdrop-blur-md px-5 py-3 text-sm font-bold text-white shadow-sm hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all cursor-pointer">
                <option value="" class="text-slate-800 font-bold">📋 Semua Status</option>
                <option value="Tindak Lanjut Baru" class="text-slate-800 font-bold">Baru</option>
                <option value="Sedang Diproses" class="text-slate-800 font-bold">Diproses</option>
                <option value="Selesai" class="text-slate-800 font-bold">Selesai</option>
            </select>
        </div>
            
            <button class="relative z-10 inline-flex items-center gap-2 rounded-2xl border border-white/30 bg-white/20 backdrop-blur-md px-5 py-3 text-sm font-bold text-white shadow-sm hover:bg-white/30 hover:border-white/50 transition-all">
                <span>⚙️</span> Filter Laporan
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-amber-50/80 border-b-2 border-amber-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-amber-800 whitespace-nowrap">Pelapor</th>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-amber-800 whitespace-nowrap">Fasilitas</th>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-amber-800 whitespace-nowrap">Deskripsi</th>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-amber-800 whitespace-nowrap">Bukti Foto</th>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-amber-800 whitespace-nowrap">Tanggal Lapor</th>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-amber-800 whitespace-nowrap">Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-emerald-50/50">
                    @forelse($data_laporan as $l)
                    <tr class="transition-all duration-300 hover:bg-amber-50/60 align-top group">
                        <td class="px-8 py-5">
                            <span class="text-sm font-extrabold text-slate-800">{{ $l->nama_lengkap }}</span>
                        </td>
                        
                        <td class="px-8 py-5">
                            <div class="flex flex-col items-start gap-1.5">
                                <span class="text-sm font-black text-slate-900 capitalize bg-slate-50 border border-slate-100 px-3 py-1 rounded-lg">{{ $l->nama_barang }}</span>
                                <span class="text-xs font-bold text-slate-500 flex items-center gap-1">
                                    <span class="text-sm">📍</span> {{ $l->ruangan }}
                                </span>
                            </div>
                        </td>

                        <td class="px-8 py-5">
                            <p class="text-sm font-semibold text-slate-600 max-w-xs leading-relaxed">{{ $l->deskripsi_kerusakan }}</p>
                        </td>
                        
                        <td class="px-8 py-5">
                            @if($l->foto)
                                <a href="{{ asset('storage/' . $l->foto) }}" target="_blank" class="block relative hover:-translate-y-1 transition-transform duration-300">
                                    <img src="{{ asset('storage/' . $l->foto) }}" alt="Bukti Rusak" class="h-20 w-20 rounded-2xl border-2 border-white object-cover shadow-md">
                                    <div class="absolute inset-0 rounded-2xl shadow-inner pointer-events-none"></div>
                                </a>
                            @else
                                <div class="h-20 w-20 rounded-2xl bg-slate-100 border-2 border-dashed border-slate-300 flex items-center justify-center">
                                    <span class="text-[10px] font-bold text-slate-400 text-center uppercase tracking-wide">No<br>Photo</span>
                                </div>
                            @endif
                        </td>

                        <td class="px-8 py-5">
                            <span class="text-sm font-bold text-slate-500 bg-white border border-slate-200 shadow-sm px-3 py-1.5 rounded-xl whitespace-nowrap">{{ $l->tanggal_lapor }}</span>
                        </td>
                        
                        <td class="px-8 py-5">
                            {{-- LOGIKA ADMIN: Form Ubah Status Premium --}}
                            @if(auth()->user()->role == 'Admin')
                                <form action="{{ route('laporan.update_status', $l->id_laporan) }}" method="POST" class="flex flex-col gap-3 min-w-[150px]">
                                    @csrf
                                    @method('PUT')
                                    <select name="status_tindak_lanjut" class="rounded-xl border-2 border-amber-100 bg-white px-3 py-2 text-xs font-extrabold text-slate-700 shadow-sm focus:border-amber-400 focus:outline-none focus:ring-4 focus:ring-amber-500/20 transition-all cursor-pointer">
                                        <option value="Tindak Lanjut Baru" {{ $l->status_tindak_lanjut == 'Tindak Lanjut Baru' ? 'selected' : '' }}>Tindak Lanjut Baru</option>
                                        <option value="Sedang Diproses" {{ $l->status_tindak_lanjut == 'Sedang Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                        <option value="Selesai" {{ $l->status_tindak_lanjut == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    <button type="submit" class="rounded-xl bg-amber-500 px-4 py-2 text-xs font-bold text-white shadow-md hover:bg-amber-600 hover:shadow-lg transition-all hover:-translate-y-0.5">Simpan Perubahan</button>
                                </form>
                            @else
                                {{-- Tampilan Badge Premium untuk Siswa/Guru --}}
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-extrabold border shadow-sm whitespace-nowrap
                                    @if($l->status_tindak_lanjut == 'Selesai') bg-emerald-100 text-emerald-800 border-emerald-300
                                    @elseif($l->status_tindak_lanjut == 'Sedang Diproses') bg-blue-100 text-blue-800 border-blue-300
                                    @else bg-amber-100 text-amber-800 border-amber-300 @endif">
                                    @if($l->status_tindak_lanjut == 'Tindak Lanjut Baru') <span class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span> @endif
                                    {{ $l->status_tindak_lanjut }}
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-24 text-center text-sm font-medium text-amber-900 bg-amber-50/30">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-5xl mb-4 drop-shadow-sm">📭</span>
                                <p class="text-lg font-bold">Data laporan belum tersedia.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="border-t-2 border-amber-100 bg-amber-50/50 px-8 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <p class="text-sm font-bold text-amber-900">Total Laporan: <span class="text-amber-600 text-lg">{{ count($data_laporan) }}</span> data</p>
        </div>
    </div>
</div>
@endsection