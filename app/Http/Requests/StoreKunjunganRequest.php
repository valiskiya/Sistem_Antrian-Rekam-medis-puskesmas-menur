<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKunjunganRequest extends FormRequest
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
            'tanggal_kunjungan' => 'required|date', // Tanggal kunjungan wajib diisi dan harus berupa tanggal yang valid
            'jam_kunjungan' => 'nullable|date_format:H:i', // Jam kunjungan bersifat opsional dengan format HH:MM
            'keluhan_awal' => 'nullable|max:255', // Keluhan awal bersifat opsional dan maksimal 255 karakter
            'id_pasien' => 'required|exists:pasien,id_pasien', // ID Pasien wajib diisi dan harus ada di tabel pasien
            'id_dokter' => 'nullable|exists:dokter,id_dokter', // ID Dokter bersifat opsional dan harus ada di tabel dokter jika diisi
            'id_poli' => 'nullable|exists:poli,id_poli', // ID Poli bersifat opsional dan harus ada di tabel poli jika diisi
            'id_pegawai_admin' => 'nullable|exists:pegawai,id_pegawai', // ID Pegawai Admin bersifat opsional dan harus ada di tabel pegawai jika diisi
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
            'tanggal_kunjungan.required' => 'Tanggal kunjungan harus diisi.',
            'tanggal_kunjungan.date' => 'Tanggal kunjungan harus berupa tanggal yang valid.',
            'jam_kunjungan.date_format' => 'Jam kunjungan harus menggunakan format HH:MM.',
            'keluhan_awal.max' => 'Keluhan awal tidak boleh lebih dari 255 karakter.',
            'id_pasien.required' => 'ID Pasien harus diisi.',
            'id_pasien.exists' => 'ID Pasien tidak ditemukan.',
            'id_dokter.exists' => 'ID Dokter tidak ditemukan.',
            'id_poli.exists' => 'ID Poli tidak ditemukan.',
            'id_pegawai_admin.exists' => 'ID Pegawai Admin tidak ditemukan.',
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
            'tanggal_kunjungan' => 'Tanggal Kunjungan',
            'jam_kunjungan' => 'Jam Kunjungan',
            'keluhan_awal' => 'Keluhan Awal',
            'id_pasien' => 'ID Pasien',
            'id_dokter' => 'ID Dokter',
            'id_poli' => 'ID Poli',
            'id_pegawai_admin' => 'ID Pegawai Admin',
        ];
    }
}
