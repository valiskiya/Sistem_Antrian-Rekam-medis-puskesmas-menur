<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemeriksaan;
use App\Models\Kunjungan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PemeriksaanApiController extends Controller
{
    /**
     * Menampilkan semua data pemeriksaan dalam format JSON.
     */
    public function index()
    {
        // Mengambil semua data pemeriksaan beserta relasi kunjungan dan pegawai
        $pemeriksaan = Pemeriksaan::with(['kunjungan', 'pegawaiPemeriksaan'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar semua data pemeriksaan berhasil diambil.',
            'data' => $pemeriksaan
        ], 200);
    }

    /**
     * Menyimpan data pemeriksaan baru ke database (API Create).
     */
    public function store(Request $request)
    {
        // Validasi data dari request
        $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'id_pegawai_pemeriksaan' => 'nullable|exists:pegawai,id_pegawai',
            'jenis_pemeriksaan' => 'required|string|max:100',
            'hasil_pemeriksaan' => 'nullable|string|max:255',
            'rekomendasi' => 'nullable|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'jam_pemeriksaan' => 'nullable|date_format:H:i',
        ]);

        // Simpan data ke tabel pemeriksaan
        $pemeriksaan = Pemeriksaan::create([
            'id_kunjungan' => $request->id_kunjungan,
            'id_pegawai_pemeriksaan' => $request->id_pegawai_pemeriksaan,
            'jenis_pemeriksaan' => $request->jenis_pemeriksaan,
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'rekomendasi' => $request->rekomendasi,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'jam_pemeriksaan' => $request->jam_pemeriksaan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pemeriksaan berhasil ditambahkan.',
            'data' => $pemeriksaan
        ], 201);
    }

    /**
     * Menampilkan detail data pemeriksaan berdasarkan ID.
     */
    public function show($id)
    {
        $pemeriksaan = Pemeriksaan::with(['kunjungan', 'pegawaiPemeriksaan'])->find($id);

        if (!$pemeriksaan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pemeriksaan tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data pemeriksaan berhasil diambil.',
            'data' => $pemeriksaan
        ], 200);
    }

    /**
     * Memperbarui data pemeriksaan berdasarkan ID (API Update).
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'id_pegawai_pemeriksaan' => 'nullable|exists:pegawai,id_pegawai',
            'jenis_pemeriksaan' => 'required|string|max:100',
            'hasil_pemeriksaan' => 'nullable|string|max:255',
            'rekomendasi' => 'nullable|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'jam_pemeriksaan' => 'nullable|date_format:H:i',
        ]);

        $pemeriksaan = Pemeriksaan::find($id);

        if (!$pemeriksaan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pemeriksaan tidak ditemukan.',
            ], 404);
        }

        $pemeriksaan->update([
            'id_kunjungan' => $request->id_kunjungan,
            'id_pegawai_pemeriksaan' => $request->id_pegawai_pemeriksaan,
            'jenis_pemeriksaan' => $request->jenis_pemeriksaan,
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'rekomendasi' => $request->rekomendasi,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'jam_pemeriksaan' => $request->jam_pemeriksaan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data pemeriksaan berhasil diperbarui.',
            'data' => $pemeriksaan
        ], 200);
    }

    /**
     * Menghapus data pemeriksaan berdasarkan ID (API Delete).
     */
    public function destroy($id)
    {
        $pemeriksaan = Pemeriksaan::find($id);

        if (!$pemeriksaan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pemeriksaan tidak ditemukan.',
            ], 404);
        }

        $pemeriksaan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pemeriksaan berhasil dihapus.',
        ], 200);
    }
}
