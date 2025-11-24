<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PembayaranResource extends JsonResource
{
    /**
     * Mengubah data model Pembayaran menjadi array untuk ditampilkan dalam respons JSON.
     */
    public function toArray(Request $request): array
    {
        return [
            'id_pembayaran' => $this->id_pembayaran,
            'id_kunjungan' => $this->id_kunjungan,
            'id_pegawai_kasir' => $this->id_pegawai_kasir,
            'jumlah_total' => $this->jumlah_total,
            'metode_pembayaran' => $this->metode_pembayaran,
            'status_pembayaran' => $this->status_pembayaran,
            'catatan_pembayaran' => $this->catatan_pembayaran,

            // Menampilkan data relasi kunjungan (jika dimuat dengan eager loading)
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

            // Menampilkan data pegawai kasir (jika dimuat dengan eager loading)
            'pegawai_kasir' => $this->whenLoaded('pegawaiKasir', function () {
                return [
                    'id_pegawai' => $this->pegawaiKasir->id_pegawai,
                    'nama_pegawai' => $this->pegawaiKasir->nama_pegawai,
                    'jabatan' => $this->pegawaiKasir->jabatan,
                    'no_hp' => $this->pegawaiKasir->no_hp,
                    'email' => $this->pegawaiKasir->email,
                ];
            }),

            // Tambahan informasi (otomatis)
            'tanggal_dibuat' => $this->created_at
                ? $this->created_at->format('Y-m-d H:i:s')
                : null,
            'tanggal_diperbarui' => $this->updated_at
                ? $this->updated_at->format('Y-m-d H:i:s')
                : null,

            // Informasi deskriptif singkat (contoh tambahan)
            'deskripsi_pembayaran' => sprintf(
                'Pembayaran sebesar Rp %s dengan metode %s memiliki status %s',
                number_format($this->jumlah_total, 0, ',', '.'),
                ucfirst($this->metode_pembayaran),
                $this->status_pembayaran
            ),
        ];
    }
}
