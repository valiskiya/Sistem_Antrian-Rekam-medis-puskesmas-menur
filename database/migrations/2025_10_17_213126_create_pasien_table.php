<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi tabel pasien
     */
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            // Gunakan InnoDB untuk dukungan foreign key
            $table->engine = 'InnoDB';

            // Primary key
            $table->id('id_pasien');

            // Data pasien
            $table->string('nama_lengkap', 100)
                  ->comment('Nama lengkap pasien');

            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])
                  ->comment('Jenis kelamin pasien');

            $table->date('tanggal_lahir')
                  ->comment('Tanggal lahir pasien');

            $table->string('alamat', 255)
                  ->comment('Alamat lengkap pasien');

            $table->string('no_telepon', 20)
                  ->nullable()
                  ->comment('Nomor telepon pasien');

            $table->string('no_ktp', 20)
                  ->unique()
                  ->comment('Nomor KTP pasien');

            $table->enum('status', ['Aktif', 'Tidak Aktif', 'Meninggal'])
                  ->default('Aktif')
                  ->comment('Status pasien saat ini');

            // Gunakan nullable() + pengisian otomatis via model/controller, agar aman di semua DB
            $table->date('tanggal_daftar')
                  ->nullable()
                  ->comment('Tanggal pasien pertama kali mendaftar');

            // Timestamps: created_at & updated_at
            $table->timestamps();
        });
    }

    /**
     * Rollback migrasi tabel pasien
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
