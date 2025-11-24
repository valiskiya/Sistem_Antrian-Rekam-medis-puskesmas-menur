<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienApiController extends Controller
{
    /**
     * Menampilkan semua data pasien (GET /api/pasien)
     */
    public function index()
    {
        // Mengambil semua data pasien dari database
        $pasien = Pasien::all();

        // Mengembalikan hasil dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil diambil',
            'data' => $pasien
        ], 200);
    }

    /**
     * Menampilkan detail pasien berdasarkan ID (GET /api/pasien/{id})
     */
    public function show($id)
    {
        // Mencari data pasien berdasarkan ID
        $pasien = Pasien::find($id);

        // Jika data pasien tidak ditemukan
        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Pasien tidak ditemukan'
            ], 404);
        }

        // Mengembalikan data pasien dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail pasien berhasil diambil',
            'data' => $pasien
        ], 200);
    }

    /**
     * Menyimpan data pasien baru (POST /api/pasien)
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim melalui request
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'no_ktp' => 'required|unique:pasien,no_ktp|string|max:20',
            'status' => 'required|in:Aktif,Tidak Aktif,Meninggal',
            'tanggal_daftar' => 'nullable|date',
        ]);

        // Simpan data ke database
        $pasien = Pasien::create($validatedData);

        // Mengembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil disimpan',
            'data' => $pasien
        ], 201);
    }

    /**
     * Mengupdate data pasien berdasarkan ID (PUT /api/pasien/{id})
     */
    public function update(Request $request, $id)
    {
        // Mencari data pasien berdasarkan ID
        $pasien = Pasien::find($id);

        // Jika data pasien tidak ditemukan
        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Pasien tidak ditemukan'
            ], 404);
        }

        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'nama_lengkap' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'no_ktp' => 'nullable|unique:pasien,no_ktp,' . $id . '|string|max:20',
            'status' => 'nullable|in:Aktif,Tidak Aktif,Meninggal',
            'tanggal_daftar' => 'nullable|date',
        ]);

        // Update data pasien di database
        $pasien->update($validatedData);

        // Mengembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil diperbarui',
            'data' => $pasien
        ], 200);
    }

    /**
     * Menghapus data pasien berdasarkan ID (DELETE /api/pasien/{id})
     */
    public function destroy($id)
    {
        // Mencari data pasien berdasarkan ID
        $pasien = Pasien::find($id);

        // Jika data tidak ditemukan
        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Pasien tidak ditemukan'
            ], 404);
        }

        // Hapus data pasien
        $pasien->delete();

        // Mengembalikan respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil dihapus'
        ], 200);
    }
}
