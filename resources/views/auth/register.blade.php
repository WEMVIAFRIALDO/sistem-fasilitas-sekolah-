<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Sistem Sarpras Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans text-slate-900 antialiased bg-white">
    <div class="flex min-h-screen">
        
        <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-blue-800 via-blue-700 to-blue-900 p-12 relative flex-col justify-between overflow-hidden">
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-40"></div>

            <div class="relative z-10 flex items-center gap-3 text-white">
                <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm text-xl shadow-lg">🏫</span>
                <span class="text-xl font-bold tracking-wide">Sarpras<span class="text-blue-300">Sekolah</span></span>
            </div>

            <div class="relative z-10 flex flex-col items-center text-center max-w-lg mx-auto w-full">
                <div class="w-48 h-48 sm:w-56 sm:h-56 bg-white rounded-full shadow-[0_20px_50px_rgba(0,0,0,0.3)] flex items-center justify-center mx-auto mb-10 relative group border-4 border-white/20 overflow-hidden">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo Sarpras" class="w-full h-full object-cover scale-110 group-hover:scale-125 transition-transform duration-500">
                </div>
                <h1 class="text-4xl font-extrabold text-white leading-tight mb-4">Mulai Perjalanan Anda</h1>
                <p class="text-base text-blue-100/90 leading-relaxed">Daftarkan diri Anda untuk mulai menggunakan fasilitas sekolah, melakukan peminjaman, dan melapor kerusakan.</p>
            </div>

            <div class="relative z-10 text-center text-sm font-medium text-blue-200/80">
                &copy; 2026 Manajemen Sarpras Sekolah.
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 bg-white relative overflow-y-auto">
            <div class="w-full max-w-md bg-white p-2 rounded-[2rem] lg:p-0 my-8">
                
                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-3xl font-bold text-slate-900">Buat Akun Baru ✨</h2>
                    <p class="mt-3 text-slate-500">Lengkapi data di bawah ini untuk mendaftar sebagai Siswa atau Guru.</p>
                </div>

                <form action="#" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label for="nama" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <input type="text" id="nama" name="nama" required class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all shadow-sm" placeholder="Contoh: Wemvi Afrialdo">
                        </div>
                    </div>

                    <div>
                        <label for="username" class="block text-sm font-semibold text-slate-700 mb-2">NISN / NIP (Username)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                            </div>
                            <input type="text" id="username" name="username" required class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all shadow-sm" placeholder="Masukkan nomor induk">
                        </div>
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-semibold text-slate-700 mb-2">Mendaftar Sebagai</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <select id="role" name="role" required class="block w-full pl-11 pr-10 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white appearance-none transition-all shadow-sm cursor-pointer">
                                <option value="" disabled selected>Pilih Peran Anda...</option>
                                <option value="Siswa">Siswa</option>
                                <option value="Guru">Guru</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input type="password" id="password" name="password" required class="block w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all shadow-sm" placeholder="Buat password yang kuat">
                        </div>
                    </div>

                    <button type="submit" class="w-full flex justify-center py-4 px-4 mt-8 border border-transparent rounded-xl shadow-lg shadow-blue-500/30 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:-translate-y-1">
                        Daftar Sekarang
                    </button>
                    
                    <div class="pt-6 text-center text-sm text-slate-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700 hover:underline transition-colors">Masuk di sini</a>
                    </div>

                </form>
                
            </div>
        </div>
    </div>
</body>
</html>