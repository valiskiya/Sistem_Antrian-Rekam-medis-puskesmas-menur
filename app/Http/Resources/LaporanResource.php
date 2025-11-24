<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanResource extends JsonResource
{
    /**
     * Mengubah data model Laporan menjadi array untuk respons JSON.
     */
    public function toArray(Request $request): array
    {
        return [
            'id_laporan' => $this->id_laporan,
            'id_pegawai' => $this->id_pegawai,
            'jenis_laporan' => $this->jenis_laporan,
            'tanggal_laporan' => $this->tanggal_laporan,
            'deskripsi_laporan' => $this->deskripsi_laporan,

            // Menampilkan data relasi pegawai (jika dimuat dengan eager loading)
            'pegawai' => $this->whenLoaded('pegawai', function () {
                return [
                    'id_pegawai' => $this->pegawai->id_pegawai,
                    'nama_pegawai' => $this->pegawai->nama_pegawai,
                    'jabatan' => $this->pegawai->jabatan,
                    'no_hp' => $this->pegawai->no_hp,
                    'email' => $this->pegawai->email,
                ];
            }),

            // Tambahan informasi waktu
            'tanggal_dibuat' => $this->created_at
                ? $this->created_at->format('Y-m-d H:i:s')
                : null,
            'tanggal_diperbarui' => $this->updated_at
                ? $this->updated_at->format('Y-m-d H:i:s')
                : null,

            // Deskripsi singkat yang dijelaskan dalam Bahasa Indonesia
            'deskripsi_ringkas' => sprintf(
                'Laporan %s oleh %s pada tanggal %s',
                $this->jenis_laporan,
                optional($this->pegawai)->nama_pegawai ?? 'Pegawai Tidak Diketahui',
                $this->tanggal_laporan
            ),
        ];
    }
}

