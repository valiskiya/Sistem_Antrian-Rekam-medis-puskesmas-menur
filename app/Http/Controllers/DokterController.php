<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Menampilkan daftar semua dokter
     */
    public function index()
    {
        // Mengambil semua data dokter
        $dokter = Dokter::all();
        return view('dokter.index', compact('dokter'));
    }

    /**
     * Menampilkan form untuk menambah dokter baru
     */
    public function create()
    {
        return view('dokter.create');
    }

    /**
     * Menyimpan data dokter baru
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_dokter' => 'required|max:100',
            'spesialisasi' => 'nullable|max:100',
            'no_telepon' => 'required|unique:dokter,no_telepon|max:20',
            'jam_praktik' => 'nullable|date_format:H:i',
            'jadwal_konsultasi' => 'nullable|max:100',
        ]);

        // Menyimpan data dokter baru ke dalam database
        Dokter::create([
            'nama_dokter' => $request->nama_dokter,
            'spesialisasi' => $request->spesialisasi,
            'no_telepon' => $request->no_telepon,
            'jam_praktik' => $request->jam_praktik,
            'jadwal_konsultasi' => $request->jadwal_konsultasi,
        ]);

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit data dokter
     */
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('dokter.edit', compact('dokter'));
    }

    /**
     * Mengupdate data dokter
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_dokter' => 'required|max:100',
            'spesialisasi' => 'nullable|max:100',
            'no_telepon' => 'required|max:20|unique:dokter,no_telepon,' . $id,
            'jam_praktik' => 'nullable|date_format:H:i',
            'jadwal_konsultasi' => 'nullable|max:100',
        ]);

        $dokter = Dokter::findOrFail($id);
        $dokter->update([
            'nama_dokter' => $request->nama_dokter,
            'spesialisasi' => $request->spesialisasi,
            'no_telepon' => $request->no_telepon,
            'jam_praktik' => $request->jam_praktik,
            'jadwal_konsultasi' => $request->jadwal_konsultasi,
        ]);

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil diperbarui');
    }

    /**
     * Menghapus data dokter
     */
    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Dokter berhasil dihapus');
    }
}
