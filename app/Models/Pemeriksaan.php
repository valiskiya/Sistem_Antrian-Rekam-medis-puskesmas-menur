<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'pemeriksaan';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_pemeriksaan';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'id_kunjungan',
        'id_pegawai_pemeriksaan',
        'jenis_pemeriksaan',
        'hasil_pemeriksaan',
        'rekomendasi',
        'tanggal_pemeriksaan',
        'jam_pemeriksaan',
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
     * Relasi ke model Pegawai (Pemeriksa)
     */
    public function pegawaiPemeriksaan()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai_pemeriksaan');
    }

    /**
     * Accessor untuk mendapatkan jam pemeriksaan dengan format yang lebih rapi
     */
    public function getJamPemeriksaanAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('H:i') : null;
    }

    /**
     * Mutator untuk menyimpan jam pemeriksaan dengan format yang konsisten
     */
    public function setJamPemeriksaanAttribute($value)
    {
        $this->attributes['jam_pemeriksaan'] = $value ? \Carbon\Carbon::parse($value)->format('H:i') : null;
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
