<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BiayaSeeder extends Seeder
{
    /**
     * Jalankan database seed.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Menyisipkan beberapa data biaya
        foreach (range(1, 10) as $index) {
            DB::table('biaya')->insert([
                'id_kunjungan' => $faker->numberBetween(1, 10), // Menggunakan id_kunjungan yang ada di tabel kunjungan
                'id_obat' => $faker->numberBetween(1, 10), // Menggunakan id_obat yang ada di tabel obat
                'jenis_biaya' => $faker->randomElement(['Biaya Pemeriksaan', 'Biaya Obat', 'Biaya Rawat Inap']),
                'jumlah_biaya' => $faker->randomFloat(2, 5000, 500000), // Biaya antara 5000 hingga 500000
                'tanggal_biaya' => $faker->date(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
