<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BiayaResource extends JsonResource
{
    /**
     * Mengubah data model Biaya menjadi array JSON untuk API.
     */
    public function toArray(Request $request): array
    {
        return [
            'id_biaya' => $this->id_biaya,
            'id_kunjungan' => $this->id_kunjungan,
            'id_obat' => $this->id_obat,
            'jenis_biaya' => $this->jenis_biaya,
            'jumlah_biaya' => $this->jumlah_biaya,
            'tanggal_biaya' => $this->tanggal_biaya,

            // Relasi data kunjungan
            'kunjungan' => $this->whenLoaded('kunjungan', function () {
                return [
                    'id_kunjungan' => $this->kunjungan->id_kunjungan,
                    'tanggal_kunjungan' => $this->kunjungan->tanggal_kunjungan,
                    'keluhan' => $this->kunjungan->keluhan,
                    'id_pasien' => $this->kunjungan->id_pasien,
                    'id_dokter' => $this->kunjungan->id_dokter,
                    'status' => $this->kunjungan->status,
                ];
            }),

            // Relasi data obat
            'obat' => $this->whenLoaded('obat', function () {
                return [
                    'id_obat' => $this->obat->id_obat,
                    'nama_obat' => $this->obat->nama_obat,
                    'jenis_obat' => $this->obat->jenis_obat,
                    'stok' => $this->obat->stok,
                    'harga_satuan' => $this->obat->harga_satuan,
                    'tanggal_kedaluwarsa' => $this->obat->tanggal_kedaluwarsa,
                    'supplier' => $this->obat->supplier,
                ];
            }),

            // Informasi tambahan
            'total_biaya_dengan_obat' => $this->obat
                ? $this->jumlah_biaya + $this->obat->harga_satuan
                : $this->jumlah_biaya,

            // Waktu pembuatan dan pembaruan
            'dibuat_pada' => $this->created_at
                ? $this->created_at->format('Y-m-d H:i:s')
                : null,
            'diperbarui_pada' => $this->updated_at
                ? $this->updated_at->format('Y-m-d H:i:s')
                : null,
        ];
    }
}
