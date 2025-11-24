<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Menyisipkan 10 data pasien contoh
        foreach (range(1, 10) as $index) {
            DB::table('pasien')->insert([
                'nama_lengkap' => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'tanggal_lahir' => $faker->date,
                'alamat' => $faker->address,
                'no_telepon' => $faker->phoneNumber,
                'no_ktp' => $faker->unique()->numerify('##########'),
                'status' => $faker->randomElement(['Aktif', 'Tidak Aktif', 'Meninggal']),
                'tanggal_daftar' => $faker->date,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
