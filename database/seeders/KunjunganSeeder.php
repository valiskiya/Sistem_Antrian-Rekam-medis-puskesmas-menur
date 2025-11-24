<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KunjunganSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Daftar keluhan umum pasien di Puskesmas (Indonesia)
        $keluhanList = [
            'Demam tinggi dan menggigil',
            'Batuk dan pilek',
            'Sakit kepala berulang',
            'Diare atau buang air besar cair',
            'Nyeri perut bagian bawah',
            'Sakit tenggorokan dan sulit menelan',
            'Sesak napas ringan',
            'Nyeri sendi dan pegal-pegal',
            'Ruam kulit dan gatal-gatal',
            'Mual dan muntah',
            'Sakit gigi atau gusi bengkak',
            'Luka ringan akibat jatuh',
            'Tekanan darah tinggi',
            'Pusing berputar (vertigo)',
            'Lemas dan tidak nafsu makan',
            'Sakit mata atau iritasi',
            'Nyeri dada ringan',
            'Batuk berdahak lebih dari 2 minggu',
            'Nyeri saat buang air kecil',
            'Gatal di kulit kepala',
        ];

        for ($i = 1; $i <= 10; $i++) {
            DB::table('kunjungan')->insert([
                'tanggal_kunjungan' => $faker->date(),
                'jam_kunjungan' => $faker->time(),
                'keluhan_awal' => $faker->randomElement($keluhanList),
                'id_pasien' => $faker->numberBetween(1, 10),
                'id_dokter' => $faker->numberBetween(1, 8),
                'id_poli' => $faker->numberBetween(1, 8),
                'id_pegawai_admin' => $faker->numberBetween(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
