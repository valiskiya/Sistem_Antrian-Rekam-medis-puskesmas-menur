<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'laporan';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_laporan';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'id_pegawai',
        'jenis_laporan',
        'tanggal_laporan',
        'deskripsi_laporan',
    ];

    // Tentukan field yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Tentukan format tanggal untuk field yang berhubungan dengan tanggal
    protected $dates = ['tanggal_laporan', 'created_at', 'updated_at'];

    /**
     * Relasi ke model Pegawai
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    /**
     * Accessor untuk mendapatkan jenis laporan dengan format yang lebih rapi
     */
    public function getJenisLaporanAttribute($value)
    {
        return ucfirst(strtolower($value)); // Format jenis laporan menjadi kapitalisasi huruf pertama
    }

    /**
     * Mutator untuk menyimpan jenis laporan dengan format yang konsisten
     */
    public function setJenisLaporanAttribute($value)
    {
        $this->attributes['jenis_laporan'] = ucfirst(strtolower($value)); // Menyimpan jenis laporan dalam format konsisten
    }

    /**
     * Accessor untuk mendapatkan tanggal laporan dengan format yang lebih rapi
     */
    public function getTanggalLaporanAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y'); // Format tanggal laporan
    }

    /**
     * Mutator untuk menyimpan tanggal laporan dengan format yang konsisten
     */
    public function setTanggalLaporanAttribute($value)
    {
        $this->attributes['tanggal_laporan'] = \Carbon\Carbon::parse($value)->format('Y-m-d'); // Format tanggal laporan
    }
}
