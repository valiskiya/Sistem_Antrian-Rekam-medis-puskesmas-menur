<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PoliResource extends JsonResource
{
    /**
     * Mengubah data model Poli menjadi array JSON yang terstruktur.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_poli' => $this->id, // ID unik untuk poli
            'nama_poli' => $this->nama_poli, // Nama poli (misalnya: Poli Umum, Poli Gigi, dsb)
            'deskripsi' => $this->deskripsi, // Deskripsi singkat tentang poli
            'dibuat_pada' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null, // Tanggal data dibuat
            'diperbarui_pada' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null, // Tanggal terakhir data diperbarui
        ];
    }
}

