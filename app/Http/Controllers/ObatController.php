<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Menampilkan daftar semua obat
     */
    public function index()
    {
        // Mengambil semua data obat
        $obat = Obat::all();
        return view('obat.index', compact('obat'));
    }

    /**
     * Menampilkan form untuk menambah obat baru
     */
    public function create()
    {
        return view('obat.create');
    }

    /**
     * Menyimpan data obat baru
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_obat' => 'required|max:100',
            'jenis_obat' => 'nullable|max:50',
            'stok' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_kedaluwarsa' => 'nullable|date',
            'supplier' => 'nullable|max:100',
        ]);

        // Menyimpan data obat baru ke dalam database
        Obat::create([
            'nama_obat' => $request->nama_obat,
            'jenis_obat' => $request->jenis_obat,
            'stok' => $request->stok,
            'harga_satuan' => $request->harga_satuan,
            'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
            'supplier' => $request->supplier,
        ]);

        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit data obat
     */
    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('obat.edit', compact('obat'));
    }

    /**
     * Mengupdate data obat
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_obat' => 'required|max:100',
            'jenis_obat' => 'nullable|max:50',
            'stok' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_kedaluwarsa' => 'nullable|date',
            'supplier' => 'nullable|max:100',
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'jenis_obat' => $request->jenis_obat,
            'stok' => $request->stok,
            'harga_satuan' => $request->harga_satuan,
            'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
            'supplier' => $request->supplier,
        ]);

        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui');
    }

    /**
     * Menghapus data obat
     */
    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus');
    }
}
