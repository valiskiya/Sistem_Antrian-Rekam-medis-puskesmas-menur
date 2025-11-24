<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel laporan
     */
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            // Gunakan InnoDB agar mendukung foreign key
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_laporan');

            // Relasi ke pegawai
            $table->foreignId('id_pegawai')
                  ->constrained('pegawai', 'id_pegawai')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete()
                  ->comment('Pegawai yang membuat laporan');

            // Data laporan
            $table->enum('jenis_laporan', ['Harian', 'Mingguan', 'Bulanan', 'Tahunan'])
                  ->comment('Jenis laporan');

            $table->date('tanggal_laporan')
                  ->default(now())
                  ->comment('Tanggal laporan dibuat');

            $table->text('deskripsi_laporan')
                  ->comment('Deskripsi atau isi laporan');

            // Timestamps otomatis
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel laporan
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
