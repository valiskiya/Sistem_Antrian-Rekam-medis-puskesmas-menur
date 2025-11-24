<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Kunjungan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PembayaranApiController extends Controller
{
    /**
     * Menampilkan semua data pembayaran beserta relasinya
     */
    public function index()
    {
        // Mengambil semua data pembayaran dengan relasi kunjungan dan pegawai kasir
        $pembayaran = Pembayaran::with(['kunjungan', 'pegawaiKasir'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar semua data pembayaran berhasil diambil',
            'data' => $pembayaran
        ], 200);
    }

    /**
     * Menyimpan data pembayaran baru ke dalam database
     */
    public function store(Request $request)
    {
        // Validasi data input dari pengguna
        $validatedData = $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'id_pegawai_kasir' => 'nullable|exists:pegawai,id_pegawai',
            'jumlah_total' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:tunai,transfer,kartu_kredit,bpjs,jamkesmas',
            'status_pembayaran' => 'required|in:Lunas,Pending,Ditunda',
            'catatan_pembayaran' => 'nullable|string|max:255',
        ]);

        // Simpan data pembayaran baru
        $pembayaran = Pembayaran::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil ditambahkan',
            'data' => $pembayaran
        ], 201);
    }

    /**
     * Menampilkan detail data pembayaran berdasarkan ID
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::with(['kunjungan', 'pegawaiKasir'])->find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data pembayaran berhasil diambil',
            'data' => $pembayaran
        ], 200);
    }

    /**
     * Mengupdate data pembayaran berdasarkan ID
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'id_pegawai_kasir' => 'nullable|exists:pegawai,id_pegawai',
            'jumlah_total' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:tunai,transfer,kartu_kredit,bpjs,jamkesmas',
            'status_pembayaran' => 'required|in:Lunas,Pending,Ditunda',
            'catatan_pembayaran' => 'nullable|string|max:255',
        ]);

        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan',
            ], 404);
        }

        // Update data pembayaran
        $pembayaran->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil diperbarui',
            'data' => $pembayaran
        ], 200);
    }

    /**
     * Menghapus data pembayaran berdasarkan ID
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan',
            ], 404);
        }

        $pembayaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pembayaran berhasil dihapus'
        ], 200);
    }
}
