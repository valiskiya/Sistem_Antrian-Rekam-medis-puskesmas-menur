<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Menampilkan daftar semua poli
     */
    public function index()
    {
        // Mengambil semua data poli
        $poli = Poli::all();
        return view('poli.index', compact('poli'));
    }

    /**
     * Menampilkan form untuk menambah poli baru
     */
    public function create()
    {
        return view('poli.create');
    }

    /**
     * Menyimpan data poli baru
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_poli' => 'required|unique:poli,nama_poli|max:100',
            'deskripsi' => 'nullable|max:255',
        ]);

        // Menyimpan data poli baru ke dalam database
        Poli::create([
            'nama_poli' => $request->nama_poli,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('poli.index')->with('success', 'Poli berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit data poli
     */
    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('poli.edit', compact('poli'));
    }

    /**
     * Mengupdate data poli
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_poli' => 'required|unique:poli,nama_poli,' . $id . '|max:100',
            'deskripsi' => 'nullable|max:255',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update([
            'nama_poli' => $request->nama_poli,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('poli.index')->with('success', 'Poli berhasil diperbarui');
    }

    /**
     * Menghapus data poli
     */
    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();

        return redirect()->route('poli.index')->with('success', 'Poli berhasil dihapus');
    }
}
