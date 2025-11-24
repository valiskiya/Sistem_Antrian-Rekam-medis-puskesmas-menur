<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel obat
     */
    public function up(): void
    {
        Schema::create('obat', function (Blueprint $table) {
            // Gunakan InnoDB agar mendukung foreign key
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_obat');

            // Data obat
            $table->string('nama_obat', 100)
                  ->comment('Nama obat');

            $table->string('jenis_obat', 50)
                  ->nullable()
                  ->comment('Jenis obat, misal tablet, kapsul, sirup');

            $table->integer('stok')
                  ->default(0)
                  ->comment('Jumlah stok obat yang tersedia');

            $table->decimal('harga_satuan', 8, 2)
                  ->comment('Harga per satuan obat');

            $table->date('tanggal_kedaluwarsa')
                  ->nullable()
                  ->comment('Tanggal kedaluwarsa obat');

            $table->string('supplier', 100)
                  ->nullable()
                  ->comment('Nama supplier obat');

            // Timestamps otomatis
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel obat
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
