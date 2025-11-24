<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'biaya';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_biaya';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'id_kunjungan',
        'id_obat',
        'jenis_biaya',
        'jumlah_biaya',
        'tanggal_biaya',
    ];

    // Tentukan field yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Tentukan format tanggal untuk field yang berhubungan dengan tanggal
    protected $dates = ['tanggal_biaya', 'created_at', 'updated_at'];

    /**
     * Relasi ke model Kunjungan
     */
    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'id_kunjungan');
    }

    /**
     * Relasi ke model Obat (opsional)
     */
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }

    /**
     * Accessor untuk mendapatkan jumlah biaya dengan format yang lebih rapi
     */
    public function getJumlahBiayaAttribute($value)
    {
        return 'Rp ' . number_format($value, 2, ',', '.'); // Format jumlah biaya dengan simbol "Rp" dan pemisah ribuan
    }

    /**
     * Mutator untuk menyimpan jumlah biaya dengan format yang konsisten
     */
    public function setJumlahBiayaAttribute($value)
    {
        $this->attributes['jumlah_biaya'] = preg_replace('/[^0-9.]/', '', $value); // Menghapus karakter selain angka dan titik
    }

    /**
     * Accessor untuk mendapatkan tanggal biaya dengan format yang lebih rapi
     */
    public function getTanggalBiayaAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y'); // Format tanggal biaya
    }

    /**
     * Mutator untuk menyimpan tanggal biaya dengan format yang konsisten
     */
    public function setTanggalBiayaAttribute($value)
    {
        $this->attributes['tanggal_biaya'] = \Carbon\Carbon::parse($value)->format('Y-m-d'); // Format tanggal biaya
    }
}
