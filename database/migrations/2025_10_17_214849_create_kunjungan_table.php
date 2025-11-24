<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel kunjungan
     */
    public function up(): void
    {
        Schema::create('kunjungan', function (Blueprint $table) {
            // Gunakan InnoDB agar mendukung relasi
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_kunjungan');

            // Informasi waktu kunjungan
            $table->date('tanggal_kunjungan')
                  ->comment('Tanggal pasien datang ke puskesmas');
            $table->time('jam_kunjungan')
                  ->nullable()
                  ->comment('Waktu pasien datang (opsional)');

            // Data keluhan dan catatan awal
            $table->text('keluhan_awal')
                  ->nullable()
                  ->comment('Keluhan awal pasien saat registrasi');

            // Relasi ke tabel pasien
            $table->foreignId('id_pasien')
                  ->constrained('pasien', 'id_pasien')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            // Relasi ke tabel dokter
            $table->foreignId('id_dokter')
                  ->nullable()
                  ->constrained('dokter', 'id_dokter')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();

            // Relasi ke tabel poli
            $table->foreignId('id_poli')
                  ->nullable()
                  ->constrained('poli', 'id_poli')
                  ->nullOnDelete()
                  ->cascadeOnUpdate();

            // Relasi ke tabel pegawai (admin)
            $table->foreignId('id_pegawai_admin')
                  ->nullable()
                  ->constrained('pegawai', 'id_pegawai')
                  ->nullOnDelete()
                  ->cascadeOnUpdate()
                  ->comment('Pegawai yang mendaftarkan kunjungan');

            // Waktu otomatis dibuat dan diperbarui
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel kunjungan
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan');
    }
};
