<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePasienRequest extends FormRequest
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
            'nama_lengkap' => 'required|string|max:100', // Nama lengkap wajib diisi, berupa string, maksimal 100 karakter
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan', // Jenis kelamin wajib dipilih, hanya 'Laki-laki' atau 'Perempuan'
            'tanggal_lahir' => 'required|date', // Tanggal lahir wajib diisi, dengan format tanggal yang valid
            'alamat' => 'required|string|max:255', // Alamat wajib diisi, berupa string, maksimal 255 karakter
            'no_telepon' => 'nullable|string|max:20', // No telepon bersifat opsional, berupa string, maksimal 20 karakter
            'no_ktp' => 'required|unique:pasien,no_ktp|string|max:20', // No KTP wajib diisi dan harus unik dalam tabel pasien
            'status' => 'required|in:Aktif,Tidak Aktif,Meninggal', // Status wajib dipilih, hanya 'Aktif', 'Tidak Aktif', atau 'Meninggal'
            'tanggal_daftar' => 'nullable|date', // Tanggal daftar bersifat opsional, dengan format tanggal yang valid
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
            'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
            'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 100 karakter.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin yang valid adalah Laki-laki atau Perempuan.',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'no_telepon.string' => 'No telepon harus berupa teks.',
            'no_telepon.max' => 'No telepon tidak boleh lebih dari 20 karakter.',
            'no_ktp.required' => 'No KTP harus diisi.',
            'no_ktp.unique' => 'No KTP sudah terdaftar.',
            'no_ktp.string' => 'No KTP harus berupa teks.',
            'no_ktp.max' => 'No KTP tidak boleh lebih dari 20 karakter.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status yang valid adalah Aktif, Tidak Aktif, atau Meninggal.',
            'tanggal_daftar.date' => 'Tanggal daftar harus berupa tanggal yang valid.',
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
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'no_telepon' => 'No Telepon',
            'no_ktp' => 'No KTP',
            'status' => 'Status',
            'tanggal_daftar' => 'Tanggal Daftar',
        ];
    }
}
