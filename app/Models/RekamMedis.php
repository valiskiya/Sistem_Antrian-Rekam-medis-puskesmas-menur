<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'rekam_medis';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_rekam_medis';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'id_kunjungan',
        'tanggal_pemeriksaan',
        'diagnosis',
        'terapi',
        'catatan_dokter',
    ];

    // Tentukan field yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Tentukan format tanggal untuk field yang berhubungan dengan tanggal
    protected $dates = ['tanggal_pemeriksaan', 'created_at', 'updated_at'];

    /**
     * Relasi ke model Kunjungan
     */
    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'id_kunjungan');
    }

    /**
     * Accessor untuk mendapatkan tanggal pemeriksaan dengan format yang lebih rapi
     */
    public function getTanggalPemeriksaanAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    /**
     * Mutator untuk menyimpan tanggal pemeriksaan dengan format yang konsisten
     */
    public function setTanggalPemeriksaanAttribute($value)
    {
        $this->attributes['tanggal_pemeriksaan'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}

