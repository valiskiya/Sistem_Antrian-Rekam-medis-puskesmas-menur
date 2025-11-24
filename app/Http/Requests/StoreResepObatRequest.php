<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResepObatRequest extends FormRequest
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
            'id_pasien' => 'required|exists:pasien,id_pasien', // ID Pasien wajib diisi dan harus ada di tabel pasien
            'id_rekam_medis' => 'required|exists:rekam_medis,id_rekam_medis', // ID Rekam Medis wajib diisi dan harus ada di tabel rekam medis
            'id_obat' => 'required|exists:obat,id_obat', // ID Obat wajib diisi dan harus ada di tabel obat
            'jumlah' => 'required|integer|min:1', // Jumlah obat wajib diisi, harus berupa angka bulat dan lebih besar dari 0
            'dosis' => 'nullable|string|max:50', // Dosis bersifat opsional, maksimal 50 karakter
            'tanggal_resep' => 'required|date', // Tanggal resep wajib diisi dan harus berupa tanggal yang valid
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
            'id_pasien.required' => 'ID Pasien harus diisi.',
            'id_pasien.exists' => 'ID Pasien tidak ditemukan.',
            'id_rekam_medis.required' => 'ID Rekam Medis harus diisi.',
            'id_rekam_medis.exists' => 'ID Rekam Medis tidak ditemukan.',
            'id_obat.required' => 'ID Obat harus diisi.',
            'id_obat.exists' => 'ID Obat tidak ditemukan.',
            'jumlah.required' => 'Jumlah obat harus diisi.',
            'jumlah.integer' => 'Jumlah obat harus berupa angka.',
            'jumlah.min' => 'Jumlah obat harus lebih besar dari 0.',
            'dosis.string' => 'Dosis harus berupa teks.',
            'dosis.max' => 'Dosis tidak boleh lebih dari 50 karakter.',
            'tanggal_resep.required' => 'Tanggal resep harus diisi.',
            'tanggal_resep.date' => 'Tanggal resep harus berupa tanggal yang valid.',
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
            'id_pasien' => 'ID Pasien',
            'id_rekam_medis' => 'ID Rekam Medis',
            'id_obat' => 'ID Obat',
            'jumlah' => 'Jumlah',
            'dosis' => 'Dosis',
            'tanggal_resep' => 'Tanggal Resep',
        ];
    }
}
