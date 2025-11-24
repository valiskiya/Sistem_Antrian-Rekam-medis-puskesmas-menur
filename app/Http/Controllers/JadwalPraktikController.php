<?php

namespace App\Http\Controllers;

use App\Models\JadwalPraktik;
use App\Models\Dokter;
use Illuminate\Http\Request;

class JadwalPraktikController extends Controller
{
    /**
     * Menampilkan daftar semua jadwal praktik
     */
    public function index()
    {
        // Mengambil semua data jadwal praktik beserta data dokter terkait
        $jadwalPraktik = JadwalPraktik::with('dokter')->get();
        return view('jadwal_praktik.index', compact('jadwalPraktik'));
    }

    /**
     * Menampilkan form untuk menambah jadwal praktik baru
     */
    public function create()
    {
        // Mendapatkan data dokter untuk dropdown
        $dokter = Dokter::all();

        return view('jadwal_praktik.create', compact('dokter'));
    }

    /**
     * Menyimpan data jadwal praktik baru
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_dokter' => 'required|exists:dokter,id_dokter',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'tanggal' => 'nullable|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota_pasien' => 'required|integer|min:0',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        // Menyimpan data jadwal praktik baru ke dalam database
        JadwalPraktik::create([
            'id_dokter' => $request->id_dokter,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kuota_pasien' => $request->kuota_pasien,
            'status' => $request->status,
        ]);

        return redirect()->route('jadwal_praktik.index')->with('success', 'Jadwal praktik berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit data jadwal praktik
     */
    public function edit($id)
    {
        $jadwalPraktik = JadwalPraktik::findOrFail($id);

        // Mendapatkan data dokter untuk dropdown
        $dokter = Dokter::all();

        return view('jadwal_praktik.edit', compact('jadwalPraktik', 'dokter'));
    }

    /**
     * Mengupdate data jadwal praktik
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_dokter' => 'required|exists:dokter,id_dokter',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'tanggal' => 'nullable|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'kuota_pasien' => 'required|integer|min:0',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $jadwalPraktik = JadwalPraktik::findOrFail($id);
        $jadwalPraktik->update([
            'id_dokter' => $request->id_dokter,
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kuota_pasien' => $request->kuota_pasien,
            'status' => $request->status,
        ]);

        return redirect()->route('jadwal_praktik.index')->with('success', 'Jadwal praktik berhasil diperbarui');
    }

    /**
     * Menghapus data jadwal praktik
     */
    public function destroy($id)
    {
        $jadwalPraktik = JadwalPraktik::findOrFail($id);
        $jadwalPraktik->delete();

        return redirect()->route('jadwal_praktik.index')->with('success', 'Jadwal praktik berhasil dihapus');
    }
}
