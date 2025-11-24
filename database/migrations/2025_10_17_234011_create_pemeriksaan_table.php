<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel pemeriksaan
     */
    public function up(): void
    {
        Schema::create('pemeriksaan', function (Blueprint $table) {
            // Gunakan InnoDB agar mendukung foreign key
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_pemeriksaan');

            // Relasi ke kunjungan
            $table->foreignId('id_kunjungan')
                  ->constrained('kunjungan', 'id_kunjungan')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete()
                  ->comment('Kunjungan yang diperiksa');

            // Relasi ke pegawai (pemeriksa)
            $table->foreignId('id_pegawai_pemeriksaan')
                  ->nullable()
                  ->constrained('pegawai', 'id_pegawai')
                  ->nullOnDelete()
                  ->cascadeOnUpdate()
                  ->comment('Pegawai yang melakukan pemeriksaan');

            // Data pemeriksaan
            $table->string('jenis_pemeriksaan', 100)
                  ->comment('Jenis pemeriksaan yang dilakukan');

            $table->text('hasil_pemeriksaan')
                  ->nullable()
                  ->comment('Hasil dari pemeriksaan');

            $table->text('rekomendasi')
                  ->nullable()
                  ->comment('Rekomendasi atau tindak lanjut pemeriksaan');

            $table->date('tanggal_pemeriksaan')
                  ->default(now())
                  ->comment('Tanggal pemeriksaan');

            $table->time('jam_pemeriksaan')
                  ->nullable()
                  ->comment('Jam pemeriksaan dilakukan');

            // Timestamps otomatis
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel pemeriksaan
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
