<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Menampilkan daftar semua laporan
     */
    public function index()
    {
        // Mengambil semua data laporan beserta data pegawai terkait
        $laporan = Laporan::with('pegawai')->get();
        return view('laporan.index', compact('laporan'));
    }

    /**
     * Menampilkan form untuk menambah laporan baru
     */
    public function create()
    {
        // Mendapatkan data pegawai untuk dropdown
        $pegawai = Pegawai::all();

        return view('laporan.create', compact('pegawai'));
    }

    /**
     * Menyimpan data laporan baru
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            'jenis_laporan' => 'required|in:Harian,Mingguan,Bulanan,Tahunan',
            'tanggal_laporan' => 'required|date',
            'deskripsi_laporan' => 'required|string|max:1000',
        ]);

        // Menyimpan data laporan baru ke dalam database
        Laporan::create([
            'id_pegawai' => $request->id_pegawai,
            'jenis_laporan' => $request->jenis_laporan,
            'tanggal_laporan' => $request->tanggal_laporan,
            'deskripsi_laporan' => $request->deskripsi_laporan,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit data laporan
     */
    public function edit($id)
    {
        $laporan = Laporan::findOrFail($id);

        // Mendapatkan data pegawai untuk dropdown
        $pegawai = Pegawai::all();

        return view('laporan.edit', compact('laporan', 'pegawai'));
    }

    /**
     * Mengupdate data laporan
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            'jenis_laporan' => 'required|in:Harian,Mingguan,Bulanan,Tahunan',
            'tanggal_laporan' => 'required|date',
            'deskripsi_laporan' => 'required|string|max:1000',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'id_pegawai' => $request->id_pegawai,
            'jenis_laporan' => $request->jenis_laporan,
            'tanggal_laporan' => $request->tanggal_laporan,
            'deskripsi_laporan' => $request->deskripsi_laporan,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui');
    }

    /**
     * Menghapus data laporan
     */
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus');
    }
}
