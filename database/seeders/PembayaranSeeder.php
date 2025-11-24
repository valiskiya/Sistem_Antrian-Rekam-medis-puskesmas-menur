<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PembayaranSeeder extends Seeder
{
    /**
     * Jalankan database seed.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Menyisipkan beberapa data pembayaran
        foreach (range(1, 10) as $index) {
            DB::table('pembayaran')->insert([
                'id_kunjungan' => $faker->numberBetween(1, 10), // Menggunakan id_kunjungan yang ada di tabel kunjungan
                'id_pegawai_kasir' => $faker->numberBetween(1, 10), // Menggunakan id_pegawai yang ada di tabel pegawai
                'jumlah_total' => $faker->randomFloat(2, 100000, 500000), // Total pembayaran antara 100000 dan 500000
                'metode_pembayaran' => $faker->randomElement(['tunai', 'transfer', 'kartu_kredit', 'bpjs', 'jamkesmas']),
                'status_pembayaran' => $faker->randomElement(['Lunas', 'Pending', 'Ditunda']),
                'catatan_pembayaran' => $faker->optional()->text,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
