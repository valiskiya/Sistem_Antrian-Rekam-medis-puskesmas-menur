<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\Obat;
use Illuminate\Http\Request;

class ResepObatController extends Controller
{
    /**
     * Menampilkan daftar semua resep obat
     */
    public function index()
    {
        // Mengambil semua data resep obat beserta data terkait (pasien, rekam medis, obat)
        $resepObat = ResepObat::with(['pasien', 'rekamMedis', 'obat'])->get();
        return view('resep_obat.index', compact('resepObat'));
    }

    /**
     * Menampilkan form untuk menambah resep obat baru
     */
    public function create()
    {
        // Mendapatkan data pasien, rekam medis, dan obat untuk dropdown
        $pasien = Pasien::all();
        $rekamMedis = RekamMedis::all();
        $obat = Obat::all();

        return view('resep_obat.create', compact('pasien', 'rekamMedis', 'obat'));
    }

    /**
     * Menyimpan data resep obat baru
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_rekam_medis' => 'required|exists:rekam_medis,id_rekam_medis',
            'id_obat' => 'required|exists:obat,id_obat',
            'jumlah' => 'required|integer|min:1',
            'dosis' => 'nullable|string|max:50',
            'tanggal_resep' => 'required|date',
        ]);

        // Menyimpan data resep obat baru ke dalam database
        ResepObat::create([
            'id_pasien' => $request->id_pasien,
            'id_rekam_medis' => $request->id_rekam_medis,
            'id_obat' => $request->id_obat,
            'jumlah' => $request->jumlah,
            'dosis' => $request->dosis,
            'tanggal_resep' => $request->tanggal_resep,
        ]);

        return redirect()->route('resep_obat.index')->with('success', 'Resep obat berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit data resep obat
     */
    public function edit($id)
    {
        $resepObat = ResepObat::findOrFail($id);

        // Mendapatkan data pasien, rekam medis, dan obat untuk dropdown
        $pasien = Pasien::all();
        $rekamMedis = RekamMedis::all();
        $obat = Obat::all();

        return view('resep_obat.edit', compact('resepObat', 'pasien', 'rekamMedis', 'obat'));
    }

    /**
     * Mengupdate data resep obat
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_rekam_medis' => 'required|exists:rekam_medis,id_rekam_medis',
            'id_obat' => 'required|exists:obat,id_obat',
            'jumlah' => 'required|integer|min:1',
            'dosis' => 'nullable|string|max:50',
            'tanggal_resep' => 'required|date',
        ]);

        $resepObat = ResepObat::findOrFail($id);
        $resepObat->update([
            'id_pasien' => $request->id_pasien,
            'id_rekam_medis' => $request->id_rekam_medis,
            'id_obat' => $request->id_obat,
            'jumlah' => $request->jumlah,
            'dosis' => $request->dosis,
            'tanggal_resep' => $request->tanggal_resep,
        ]);

        return redirect()->route('resep_obat.index')->with('success', 'Resep obat berhasil diperbarui');
    }

    /**
     * Menghapus data resep obat
     */
    public function destroy($id)
    {
        $resepObat = ResepObat::findOrFail($id);
        $resepObat->delete();

        return redirect()->route('resep_obat.index')->with('success', 'Resep obat berhasil dihapus');
    }
}
