<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PegawaiResource extends JsonResource
{
    /**
     * Mengubah data model Pegawai menjadi array JSON yang terstruktur.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_pegawai' => $this->id, // ID unik pegawai
            'nama_lengkap' => $this->nama_lengkap, // Nama lengkap pegawai
            'jabatan' => $this->jabatan, // Jabatan atau posisi pegawai
            'tanggal_lahir' => $this->tanggal_lahir, // Tanggal lahir pegawai
            'tanggal_masuk_kerja' => $this->tanggal_masuk_kerja, // Tanggal mulai bekerja
            'alamat' => $this->alamat, // Alamat lengkap pegawai
            'no_telepon' => $this->no_telepon, // Nomor telepon (opsional)
            'nomor_SIP' => $this->nomor_SIP, // Nomor Surat Izin Praktik (SIP)
            'dibuat_pada' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null, // Tanggal & waktu data dibuat
            'diperbarui_pada' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null, // Tanggal & waktu data terakhir diupdate
        ];
    }
}
