<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Kunjungan;
use App\Models\Obat;
use Illuminate\Http\Request;

class BiayaApiController extends Controller
{
    /**
     * Menampilkan daftar semua data biaya
     */
    public function index()
    {
        // Ambil semua data biaya dengan relasi kunjungan dan obat
        $biaya = Biaya::with(['kunjungan', 'obat'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar semua data biaya berhasil diambil',
            'data' => $biaya
        ], 200);
    }

    /**
     * Menyimpan data biaya baru ke database
     */
    public function store(Request $request)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'id_obat' => 'nullable|exists:obat,id_obat',
            'jenis_biaya' => 'required|string|max:100',
            'jumlah_biaya' => 'required|numeric|min:0',
            'tanggal_biaya' => 'required|date',
        ]);

        // Simpan ke database
        $biaya = Biaya::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data biaya berhasil ditambahkan',
            'data' => $biaya
        ], 201);
    }

    /**
     * Menampilkan detail satu data biaya berdasarkan ID
     */
    public function show($id)
    {
        $biaya = Biaya::with(['kunjungan', 'obat'])->find($id);

        if (!$biaya) {
            return response()->json([
                'success' => false,
                'message' => 'Data biaya tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data biaya berhasil diambil',
            'data' => $biaya
        ], 200);
    }

    /**
     * Mengupdate data biaya berdasarkan ID
     */
    public function update(Request $request, $id)
    {
        // Validasi inputan
        $validatedData = $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'id_obat' => 'nullable|exists:obat,id_obat',
            'jenis_biaya' => 'required|string|max:100',
            'jumlah_biaya' => 'required|numeric|min:0',
            'tanggal_biaya' => 'required|date',
        ]);

        $biaya = Biaya::find($id);

        if (!$biaya) {
            return response()->json([
                'success' => false,
                'message' => 'Data biaya tidak ditemukan',
            ], 404);
        }

        // Update data
        $biaya->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data biaya berhasil diperbarui',
            'data' => $biaya
        ], 200);
    }

    /**
     * Menghapus data biaya berdasarkan ID
     */
    public function destroy($id)
    {
        $biaya = Biaya::find($id);

        if (!$biaya) {
            return response()->json([
                'success' => false,
                'message' => 'Data biaya tidak ditemukan',
            ], 404);
        }

        $biaya->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data biaya berhasil dihapus'
        ], 200);
    }
}
