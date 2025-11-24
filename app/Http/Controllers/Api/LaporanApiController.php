<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class LaporanApiController extends Controller
{
    /**
     * Menampilkan semua data laporan beserta relasi pegawai
     */
    public function index()
    {
        // Mengambil semua data laporan dengan relasi pegawai
        $laporan = Laporan::with('pegawai')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar semua laporan berhasil diambil',
            'data' => $laporan
        ], 200);
    }

    /**
     * Menyimpan laporan baru ke dalam database
     */
    public function store(Request $request)
    {
        // Validasi data masukan
        $validatedData = $request->validate([
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            'jenis_laporan' => 'required|in:Harian,Mingguan,Bulanan,Tahunan',
            'tanggal_laporan' => 'required|date',
            'deskripsi_laporan' => 'required|string|max:1000',
        ]);

        // Menyimpan data laporan baru
        $laporan = Laporan::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Laporan baru berhasil ditambahkan',
            'data' => $laporan
        ], 201);
    }

    /**
     * Menampilkan detail laporan berdasarkan ID
     */
    public function show($id)
    {
        $laporan = Laporan::with('pegawai')->find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail laporan berhasil diambil',
            'data' => $laporan
        ], 200);
    }

    /**
     * Memperbarui data laporan berdasarkan ID
     */
    public function update(Request $request, $id)
    {
        // Validasi data masukan
        $validatedData = $request->validate([
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            'jenis_laporan' => 'required|in:Harian,Mingguan,Bulanan,Tahunan',
            'tanggal_laporan' => 'required|date',
            'deskripsi_laporan' => 'required|string|max:1000',
        ]);

        $laporan = Laporan::find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan',
            ], 404);
        }

        // Update data laporan
        $laporan->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil diperbarui',
            'data' => $laporan
        ], 200);
    }

    /**
     * Menghapus laporan berdasarkan ID
     */
    public function destroy($id)
    {
        $laporan = Laporan::find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false,
                'message' => 'Laporan tidak ditemukan',
            ], 404);
        }

        $laporan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dihapus'
        ], 200);
    }
}
