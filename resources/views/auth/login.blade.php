<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Sarpras - Autentikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .form-transition { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }

        /* INI YANG DIUBAH: Kotak form jadi Biru Pastel Adem (Soft Frosty Blue) */
        .glass-panel-soft {
            background: rgba(219, 234, 254, 0.85); /* Warna biru pastel yang sangat adem di mata */
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.15); /* Shadow kebiruan */
        }
        
        /* Input putih bersih agar menonjol dari background form yang biru pastel */
        .input-solid {
            background: #ffffff;
            border: 1px solid rgba(148, 163, 184, 0.4);
            color: #0f172a;
        }
        .input-solid:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            outline: none;
        }
    </style>
</head>
<body class="font-sans text-slate-900 antialiased overflow-hidden min-h-screen flex bg-slate-50">
    
    <div class="flex w-full min-h-screen">
        
        <!-- SISI KIRI: Biru Sekolah yang Cerah & Ramah -->
        <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-blue-500 via-blue-600 to-blue-800 p-12 flex-col justify-between relative shadow-[10px_0_30px_rgba(0,0,0,0.1)] z-20 overflow-hidden">
            
            <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-white rounded-full mix-blend-overlay filter blur-[80px] opacity-30 pointer-events-none"></div>

            <div class="relative z-10 flex items-center justify-between w-full">
                <div class="flex items-center gap-3 text-white">
                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm text-xl border border-white/30 shadow-sm">🏫</span>
                    <span class="text-xl font-bold tracking-wide">Sarpras<span class="text-blue-200">Sekolah</span></span>
                </div>
                <div class="flex gap-6 text-sm font-medium text-blue-100">
                    <a href="#" class="hover:text-white transition-colors">Tentang Kami</a>
                    <a href="#" class="hover:text-white transition-colors">Bantuan</a>
                </div>
            </div>

            <div class="relative z-10 flex flex-col items-center text-center max-w-lg mx-auto w-full">
                <div class="w-48 h-48 sm:w-56 sm:h-56 rounded-full shadow-2xl mx-auto mb-10 border-4 border-white overflow-hidden bg-white">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" class="w-full h-full object-cover scale-[1.15]" style="filter: contrast(1.1) brightness(1.05);">
                </div>
                <h1 class="text-4xl font-extrabold text-white leading-tight mb-4 drop-shadow-sm">Sistem Fasilitas Sekolah</h1>
                <p class="text-blue-100 leading-relaxed max-w-md">Platform terintegrasi yang cerdas, cepat, dan ramah pengguna untuk sekolah modern.</p>
            </div>

            <div class="relative z-10 text-sm font-medium text-blue-200/70 text-center">
                &copy; 2026 Manajemen Sarpras Sekolah.
            </div>
        </div>

        <!-- SISI KANAN: Background Layar Utama -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 relative bg-[#f8fafc] z-10">
            
            <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-blue-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 pointer-events-none"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[400px] h-[400px] bg-indigo-200 rounded-full mix-blend-multiply filter blur-[100px] opacity-40 pointer-events-none"></div>

            <div class="w-full max-w-md relative min-h-[550px] flex items-center justify-center z-20">

                <!-- FORM LOGIN -->
                <div id="login-form" class="glass-panel-soft w-full p-10 rounded-[2rem] absolute form-transition transform scale-100 opacity-100 z-20">
                    <div class="mb-8 text-center lg:text-left">
                        <h2 class="text-3xl font-extrabold text-slate-800">Selamat Datang 👋</h2>
                        <p class="mt-2 text-slate-600 text-sm">Silakan login menggunakan akun Anda.</p>
                    </div>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        
                        <div class="mb-5">
                            <label class="block text-xs font-bold text-blue-800 uppercase tracking-wide mb-2 ml-1">Username / NISN</label>
                            <input type="text" name="username" required class="input-solid w-full px-5 py-3.5 rounded-xl transition-all" placeholder="Masukkan ID Anda...">
                        </div>

                        <div class="mb-5">
                            <label class="block text-xs font-bold text-blue-800 uppercase tracking-wide mb-2 ml-1">Password</label>
                            <input type="password" name="password" required class="input-solid w-full px-5 py-3.5 rounded-xl transition-all" placeholder="••••••••">
                        </div>
                        
                        <div class="flex items-center justify-between mt-2 text-sm">
                            <label class="flex items-center cursor-pointer text-slate-600 hover:text-blue-800 transition">
                                <input type="checkbox" name="remember" class="mr-2 h-4 w-4 text-blue-600 rounded border-slate-300">
                                <span class="font-medium">Ingat saya</span>
                            </label>
                            <a href="#" class="font-bold text-blue-700 hover:text-blue-500">Lupa password?</a>
                        </div>

                        <button type="submit" class="w-full py-4 mt-8 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/40 transition-all hover:-translate-y-1">
                            MASUK KE SISTEM
                        </button>
                        
                        <div class="pt-6 text-center text-sm text-slate-600 border-t border-blue-200/50 mt-6">
                            Belum punya akun? 
                            <button type="button" onclick="toggleForm()" class="font-bold text-blue-700 hover:text-blue-500 transition-colors uppercase tracking-wide ml-1">Daftar Siswa</button>
                        </div>
                    </form>
                </div>

                <!-- FORM REGISTER (KHUSUS SISWA) -->
                <div id="register-form" class="glass-panel-soft w-full p-10 rounded-[2rem] absolute form-transition transform scale-95 opacity-0 pointer-events-none z-10">
                    <div class="mb-6 text-center lg:text-left">
                        <h2 class="text-3xl font-extrabold text-slate-800">Registrasi Siswa ✨</h2>
                        <p class="mt-2 text-slate-600 text-sm">Isi biodata Anda untuk akses sistem.</p>
                    </div>

                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" name="role" value="Siswa">
                        
                        <div class="mb-4">
                            <label class="block text-xs font-bold text-blue-800 uppercase tracking-wide mb-2 ml-1">Nama Lengkap</label>
                            <input type="text" name="nama" required class="input-solid w-full px-5 py-3.5 rounded-xl transition-all" placeholder="Contoh: Wemvi Afrialdo">
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-blue-800 uppercase tracking-wide mb-2 ml-1">NISN Siswa</label>
                            <input type="text" name="username" required class="input-solid w-full px-5 py-3.5 rounded-xl transition-all" placeholder="Masukkan NISN aktif...">
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-blue-800 uppercase tracking-wide mb-2 ml-1">Password</label>
                            <input type="password" name="password" required class="input-solid w-full px-5 py-3.5 rounded-xl transition-all" placeholder="Buat password...">
                        </div>
                        
                        <button type="submit" class="w-full py-4 mt-8 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-700 shadow-lg shadow-blue-500/40 transition-all hover:-translate-y-1">
                            DAFTAR AKUN
                        </button>
                        
                        <div class="pt-4 text-center text-sm text-slate-600 border-t border-blue-200/50 mt-6">
                            Sudah punya akun? 
                            <button type="button" onclick="toggleForm()" class="font-bold text-blue-700 hover:text-blue-500 transition-colors uppercase tracking-wide ml-1">Login di sini</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        let isLoginVisible = true;

        function toggleForm() {
            if (isLoginVisible) {
                loginForm.classList.replace('scale-100', 'scale-95');
                loginForm.classList.replace('opacity-100', 'opacity-0');
                loginForm.classList.add('pointer-events-none');
                loginForm.classList.replace('z-20', 'z-10');

                registerForm.classList.remove('pointer-events-none');
                registerForm.classList.replace('z-10', 'z-20');
                registerForm.classList.replace('scale-95', 'scale-100');
                registerForm.classList.replace('opacity-0', 'opacity-100');
            } else {
                registerForm.classList.replace('scale-100', 'scale-95');
                registerForm.classList.replace('opacity-100', 'opacity-0');
                registerForm.classList.add('pointer-events-none');
                registerForm.classList.replace('z-20', 'z-10');

                loginForm.classList.remove('pointer-events-none');
                loginForm.classList.replace('z-10', 'z-20');
                loginForm.classList.replace('scale-95', 'scale-100');
                loginForm.classList.replace('opacity-0', 'opacity-100');
            }
            isLoginVisible = !isLoginVisible;
        }
    </script>
</body>
</html>