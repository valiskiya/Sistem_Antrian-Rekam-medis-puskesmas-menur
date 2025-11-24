<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'poli';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_poli';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'nama_poli',
        'deskripsi',
    ];

    // Tentukan field yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Timestamps diaktifkan oleh default Laravel
    // created_at dan updated_at akan otomatis diatur oleh Laravel

    /**
     * Relasi jika poli memiliki banyak kunjungan
     * Misalnya, relasi ke tabel kunjungan yang berhubungan dengan poli
     */
    // public function kunjungan()
    // {
    //     return $this->hasMany(Kunjungan::class, 'id_poli');
    // }

    /**
     * Accessor untuk mendapatkan nama poli dengan format yang lebih rapi
     */
    public function getNamaPoliAttribute($value)
    {
        return ucfirst($value); // Mengubah nama poli menjadi kapitalisasi huruf pertama
    }

    /**
     * Mutator untuk menyimpan nama poli dengan format yang konsisten
     */
    public function setNamaPoliAttribute($value)
    {
        $this->attributes['nama_poli'] = ucfirst(strtolower($value)); // Memastikan nama poli disimpan dengan huruf pertama kapital
    }
}
