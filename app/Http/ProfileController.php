<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'nullable|email|max:255',
            'no_hp'        => 'nullable|string|max:20',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        ]);

        // Proses unggah foto (jika ada)
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }

            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('profil_fotos', 'public');
            $user->foto = $fotoPath;
        }

        // Update data profil
        $user->nama_lengkap = $request->nama_lengkap;
        // Hanya update email dan no_hp jika kolomnya ada di database kamu.
        // Jika belum ada, beri komentar (//) pada dua baris di bawah ini.
        if(isset($user->email)) $user->email = $request->email;
        if(isset($user->no_hp)) $user->no_hp = $request->no_hp;

        $user->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui!');
    }
}