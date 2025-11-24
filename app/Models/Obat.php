<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'obat';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_obat';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'nama_obat',
        'jenis_obat',
        'stok',
        'harga_satuan',
        'tanggal_kedaluwarsa',
        'supplier',
    ];

    // Tentukan field yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Tentukan format tanggal untuk field yang berhubungan dengan tanggal
    protected $dates = ['tanggal_kedaluwarsa', 'created_at', 'updated_at'];

    /**
     * Accessor untuk mendapatkan harga obat dengan format yang lebih rapi
     */
    public function getHargaSatuanAttribute($value)
    {
        return 'Rp ' . number_format($value, 2, ',', '.'); // Format harga dengan simbol "Rp" dan pemisah ribuan
    }

    /**
     * Mutator untuk menyimpan harga obat dengan format yang konsisten
     */
    public function setHargaSatuanAttribute($value)
    {
        $this->attributes['harga_satuan'] = preg_replace('/[^0-9.]/', '', $value); // Menghapus karakter selain angka dan titik
    }

    /**
     * Accessor untuk mendapatkan tanggal kedaluwarsa obat dengan format yang lebih rapi
     */
    public function getTanggalKedaluwarsaAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y'); // Format tanggal kedaluwarsa
    }

    /**
     * Mutator untuk menyimpan tanggal kedaluwarsa dengan format yang konsisten
     */
    public function setTanggalKedaluwarsaAttribute($value)
    {
        $this->attributes['tanggal_kedaluwarsa'] = \Carbon\Carbon::parse($value)->format('Y-m-d'); // Format tanggal kedaluwarsa
    }
}
