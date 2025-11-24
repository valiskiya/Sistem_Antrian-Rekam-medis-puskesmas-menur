<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DokterResource extends JsonResource
{
    /**
     * Mengubah data model Dokter menjadi array JSON yang terstruktur.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_dokter' => $this->id, // ID unik dokter
            'nama_dokter' => $this->nama_dokter, // Nama lengkap dokter
            'spesialisasi' => $this->spesialisasi, // Bidang keahlian dokter
            'no_telepon' => $this->no_telepon, // Nomor telepon dokter
            'jam_praktik' => $this->jam_praktik, // Jam praktik dokter
            'jadwal_konsultasi' => $this->jadwal_konsultasi, // Hari/jadwal konsultasi
            'dibuat_pada' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null, // Waktu data dibuat
            'diperbarui_pada' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null, // Waktu terakhir data diperbarui
        ];
    }
}

