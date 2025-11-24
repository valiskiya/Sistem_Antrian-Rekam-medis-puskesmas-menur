<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JadwalPraktikSeeder extends Seeder
{
    /**
     * Jalankan database seed.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Menyisipkan beberapa data jadwal praktik
        foreach (range(1, 10) as $index) {
            DB::table('jadwal_praktik')->insert([
                'id_dokter' => $faker->numberBetween(1, 10), // Menggunakan id_dokter yang ada di tabel dokter
                'hari' => $faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']),
                'tanggal' => $faker->optional()->date(), // Tanggal khusus jadwal praktik (opsional)
                'jam_mulai' => $faker->time('H:i'),
                'jam_selesai' => $faker->time('H:i'),
                'kuota_pasien' => $faker->numberBetween(5, 20), // Jumlah maksimum pasien per jadwal
                'status' => $faker->randomElement(['Aktif', 'Nonaktif']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
