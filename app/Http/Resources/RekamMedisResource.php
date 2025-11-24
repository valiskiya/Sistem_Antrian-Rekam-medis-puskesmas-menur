<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RekamMedisResource extends JsonResource
{
    /**
     * Mengubah data resource Rekam Medis menjadi array JSON.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_rekam_medis' => $this->id, // ID unik dari tabel rekam medis
            'tanggal_pemeriksaan' => $this->tanggal_pemeriksaan, // Tanggal pemeriksaan pasien dilakukan
            'diagnosis' => $this->diagnosis, // Hasil diagnosis yang diberikan oleh dokter
            'terapi' => $this->terapi, // Terapi atau pengobatan yang diresepkan
            'catatan_dokter' => $this->catatan_dokter, // Catatan tambahan dari dokter terkait pemeriksaan

            // Relasi ke tabel kunjungan
            'kunjungan' => $this->whenLoaded('kunjungan', function () {
                return [
                    'id_kunjungan' => $this->kunjungan->id_kunjungan ?? null,
                    'tanggal_kunjungan' => $this->kunjungan->tanggal_kunjungan ?? null,
                    'jam_kunjungan' => $this->kunjungan->jam_kunjungan ?? null,
                    'keluhan_awal' => $this->kunjungan->keluhan_awal ?? null,

                    // Data pasien yang terkait dengan kunjungan
                    'pasien' => [
                        'id_pasien' => $this->kunjungan->pasien->id_pasien ?? null,
                        'nama_pasien' => $this->kunjungan->pasien->nama_lengkap ?? null,
                        'jenis_kelamin' => $this->kunjungan->pasien->jenis_kelamin ?? null,
                        'tanggal_lahir' => $this->kunjungan->pasien->tanggal_lahir ?? null,
                        'alamat' => $this->kunjungan->pasien->alamat ?? null,
                    ],

                    // Data dokter yang menangani
                    'dokter' => [
                        'id_dokter' => $this->kunjungan->dokter->id_dokter ?? null,
                        'nama_dokter' => $this->kunjungan->dokter->nama_lengkap ?? null,
                        'spesialis' => $this->kunjungan->dokter->spesialis ?? null,
                    ],

                    // Data poli yang dikunjungi pasien
                    'poli' => [
                        'id_poli' => $this->kunjungan->poli->id_poli ?? null,
                        'nama_poli' => $this->kunjungan->poli->nama_poli ?? null,
                        'deskripsi' => $this->kunjungan->poli->deskripsi ?? null,
                    ],
                ];
            }),

            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null, // Waktu data dibuat
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null, // Waktu terakhir diperbarui
        ];
    }
}
