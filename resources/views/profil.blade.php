@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="w-full space-y-6 p-6 md:p-8">
    <!-- Header Section -->
    <div class="flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-3xl font-black text-indigo-950 flex items-center gap-3 drop-shadow-sm">
                <span class="text-4xl">👤</span> Profil Saya
            </h1>
            <p class="mt-2 text-sm font-medium text-indigo-900/60">Kelola informasi data diri dan foto profil akun Anda.</p>
        </div>
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

    <!-- Form Profil -->
    <!-- PERHATIAN: Pastikan action form mengarah ke route update profil yang ada di controllermu -->
    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        @csrf
        @method('PUT')

        <!-- KOLOM KIRI: KARTU IDENTITAS & UPLOAD FOTO -->
        <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_-12px_rgba(79,70,229,0.15)] border-4 border-white overflow-hidden lg:col-span-1 relative">
            <!-- Cover Photo Background -->
            <div class="h-40 bg-gradient-to-r from-indigo-500 via-purple-500 to-fuchsia-500 relative overflow-hidden flex items-center justify-center">
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20"></div>
            </div>
            
            <div class="px-6 pb-10 text-center -mt-20 relative z-10">
                <!-- Foto Profil / Inisial (Bisa Diklik untuk Upload) -->
                <div class="relative inline-block group cursor-pointer" onclick="document.getElementById('fotoUpload').click()">
                    
                    <div id="avatarPreviewContainer" class="w-36 h-36 rounded-full bg-white text-indigo-600 border-4 border-white shadow-xl mx-auto flex items-center justify-center text-5xl font-black overflow-hidden relative transition-transform duration-300 group-hover:scale-105">
                        
                        {{-- Logika Menampilkan Foto Asli vs Inisial --}}
                        @if(auth()->user()->foto)
                            <!-- Jika user sudah punya foto di database -->
                            <img id="avatarPreview" src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto Profil" class="w-full h-full object-cover">
                        @else
                            <!-- Jika user belum punya foto, tampilkan inisial (sesuai kode aslimu) -->
                            <span id="avatarInitial">{{ strtoupper(substr(auth()->user()->nama_lengkap ?? 'U', 0, 1)) }}</span>
                            <img id="avatarPreview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                        @endif

                        <!-- Overlay Hover untuk Upload -->
                        <div class="absolute inset-0 bg-black/50 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-2xl">📷</span>
                            <span class="text-[10px] text-white font-bold mt-1 uppercase tracking-wider">Ubah Foto</span>
                        </div>
                    </div>
                </div>

                <!-- Input File Hidden -->
                <input type="file" id="fotoUpload" name="foto" accept="image/*" class="hidden" onchange="previewImage(event)">

                <!-- Nama & Role (Sesuai kode aslimu) -->
                <h2 class="mt-5 text-2xl font-black text-slate-800 capitalize leading-tight drop-shadow-sm">{{ auth()->user()->nama_lengkap }}</h2>
                <p class="mt-1 text-sm font-bold text-slate-500">{{ auth()->user()->username }}</p>
                
                <span class="mt-3 inline-flex items-center rounded-xl bg-indigo-50 px-4 py-1.5 text-xs font-extrabold text-indigo-700 border border-indigo-200 uppercase tracking-widest shadow-sm">
                    Hak Akses: {{ auth()->user()->role }}
                </span>
            </div>
        </div>

        <!-- KOLOM KANAN: FORM EDIT INFORMASI -->
        <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_-12px_rgba(79,70,229,0.15)] border-4 border-white p-8 lg:col-span-2">
            
            <!-- Seksi Identitas -->
            <div class="mb-8">
                <h3 class="text-xs font-black uppercase tracking-widest text-indigo-500 mb-6 flex items-center gap-2 border-b-2 border-indigo-50 pb-3">
                    <span class="text-lg">📋</span> Data Identitas
                </h3>
                
                <div class="space-y-5">
                    <!-- Sesuai kode aslimu -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-4 items-center border-b border-slate-50 pb-4">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Nama Lengkap</label>
                        <div class="sm:col-span-2">
                            <input type="text" name="nama_lengkap" value="{{ auth()->user()->nama_lengkap }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-bold text-slate-800 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-4 items-center border-b border-slate-50 pb-4">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Username / NISN</label>
                        <div class="sm:col-span-2">
                            <input type="text" value="{{ auth()->user()->username }}" readonly class="w-full rounded-xl border border-slate-200 bg-slate-100 px-4 py-2.5 text-sm font-bold text-slate-500 cursor-not-allowed">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-4 items-center pb-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Status Akun</label>
                        <div class="sm:col-span-2 flex items-center gap-2">
                            <span class="flex h-2.5 w-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-sm font-bold text-emerald-600">Aktif Terverifikasi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seksi Kontak -->
            <div class="mb-10">
                <h3 class="text-xs font-black uppercase tracking-widest text-purple-500 mb-6 flex items-center gap-2 border-b-2 border-purple-50 pb-3">
                    <span class="text-lg">📞</span> Informasi Kontak
                </h3>
                
                <div class="space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-4 items-center border-b border-slate-50 pb-4">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Alamat Email</label>
                        <div class="sm:col-span-2">
                            <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" placeholder="Masukkan email..." class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-bold text-slate-800 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-4 items-center border-b border-slate-50 pb-4">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">No. Handphone</label>
                        <div class="sm:col-span-2">
                            <input type="text" name="no_hp" value="{{ auth()->user()->no_hp ?? '' }}" placeholder="08xxxxxxxxxx" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-bold text-slate-800 focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-4 items-center pb-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1 sm:mb-0">Bergabung Sejak</label>
                        <div class="sm:col-span-2">
                            <!-- Sesuai kode aslimu -->
                            <span class="text-sm font-bold text-slate-700">{{ auth()->user()->created_at->format('d F Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end pt-4 border-t-2 border-slate-50">
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-3.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 hover:from-indigo-700 hover:to-purple-700 hover:-translate-y-1 transition-all duration-300">
                    💾 Simpan Perubahan
                </button>
            </div>

        </div>
    </form>
</div>

<!-- Script Preview Foto Sebelum Diupload -->
<script>
    function previewImage(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const preview = document.getElementById('avatarPreview');
                const initial = document.getElementById('avatarInitial');
                
                // Sembunyikan inisial huruf, tampilkan img preview
                if(initial) initial.style.display = 'none';
                
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection