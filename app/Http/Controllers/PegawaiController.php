<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Menampilkan daftar semua pegawai
     */
    public function index()
    {
        // Mengambil semua data pegawai
        $pegawai = Pegawai::all();
        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * Menampilkan form untuk menambah pegawai baru
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Menyimpan data pegawai baru
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_lengkap' => 'required|max:100',
            'jabatan' => 'required|max:50',
            'tanggal_lahir' => 'required|date',
            'tanggal_masuk_kerja' => 'required|date',
            'alamat' => 'required|max:255',
            'no_telepon' => 'nullable|max:20',
            'nomor_SIP' => 'required|unique:pegawai,nomor_SIP|max:30',
        ]);

        // Menyimpan data pegawai baru ke dalam database
        Pegawai::create([
            'nama_lengkap' => $request->nama_lengkap,
            'jabatan' => $request->jabatan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_masuk_kerja' => $request->tanggal_masuk_kerja,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'nomor_SIP' => $request->nomor_SIP,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit data pegawai
     */
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Mengupdate data pegawai
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'nama_lengkap' => 'required|max:100',
            'jabatan' => 'required|max:50',
            'tanggal_lahir' => 'required|date',
            'tanggal_masuk_kerja' => 'required|date',
            'alamat' => 'required|max:255',
            'no_telepon' => 'nullable|max:20',
            'nomor_SIP' => 'required|max:30|unique:pegawai,nomor_SIP,' . $id,
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update([
            'nama_lengkap' => $request->nama_lengkap,
            'jabatan' => $request->jabatan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_masuk_kerja' => $request->tanggal_masuk_kerja,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'nomor_SIP' => $request->nomor_SIP,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui');
    }

    /**
     * Menghapus data pegawai
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus');
    }
}
