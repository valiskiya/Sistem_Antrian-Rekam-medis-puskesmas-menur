<?php

namespace App\Http\Controllers;

use App\Models\Pasien;  // Mengimpor model Pasien
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Menampilkan semua data pasien
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data pasien dari database
        $pasien = Pasien::all();
        return response()->json($pasien); // Mengembalikan data dalam format JSON
    }

    /**
     * Menampilkan data pasien berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mencari pasien berdasarkan ID
        $pasien = Pasien::find($id);

        // Jika pasien tidak ditemukan
        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        return response()->json($pasien); // Mengembalikan data pasien dalam format JSON
    }

    /**
     * Menyimpan data pasien baru
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'no_ktp' => 'required|unique:pasien,no_ktp|string|max:20',
            'status' => 'required|in:Aktif,Tidak Aktif,Meninggal',
            'tanggal_daftar' => 'nullable|date',
        ]);

        // Menyimpan data pasien baru
        $pasien = Pasien::create([
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'no_ktp' => $request->no_ktp,
            'status' => $request->status,
            'tanggal_daftar' => $request->tanggal_daftar,
        ]);

        // Mengembalikan respon sukses dengan data pasien yang baru
        return response()->json($pasien, 201);
    }

    /**
     * Mengupdate data pasien berdasarkan ID
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Mencari pasien berdasarkan ID
        $pasien = Pasien::find($id);

        // Jika pasien tidak ditemukan
        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        // Validasi data yang diterima
        $request->validate([
            'nama_lengkap' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'no_ktp' => 'nullable|unique:pasien,no_ktp,' . $id . '|string|max:20',
            'status' => 'nullable|in:Aktif,Tidak Aktif,Meninggal',
            'tanggal_daftar' => 'nullable|date',
        ]);

        // Mengupdate data pasien
        $pasien->update($request->all());

        return response()->json($pasien); // Mengembalikan data pasien yang sudah diupdate
    }

    /**
     * Menghapus data pasien berdasarkan ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Mencari pasien berdasarkan ID
        $pasien = Pasien::find($id);

        // Jika pasien tidak ditemukan
        if (!$pasien) {
            return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
        }

        // Menghapus data pasien
        $pasien->delete();

        return response()->json(['message' => 'Pasien berhasil dihapus']); // Mengembalikan respon berhasil
    }
}
