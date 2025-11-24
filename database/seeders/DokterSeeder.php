<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Menyisipkan 10 data dokter contoh
        foreach (range(1, 10) as $index) {
            DB::table('dokter')->insert([
                'nama_dokter' => $faker->name,
                'spesialisasi' => $faker->randomElement(['Umum', 'Kandungan', 'Anak', 'Gigi', 'Jantung']),
                'no_telepon' => $faker->unique()->phoneNumber,
                'jam_praktik' => $faker->time('H:i'),
                'jadwal_konsultasi' => $faker->randomElement(['Senin - Jumat', 'Senin, Rabu, Jumat', 'Selasa, Kamis']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
