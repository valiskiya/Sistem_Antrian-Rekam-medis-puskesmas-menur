<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreObatRequest extends FormRequest
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
            'nama_obat' => 'required|string|max:100', // Nama obat wajib diisi, berupa string, maksimal 100 karakter
            'jenis_obat' => 'nullable|string|max:50', // Jenis obat bersifat opsional, berupa string, maksimal 50 karakter
            'dosis' => 'required|string|max:255', // Dosis obat wajib diisi, berupa string, maksimal 255 karakter
            'harga' => 'required|numeric|min:0', // Harga wajib diisi, berupa angka dan harus lebih besar atau sama dengan 0
            'stok' => 'required|integer|min:0', // Stok wajib diisi, berupa angka bulat dan harus lebih besar atau sama dengan 0
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
            'nama_obat.required' => 'Nama obat harus diisi.',
            'nama_obat.string' => 'Nama obat harus berupa teks.',
            'nama_obat.max' => 'Nama obat tidak boleh lebih dari 100 karakter.',
            'jenis_obat.string' => 'Jenis obat harus berupa teks.',
            'jenis_obat.max' => 'Jenis obat tidak boleh lebih dari 50 karakter.',
            'dosis.required' => 'Dosis obat harus diisi.',
            'dosis.string' => 'Dosis obat harus berupa teks.',
            'dosis.max' => 'Dosis obat tidak boleh lebih dari 255 karakter.',
            'harga.required' => 'Harga obat harus diisi.',
            'harga.numeric' => 'Harga obat harus berupa angka.',
            'harga.min' => 'Harga obat harus lebih besar atau sama dengan 0.',
            'stok.required' => 'Stok obat harus diisi.',
            'stok.integer' => 'Stok obat harus berupa angka bulat.',
            'stok.min' => 'Stok obat harus lebih besar atau sama dengan 0.',
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
            'nama_obat' => 'Nama Obat',
            'jenis_obat' => 'Jenis Obat',
            'dosis' => 'Dosis',
            'harga' => 'Harga',
            'stok' => 'Stok',
        ];
    }
}
