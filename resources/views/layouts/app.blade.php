<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','Dashboard - Sistem Sarpras')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS Reset Super Ketat: Mematikan paksa semua ruang kosong bawaan browser */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { width: 100%; min-height: 100vh; background-color: #f1f5f9; } /* bg-slate-100 */
        body, * { user-select: none; cursor: default; }
        a, button, [role="button"] { cursor: pointer; }
        textarea, input[type="text"], input[type="email"], input[type="password"], input[type="search"], input[type="number"], input[type="tel"], input[type="url"], input[type="date"], input[type="time"], input[type="datetime-local"], select { user-select: text; cursor: text; }
    </style>

    <script defer src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('head')
</head>
<body x-data="{ sidebarOpen: false }" class="text-slate-800 font-sans antialiased overflow-x-hidden">

    <div class="relative min-h-screen">
        
        <div class="fixed inset-0 z-40 bg-sky-900/30 backdrop-blur-sm transition-opacity md:hidden"
             x-show="sidebarOpen"
             x-transition.opacity
             x-cloak
             @click="sidebarOpen = false"></div>

        <aside class="fixed inset-y-0 left-0 z-50 w-72 md:w-64 transform bg-sky-400/80 backdrop-blur-xl border-r border-sky-300 shadow-[4px_0_24px_rgba(14,165,233,0.15)] transition-transform duration-300 ease-in-out md:translate-x-0"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <div class="flex h-16 items-center justify-between px-4 border-b border-sky-300/60 md:px-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-400 text-white shadow-md shadow-emerald-500/30 transform transition-transform group-hover:rotate-12 group-hover:scale-110">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1v1H9V7zm5 0h1v1h-1V7zm-5 4h1v1H9v-1zm5 0h1v1h-1v-1zm-3 4H2v5h15v-5z"></path>
                        </svg>
                    </div>
                    <span class="text-lg font-extrabold tracking-wide text-white drop-shadow-sm">Sistem Sarpras</span>
                </a>
                
                <button @click="sidebarOpen = false"
                        class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-sky-300/50 bg-sky-500/50 text-white transition hover:bg-sky-50 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <nav class="space-y-1.5 px-4 py-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition-all duration-200 {{ Request::routeIs('dashboard') ? 'bg-white text-sky-600 shadow-md ring-1 ring-sky-200/50' : 'text-white hover:bg-white/20 hover:text-white' }}">
                    <span class="text-lg">📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('fasilitas') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition-all duration-200 {{ Request::routeIs('fasilitas*') ? 'bg-white text-sky-600 shadow-md ring-1 ring-sky-200/50' : 'text-white hover:bg-white/20 hover:text-white' }}">
                    <span class="text-lg">📦</span>
                    <span>Data Fasilitas</span>
                </a>
                <a href="{{ route('peminjaman') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition-all duration-200 {{ Request::routeIs('peminjaman*') ? 'bg-white text-sky-600 shadow-md ring-1 ring-sky-200/50' : 'text-white hover:bg-white/20 hover:text-white' }}">
                    <span class="text-lg">🤝</span>
                    <span>Peminjaman Barang</span>
                </a>
                <a href="{{ route('laporan') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition-all duration-200 {{ Request::routeIs('laporan*') ? 'bg-white text-sky-600 shadow-md ring-1 ring-sky-200/50' : 'text-white hover:bg-white/20 hover:text-white' }}">
                    <span class="text-lg">🛠️</span>
                    <span>Laporan Kerusakan</span>
                </a>
                <a href="{{ route('profil') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-bold transition-all duration-200 {{ Request::routeIs('profil*') ? 'bg-white text-sky-600 shadow-md ring-1 ring-sky-200/50' : 'text-white hover:bg-white/20 hover:text-white' }}">
                    <span class="text-lg">👤</span>
                    <span>Profil Saya</span>
                </a>
            </nav>
        </aside>

        <div class="flex flex-col min-h-screen md:pl-64">
            
            <header class="sticky top-0 z-30 w-full border-b border-sky-300/60 bg-sky-400/80 backdrop-blur-xl shadow-md">
                <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
                    <button @click="sidebarOpen = true" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-sky-300/50 bg-sky-500/50 text-white shadow-sm transition hover:bg-sky-500 md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <div class="flex-1 flex items-center justify-between md:justify-end gap-4">
                        <div class="hidden md:block text-sm font-medium text-white drop-shadow-sm">Hai, <span class="font-extrabold">{{ auth()->user()->nama_lengkap ?? 'Admin' }}</span></div>
                        
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-3 rounded-full border border-sky-300/50 bg-sky-500/50 px-4 py-1.5 text-sm shadow-sm transition hover:bg-sky-500 hover:border-sky-300">
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-white text-sky-500 font-black shadow-inner">
                                    {{ strtoupper(substr(auth()->user()->nama_lengkap ?? 'U', 0, 1)) }}
                                </span>
                                <span class="hidden md:inline-block font-bold text-white">{{ auth()->user()->nama_lengkap ?? 'User' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-sky-100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                            </button>

                            <div x-show="open" x-transition class="absolute right-0 mt-3 w-48 overflow-hidden rounded-2xl border border-sky-100 bg-white shadow-2xl ring-1 ring-black ring-opacity-5" x-cloak @click.away="open = false">
                                <a href="{{ route('profil') }}" class="block px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-sky-50 hover:text-sky-600 transition-colors">Profil Saya</a>
                                <div class="border-t border-slate-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full px-5 py-3 text-left text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 w-full overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: {!! json_encode(session('success')) !!},
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: { popup: 'rounded-2xl' }
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: {!! json_encode(session('error')) !!},
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: { popup: 'rounded-2xl' }
                });
            @endif
        });
    </script>

    @stack('scripts')
</body>
</html>