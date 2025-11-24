<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel poli
     */
    public function up(): void
    {
        Schema::create('poli', function (Blueprint $table) {
            // Gunakan InnoDB agar mendukung foreign key
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_poli');

            // Data poli
            $table->string('nama_poli', 100)
                  ->unique()
                  ->comment('Nama poli, misalnya poli umum, poli gigi , poli kia, poli gizi, poli anak, poli paru paru, poli batra, poli psikologi, poli rehabilitasi medik, poli medical check up, poli lansia, dan poli pkg.');

            $table->text('deskripsi')
                  ->nullable()
                  ->comment('Deskripsi atau keterangan tentang poli');

            // Waktu pembuatan dan pembaruan data
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel poli
     */
    public function down(): void
    {
        Schema::dropIfExists('poli');
    }
};
