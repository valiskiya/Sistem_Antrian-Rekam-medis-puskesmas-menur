<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat permintaan ini.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Mengizinkan semua pengguna untuk mengakses
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk permintaan ini.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_pegawai' => 'required|exists:pegawai,id_pegawai', // ID Pegawai wajib diisi dan harus ada di tabel pegawai
            'jenis_laporan' => 'required|in:Harian,Mingguan,Bulanan,Tahunan', // Jenis laporan wajib diisi dan harus salah satu dari pilihan yang ada
            'tanggal_laporan' => 'required|date', // Tanggal laporan wajib diisi dan harus berupa tanggal yang valid
            'deskripsi_laporan' => 'required|string|max:1000', // Deskripsi laporan wajib diisi, berupa string, dan maksimal 1000 karakter
        ];
    }

    /**
     * Pesan kesalahan kustom untuk aturan validasi tertentu.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id_pegawai.required' => 'ID Pegawai harus diisi.',
            'id_pegawai.exists' => 'ID Pegawai tidak ditemukan.',
            'jenis_laporan.required' => 'Jenis laporan harus diisi.',
            'jenis_laporan.in' => 'Jenis laporan harus salah satu dari Harian, Mingguan, Bulanan, atau Tahunan.',
            'tanggal_laporan.required' => 'Tanggal laporan harus diisi.',
            'tanggal_laporan.date' => 'Tanggal laporan harus berupa tanggal yang valid.',
            'deskripsi_laporan.required' => 'Deskripsi laporan harus diisi.',
            'deskripsi_laporan.string' => 'Deskripsi laporan harus berupa teks.',
            'deskripsi_laporan.max' => 'Deskripsi laporan tidak boleh lebih dari 1000 karakter.',
        ];
    }

    /**
     * Tentukan atribut yang digunakan untuk validasi
     * atau untuk penyesuaian khusus lainnya
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'id_pegawai' => 'ID Pegawai',
            'jenis_laporan' => 'Jenis Laporan',
            'tanggal_laporan' => 'Tanggal Laporan',
            'deskripsi_laporan' => 'Deskripsi Laporan',
        ];
    }
}
