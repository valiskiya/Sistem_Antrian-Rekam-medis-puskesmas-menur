<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePemeriksaanRequest extends FormRequest
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
            'id_pegawai_pemeriksaan' => 'nullable|exists:pegawai,id_pegawai', // ID pegawai pemeriksaan bersifat opsional dan harus ada di tabel pegawai jika diisi
            'jenis_pemeriksaan' => 'required|string|max:100', // Jenis pemeriksaan wajib diisi, berupa string, dan maksimal 100 karakter
            'hasil_pemeriksaan' => 'nullable|string|max:255', // Hasil pemeriksaan bersifat opsional, berupa string, dan maksimal 255 karakter
            'rekomendasi' => 'nullable|string|max:255', // Rekomendasi bersifat opsional, berupa string, dan maksimal 255 karakter
            'tanggal_pemeriksaan' => 'required|date', // Tanggal pemeriksaan wajib diisi dan harus berupa tanggal yang valid
            'jam_pemeriksaan' => 'nullable|date_format:H:i', // Jam pemeriksaan bersifat opsional dengan format HH:MM
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
            'id_pegawai_pemeriksaan.exists' => 'ID Pegawai Pemeriksaan tidak ditemukan.',
            'jenis_pemeriksaan.required' => 'Jenis pemeriksaan harus diisi.',
            'jenis_pemeriksaan.string' => 'Jenis pemeriksaan harus berupa teks.',
            'jenis_pemeriksaan.max' => 'Jenis pemeriksaan tidak boleh lebih dari 100 karakter.',
            'hasil_pemeriksaan.string' => 'Hasil pemeriksaan harus berupa teks.',
            'hasil_pemeriksaan.max' => 'Hasil pemeriksaan tidak boleh lebih dari 255 karakter.',
            'rekomendasi.string' => 'Rekomendasi harus berupa teks.',
            'rekomendasi.max' => 'Rekomendasi tidak boleh lebih dari 255 karakter.',
            'tanggal_pemeriksaan.required' => 'Tanggal pemeriksaan harus diisi.',
            'tanggal_pemeriksaan.date' => 'Tanggal pemeriksaan harus berupa tanggal yang valid.',
            'jam_pemeriksaan.date_format' => 'Jam pemeriksaan harus menggunakan format HH:MM.',
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
            'id_pegawai_pemeriksaan' => 'ID Pegawai Pemeriksaan',
            'jenis_pemeriksaan' => 'Jenis Pemeriksaan',
            'hasil_pemeriksaan' => 'Hasil Pemeriksaan',
            'rekomendasi' => 'Rekomendasi',
            'tanggal_pemeriksaan' => 'Tanggal Pemeriksaan',
            'jam_pemeriksaan' => 'Jam Pemeriksaan',
        ];
    }
}
