<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'kunjungan';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_kunjungan';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'tanggal_kunjungan',
        'jam_kunjungan',
        'keluhan_awal',
        'id_pasien',
        'id_dokter',
        'id_poli',
        'id_pegawai_admin',
    ];

    // Tentukan field yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Tentukan format tanggal untuk field yang berhubungan dengan tanggal
    protected $dates = ['tanggal_kunjungan', 'created_at', 'updated_at'];

    /**
     * Relasi ke model Pasien
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    /**
     * Relasi ke model Dokter
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    /**
     * Relasi ke model Poli
     */
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    /**
     * Relasi ke model Pegawai (Admin)
     */
    public function pegawaiAdmin()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai_admin');
    }

    /**
     * Accessor untuk mendapatkan jam kunjungan dengan format yang lebih rapi
     */
    public function getJamKunjunganAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('H:i') : null;
    }

    /**
     * Mutator untuk menyimpan jam kunjungan dengan format yang konsisten
     */
    public function setJamKunjunganAttribute($value)
    {
        $this->attributes['jam_kunjungan'] = $value ? \Carbon\Carbon::parse($value)->format('H:i') : null;
    }
}
