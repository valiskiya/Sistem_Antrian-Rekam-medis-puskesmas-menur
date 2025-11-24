<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    /**
     * Menampilkan daftar semua kunjungan
     */
    public function index()
    {
        // Mengambil semua data kunjungan
        $kunjungan = Kunjungan::with(['pasien', 'dokter', 'poli', 'pegawaiAdmin'])->get();
        return view('kunjungan.index', compact('kunjungan'));
    }

    /**
     * Menampilkan form untuk menambah kunjungan baru
     */
    public function create()
    {
        // Mendapatkan data untuk dropdown
        $pasien = Pasien::all();
        $dokter = Dokter::all();
        $poli = Poli::all();
        $pegawai = Pegawai::all();

        return view('kunjungan.create', compact('pasien', 'dokter', 'poli', 'pegawai'));
    }

    /**
     * Menyimpan data kunjungan baru
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'nullable|date_format:H:i',
            'keluhan_awal' => 'nullable|max:255',
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_dokter' => 'nullable|exists:dokter,id_dokter',
            'id_poli' => 'nullable|exists:poli,id_poli',
            'id_pegawai_admin' => 'nullable|exists:pegawai,id_pegawai',
        ]);

        // Menyimpan data kunjungan baru ke dalam database
        Kunjungan::create([
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'jam_kunjungan' => $request->jam_kunjungan,
            'keluhan_awal' => $request->keluhan_awal,
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'id_poli' => $request->id_poli,
            'id_pegawai_admin' => $request->id_pegawai_admin,
        ]);

        return redirect()->route('kunjungan.index')->with('success', 'Kunjungan berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit data kunjungan
     */
    public function edit($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);

        // Mendapatkan data untuk dropdown
        $pasien = Pasien::all();
        $dokter = Dokter::all();
        $poli = Poli::all();
        $pegawai = Pegawai::all();

        return view('kunjungan.edit', compact('kunjungan', 'pasien', 'dokter', 'poli', 'pegawai'));
    }

    /**
     * Mengupdate data kunjungan
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'nullable|date_format:H:i',
            'keluhan_awal' => 'nullable|max:255',
            'id_pasien' => 'required|exists:pasien,id_pasien',
            'id_dokter' => 'nullable|exists:dokter,id_dokter',
            'id_poli' => 'nullable|exists:poli,id_poli',
            'id_pegawai_admin' => 'nullable|exists:pegawai,id_pegawai',
        ]);

        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->update([
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'jam_kunjungan' => $request->jam_kunjungan,
            'keluhan_awal' => $request->keluhan_awal,
            'id_pasien' => $request->id_pasien,
            'id_dokter' => $request->id_dokter,
            'id_poli' => $request->id_poli,
            'id_pegawai_admin' => $request->id_pegawai_admin,
        ]);

        return redirect()->route('kunjungan.index')->with('success', 'Kunjungan berhasil diperbarui');
    }

    /**
     * Menghapus data kunjungan
     */
    public function destroy($id)
    {
        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->delete();

        return redirect()->route('kunjungan.index')->with('success', 'Kunjungan berhasil dihapus');
    }
}
