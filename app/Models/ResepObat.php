<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepObat extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'resep_obat';

    // Tentukan primary key, jika tidak menggunakan id default
    protected $primaryKey = 'id_resep_obat';

    // Tentukan apakah primary key adalah auto-increment
    public $incrementing = true;

    // Tentukan tipe data untuk primary key
    protected $keyType = 'int';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'id_pasien',
        'id_rekam_medis',
        'id_obat',
        'jumlah',
        'dosis',
        'tanggal_resep',
    ];

    // Tentukan field yang tidak boleh diisi (guarded)
    protected $guarded = [];

    // Tentukan format tanggal untuk field yang berhubungan dengan tanggal
    protected $dates = ['tanggal_resep', 'created_at', 'updated_at'];

    /**
     * Relasi ke model Pasien
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    /**
     * Relasi ke model RekamMedis
     */
    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'id_rekam_medis');
    }

    /**
     * Relasi ke model Obat
     */
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }

    /**
     * Accessor untuk mendapatkan tanggal resep dengan format yang lebih rapi
     */
    public function getTanggalResepAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-Y'); // Format tanggal resep
    }

    /**
     * Mutator untuk menyimpan tanggal resep dengan format yang konsisten
     */
    public function setTanggalResepAttribute($value)
    {
        $this->attributes['tanggal_resep'] = \Carbon\Carbon::parse($value)->format('Y-m-d'); // Format tanggal resep
    }

    /**
     * Accessor untuk mendapatkan dosis obat
     */
    public function getDosisAttribute($value)
    {
        return $value ? strtoupper($value) : null; // Format dosis menjadi huruf kapital
    }
}
