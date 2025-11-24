<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $jabatanList = [
            'Kepala Puskesmas',
            'Penanggung Jawab UKP',
            'Dokter Umum',
            'Dokter Gigi',
            'Perawat',
            'Penanggung Jawab UKM',
            'Bidan Koordinator',
            'Petugas Gizi',
            'Sanitarian',
            'Petugas Promkes',
            'Petugas Laboratorium',
            'Petugas Farmasi',
            'Staf Administrasi dan Keuangan'
        ];

        foreach ($jabatanList as $jabatan) {
            DB::table('pegawai')->insert([
                'nama_lengkap'        => $faker->name,
                'jabatan'             => $jabatan,
                'tanggal_lahir'       => $faker->date('Y-m-d', '1995-12-31'),
                'tanggal_masuk_kerja' => $faker->date('Y-m-d', '2023-01-01'),
                'alamat'              => $faker->address,
                'no_telepon'          => $faker->unique()->phoneNumber,
                'nomor_SIP'           => $faker->unique()->numerify('SIP-#####'),
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }
    }
}
