<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRekamMedisRequest extends FormRequest
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
            'id_kunjungan' => 'required|exists:kunjungan,id_kunjungan', // ID kunjungan wajib diisi dan harus ada di tabel kunjungan
            'tanggal_pemeriksaan' => 'required|date', // Tanggal pemeriksaan wajib diisi dan harus berupa tanggal yang valid
            'diagnosis' => 'required|string|max:255', // Diagnosis wajib diisi, harus berupa string, dan maksimal 255 karakter
            'terapi' => 'required|string|max:255', // Terapi wajib diisi, harus berupa string, dan maksimal 255 karakter
            'catatan_dokter' => 'nullable|string|max:255', // Catatan dokter bersifat opsional, maksimal 255 karakter
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
            'tanggal_pemeriksaan.required' => 'Tanggal pemeriksaan harus diisi.',
            'tanggal_pemeriksaan.date' => 'Tanggal pemeriksaan harus berupa tanggal yang valid.',
            'diagnosis.required' => 'Diagnosis harus diisi.',
            'diagnosis.string' => 'Diagnosis harus berupa teks.',
            'diagnosis.max' => 'Diagnosis tidak boleh lebih dari 255 karakter.',
            'terapi.required' => 'Terapi harus diisi.',
            'terapi.string' => 'Terapi harus berupa teks.',
            'terapi.max' => 'Terapi tidak boleh lebih dari 255 karakter.',
            'catatan_dokter.string' => 'Catatan dokter harus berupa teks.',
            'catatan_dokter.max' => 'Catatan dokter tidak boleh lebih dari 255 karakter.',
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
            'tanggal_pemeriksaan' => 'Tanggal Pemeriksaan',
            'diagnosis' => 'Diagnosis',
            'terapi' => 'Terapi',
            'catatan_dokter' => 'Catatan Dokter',
        ];
    }
}
