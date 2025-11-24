<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'pasien';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_pasien';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'no_ktp',
        'status',
        'tanggal_daftar',
    ];

    // Tentukan field yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Tentukan format tanggal untuk field yang berhubungan dengan tanggal
    protected $dates = ['tanggal_lahir', 'tanggal_daftar'];

    /**
     * Jika Anda ingin menambahkan relasi dengan model lain, misalnya model Kunjungan
     */
    // public function kunjungan()
    // {
    //     return $this->hasMany(Kunjungan::class, 'id_pasien');
    // }

    /**
     * Accessor untuk status yang lebih mudah dipahami
     */
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // Misalnya mengubah 'aktif' menjadi 'Aktif'
    }

    /**
     * Mutator untuk mengubah tanggal daftar sebelum disimpan
     */
    public function setTanggalDaftarAttribute($value)
    {
        $this->attributes['tanggal_daftar'] = $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null;
    }

    /**
     * Menggunakan cast untuk format data lainnya jika perlu
     */
    // protected $casts = [
    //     'tanggal_lahir' => 'datetime:Y-m-d',
    // ];

    // Menambahkan komentar jika ingin memberikan penjelasan pada setiap field
    // Diakses melalui migrasi dan dokumentasi
    // protected $attributes = [
    //     'nama_lengkap' => 'Nama lengkap pasien',
    //     'jenis_kelamin' => 'Jenis kelamin pasien',
    //     'no_ktp' => 'Nomor KTP pasien',
    //     'status' => 'Status pasien saat ini',
    //     'tanggal_daftar' => 'Tanggal pasien pertama kali mendaftar',
    // ];
}
