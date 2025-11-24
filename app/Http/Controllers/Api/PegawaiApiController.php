<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiApiController extends Controller
{
    /**
     * Menampilkan semua data pegawai (GET /api/pegawai)
     */
    public function index()
    {
        // Mengambil semua data pegawai dari database
        $pegawai = Pegawai::all();

        // Mengembalikan data dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil diambil',
            'data' => $pegawai
        ], 200);
    }

    /**
     * Menampilkan data pegawai berdasarkan ID (GET /api/pegawai/{id})
     */
    public function show($id)
    {
        // Mencari data pegawai berdasarkan ID
        $pegawai = Pegawai::find($id);

        // Jika data tidak ditemukan
        if (!$pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Pegawai tidak ditemukan'
            ], 404);
        }

        // Mengembalikan data pegawai dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil ditemukan',
            'data' => $pegawai
        ], 200);
    }

    /**
     * Menyimpan data pegawai baru (POST /api/pegawai)
     */
    public function store(Request $request)
    {
        // Validasi data dari permintaan
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|max:100',
            'jabatan' => 'required|max:50',
            'tanggal_lahir' => 'required|date',
            'tanggal_masuk_kerja' => 'required|date',
            'alamat' => 'required|max:255',
            'no_telepon' => 'nullable|max:20',
            'nomor_SIP' => 'required|unique:pegawai,nomor_SIP|max:30',
        ]);

        // Simpan data pegawai baru ke database
        $pegawai = Pegawai::create($validatedData);

        // Mengembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil ditambahkan',
            'data' => $pegawai
        ], 201);
    }

    /**
     * Mengupdate data pegawai berdasarkan ID (PUT /api/pegawai/{id})
     */
    public function update(Request $request, $id)
    {
        // Mencari data pegawai berdasarkan ID
        $pegawai = Pegawai::find($id);

        // Jika data tidak ditemukan
        if (!$pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Pegawai tidak ditemukan'
            ], 404);
        }

        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|max:100',
            'jabatan' => 'required|max:50',
            'tanggal_lahir' => 'required|date',
            'tanggal_masuk_kerja' => 'required|date',
            'alamat' => 'required|max:255',
            'no_telepon' => 'nullable|max:20',
            'nomor_SIP' => 'required|max:30|unique:pegawai,nomor_SIP,' . $id,
        ]);

        // Update data pegawai di database
        $pegawai->update($validatedData);

        // Mengembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil diperbarui',
            'data' => $pegawai
        ], 200);
    }

    /**
     * Menghapus data pegawai berdasarkan ID (DELETE /api/pegawai/{id})
     */
    public function destroy($id)
    {
        // Mencari data pegawai berdasarkan ID
        $pegawai = Pegawai::find($id);

        // Jika data tidak ditemukan
        if (!$pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Pegawai tidak ditemukan'
            ], 404);
        }

        // Hapus data pegawai dari database
        $pegawai->delete();

        // Mengembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Data pegawai berhasil dihapus'
        ], 200);
    }
}
