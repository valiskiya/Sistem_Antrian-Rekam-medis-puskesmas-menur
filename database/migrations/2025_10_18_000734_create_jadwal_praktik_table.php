<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel jadwal_praktik
     */
    public function up(): void
    {
        Schema::create('jadwal_praktik', function (Blueprint $table) {
            // Gunakan InnoDB agar mendukung foreign key
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_jadwal_praktik');

            // Relasi ke dokter
            $table->foreignId('id_dokter')
                  ->constrained('dokter', 'id_dokter')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete()
                  ->comment('Dokter yang memiliki jadwal praktik');

            // Data jadwal praktik
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'])
                  ->comment('Hari jadwal praktik');

            $table->date('tanggal')
                  ->nullable()
                  ->comment('Tanggal khusus jadwal praktik, jika ada');

            $table->time('jam_mulai')
                  ->comment('Jam mulai praktik');

            $table->time('jam_selesai')
                  ->comment('Jam selesai praktik');

            $table->integer('kuota_pasien')
                  ->default(0)
                  ->comment('Jumlah maksimum pasien per jadwal');

            $table->enum('status', ['Aktif', 'Nonaktif'])
                  ->default('Aktif')
                  ->comment('Status jadwal praktik');

            // Timestamps otomatis
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel jadwal_praktik
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_praktik');
    }
};
