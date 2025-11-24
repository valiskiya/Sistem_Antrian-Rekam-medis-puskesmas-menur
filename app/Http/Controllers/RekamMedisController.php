<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    /**
     * Menampilkan daftar semua rekam medis
     */
    public function index()
    {
        // Mengambil semua data rekam medis beserta data kunjungan terkait
        $rekamMedis = RekamMedis::with('kunjungan')->get();
        return view('rekam_medis.index', compact('rekamMedis'));
    }

    /**
     * Menampilkan form untuk menambah rekam medis baru
     */
    public function create()
    {
        // Mendapatkan data kunjungan untuk dropdown
        $kunjungan = Kunjungan::all();

        return view('rekam_medis.create', compact('kunjungan'));
    }

    /**
     * Menyimpan data rekam medis baru
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'tanggal_pemeriksaan' => 'required|date',
            'diagnosis' => 'required|string|max:255',
            'terapi' => 'required|string|max:255',
            'catatan_dokter' => 'nullable|string|max:255',
        ]);

        // Menyimpan data rekam medis baru ke dalam database
        RekamMedis::create([
            'id_kunjungan' => $request->id_kunjungan,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'diagnosis' => $request->diagnosis,
            'terapi' => $request->terapi,
            'catatan_dokter' => $request->catatan_dokter,
        ]);

        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit data rekam medis
     */
    public function edit($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);

        // Mendapatkan data kunjungan untuk dropdown
        $kunjungan = Kunjungan::all();

        return view('rekam_medis.edit', compact('rekamMedis', 'kunjungan'));
    }

    /**
     * Mengupdate data rekam medis
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'tanggal_pemeriksaan' => 'required|date',
            'diagnosis' => 'required|string|max:255',
            'terapi' => 'required|string|max:255',
            'catatan_dokter' => 'nullable|string|max:255',
        ]);

        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->update([
            'id_kunjungan' => $request->id_kunjungan,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'diagnosis' => $request->diagnosis,
            'terapi' => $request->terapi,
            'catatan_dokter' => $request->catatan_dokter,
        ]);

        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil diperbarui');
    }

    /**
     * Menghapus data rekam medis
     */
    public function destroy($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->delete();

        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil dihapus');
    }
}
