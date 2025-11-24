<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterApiController extends Controller
{
    /**
     * Menampilkan semua data dokter (GET /api/dokter)
     */
    public function index()
    {
        // Mengambil semua data dokter dari database
        $dokter = Dokter::all();

        // Mengembalikan respon dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data dokter berhasil diambil',
            'data' => $dokter
        ], 200);
    }

    /**
     * Menampilkan data dokter berdasarkan ID (GET /api/dokter/{id})
     */
    public function show($id)
    {
        // Mencari dokter berdasarkan ID
        $dokter = Dokter::find($id);

        // Jika dokter tidak ditemukan
        if (!$dokter) {
            return response()->json([
                'success' => false,
                'message' => 'Dokter tidak ditemukan'
            ], 404);
        }

        // Mengembalikan data dokter
        return response()->json([
            'success' => true,
            'message' => 'Data dokter berhasil ditemukan',
            'data' => $dokter
        ], 200);
    }

    /**
     * Menyimpan data dokter baru (POST /api/dokter)
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim oleh user
        $validatedData = $request->validate([
            'nama_dokter' => 'required|max:100',
            'spesialisasi' => 'nullable|max:100',
            'no_telepon' => 'required|unique:dokter,no_telepon|max:20',
            'jam_praktik' => 'nullable|date_format:H:i',
            'jadwal_konsultasi' => 'nullable|max:100',
        ]);

        // Simpan data dokter baru ke database
        $dokter = Dokter::create($validatedData);

        // Mengembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Data dokter berhasil ditambahkan',
            'data' => $dokter
        ], 201);
    }

    /**
     * Memperbarui data dokter berdasarkan ID (PUT /api/dokter/{id})
     */
    public function update(Request $request, $id)
    {
        // Cari data dokter berdasarkan ID
        $dokter = Dokter::find($id);

        // Jika dokter tidak ditemukan
        if (!$dokter) {
            return response()->json([
                'success' => false,
                'message' => 'Dokter tidak ditemukan'
            ], 404);
        }

        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'nama_dokter' => 'required|max:100',
            'spesialisasi' => 'nullable|max:100',
            'no_telepon' => 'required|max:20|unique:dokter,no_telepon,' . $id,
            'jam_praktik' => 'nullable|date_format:H:i',
            'jadwal_konsultasi' => 'nullable|max:100',
        ]);

        // Update data dokter di database
        $dokter->update($validatedData);

        // Mengembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Data dokter berhasil diperbarui',
            'data' => $dokter
        ], 200);
    }

    /**
     * Menghapus data dokter berdasarkan ID (DELETE /api/dokter/{id})
     */
    public function destroy($id)
    {
        // Cari data dokter berdasarkan ID
        $dokter = Dokter::find($id);

        // Jika dokter tidak ditemukan
        if (!$dokter) {
            return response()->json([
                'success' => false,
                'message' => 'Dokter tidak ditemukan'
            ], 404);
        }

        // Hapus data dokter
        $dokter->delete();

        // Mengembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Data dokter berhasil dihapus'
        ], 200);
    }
}
