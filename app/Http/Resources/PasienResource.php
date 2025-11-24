<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PasienResource extends JsonResource
{
    /**
     * Mengubah resource pasien menjadi array.
     * Keterangan setiap kolom ditulis dalam bahasa Indonesia.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_lengkap' => $this->nama_lengkap, // Nama lengkap pasien
            'jenis_kelamin' => $this->jenis_kelamin, // Jenis kelamin pasien (Laki-laki/Perempuan)
            'tanggal_lahir' => $this->tanggal_lahir, // Tanggal lahir pasien
            'alamat' => $this->alamat, // Alamat lengkap pasien
            'no_telepon' => $this->no_telepon, // Nomor telepon pasien
            'no_ktp' => $this->no_ktp, // Nomor KTP pasien
            'status' => $this->status, // Status pasien (Aktif, Tidak Aktif, atau Meninggal)
            'tanggal_daftar' => $this->tanggal_daftar, // Tanggal pasien terdaftar di sistem
            'dibuat_pada' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'diperbarui_pada' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }
}

