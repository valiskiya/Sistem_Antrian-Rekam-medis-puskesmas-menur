<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResepObatResource extends JsonResource
{
    /**
     * Mengubah data model menjadi array JSON untuk API.
     */
    public function toArray(Request $request): array
    {
        return [
            'id_resep_obat' => $this->id_resep_obat,
            'id_pasien' => $this->id_pasien,
            'id_rekam_medis' => $this->id_rekam_medis,
            'id_obat' => $this->id_obat,
            'jumlah' => $this->jumlah,
            'dosis' => $this->dosis,
            'tanggal_resep' => $this->tanggal_resep,

            // Relasi data pasien
            'pasien' => $this->whenLoaded('pasien', function () {
                return [
                    'id_pasien' => $this->pasien->id_pasien,
                    'nama_pasien' => $this->pasien->nama_pasien,
                    'jenis_kelamin' => $this->pasien->jenis_kelamin,
                    'tanggal_lahir' => $this->pasien->tanggal_lahir,
                    'alamat' => $this->pasien->alamat,
                    'no_telp' => $this->pasien->no_telp,
                ];
            }),

            // Relasi data rekam medis
            'rekam_medis' => $this->whenLoaded('rekamMedis', function () {
                return [
                    'id_rekam_medis' => $this->rekamMedis->id_rekam_medis,
                    'keluhan' => $this->rekamMedis->keluhan,
                    'diagnosa' => $this->rekamMedis->diagnosa,
                    'tindakan' => $this->rekamMedis->tindakan,
                    'tanggal_periksa' => $this->rekamMedis->tanggal_periksa,
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
            'total_harga_obat' => $this->obat ? $this->jumlah * $this->obat->harga_satuan : null,

            // Waktu pembuatan dan pembaruan
            'dibuat_pada' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'diperbarui_pada' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
