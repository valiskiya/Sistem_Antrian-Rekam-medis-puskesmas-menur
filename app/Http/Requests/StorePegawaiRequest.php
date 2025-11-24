<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePegawaiRequest extends FormRequest
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
            'nama_lengkap' => 'required|max:100', // Nama lengkap wajib diisi, maksimal 100 karakter
            'jabatan' => 'required|max:50', // Jabatan wajib diisi, maksimal 50 karakter
            'tanggal_lahir' => 'required|date', // Tanggal lahir wajib diisi, dengan format tanggal yang valid
            'tanggal_masuk_kerja' => 'required|date', // Tanggal masuk kerja wajib diisi, dengan format tanggal yang valid
            'alamat' => 'required|max:255', // Alamat wajib diisi, maksimal 255 karakter
            'no_telepon' => 'nullable|max:20', // No telepon bersifat opsional, maksimal 20 karakter
            'nomor_SIP' => 'required|unique:pegawai,nomor_SIP|max:30', // Nomor SIP wajib diisi dan harus unik dalam tabel pegawai
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
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 100 karakter.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'jabatan.max' => 'Jabatan tidak boleh lebih dari 50 karakter.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'tanggal_masuk_kerja.required' => 'Tanggal masuk kerja harus diisi.',
            'tanggal_masuk_kerja.date' => 'Tanggal masuk kerja harus berupa tanggal yang valid.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'no_telepon.max' => 'No telepon tidak boleh lebih dari 20 karakter.',
            'nomor_SIP.required' => 'Nomor SIP harus diisi.',
            'nomor_SIP.unique' => 'Nomor SIP sudah terdaftar.',
            'nomor_SIP.max' => 'Nomor SIP tidak boleh lebih dari 30 karakter.',
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
            'nama_lengkap' => 'Nama Lengkap',
            'jabatan' => 'Jabatan',
            'tanggal_lahir' => 'Tanggal Lahir',
            'tanggal_masuk_kerja' => 'Tanggal Masuk Kerja',
            'alamat' => 'Alamat',
            'no_telepon' => 'No Telepon',
            'nomor_SIP' => 'Nomor SIP',
        ];
    }
}
