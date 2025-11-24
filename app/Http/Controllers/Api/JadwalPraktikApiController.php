<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JadwalPraktik;
use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalPraktikApiController extends Controller
{
    /**
     * Menampilkan semua data jadwal praktik.
     */
    public function index()
    {
        // Mengambil semua jadwal praktik beserta relasi dokter
        $jadwalPraktik = JadwalPraktik::with('dokter')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data semua jadwal praktik berhasil diambil',
            'data' => $jadwalPraktik
        ], 200);
    }

    /**
     * Menyimpan data jadwal praktik baru.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $validated = $request->validate([
            'id_dokter' => 'required|exists:dokter,id_dokter',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'tanggal' => 'nullable|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota_pasien' => 'required|integer|min:0',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        // Menyimpan data ke tabel jadwal_praktik
        $jadwalPraktik = JadwalPraktik::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data jadwal praktik berhasil ditambahkan',
            'data' => $jadwalPraktik
        ], 201);
    }

    /**
     * Menampilkan data detail jadwal praktik berdasarkan ID.
     */
    public function show($id)
    {
        $jadwalPraktik = JadwalPraktik::with('dokter')->find($id);

        if (!$jadwalPraktik) {
            return response()->json([
                'success' => false,
                'message' => 'Data jadwal praktik tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail jadwal praktik berhasil diambil',
            'data' => $jadwalPraktik
        ], 200);
    }

    /**
     * Mengupdate data jadwal praktik berdasarkan ID.
     */
    public function update(Request $request, $id)
    {
        $jadwalPraktik = JadwalPraktik::find($id);

        if (!$jadwalPraktik) {
            return response()->json([
                'success' => false,
                'message' => 'Data jadwal praktik tidak ditemukan'
            ], 404);
        }

        // Validasi input data
        $validated = $request->validate([
            'id_dokter' => 'required|exists:dokter,id_dokter',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'tanggal' => 'nullable|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota_pasien' => 'required|integer|min:0',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $jadwalPraktik->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data jadwal praktik berhasil diperbarui',
            'data' => $jadwalPraktik
        ], 200);
    }

    /**
     * Menghapus data jadwal praktik berdasarkan ID.
     */
    public function destroy($id)
    {
        $jadwalPraktik = JadwalPraktik::find($id);

        if (!$jadwalPraktik) {
            return response()->json([
                'success' => false,
                'message' => 'Data jadwal praktik tidak ditemukan'
            ], 404);
        }

        $jadwalPraktik->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data jadwal praktik berhasil dihapus'
        ], 200);
    }
}
