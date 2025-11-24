<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktik extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'jadwal_praktik';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_jadwal_praktik';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'id_dokter',
        'hari',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kuota_pasien',
        'status',
    ];

    // Tentukan field yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Tentukan format tanggal untuk field yang berhubungan dengan tanggal
    protected $dates = ['tanggal', 'created_at', 'updated_at'];

    /**
     * Relasi ke model Dokter
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    /**
     * Accessor untuk mendapatkan hari jadwal praktik dengan format yang lebih rapi
     */
    public function getHariAttribute($value)
    {
        return ucfirst(strtolower($value)); // Format hari dengan huruf kapital pertama
    }

    /**
     * Mutator untuk menyimpan hari dengan format yang konsisten
     */
    public function setHariAttribute($value)
    {
        $this->attributes['hari'] = ucfirst(strtolower($value)); // Menyimpan hari dalam format konsisten
    }

    /**
     * Accessor untuk mendapatkan jam mulai praktik dengan format yang lebih rapi
     */
    public function getJamMulaiAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('H:i'); // Format jam mulai praktik
    }

    /**
     * Mutator untuk menyimpan jam mulai praktik dengan format yang konsisten
     */
    public function setJamMulaiAttribute($value)
    {
        $this->attributes['jam_mulai'] = \Carbon\Carbon::parse($value)->format('H:i'); // Format jam mulai praktik
    }

    /**
     * Accessor untuk mendapatkan jam selesai praktik dengan format yang lebih rapi
     */
    public function getJamSelesaiAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('H:i'); // Format jam selesai praktik
    }

    /**
     * Mutator untuk menyimpan jam selesai praktik dengan format yang konsisten
     */
    public function setJamSelesaiAttribute($value)
    {
        $this->attributes['jam_selesai'] = \Carbon\Carbon::parse($value)->format('H:i'); // Format jam selesai praktik
    }

    /**
     * Accessor untuk mendapatkan status jadwal praktik dengan format yang lebih rapi
     */
    public function getStatusAttribute($value)
    {
        return ucfirst(strtolower($value)); // Format status menjadi kapitalisasi huruf pertama
    }

    /**
     * Mutator untuk menyimpan status dengan format yang konsisten
     */
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = ucfirst(strtolower($value)); // Menyimpan status dalam format konsisten
    }
}
