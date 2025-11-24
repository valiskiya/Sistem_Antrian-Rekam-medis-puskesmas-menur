<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PoliApiController extends Controller
{
    /**
     * Menampilkan semua data poli (GET /api/poli)
     */
    public function index()
    {
        // Mengambil semua data poli dari database
        $poli = Poli::all();

        // Mengembalikan data dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data poli berhasil diambil',
            'data' => $poli
        ], 200);
    }

    /**
     * Menampilkan data poli berdasarkan ID (GET /api/poli/{id})
     */
    public function show($id)
    {
        // Mencari data poli berdasarkan ID
        $poli = Poli::find($id);

        // Jika data poli tidak ditemukan
        if (!$poli) {
            return response()->json([
                'success' => false,
                'message' => 'Poli tidak ditemukan'
            ], 404);
        }

        // Mengembalikan data poli dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data poli berhasil ditemukan',
            'data' => $poli
        ], 200);
    }

    /**
     * Menyimpan data poli baru (POST /api/poli)
     */
    public function store(Request $request)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'nama_poli' => 'required|unique:poli,nama_poli|max:100',
            'deskripsi' => 'nullable|max:255',
        ]);

        // Simpan data poli baru ke database
        $poli = Poli::create($validatedData);

        // Mengembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Data poli berhasil ditambahkan',
            'data' => $poli
        ], 201);
    }

    /**
     * Mengupdate data poli berdasarkan ID (PUT /api/poli/{id})
     */
    public function update(Request $request, $id)
    {
        // Cari data poli berdasarkan ID
        $poli = Poli::find($id);

        // Jika data poli tidak ditemukan
        if (!$poli) {
            return response()->json([
                'success' => false,
                'message' => 'Poli tidak ditemukan'
            ], 404);
        }

        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nama_poli' => 'required|unique:poli,nama_poli,' . $id . '|max:100',
            'deskripsi' => 'nullable|max:255',
        ]);

        // Update data poli
        $poli->update($validatedData);

        // Mengembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Data poli berhasil diperbarui',
            'data' => $poli
        ], 200);
    }

    /**
     * Menghapus data poli berdasarkan ID (DELETE /api/poli/{id})
     */
    public function destroy($id)
    {
        // Mencari data poli berdasarkan ID
        $poli = Poli::find($id);

        // Jika poli tidak ditemukan
        if (!$poli) {
            return response()->json([
                'success' => false,
                'message' => 'Poli tidak ditemukan'
            ], 404);
        }

        // Hapus data poli dari database
        $poli->delete();

        // Mengembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Data poli berhasil dihapus'
        ], 200);
    }
}
