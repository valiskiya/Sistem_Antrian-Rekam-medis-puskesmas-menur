<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJadwalPraktikRequest extends FormRequest
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
            'id_dokter' => 'required|exists:dokter,id_dokter', // ID Dokter wajib diisi dan harus ada di tabel dokter
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu', // Hari wajib diisi dan harus salah satu dari hari yang valid
            'tanggal' => 'nullable|date', // Tanggal bersifat opsional dan harus berupa tanggal yang valid
            'jam_mulai' => 'required|date_format:H:i', // Jam mulai wajib diisi dengan format HH:MM
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai', // Jam selesai wajib diisi dengan format HH:MM dan harus setelah jam mulai
            'kuota_pasien' => 'required|integer|min:0', // Kuota pasien wajib diisi, harus berupa angka bulat dan lebih besar atau sama dengan 0
            'status' => 'required|in:Aktif,Nonaktif', // Status wajib diisi dan harus salah satu dari pilihan yang valid (Aktif atau Nonaktif)
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
            'id_dokter.required' => 'ID Dokter harus diisi.',
            'id_dokter.exists' => 'ID Dokter tidak ditemukan.',
            'hari.required' => 'Hari praktik harus diisi.',
            'hari.in' => 'Hari praktik harus salah satu dari Senin, Selasa, Rabu, Kamis, Jumat, Sabtu, atau Minggu.',
            'tanggal.date' => 'Tanggal harus berupa tanggal yang valid.',
            'jam_mulai.required' => 'Jam mulai harus diisi.',
            'jam_mulai.date_format' => 'Jam mulai harus menggunakan format HH:MM.',
            'jam_selesai.required' => 'Jam selesai harus diisi.',
            'jam_selesai.date_format' => 'Jam selesai harus menggunakan format HH:MM.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'kuota_pasien.required' => 'Kuota pasien harus diisi.',
            'kuota_pasien.integer' => 'Kuota pasien harus berupa angka bulat.',
            'kuota_pasien.min' => 'Kuota pasien harus lebih besar atau sama dengan 0.',
            'status.required' => 'Status harus diisi.',
            'status.in' => 'Status harus salah satu dari Aktif atau Nonaktif.',
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
            'id_dokter' => 'ID Dokter',
            'hari' => 'Hari',
            'tanggal' => 'Tanggal',
            'jam_mulai' => 'Jam Mulai',
            'jam_selesai' => 'Jam Selesai',
            'kuota_pasien' => 'Kuota Pasien',
            'status' => 'Status',
        ];
    }
}
