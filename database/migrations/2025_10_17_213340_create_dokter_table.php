<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel dokter
     */
    public function up(): void
    {
        Schema::create('dokter', function (Blueprint $table) {
            // Gunakan InnoDB agar mendukung foreign key
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_dokter');

            // Data dokter
            $table->string('nama_dokter', 100)
                  ->comment('Nama lengkap dokter');

            $table->string('spesialisasi', 100)
                  ->nullable()
                  ->comment('Spesialisasi atau bidang keahlian dokter');

            $table->string('no_telepon', 20)
                  ->unique()
                  ->comment('Nomor telepon dokter');

            $table->time('jam_praktik')
                  ->nullable()
                  ->comment('Jam mulai praktik dokter');

            $table->string('jadwal_konsultasi', 100)
                  ->nullable()
                  ->comment('Hari atau jadwal konsultasi dokter');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel dokter
     */
    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};

