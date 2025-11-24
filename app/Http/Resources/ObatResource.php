<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ObatResource extends JsonResource
{
    /**
     * Mengubah data model menjadi array JSON untuk API.
     */
    public function toArray(Request $request): array
    {
        return [
            'id_obat' => $this->id_obat,
            'nama_obat' => $this->nama_obat,
            'jenis_obat' => $this->jenis_obat,
            'stok' => $this->stok,
            'harga_satuan' => $this->harga_satuan,
            'tanggal_kedaluwarsa' => $this->tanggal_kedaluwarsa,
            'supplier' => $this->supplier,

            // Informasi tambahan untuk API
            'status_stok' => $this->stok > 0 ? 'Tersedia' : 'Habis',
            'total_nilai_stok' => $this->stok * $this->harga_satuan,

            // Format waktu dibuat & diperbarui
            'dibuat_pada' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'diperbarui_pada' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }
}

