<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePoliRequest extends FormRequest
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
            'nama_poli' => 'required|unique:poli,nama_poli|max:100', // Nama poli wajib diisi, harus unik dan maksimal 100 karakter
            'deskripsi' => 'nullable|max:255', // Deskripsi bersifat opsional dan maksimal 255 karakter
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
            'nama_poli.required' => 'Nama poli harus diisi.',
            'nama_poli.unique' => 'Nama poli sudah terdaftar.',
            'nama_poli.max' => 'Nama poli tidak boleh lebih dari 100 karakter.',
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.',
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
            'nama_poli' => 'Nama Poli',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
