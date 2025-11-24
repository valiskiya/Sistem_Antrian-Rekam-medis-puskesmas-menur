<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel pegawai
     */
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            // Gunakan InnoDB untuk dukungan foreign key
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_pegawai');

            // Data pegawai
            $table->string('nama_lengkap', 100)
                  ->comment('Nama lengkap pegawai');

            $table->string('jabatan', 50)
                  ->comment('Jabatan atau posisi pegawai di puskesmas');

            $table->date('tanggal_lahir')
                  ->comment('Tanggal lahir pegawai');

            $table->date('tanggal_masuk_kerja')
                  ->comment('Tanggal pegawai mulai bekerja');

            $table->string('alamat', 255)
                  ->comment('Alamat lengkap pegawai');

            $table->string('no_telepon', 20)
                  ->nullable()
                  ->comment('Nomor telepon pegawai');

            $table->string('nomor_SIP', 30)
                  ->unique()
                  ->comment('Nomor Surat Izin Praktik pegawai (SIP)');

            // Timestamps (created_at & updated_at)
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel pegawai
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
