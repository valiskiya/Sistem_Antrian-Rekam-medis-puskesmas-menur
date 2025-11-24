<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel rekam medis
     */
    public function up(): void
    {
        Schema::create('rekam_medis', function (Blueprint $table) {
            // Gunakan InnoDB untuk dukungan foreign key
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_rekam_medis');

            // Relasi ke tabel kunjungan
            $table->foreignId('id_kunjungan')
                  ->constrained('kunjungan', 'id_kunjungan')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            // Data rekam medis
            $table->date('tanggal_pemeriksaan')
                  ->comment('Tanggal pemeriksaan pasien');

            $table->text('diagnosis')
                  ->comment('Diagnosis medis pasien');

            $table->text('terapi')
                  ->comment('Terapi atau pengobatan yang diberikan');

            $table->text('catatan_dokter')
                  ->nullable()
                  ->comment('Catatan tambahan dari dokter saat pemeriksaan');

            // Timestamp otomatis
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel rekam medis
     */
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis');
    }
};
