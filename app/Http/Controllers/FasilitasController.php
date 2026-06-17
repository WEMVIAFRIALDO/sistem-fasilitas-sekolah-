<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FasilitasController extends Controller
{
    // --- METHOD INDEX (BARU DITAMBAHKAN) ---
    public function index()
    {
        // Ambil semua data dari dalam tabel fasilitas
        $data_fasilitas = Fasilitas::latest()->get();
        
        // Kirim datanya ke halaman HTML (view)
        return view('fasilitas', compact('data_fasilitas'));
    }
    // --------------------------------------

    public function create()
    {
        return view('fasilitas-tambah');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'ruangan' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:255|unique:fasilitas,kode_barang',
            'status' => 'required|string|max:255',
        ]);

        Fasilitas::create($validated);

        return redirect()->route('fasilitas')->with('success', 'Data fasilitas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        return view('fasilitas-edit', compact('fasilitas'));
    }

    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'ruangan' => 'required|string|max:255',
            'kode_barang' => [
                'required',
                'string',
                'max:255',
                Rule::unique('fasilitas', 'kode_barang')->ignore($fasilitas->id),
            ],
            'status' => 'required|string|max:255',
        ]);

        $fasilitas->update($validated);

        return redirect()->route('fasilitas')->with('success', 'Data fasilitas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->delete();

        return redirect()->route('fasilitas')->with('success', 'Data fasilitas berhasil dihapus.');
    }
}