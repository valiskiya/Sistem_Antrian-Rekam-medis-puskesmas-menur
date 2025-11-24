<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ObatSeeder extends Seeder
{
    /**
     * Jalankan database seed.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Menyisipkan beberapa data obat contoh
        foreach (range(1, 10) as $index) {
            DB::table('obat')->insert([
                'nama_obat' => $faker->word,
                'jenis_obat' => $faker->randomElement(['Tablet', 'Kapsul', 'Sirup', 'Injeksi', 'Salep']),
                'stok' => $faker->numberBetween(10, 100),
                'harga_satuan' => $faker->randomFloat(2, 5000, 50000), // Harga obat antara 5000 dan 50000
                'tanggal_kedaluwarsa' => $faker->date(),
                'supplier' => $faker->company,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
