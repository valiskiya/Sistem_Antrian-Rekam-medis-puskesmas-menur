<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBiayaRequest extends FormRequest
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
            'id_obat' => 'nullable|exists:obat,id_obat', // ID Obat bersifat opsional dan harus ada di tabel obat jika diisi
            'jenis_biaya' => 'required|string|max:100', // Jenis biaya wajib diisi, berupa string, dan maksimal 100 karakter
            'jumlah_biaya' => 'required|numeric|min:0', // Jumlah biaya wajib diisi, berupa angka, dan lebih besar atau sama dengan 0
            'tanggal_biaya' => 'required|date', // Tanggal biaya wajib diisi dan harus berupa tanggal yang valid
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
            'id_obat.exists' => 'ID Obat tidak ditemukan.',
            'jenis_biaya.required' => 'Jenis biaya harus diisi.',
            'jenis_biaya.string' => 'Jenis biaya harus berupa teks.',
            'jenis_biaya.max' => 'Jenis biaya tidak boleh lebih dari 100 karakter.',
            'jumlah_biaya.required' => 'Jumlah biaya harus diisi.',
            'jumlah_biaya.numeric' => 'Jumlah biaya harus berupa angka.',
            'jumlah_biaya.min' => 'Jumlah biaya harus lebih besar atau sama dengan 0.',
            'tanggal_biaya.required' => 'Tanggal biaya harus diisi.',
            'tanggal_biaya.date' => 'Tanggal biaya harus berupa tanggal yang valid.',
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
            'id_obat' => 'ID Obat',
            'jenis_biaya' => 'Jenis Biaya',
            'jumlah_biaya' => 'Jumlah Biaya',
            'tanggal_biaya' => 'Tanggal Biaya',
        ];
    }
}
