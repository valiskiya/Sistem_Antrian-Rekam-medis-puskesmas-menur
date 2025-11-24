<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatApiController extends Controller
{
    /**
     * Menampilkan daftar semua data obat dalam format JSON.
     */
    public function index()
    {
        // Mengambil semua data obat dari database
        $obat = Obat::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar semua data obat berhasil diambil.',
            'data' => $obat
        ], 200);
    }

    /**
     * Menyimpan data obat baru ke dalam database (API Create).
     */
    public function store(Request $request)
    {
        // Validasi data dari permintaan pengguna
        $request->validate([
            'nama_obat' => 'required|max:100',
            'jenis_obat' => 'nullable|max:50',
            'stok' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_kedaluwarsa' => 'nullable|date',
            'supplier' => 'nullable|max:100',
        ]);

        // Menyimpan data obat baru
        $obat = Obat::create([
            'nama_obat' => $request->nama_obat,
            'jenis_obat' => $request->jenis_obat,
            'stok' => $request->stok,
            'harga_satuan' => $request->harga_satuan,
            'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
            'supplier' => $request->supplier,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data obat baru berhasil ditambahkan.',
            'data' => $obat
        ], 201);
    }

    /**
     * Menampilkan detail data obat berdasarkan ID.
     */
    public function show($id)
    {
        $obat = Obat::find($id);

        if (!$obat) {
            return response()->json([
                'success' => false,
                'message' => 'Data obat tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data obat berhasil diambil.',
            'data' => $obat
        ], 200);
    }

    /**
     * Memperbarui data obat berdasarkan ID (API Update).
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'nama_obat' => 'required|max:100',
            'jenis_obat' => 'nullable|max:50',
            'stok' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'tanggal_kedaluwarsa' => 'nullable|date',
            'supplier' => 'nullable|max:100',
        ]);

        $obat = Obat::find($id);

        if (!$obat) {
            return response()->json([
                'success' => false,
                'message' => 'Data obat tidak ditemukan.',
            ], 404);
        }

        // Update data obat
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'jenis_obat' => $request->jenis_obat,
            'stok' => $request->stok,
            'harga_satuan' => $request->harga_satuan,
            'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
            'supplier' => $request->supplier,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data obat berhasil diperbarui.',
            'data' => $obat
        ], 200);
    }

    /**
     * Menghapus data obat berdasarkan ID (API Delete).
     */
    public function destroy($id)
    {
        $obat = Obat::find($id);

        if (!$obat) {
            return response()->json([
                'success' => false,
                'message' => 'Data obat tidak ditemukan.',
            ], 404);
        }

        $obat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data obat berhasil dihapus.',
        ], 200);
    }
}
