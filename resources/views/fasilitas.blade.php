@extends('layouts.app')
@section('title', 'Data Fasilitas')
@section('content')
<div class="w-full space-y-6 p-6 md:p-8">
    <div class="flex flex-col items-center justify-center text-center gap-5 mb-6">
        <div>
            <h1 class="text-4xl sm:text-5xl font-black text-slate-800 flex items-center justify-center gap-4 drop-shadow-sm">
                <span class="text-5xl sm:text-6xl">📦</span> Manajemen Fasilitas
            </h1>
            <p class="mt-3 text-base sm:text-lg font-medium text-slate-500 max-w-2xl mx-auto">
                Kelola inventaris fasilitas sekolah secara terstruktur dan aman.
            </p>
        </div>
        
        @if(auth()->user() && auth()->user()->role == 'Admin')
        <a href="{{ route('fasilitas.tambah') }}" class="mt-2 inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-sky-500 to-blue-600 px-8 py-3.5 text-base font-bold text-white shadow-lg shadow-sky-500/30 hover:from-sky-600 hover:to-blue-700 hover:-translate-y-1 transition-all duration-300">
            <span class="text-xl leading-none">+</span>
            Tambah Fasilitas
        </a>
        @endif
    </div>

    @if(session('success'))
    <div class="rounded-2xl border border-emerald-300 bg-gradient-to-r from-emerald-50 to-teal-50 px-6 py-4 text-sm text-emerald-800 shadow-md flex items-center gap-4">
        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
        <span class="font-extrabold tracking-wide">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-gradient-to-r from-blue-500 via-blue-600 to-indigo-600 px-8 py-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative overflow-hidden rounded-[2.5rem] shadow-xl shadow-blue-500/20 mb-8 border border-blue-400">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>

        <div class="relative z-10 w-full sm:w-96">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <span class="text-blue-500 font-bold text-lg">🔍</span>
            </div>
            <input type="text" id="searchInput" placeholder="Cari fasilitas atau kode..." class="w-full pl-12 pr-4 py-3 rounded-full border-0 bg-white/95 text-sm font-bold text-slate-800 focus:outline-none focus:bg-white focus:ring-4 focus:ring-sky-300/50 shadow-inner transition-all placeholder:text-slate-400">
        </div>
        
        <select id="statusFilter" class="relative z-10 inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/10 backdrop-blur-md px-5 py-3 text-sm font-bold text-white shadow-sm hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all cursor-pointer">
            <option value="" class="text-slate-800 font-bold">📋 Semua Status</option>
            <option value="Tersedia" class="text-slate-800 font-bold">Tersedia</option>
            <option value="Sedang Dipinjam" class="text-slate-800 font-bold">Dipinjam</option>
            <option value="Rusak" class="text-slate-800 font-bold">Rusak</option>
        </select>
    </div>

    <div class="bg-white rounded-[2rem] shadow-md border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                
                <thead class="bg-sky-500 text-white border-b-4 border-sky-600">
                    <tr>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest">No</th>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest">Nama Fasilitas</th>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest">Kode Barang</th>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest">Lokasi</th>
                        <th class="px-8 py-5 text-xs font-black uppercase tracking-widest">Status</th>
                        <th class="px-8 py-5 text-center text-xs font-black uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                
                <tbody id="tableBody" class="divide-y-2 divide-slate-200">
                    @forelse($data_fasilitas as $barang)
                    <tr class="transition-all duration-300 hover:bg-slate-50/80 group">
                        <td class="px-8 py-5 text-sm font-black text-sky-500 group-hover:text-sky-600">{{ $loop->iteration }}</td>
                        <td class="px-8 py-5">
                            <p class="text-sm font-extrabold text-slate-800 capitalize">{{ $barang->nama_barang }}</p>
                        </td>
                        <td class="px-8 py-5">
                            <span class="inline-flex items-center rounded-xl bg-slate-100 px-3 py-1.5 font-mono text-xs font-bold text-slate-600 border border-slate-300">{{ $barang->kode_barang }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <p class="text-sm font-bold text-slate-600 uppercase flex items-center gap-2">
                                <span class="flex items-center justify-center w-6 h-6 rounded-full bg-sky-100 text-xs">📍</span> 
                                {{ $barang->ruangan }}
                            </p>
                        </td>
                        <td class="px-8 py-5">
                            @if(strtolower($barang->status) === 'tersedia')
                                <span class="inline-flex items-center gap-1.5 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-extrabold text-emerald-700 shadow-sm">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span> Tersedia
                                </span>
                            @elseif(strtolower($barang->status) === 'sedang dipinjam')
                                <span class="inline-flex items-center gap-1.5 rounded-full border border-amber-200 bg-amber-50 px-3 py-1.5 text-xs font-extrabold text-amber-700 shadow-sm">
                                    <span class="h-2 w-2 rounded-full bg-amber-500"></span> Dipinjam
                                </span>
                            @elseif(strtolower($barang->status) === 'rusak')
                                <span class="inline-flex items-center gap-1.5 rounded-full border border-rose-200 bg-rose-50 px-3 py-1.5 text-xs font-extrabold text-rose-700 shadow-sm">
                                    <span class="h-2 w-2 rounded-full bg-rose-500"></span> Rusak
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-extrabold text-slate-700 shadow-sm">
                                    <span class="h-2 w-2 rounded-full bg-slate-400"></span> {{ $barang->status }}
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center justify-center gap-3">
                                @if(auth()->user() && auth()->user()->role == 'Admin')
                                    <a href="{{ route('fasilitas.edit', $barang->id) }}" class="flex items-center justify-center w-10 h-10 rounded-xl bg-amber-50 border-2 border-amber-200 text-amber-600 transition-all hover:bg-amber-500 hover:text-white hover:border-amber-500 shadow-sm hover:shadow-md hover:-translate-y-1" title="Edit Data">
                                        🛠️
                                    </a>
                                    <form action="{{ route('fasilitas.destroy', $barang->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex items-center justify-center w-10 h-10 rounded-xl bg-rose-50 border-2 border-rose-200 text-rose-600 transition-all hover:bg-rose-600 hover:text-white hover:border-rose-600 shadow-sm hover:shadow-md hover:-translate-y-1" title="Hapus Data">
                                            🗑️
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs font-extrabold text-slate-400 bg-slate-50 px-3 py-1.5 rounded-xl border border-slate-300">Read Only</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-24 text-center text-sm font-medium text-slate-500 bg-white">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-5xl mb-4 drop-shadow-sm">📭</span>
                                <p class="text-lg font-bold text-slate-700">Data fasilitas belum tersedia.</p>
                                <p class="text-sky-500 font-medium mt-1">Silakan tambahkan data baru melalui tombol di atas.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t-2 border-slate-200 bg-slate-50/50 px-8 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <p class="text-sm font-bold text-slate-500">Total Data: <span class="text-sky-600 text-lg font-black">{{ count($data_fasilitas) }}</span> fasilitas</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const tableBody = document.getElementById('tableBody');
    
    if (!searchInput || !statusFilter || !tableBody) return;

    const rows = tableBody.querySelectorAll('tr');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const filterValue = statusFilter.value.toLowerCase();

        rows.forEach(row => {
            if(row.cells.length <= 1) return; 

            const rowText = row.textContent.toLowerCase();
            const matchesSearch = rowText.includes(searchTerm);
            const matchesFilter = filterValue === "" || rowText.includes(filterValue);

            if (matchesSearch && matchesFilter) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterTable);
    statusFilter.addEventListener('change', filterTable);
});
</script>

@endsection