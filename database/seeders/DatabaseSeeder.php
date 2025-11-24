<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan semua seeder secara berurutan agar tidak error FK.
     */
    public function run(): void
    {
        // Seeder utama dijalankan berurutan
        $this->call([
            PasienSeeder::class,
            DokterSeeder::class,
            PegawaiSeeder::class,
            PoliSeeder::class,
            KunjunganSeeder::class,
            RekamMedisSeeder::class,
            PemeriksaanSeeder::class,
            ObatSeeder::class,
            ResepObatSeeder::class,
            BiayaSeeder::class,
            PembayaranSeeder::class,
            LaporanSeeder::class,
            JadwalPraktikSeeder::class,
        ]);
    }
}
