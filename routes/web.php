<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporanController;

// Jika user membuka alamat utama web (localhost:8000/), langsung belokkan ke halaman login
Route::redirect('/', '/login');

// ==========================================
// KELOMPOK RUTE GUEST (Belum Login)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});

// ==========================================
// KELOMPOK RUTE AUTH (Harus Login Dulu)
// ==========================================
Route::middleware('auth')->group(function () {
    
    // --- RUTE DASHBOARD ---
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- RUTE PROFIL ---
    Route::get('/profil', function () {
        return view('profil');
    })->name('profil');

    // Rute untuk SIMPAN UPDATE profil (Lengkap dengan Email & No HP)
    Route::put('/profil/update', function (Request $request) {
        $user = auth()->user();

        // Validasi input form
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'nullable|email|max:255',
            'no_hp'        => 'nullable|string|max:20',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 1. Simpan perubahan teks ke database
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;

        // 2. Proses upload foto jika ada
        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }
            $path = $request->file('foto')->store('profil_fotos', 'public');
            $user->foto = $path;
        }

        $user->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui!');
    })->name('profil.update');

    // --- RUTE DATA FASILITAS ---
    Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas');
    Route::get('/fasilitas/tambah', [FasilitasController::class, 'create'])->name('fasilitas.tambah');
    Route::post('/fasilitas/simpan', [FasilitasController::class, 'store'])->name('fasilitas.store');
    Route::get('/fasilitas/{id}/edit', [FasilitasController::class, 'edit'])->name('fasilitas.edit');
    Route::put('/fasilitas/{id}', [FasilitasController::class, 'update'])->name('fasilitas.update');
    Route::delete('/fasilitas/{id}', [FasilitasController::class, 'destroy'])->name('fasilitas.destroy');


    // --- RUTE PEMINJAMAN ---
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman'); 
    Route::get('/peminjaman/tambah', [PeminjamanController::class, 'create'])->name('peminjaman.tambah');
    Route::post('/peminjaman/simpan', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    Route::patch('/peminjaman/{id}/verifikasi', [PeminjamanController::class, 'verifikasi'])->name('peminjaman.verifikasi');
    Route::patch('/peminjaman/{id}/kembali', [PeminjamanController::class, 'kembali'])->name('peminjaman.kembali');


    // --- RUTE LAPORAN KERUSAKAN ---
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/laporan/tambah', [LaporanController::class, 'create'])->name('laporan.tambah');
    Route::post('/laporan/simpan', [LaporanController::class, 'store'])->name('laporan.store');
    Route::put('/laporan/update-status/{id}', [LaporanController::class, 'updateStatus'])->name('laporan.update_status');


    // --- RUTE LOGOUT ---
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});