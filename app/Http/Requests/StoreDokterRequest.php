<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDokterRequest extends FormRequest
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
            'nama_dokter' => 'required|max:100', // Nama dokter wajib diisi, maksimal 100 karakter
            'spesialisasi' => 'nullable|max:100', // Spesialisasi bersifat opsional, maksimal 100 karakter
            'no_telepon' => 'required|unique:dokter,no_telepon|max:20', // No telepon wajib diisi, harus unik, dan maksimal 20 karakter
            'jam_praktik' => 'nullable|date_format:H:i', // Jam praktik bersifat opsional, dengan format waktu HH:MM
            'jadwal_konsultasi' => 'nullable|max:100', // Jadwal konsultasi bersifat opsional, maksimal 100 karakter
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
            'nama_dokter.required' => 'Nama dokter harus diisi.',
            'nama_dokter.max' => 'Nama dokter tidak boleh lebih dari 100 karakter.',
            'spesialisasi.max' => 'Spesialisasi tidak boleh lebih dari 100 karakter.',
            'no_telepon.required' => 'No telepon harus diisi.',
            'no_telepon.unique' => 'No telepon sudah terdaftar.',
            'no_telepon.max' => 'No telepon tidak boleh lebih dari 20 karakter.',
            'jam_praktik.date_format' => 'Jam praktik harus menggunakan format HH:MM.',
            'jadwal_konsultasi.max' => 'Jadwal konsultasi tidak boleh lebih dari 100 karakter.',
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
            'nama_dokter' => 'Nama Dokter',
            'spesialisasi' => 'Spesialisasi',
            'no_telepon' => 'No Telepon',
            'jam_praktik' => 'Jam Praktik',
            'jadwal_konsultasi' => 'Jadwal Konsultasi',
        ];
    }
}
