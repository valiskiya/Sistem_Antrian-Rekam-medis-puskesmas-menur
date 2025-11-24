<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KunjunganResource extends JsonResource
{
    /**
     * Mengubah data resource Kunjungan menjadi array JSON.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_kunjungan' => $this->id, // ID utama dari tabel kunjungan
            'tanggal_kunjungan' => $this->tanggal_kunjungan, // Tanggal pasien melakukan kunjungan
            'jam_kunjungan' => $this->jam_kunjungan, // Jam saat pasien datang
            'keluhan_awal' => $this->keluhan_awal, // Keluhan awal pasien yang disampaikan
            'pasien' => [
                'id_pasien' => $this->pasien->id_pasien ?? null,
                'nama_pasien' => $this->pasien->nama_lengkap ?? null,
                'jenis_kelamin' => $this->pasien->jenis_kelamin ?? null,
                'tanggal_lahir' => $this->pasien->tanggal_lahir ?? null,
                'alamat' => $this->pasien->alamat ?? null,
                'no_telepon' => $this->pasien->no_telepon ?? null,
            ],
            'dokter' => [
                'id_dokter' => $this->dokter->id_dokter ?? null,
                'nama_dokter' => $this->dokter->nama_lengkap ?? null,
                'spesialis' => $this->dokter->spesialis ?? null,
                'nomor_SIP' => $this->dokter->nomor_SIP ?? null,
            ],
            'poli' => [
                'id_poli' => $this->poli->id_poli ?? null,
                'nama_poli' => $this->poli->nama_poli ?? null,
                'deskripsi' => $this->poli->deskripsi ?? null,
            ],
            'pegawai_admin' => [
                'id_pegawai' => $this->pegawaiAdmin->id_pegawai ?? null,
                'nama_admin' => $this->pegawaiAdmin->nama_lengkap ?? null,
                'jabatan' => $this->pegawaiAdmin->jabatan ?? null,
            ],
            'created_at' => $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : null, // Waktu data dibuat
            'updated_at' => $this->updated_at ? $this->updated_at->format('Y-m-d H:i:s') : null, // Waktu data terakhir diperbarui
        ];
    }
}

