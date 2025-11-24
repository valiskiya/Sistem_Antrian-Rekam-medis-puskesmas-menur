<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel pembayaran
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            // Gunakan InnoDB agar mendukung foreign key
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_pembayaran');

            // Relasi ke kunjungan
            $table->foreignId('id_kunjungan')
                  ->constrained('kunjungan', 'id_kunjungan')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete()
                  ->comment('Kunjungan yang dibayarkan');

            // Relasi ke pegawai (kasir)
            $table->foreignId('id_pegawai_kasir')
                  ->nullable()
                  ->constrained('pegawai', 'id_pegawai')
                  ->nullOnDelete()
                  ->cascadeOnUpdate()
                  ->comment('Pegawai yang memproses pembayaran');

            // Data pembayaran
            $table->decimal('jumlah_total', 8, 2)
                  ->comment('Total pembayaran yang dilakukan');

            $table->enum('metode_pembayaran', ['tunai', 'transfer', 'kartu_kredit', 'bpjs', 'jamkesmas'])
                  ->comment('Metode pembayaran');


            $table->enum('status_pembayaran', ['Lunas', 'Pending', 'Ditunda'])
                  ->default('Pending')
                  ->comment('Status pembayaran');

            $table->text('catatan_pembayaran')
                  ->nullable()
                  ->comment('Catatan tambahan terkait pembayaran');

            // Timestamps otomatis
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel pembayaran
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
