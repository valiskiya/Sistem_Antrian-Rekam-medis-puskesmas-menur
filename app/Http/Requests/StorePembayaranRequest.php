<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePembayaranRequest extends FormRequest
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
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan', // ID Kunjungan wajib diisi dan harus ada di tabel kunjungan
            'id_pegawai_kasir' => 'nullable|exists:pegawai,id_pegawai', // ID Pegawai Kasir bersifat opsional dan harus ada di tabel pegawai jika diisi
            'jumlah_total' => 'required|numeric|min:0', // Jumlah total wajib diisi, harus berupa angka dan lebih besar atau sama dengan 0
            'metode_pembayaran' => 'required|in:tunai,transfer,kartu_kredit,bpjs,jamkesmas', // Metode pembayaran wajib diisi dan harus salah satu dari nilai yang ditentukan
            'status_pembayaran' => 'required|in:Lunas,Pending,Ditunda', // Status pembayaran wajib diisi dan harus salah satu dari nilai yang ditentukan
            'catatan_pembayaran' => 'nullable|string|max:255', // Catatan pembayaran bersifat opsional, berupa string, dan maksimal 255 karakter
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
            'id_kunjungan.required' => 'ID Kunjungan harus diisi.',
            'id_kunjungan.exists' => 'ID Kunjungan tidak ditemukan.',
            'id_pegawai_kasir.exists' => 'ID Pegawai Kasir tidak ditemukan.',
            'jumlah_total.required' => 'Jumlah total harus diisi.',
            'jumlah_total.numeric' => 'Jumlah total harus berupa angka.',
            'jumlah_total.min' => 'Jumlah total harus lebih besar atau sama dengan 0.',
            'metode_pembayaran.required' => 'Metode pembayaran harus diisi.',
            'metode_pembayaran.in' => 'Metode pembayaran harus salah satu dari tunai, transfer, kartu_kredit, bpjs, atau jamkesmas.',
            'status_pembayaran.required' => 'Status pembayaran harus diisi.',
            'status_pembayaran.in' => 'Status pembayaran harus salah satu dari Lunas, Pending, atau Ditunda.',
            'catatan_pembayaran.string' => 'Catatan pembayaran harus berupa teks.',
            'catatan_pembayaran.max' => 'Catatan pembayaran tidak boleh lebih dari 255 karakter.',
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
            'id_kunjungan' => 'ID Kunjungan',
            'id_pegawai_kasir' => 'ID Pegawai Kasir',
            'jumlah_total' => 'Jumlah Total',
            'metode_pembayaran' => 'Metode Pembayaran',
            'status_pembayaran' => 'Status Pembayaran',
            'catatan_pembayaran' => 'Catatan Pembayaran',
        ];
    }
}
