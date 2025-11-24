<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'dokter';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_dokter';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'nama_dokter',
        'spesialisasi',
        'no_telepon',
        'jam_praktik',
        'jadwal_konsultasi',
    ];

    // Tentukan field yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Tentukan format tanggal untuk field yang berhubungan dengan tanggal
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Relasi jika dokter memiliki banyak kunjungan
     * (Misalnya relasi ke tabel kunjungan yang berhubungan dengan dokter)
     */
    // public function kunjungan()
    // {
    //     return $this->hasMany(Kunjungan::class, 'id_dokter');
    // }

    /**
     * Accessor untuk jam praktik agar lebih mudah dipahami
     */
    public function getJamPraktikAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('H:i') : null;
    }

    /**
     * Mutator untuk jam praktik agar disimpan dengan format yang konsisten
     */
    public function setJamPraktikAttribute($value)
    {
        $this->attributes['jam_praktik'] = $value ? \Carbon\Carbon::parse($value)->format('H:i') : null;
    }

    /**
     * Jika Anda ingin menambahkan validasi atau logika tambahan lainnya, lakukan di sini
     */
}
