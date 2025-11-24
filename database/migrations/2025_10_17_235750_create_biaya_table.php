<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel biaya
     */
    public function up(): void
    {
        Schema::create('biaya', function (Blueprint $table) {
            // Gunakan InnoDB untuk mendukung foreign key
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_biaya');

            // Relasi ke kunjungan
            $table->foreignId('id_kunjungan')
                  ->constrained('kunjungan', 'id_kunjungan')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete()
                  ->comment('Kunjungan terkait biaya ini');

            // Relasi ke obat (opsional)
            $table->foreignId('id_obat')
                  ->nullable()
                  ->constrained('obat', 'id_obat')
                  ->cascadeOnUpdate()
                  ->nullOnDelete()
                  ->comment('Obat terkait biaya ini, jika ada');

            // Data biaya
            $table->string('jenis_biaya', 100)
                  ->comment('Jenis biaya, misal biaya pemeriksaan, obat, dll.');

            $table->decimal('jumlah_biaya', 8, 2)
                  ->comment('Jumlah biaya');

            $table->date('tanggal_biaya')
                  ->default(now())
                  ->comment('Tanggal biaya dikenakan');

            // Timestamps otomatis
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel biaya
     */
    public function down(): void
    {
        Schema::dropIfExists('biaya');
    }
};
