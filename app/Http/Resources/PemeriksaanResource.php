<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PemeriksaanResource extends JsonResource
{
    /**
     * Ubah data model menjadi array JSON.
     */
    public function toArray(Request $request): array
    {
        return [
            'id_pemeriksaan' => $this->id_pemeriksaan,
            'id_kunjungan' => $this->id_kunjungan,
            'id_pegawai_pemeriksaan' => $this->id_pegawai_pemeriksaan,
            'jenis_pemeriksaan' => $this->jenis_pemeriksaan,
            'hasil_pemeriksaan' => $this->hasil_pemeriksaan,
            'rekomendasi' => $this->rekomendasi,
            'tanggal_pemeriksaan' => $this->tanggal_pemeriksaan,
            'jam_pemeriksaan' => $this->jam_pemeriksaan,

            // Relasi: Data Kunjungan
            'kunjungan' => $this->whenLoaded('kunjungan', function () {
                return [
                    'id_kunjungan' => $this->kunjungan->id_kunjungan,
                    'id_pasien' => $this->kunjungan->id_pasien,
                    'id_dokter' => $this->kunjungan->id_dokter,
                    'id_poli' => $this->kunjungan->id_poli,
                    'tanggal_kunjungan' => $this->kunjungan->tanggal_kunjungan,
                    'keluhan' => $this->kunjungan->keluhan,
                    'diagnosa' => $this->kunjungan->diagnosa,
                ];
            }),

            // Relasi: Data Pegawai Pemeriksa
            'pegawai_pemeriksaan' => $this->whenLoaded('pegawaiPemeriksaan', function () {
                return [
                    'id_pegawai' => $this->pegawaiPemeriksaan->id_pegawai,
                    'nama_pegawai' => $this->pegawaiPemeriksaan->nama_pegawai,
                    'jabatan' => $this->pegawaiPemeriksaan->jabatan,
                ];
            }),

            // Tambahkan informasi waktu dibuat dan diperbarui
            'dibuat_pada' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null,
            'diperbarui_pada' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null,
        ];
    }
}
