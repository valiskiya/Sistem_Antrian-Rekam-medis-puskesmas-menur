<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ResepObatSeeder extends Seeder
{
    /**
     * Jalankan database seed.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Menyisipkan beberapa data resep obat
        foreach (range(1, 10) as $index) {
            DB::table('resep_obat')->insert([
                'id_pasien' => $faker->numberBetween(1, 10), // Menggunakan id_pasien yang ada di tabel pasien
                'id_rekam_medis' => $faker->numberBetween(1, 10), // Menggunakan id_rekam_medis yang ada di tabel rekam_medis
                'id_obat' => $faker->numberBetween(1, 10), // Menggunakan id_obat yang ada di tabel obat
                'jumlah' => $faker->numberBetween(1, 5), // Jumlah obat yang diberikan
                'dosis' => $faker->randomElement(['2x sehari', '3x sehari', '1x sehari', '2x seminggu']),
                'tanggal_resep' => $faker->date(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
