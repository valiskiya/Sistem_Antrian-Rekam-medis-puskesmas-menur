<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Kunjungan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Menampilkan daftar semua pembayaran
     */
    public function index()
    {
        // Mengambil semua data pembayaran beserta data terkait (kunjungan dan pegawai kasir)
        $pembayaran = Pembayaran::with(['kunjungan', 'pegawaiKasir'])->get();
        return view('pembayaran.index', compact('pembayaran'));
    }

    /**
     * Menampilkan form untuk menambah pembayaran baru
     */
    public function create()
    {
        // Mendapatkan data kunjungan dan pegawai (kasir) untuk dropdown
        $kunjungan = Kunjungan::all();
        $pegawai = Pegawai::all();

        return view('pembayaran.create', compact('kunjungan', 'pegawai'));
    }

    /**
     * Menyimpan data pembayaran baru
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'id_pegawai_kasir' => 'nullable|exists:pegawai,id_pegawai',
            'jumlah_total' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:tunai,transfer,kartu_kredit,bpjs,jamkesmas',
            'status_pembayaran' => 'required|in:Lunas,Pending,Ditunda',
            'catatan_pembayaran' => 'nullable|string|max:255',
        ]);

        // Menyimpan data pembayaran baru ke dalam database
        Pembayaran::create([
            'id_kunjungan' => $request->id_kunjungan,
            'id_pegawai_kasir' => $request->id_pegawai_kasir,
            'jumlah_total' => $request->jumlah_total,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
            'catatan_pembayaran' => $request->catatan_pembayaran,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    /**
     * Menampilkan form untuk mengedit data pembayaran
     */
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        // Mendapatkan data kunjungan dan pegawai (kasir) untuk dropdown
        $kunjungan = Kunjungan::all();
        $pegawai = Pegawai::all();

        return view('pembayaran.edit', compact('pembayaran', 'kunjungan', 'pegawai'));
    }

    /**
     * Mengupdate data pembayaran
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan',
            'id_pegawai_kasir' => 'nullable|exists:pegawai,id_pegawai',
            'jumlah_total' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|in:tunai,transfer,kartu_kredit,bpjs,jamkesmas',
            'status_pembayaran' => 'required|in:Lunas,Pending,Ditunda',
            'catatan_pembayaran' => 'nullable|string|max:255',
        ]);

        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->update([
            'id_kunjungan' => $request->id_kunjungan,
            'id_pegawai_kasir' => $request->id_pegawai_kasir,
            'jumlah_total' => $request->jumlah_total,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
            'catatan_pembayaran' => $request->catatan_pembayaran,
        ]);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diperbarui');
    }

    /**
     * Menghapus data pembayaran
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus');
    }
}
