<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Kunjungan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    /**
     * Menampilkan daftar semua pemeriksaan
     */
    public function index()
    {
        // Mengambil semua data pemeriksaan beserta data kunjungan dan pegawai terkait
        $pemeriksaan = Pemeriksaan::with(['kunjungan', 'pegawaiPemeriksaan'])->get();
        return view('pemeriksaan.index', compact('pemeriksaan'));
    }

    /**
     * Menampilkan form untuk menambah pemeriksaan baru
     */
    public function create()
    {
        // Mendapatkan data kunjungan dan pegawai untuk dropdown
        $kunjungan = Kunjungan::all();
        $pegawai = Pegawai::all();

        return view('pemeriksaan.create', compact('kunjungan', 'pegawai'));
    }

    /**
     * Menyimpan data pemeriksaan baru
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'id_pegawai_pemeriksaan' => 'nullable|exists:pegawai,id_pegawai',
            'jenis_pemeriksaan' => 'required|string|max:100',
            'hasil_pemeriksaan' => 'nullable|string|max:255',
            'rekomendasi' => 'nullable|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'jam_pemeriksaan' => 'nullable|date_format:H:i',
        ]);

        // Menyimpan data pemeriksaan baru ke dalam database
        Pemeriksaan::create([
            'id_kunjungan' => $request->id_kunjungan,
            'id_pegawai_pemeriksaan' => $request->id_pegawai_pemeriksaan,
            'jenis_pemeriksaan' => $request->jenis_pemeriksaan,
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'rekomendasi' => $request->rekomendasi,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'jam_pemeriksaan' => $request->jam_pemeriksaan,
        ]);

        return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit data pemeriksaan
     */
    public function edit($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);

        // Mendapatkan data kunjungan dan pegawai untuk dropdown
        $kunjungan = Kunjungan::all();
        $pegawai = Pegawai::all();

        return view('pemeriksaan.edit', compact('pemeriksaan', 'kunjungan', 'pegawai'));
    }

    /**
     * Mengupdate data pemeriksaan
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'id_pegawai_pemeriksaan' => 'nullable|exists:pegawai,id_pegawai',
            'jenis_pemeriksaan' => 'required|string|max:100',
            'hasil_pemeriksaan' => 'nullable|string|max:255',
            'rekomendasi' => 'nullable|string|max:255',
            'tanggal_pemeriksaan' => 'required|date',
            'jam_pemeriksaan' => 'nullable|date_format:H:i',
        ]);

        $pemeriksaan = Pemeriksaan::findOrFail($id);
        $pemeriksaan->update([
            'id_kunjungan' => $request->id_kunjungan,
            'id_pegawai_pemeriksaan' => $request->id_pegawai_pemeriksaan,
            'jenis_pemeriksaan' => $request->jenis_pemeriksaan,
            'hasil_pemeriksaan' => $request->hasil_pemeriksaan,
            'rekomendasi' => $request->rekomendasi,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,
            'jam_pemeriksaan' => $request->jam_pemeriksaan,
        ]);

        return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan berhasil diperbarui');
    }

    /**
     * Menghapus data pemeriksaan
     */
    public function destroy($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        $pemeriksaan->delete();

        return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan berhasil dihapus');
    }
}
