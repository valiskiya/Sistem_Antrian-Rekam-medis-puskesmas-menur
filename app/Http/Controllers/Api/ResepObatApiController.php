<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ResepObat;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\Obat;
use Illuminate\Http\Request;

class ResepObatApiController extends Controller
{
    /**
     * Menampilkan semua data resep obat beserta relasinya.
     */
    public function index()
    {
        // Mengambil semua data resep obat dan relasi pasien, rekam medis, serta obat
        $resepObat = ResepObat::with(['pasien', 'rekamMedis', 'obat'])->get();

        return response()->json([
            'status' => true,
            'message' => 'Daftar semua resep obat berhasil diambil',
            'data' => $resepObat
        ], 200);
    }

    /**
     * Menyimpan data resep obat baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_rekam_medis' => 'required|exists:rekam_medis,id_rekam_medis',
            'id_obat' => 'required|exists:obat,id_obat',
            'jumlah' => 'required|integer|min:1',
            'dosis' => 'nullable|string|max:50',
            'tanggal_resep' => 'required|date',
        ]);

        $resepObat = ResepObat::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Resep obat baru berhasil ditambahkan',
            'data' => $resepObat
        ], 201);
    }

    /**
     * Menampilkan detail data resep obat berdasarkan ID.
     */
    public function show($id)
    {
        $resepObat = ResepObat::with(['pasien', 'rekamMedis', 'obat'])->find($id);

        if (!$resepObat) {
            return response()->json([
                'status' => false,
                'message' => 'Data resep obat tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail resep obat berhasil diambil',
            'data' => $resepObat
        ], 200);
    }

    /**
     * Memperbarui data resep obat berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_rekam_medis' => 'required|exists:rekam_medis,id_rekam_medis',
            'id_obat' => 'required|exists:obat,id_obat',
            'jumlah' => 'required|integer|min:1',
            'dosis' => 'nullable|string|max:50',
            'tanggal_resep' => 'required|date',
        ]);

        $resepObat = ResepObat::find($id);

        if (!$resepObat) {
            return response()->json([
                'status' => false,
                'message' => 'Data resep obat tidak ditemukan',
            ], 404);
        }

        $resepObat->update($validated);

        return response()->json([
            'status' => true,
            'message' => 'Data resep obat berhasil diperbarui',
            'data' => $resepObat
        ], 200);
    }

    /**
     * Menghapus data resep obat berdasarkan ID.
     */
    public function destroy($id)
    {
        $resepObat = ResepObat::find($id);

        if (!$resepObat) {
            return response()->json([
                'status' => false,
                'message' => 'Data resep obat tidak ditemukan',
            ], 404);
        }

        $resepObat->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data resep obat berhasil dihapus'
        ], 200);
    }
}
