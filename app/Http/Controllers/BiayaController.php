<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Kunjungan;
use App\Models\Obat;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    /**
     * Menampilkan daftar semua biaya
     */
    public function index()
    {
        // Mengambil semua data biaya beserta data terkait (kunjungan dan obat)
        $biaya = Biaya::with(['kunjungan', 'obat'])->get();
        return view('biaya.index', compact('biaya'));
    }

    /**
     * Menampilkan form untuk menambah biaya baru
     */
    public function create()
    {
        // Mendapatkan data kunjungan dan obat untuk dropdown
        $kunjungan = Kunjungan::all();
        $obat = Obat::all();

        return view('biaya.create', compact('kunjungan', 'obat'));
    }

    /**
     * Menyimpan data biaya baru
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'id_obat' => 'nullable|exists:obat,id_obat',
            'jenis_biaya' => 'required|string|max:100',
            'jumlah_biaya' => 'required|numeric|min:0',
            'tanggal_biaya' => 'required|date',
        ]);

        // Menyimpan data biaya baru ke dalam database
        Biaya::create([
            'id_kunjungan' => $request->id_kunjungan,
            'id_obat' => $request->id_obat,
            'jenis_biaya' => $request->jenis_biaya,
            'jumlah_biaya' => $request->jumlah_biaya,
            'tanggal_biaya' => $request->tanggal_biaya,
        ]);

        return redirect()->route('biaya.index')->with('success', 'Biaya berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit data biaya
     */
    public function edit($id)
    {
        $biaya = Biaya::findOrFail($id);

        // Mendapatkan data kunjungan dan obat untuk dropdown
        $kunjungan = Kunjungan::all();
        $obat = Obat::all();

        return view('biaya.edit', compact('biaya', 'kunjungan', 'obat'));
    }

    /**
     * Mengupdate data biaya
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'id_obat' => 'nullable|exists:obat,id_obat',
            'jenis_biaya' => 'required|string|max:100',
            'jumlah_biaya' => 'required|numeric|min:0',
            'tanggal_biaya' => 'required|date',
        ]);

        $biaya = Biaya::findOrFail($id);
        $biaya->update([
            'id_kunjungan' => $request->id_kunjungan,
            'id_obat' => $request->id_obat,
            'jenis_biaya' => $request->jenis_biaya,
            'jumlah_biaya' => $request->jumlah_biaya,
            'tanggal_biaya' => $request->tanggal_biaya,
        ]);

        return redirect()->route('biaya.index')->with('success', 'Biaya berhasil diperbarui');
    }

    /**
     * Menghapus data biaya
     */
    public function destroy($id)
    {
        $biaya = Biaya::findOrFail($id);
        $biaya->delete();

        return redirect()->route('biaya.index')->with('success', 'Biaya berhasil dihapus');
    }
}
