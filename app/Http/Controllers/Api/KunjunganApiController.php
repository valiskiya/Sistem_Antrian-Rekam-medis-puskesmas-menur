<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class KunjunganApiController extends Controller
{
    /**
     * Menampilkan semua data kunjungan (GET /api/kunjungan)
     */
    public function index()
    {
        // Mengambil semua data kunjungan dengan relasi (eager loading)
        $kunjungan = Kunjungan::with(['pasien', 'dokter', 'poli', 'pegawaiAdmin'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Data kunjungan berhasil diambil',
            'data' => $kunjungan
        ], 200);
    }

    /**
     * Menampilkan data kunjungan berdasarkan ID (GET /api/kunjungan/{id})
     */
    public function show($id)
    {
        // Mencari data kunjungan berdasarkan ID
        $kunjungan = Kunjungan::with(['pasien', 'dokter', 'poli', 'pegawaiAdmin'])->find($id);

        if (!$kunjungan) {
            return response()->json([
                'success' => false,
                'message' => 'Kunjungan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data kunjungan berhasil ditemukan',
            'data' => $kunjungan
        ], 200);
    }

    /**
     * Menyimpan data kunjungan baru (POST /api/kunjungan)
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'nullable|date_format:H:i',
            'keluhan_awal' => 'nullable|max:255',
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_dokter' => 'nullable|exists:dokter,id_dokter',
            'id_poli' => 'nullable|exists:poli,id_poli',
            'id_pegawai_admin' => 'nullable|exists:pegawai,id_pegawai',
        ]);

        // Simpan data ke database
        $kunjungan = Kunjungan::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data kunjungan berhasil ditambahkan',
            'data' => $kunjungan
        ], 201);
    }

    /**
     * Mengupdate data kunjungan berdasarkan ID (PUT /api/kunjungan/{id})
     */
    public function update(Request $request, $id)
    {
        $kunjungan = Kunjungan::find($id);

        if (!$kunjungan) {
            return response()->json([
                'success' => false,
                'message' => 'Kunjungan tidak ditemukan',
            ], 404);
        }

        // Validasi data
        $validatedData = $request->validate([
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'nullable|date_format:H:i',
            'keluhan_awal' => 'nullable|max:255',
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_dokter' => 'nullable|exists:dokter,id_dokter',
            'id_poli' => 'nullable|exists:poli,id_poli',
            'id_pegawai_admin' => 'nullable|exists:pegawai,id_pegawai',
        ]);

        // Update data
        $kunjungan->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data kunjungan berhasil diperbarui',
            'data' => $kunjungan
        ], 200);
    }

    /**
     * Menghapus data kunjungan berdasarkan ID (DELETE /api/kunjungan/{id})
     */
    public function destroy($id)
    {
        $kunjungan = Kunjungan::find($id);

        if (!$kunjungan) {
            return response()->json([
                'success' => false,
                'message' => 'Kunjungan tidak ditemukan',
            ], 404);
        }

        $kunjungan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data kunjungan berhasil dihapus',
        ], 200);
    }
}
