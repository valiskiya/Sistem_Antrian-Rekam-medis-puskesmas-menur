<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'pegawai';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_pegawai';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'nama_lengkap',
        'jabatan',
        'tanggal_lahir',
        'tanggal_masuk_kerja',
        'alamat',
        'no_telepon',
        'nomor_SIP',
    ];

    // Tentukan field yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Tentukan format tanggal untuk field yang berhubungan dengan tanggal
    protected $dates = ['tanggal_lahir', 'tanggal_masuk_kerja', 'created_at', 'updated_at'];

    /**
     * Jika Anda ingin menambahkan relasi, misalnya relasi pegawai dengan kunjungan atau tabel lain
     * public function kunjungan()
     * {
     *     return $this->hasMany(Kunjungan::class, 'id_pegawai');
     * }
     */

    /**
     * Accessor untuk mengubah format tanggal_lahir agar lebih mudah dipahami
     */
    public function getTanggalLahirAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    /**
     * Mutator untuk mengubah tanggal_masuk_kerja agar disimpan dengan format yang konsisten
     */
    public function setTanggalMasukKerjaAttribute($value)
    {
        $this->attributes['tanggal_masuk_kerja'] = \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}
