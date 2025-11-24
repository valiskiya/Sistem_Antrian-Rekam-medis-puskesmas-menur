<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel resep_obat
     */
    public function up(): void
    {
        Schema::create('resep_obat', function (Blueprint $table) {
            // Gunakan InnoDB agar mendukung relasi foreign key
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_resep_obat');

            // Relasi ke pasien
            $table->foreignId('id_pasien')
                  ->constrained('pasien', 'id_pasien')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete()
                  ->comment('Pasien yang menerima resep');

            // Relasi ke rekam medis
            $table->foreignId('id_rekam_medis')
                  ->constrained('rekam_medis', 'id_rekam_medis')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete()
                  ->comment('Rekam medis terkait resep ini');

            // Relasi ke tabel obat
            $table->foreignId('id_obat')
                  ->constrained('obat', 'id_obat')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete()
                  ->comment('Obat yang diresepkan');

            // Data resep
            $table->integer('jumlah')
                  ->comment('Jumlah obat yang diberikan');

            $table->string('dosis', 50)
                  ->nullable()
                  ->comment('Dosis obat, misal 2x sehari');

            $table->date('tanggal_resep')
                  ->default(now())
                  ->comment('Tanggal resep dibuat');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel resep_obat
     */
    public function down(): void
    {
        Schema::dropIfExists('resep_obat');
    }
};
