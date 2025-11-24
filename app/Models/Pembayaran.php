<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'pembayaran';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_pembayaran';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'id_kunjungan',
        'id_pegawai_kasir',
        'jumlah_total',
        'metode_pembayaran',
        'status_pembayaran',
        'catatan_pembayaran',
    ];

    // Tentukan field yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Tentukan format tanggal untuk field yang berhubungan dengan tanggal
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Relasi ke model Kunjungan
     */
    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'id_kunjungan');
    }

    /**
     * Relasi ke model Pegawai (Kasir)
     */
    public function pegawaiKasir()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai_kasir');
    }

    /**
     * Accessor untuk mendapatkan jumlah pembayaran dengan format yang lebih rapi
     */
    public function getJumlahTotalAttribute($value)
    {
        return 'Rp ' . number_format($value, 2, ',', '.'); // Format jumlah total dengan simbol "Rp" dan pemisah ribuan
    }

    /**
     * Mutator untuk menyimpan jumlah pembayaran dengan format yang konsisten
     */
    public function setJumlahTotalAttribute($value)
    {
        $this->attributes['jumlah_total'] = preg_replace('/[^0-9.]/', '', $value); // Menghapus karakter selain angka dan titik
    }

    /**
     * Accessor untuk mendapatkan status pembayaran dengan format yang lebih rapi
     */
    public function getStatusPembayaranAttribute($value)
    {
        return ucfirst(strtolower($value)); // Format status pembayaran menjadi kapitalisasi huruf pertama
    }

    /**
     * Mutator untuk menyimpan status pembayaran dengan format yang konsisten
     */
    public function setStatusPembayaranAttribute($value)
    {
        $this->attributes['status_pembayaran'] = ucfirst(strtolower($value)); // Menyimpan status pembayaran dalam format konsisten
    }
}
