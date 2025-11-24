<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class RekamMedisApiController extends Controller
{
    /**
     * Menampilkan semua data rekam medis (GET /api/rekam-medis)
     */
    public function index()
    {
        // Mengambil semua data rekam medis beserta relasi kunjungan
        $rekamMedis = RekamMedis::with('kunjungan')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data rekam medis berhasil diambil',
            'data' => $rekamMedis
        ], 200);
    }

    /**
     * Menampilkan data rekam medis berdasarkan ID (GET /api/rekam-medis/{id})
     */
    public function show($id)
    {
        $rekamMedis = RekamMedis::with('kunjungan')->find($id);

        if (!$rekamMedis) {
            return response()->json([
                'success' => false,
                'message' => 'Rekam medis tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data rekam medis berhasil ditemukan',
            'data' => $rekamMedis
        ], 200);
    }

    /**
     * Menyimpan data rekam medis baru (POST /api/rekam-medis)
     */
    public function store(Request $request)
    {
        // Validasi data input dari pengguna
        $validatedData = $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'tanggal_pemeriksaan' => 'required|date',
            'diagnosis' => 'required|string|max:255',
            'terapi' => 'required|string|max:255',
            'catatan_dokter' => 'nullable|string|max:255',
        ]);

        // Simpan data rekam medis baru ke database
        $rekamMedis = RekamMedis::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data rekam medis berhasil ditambahkan',
            'data' => $rekamMedis
        ], 201);
    }

    /**
     * Mengupdate data rekam medis berdasarkan ID (PUT /api/rekam-medis/{id})
     */
    public function update(Request $request, $id)
    {
        $rekamMedis = RekamMedis::find($id);

        if (!$rekamMedis) {
            return response()->json([
                'success' => false,
                'message' => 'Rekam medis tidak ditemukan',
            ], 404);
        }

        // Validasi data input
        $validatedData = $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'tanggal_pemeriksaan' => 'required|date',
            'diagnosis' => 'required|string|max:255',
            'terapi' => 'required|string|max:255',
            'catatan_dokter' => 'nullable|string|max:255',
        ]);

        // Update data rekam medis
        $rekamMedis->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data rekam medis berhasil diperbarui',
            'data' => $rekamMedis
        ], 200);
    }

    /**
     * Menghapus data rekam medis berdasarkan ID (DELETE /api/rekam-medis/{id})
     */
    public function destroy($id)
    {
        $rekamMedis = RekamMedis::find($id);

        if (!$rekamMedis) {
            return response()->json([
                'success' => false,
                'message' => 'Rekam medis tidak ditemukan',
            ], 404);
        }

        $rekamMedis->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data rekam medis berhasil dihapus',
        ], 200);
    }
}
        