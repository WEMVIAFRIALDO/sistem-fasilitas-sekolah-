@extends('layouts.app')

@section('title', 'Data Peminjaman')

@section('content')
<div class="w-full space-y-6 p-6 md:p-8">
    <!-- Header Section -->
    <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-3xl font-black text-emerald-950 flex items-center gap-3 drop-shadow-sm">
                <span class="text-4xl">🤝</span> Daftar Peminjaman
            </h1>
            <p class="mt-2 text-sm font-medium text-emerald-900/60">Ajukan peminjaman dan pantau status pengembalian secara real-time.</p>
        </div>
        
        {{-- HAK AKSES: Selain Admin (Siswa/Guru) boleh melihat tombol Ajukan Peminjaman --}}
        @if(auth()->user()->role != 'Admin')
        <a href="{{ route('peminjaman.tambah') }}" class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-emerald-500/30 hover:from-emerald-600 hover:to-teal-700 hover:-translate-y-1 transition-all duration-300">
            <span class="text-xl leading-none">+</span>
            Ajukan Peminjaman
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

    <!-- Card Table Container (Emerald Premium UI) -->
    <div class="rounded-[2.5rem] border-4 border-white bg-white shadow-[0_20px_50px_-12px_rgba(16,185,129,0.15)] overflow-hidden">
        
        <!-- CARD TOOLBAR -->
        <!-- CARD TOOLBAR PEMINJAMAN -->
        <div class="bg-gradient-to-r from-emerald-500 via-emerald-600 to-teal-600 px-8 py-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

            <div class="relative z-10 w-full sm:w-96">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="text-emerald-500 font-bold text-lg">🔍</span>
                </div>
                <input type="text" id="searchInput" placeholder="Cari nama peminjam atau barang..." class="w-full pl-12 pr-4 py-3 rounded-2xl border-0 bg-white/95 text-sm font-bold text-slate-800 focus:outline-none focus:bg-white focus:ring-4 focus:ring-emerald-300/50 shadow-inner transition-all placeholder:text-slate-400">
            </div>
            
            <select id="statusFilter" class="relative z-10 inline-flex items-center gap-2 rounded-2xl border border-white/30 bg-white/20 backdrop-blur-md px-5 py-3 text-sm font-bold text-white shadow-sm hover:bg-white/30 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all cursor-pointer">
                <option value="" class="text-slate-800 font-bold">📋 Semua Status</option>
                <option value="Pending" class="text-slate-800 font-bold">Pending</option>
                <option value="Disetujui" class="text-slate-800 font-bold">Disetujui</option>
                <option value="Selesai" class="text-slate-800 font-bold">Selesai</option>
                <option value="Ditolak" class="text-slate-800 font-bold">Ditolak</option>
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-emerald-50/80 border-b-2 border-emerald-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-emerald-800">Peminjam</th>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-emerald-800">Barang</th>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-emerald-800">Tanggal</th>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest text-emerald-800">Status & Aksi</th>
                    </tr>
                </thead>
                
                <tbody id="tableBody" class="divide-y divide-emerald-50/50">
                    @forelse($data_peminjaman as $p)
                    <tr class="transition-all duration-300 hover:bg-emerald-50/60 group">
                        <td class="px-8 py-5">
                            <p class="text-sm font-extrabold text-slate-800">{{ $p->nama_lengkap }}</p>
                        </td>
                        <td class="px-8 py-5">
                            <p class="text-sm font-bold text-slate-600 capitalize bg-slate-50 border border-slate-100 px-3 py-1.5 rounded-xl inline-block">{{ $p->nama_barang }}</p>
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-sm font-bold text-slate-500 flex items-center gap-2">
                                <span class="text-lg">📅</span> {{ $p->tanggal_peminjaman }}
                            </span>
                        </td>
                        <td class="px-8 py-5">
                            
                            {{-- LOGIKA TOMBOL SAKTI ADMIN --}}
                            @if(auth()->user()->role == 'Admin')
                                @if($p->status_verifikasi == 'Pending')
                                    <div class="flex items-center gap-3">
                                        <form action="{{ route('peminjaman.verifikasi', $p->id_peminjaman) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button name="status" value="Disetujui" title="Setujui" class="inline-flex items-center gap-2 rounded-xl bg-emerald-100 border-2 border-emerald-200 px-3 py-2 text-xs font-extrabold text-emerald-700 shadow-sm hover:bg-emerald-500 hover:text-white hover:border-emerald-500 transition-all hover:-translate-y-1">
                                                ✅ Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('peminjaman.verifikasi', $p->id_peminjaman) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button name="status" value="Ditolak" title="Tolak" class="inline-flex items-center gap-2 rounded-xl bg-rose-100 border-2 border-rose-200 px-3 py-2 text-xs font-extrabold text-rose-700 shadow-sm hover:bg-rose-500 hover:text-white hover:border-rose-500 transition-all hover:-translate-y-1">
                                                ❌ Tolak
                                            </button>
                                        </form>
                                    </div>
                                @elseif($p->status_verifikasi == 'Disetujui')
                                    <form action="{{ route('peminjaman.verifikasi', $p->id_peminjaman) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button name="status" value="Selesai" title="Tandai Selesai" class="inline-flex items-center gap-2 rounded-xl bg-blue-100 border-2 border-blue-200 px-3 py-2 text-xs font-extrabold text-blue-700 shadow-sm hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all hover:-translate-y-1">
                                            🔙 Tandai Selesai
                                        </button>
                                    </form>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-extrabold border bg-slate-100 text-slate-500 border-slate-200">
                                        {{ $p->status_verifikasi }}
                                    </span>
                                @endif

                            {{-- LOGIKA TAMPILAN UNTUK SISWA & GURU --}}
                            @else
                                @if($p->status_verifikasi == 'Disetujui')
                                    <div class="flex items-center gap-3">
                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-300 bg-emerald-100 px-3 py-1.5 text-xs font-extrabold text-emerald-800 shadow-sm">
                                            <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span> {{ $p->status_verifikasi }}
                                        </span>
                                        <form action="{{ route('peminjaman.kembali', $p->id_peminjaman) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <button type="submit" onclick="return confirm('Apakah kamu sudah mengembalikan barang ini ke ruang Sarpras?')" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 px-4 py-2 text-xs font-bold text-white shadow-md hover:from-emerald-600 hover:to-teal-600 transition-all hover:-translate-y-1">
                                                🔄 Kembalikan
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-xs font-extrabold border shadow-sm
                                        {{ $p->status_verifikasi == 'Pending' ? 'bg-amber-100 text-amber-800 border-amber-300' : '' }}
                                        {{ $p->status_verifikasi == 'Ditolak' ? 'bg-rose-100 text-rose-800 border-rose-300' : '' }}
                                        {{ $p->status_verifikasi == 'Selesai' ? 'bg-slate-100 text-slate-600 border-slate-200' : '' }}">
                                        {{ $p->status_verifikasi }}
                                    </span>
                                @endif
                            @endif

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-24 text-center text-sm font-medium text-emerald-900 bg-emerald-50/30">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-5xl mb-4 drop-shadow-sm">📭</span>
                                <p class="text-lg font-bold">Data peminjaman belum tersedia.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="border-t-2 border-emerald-100 bg-emerald-50/50 px-8 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <p class="text-sm font-bold text-emerald-900">Total Data: <span class="text-emerald-600 text-lg">{{ count($data_peminjaman) }}</span> peminjaman</p>
        </div>
    </div>
</div>

<!-- Script Live Search & Filter -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const tableBody = document.getElementById('tableBody');
    
    // Pastikan elemen ada
    if (!searchInput || !statusFilter || !tableBody) return;

    const rows = tableBody.querySelectorAll('tr');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const filterValue = statusFilter.value.toLowerCase();

        rows.forEach(row => {
            // Abaikan baris peringatan "Data Kosong" jika ada
            if(row.cells.length <= 1) return; 

            // Ambil seluruh teks dalam satu baris (pencarian global)
            const rowText = row.textContent.toLowerCase();
            
            // Cek apakah teks cocok dengan search bar & dropdown filter
            const matchesSearch = rowText.includes(searchTerm);
            const matchesFilter = filterValue === "" || rowText.includes(filterValue);

            // Tampilkan baris jika cocok, sembunyikan jika tidak
            if (matchesSearch && matchesFilter) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Jalankan fungsi filter setiap kali user mengetik atau memilih dropdown
    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);
});
</script>

@endsection