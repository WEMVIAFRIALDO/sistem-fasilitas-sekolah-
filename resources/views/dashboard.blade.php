@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Efek melayang saat kartu di-hover */
    .hover-float {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .hover-float:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    /* Efek Kaca (Glassmorphism) untuk Badge di Header */
    .glass-badge {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Pola Background Header (Opsional untuk estetika) */
    .bg-pattern {
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
</style>

<div class="w-full space-y-8 p-4 md:p-6 lg:p-8">

    <!-- ================= HEADER / BANNER UTAMA ================= -->
    <div class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-800 p-8 md:p-10 shadow-2xl">
        <div class="absolute inset-0 bg-pattern pointer-events-none"></div>
        <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-indigo-500/20 blur-3xl pointer-events-none"></div>
        <div class="absolute -left-20 -bottom-20 h-64 w-64 rounded-full bg-blue-500/20 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center gap-6">
            <div class="flex-shrink-0 h-20 w-20 rounded-2xl glass-badge flex items-center justify-center text-white shadow-inner transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1v1H9V7zm5 0h1v1h-1V7zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1zm-3 4H2v5h15v-5z" />
                </svg>
            </div>

            <div>
                <div class="glass-badge inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-black text-indigo-100 tracking-widest uppercase mb-4 shadow-sm">
                    <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Sistem Sarpras Terpadu
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight">Untuk Hari Ini dan Masa Depan</h1>
                <p class="mt-3 text-sm md:text-base font-medium text-slate-300 max-w-2xl leading-relaxed">
                    Selamat Datang, <strong class="text-white">{{ auth()->user()->nama_lengkap ?? 'User' }}</strong>. Kelola inventaris fasilitas sivitas akademika, pantau peminjaman, dan tangani laporan kerusakan dengan cepat dan profesional.
                </p>
            </div>
        </div>
    </div>

    <!-- ================= 3 KARTU STATISTIK (ANGKA) ================= -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="bg-white rounded-[1.5rem] p-6 shadow-xl shadow-slate-200/50 border border-slate-100 border-t-4 border-t-blue-500 flex items-start gap-5 hover:-translate-y-1 transition-transform duration-300">
            <div class="h-14 w-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-500 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <h3 class="text-xs font-extrabold text-slate-400 uppercase tracking-wider mb-1">Total Fasilitas</h3>
                <p class="text-4xl font-black text-slate-800">{{ $total_fasilitas ?? 153 }}</p>
            </div>
        </div>

        <div class="bg-white rounded-[1.5rem] p-6 shadow-xl shadow-slate-200/50 border border-slate-100 border-t-4 border-t-emerald-500 flex items-start gap-5 hover:-translate-y-1 transition-transform duration-300">
            <div class="h-14 w-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-500 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <h3 class="text-xs font-extrabold text-slate-400 uppercase tracking-wider mb-1">Sedang Dipinjam</h3>
                <p class="text-4xl font-black text-slate-800">{{ $total_dipinjam ?? 0 }}</p>
            </div>
        </div>

        <div class="bg-white rounded-[1.5rem] p-6 shadow-xl shadow-slate-200/50 border border-slate-100 border-t-4 border-t-amber-500 flex items-start gap-5 hover:-translate-y-1 transition-transform duration-300">
            <div class="h-14 w-14 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-500 flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div>
                <h3 class="text-xs font-extrabold text-slate-400 uppercase tracking-wider mb-1">Laporan Kerusakan</h3>
                <p class="text-4xl font-black text-slate-800">{{ $total_laporan ?? 3 }}</p>
            </div>
        </div>

    </div>

    <!-- ================= 3 KARTU MENU (AKSI UTAMA - VERSI LEBIH TERANG & GLOWING) ================= -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pt-4">
        
        <!-- Menu 1: Data Fasilitas -->
        <div class="hover-float bg-gradient-to-b from-white to-blue-50/80 rounded-[2rem] p-8 shadow-xl shadow-slate-200/50 border border-blue-200 flex flex-col h-full group">
            <div class="h-16 w-16 rounded-2xl bg-blue-500 shadow-lg shadow-blue-500/40 flex items-center justify-center text-white mb-6 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h2 class="text-xl font-black text-slate-800 mb-3 group-hover:text-blue-600 transition-colors">Data Fasilitas</h2>
            <p class="text-sm font-medium text-slate-600 mb-8 flex-grow">Kelola inventaris barang dan fasilitas sekolah secara terstruktur dan termonitor.</p>
            <a href="{{ route('fasilitas') }}" class="inline-flex items-center justify-between w-full px-6 py-3.5 bg-white hover:bg-blue-600 text-blue-600 hover:text-white text-sm font-bold rounded-xl transition-all duration-300 border border-blue-200 hover:border-transparent shadow-sm">
                Lihat Selengkapnya
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <!-- Menu 2: Peminjaman -->
        <div class="hover-float bg-gradient-to-b from-white to-emerald-50/80 rounded-[2rem] p-8 shadow-xl shadow-slate-200/50 border border-emerald-200 flex flex-col h-full group">
            <div class="h-16 w-16 rounded-2xl bg-emerald-500 shadow-lg shadow-emerald-500/40 flex items-center justify-center text-white mb-6 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
            </div>
            <h2 class="text-xl font-black text-slate-800 mb-3 group-hover:text-emerald-600 transition-colors">Peminjaman</h2>
            <p class="text-sm font-medium text-slate-600 mb-8 flex-grow">Pantau proses sirkulasi peminjaman barang dan pastikan pengembalian tepat waktu.</p>
            <a href="{{ route('peminjaman') }}" class="inline-flex items-center justify-between w-full px-6 py-3.5 bg-white hover:bg-emerald-600 text-emerald-600 hover:text-white text-sm font-bold rounded-xl transition-all duration-300 border border-emerald-200 hover:border-transparent shadow-sm">
                Lihat Selengkapnya
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <!-- Menu 3: Lapor Kerusakan -->
        <div class="hover-float bg-gradient-to-b from-white to-amber-50/80 rounded-[2rem] p-8 shadow-xl shadow-slate-200/50 border border-amber-200 flex flex-col h-full group">
            <div class="h-16 w-16 rounded-2xl bg-amber-500 shadow-lg shadow-amber-500/40 flex items-center justify-center text-white mb-6 transform transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <h2 class="text-xl font-black text-slate-800 mb-3 group-hover:text-amber-600 transition-colors">Lapor Kerusakan</h2>
            <p class="text-sm font-medium text-slate-600 mb-8 flex-grow">Segera buat laporan kerusakan barang dan bantu tim perawatan bertindak cepat.</p>
            <a href="{{ route('laporan') }}" class="inline-flex items-center justify-between w-full px-6 py-3.5 bg-white hover:bg-amber-500 text-amber-600 hover:text-white text-sm font-bold rounded-xl transition-all duration-300 border border-amber-200 hover:border-transparent shadow-sm">
                Lihat Selengkapnya
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

    </div>
</div>
@endsection