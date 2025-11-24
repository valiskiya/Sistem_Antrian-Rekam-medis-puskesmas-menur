<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RekamMedisSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Daftar penyakit umum di Indonesia
        $penyakitList = [
            [
                'diagnosis' => 'Demam Berdarah Dengue (DBD)',
                'terapi' => 'Pemberian cairan infus, obat penurun panas, dan istirahat total.',
                'catatan_dokter' => 'Pantau tanda-tanda perdarahan dan suhu tubuh setiap 4 jam.'
            ],
            [
                'diagnosis' => 'Infeksi Saluran Pernapasan Akut (ISPA)',
                'terapi' => 'Pemberian antibiotik ringan, obat batuk, dan banyak minum air putih.',
                'catatan_dokter' => 'Anjurkan pasien untuk istirahat dan hindari rokok.'
            ],
            [
                'diagnosis' => 'Hipertensi',
                'terapi' => 'Pemberian obat antihipertensi dan diet rendah garam.',
                'catatan_dokter' => 'Kontrol tekanan darah setiap minggu.'
            ],
            [
                'diagnosis' => 'Gastritis (Maag)',
                'terapi' => 'Pemberian antasida, pengatur asam lambung, dan anjuran makan teratur.',
                'catatan_dokter' => 'Hindari kopi, makanan pedas, dan stres berlebih.'
            ],
            [
                'diagnosis' => 'Diabetes Mellitus Tipe 2',
                'terapi' => 'Pemberian obat penurun gula darah dan edukasi pola makan.',
                'catatan_dokter' => 'Kontrol gula darah setiap 2 minggu.'
            ],
            [
                'diagnosis' => 'Asma Bronkial',
                'terapi' => 'Pemberian inhaler bronkodilator dan obat antiinflamasi.',
                'catatan_dokter' => 'Jaga kebersihan udara dan hindari debu atau asap.'
            ],
            [
                'diagnosis' => 'Demam Tifoid (Tifus)',
                'terapi' => 'Antibiotik, cairan oral, dan istirahat total di rumah.',
                'catatan_dokter' => 'Pantau suhu tubuh dan pola makan pasien.'
            ],
            [
                'diagnosis' => 'Dermatitis Alergi',
                'terapi' => 'Pemberian salep kortikosteroid dan antihistamin oral.',
                'catatan_dokter' => 'Hindari pemicu alergi seperti sabun keras atau makanan tertentu.'
            ],
            [
                'diagnosis' => 'Nyeri Otot (Myalgia)',
                'terapi' => 'Pemberian analgesik ringan dan anjuran peregangan otot.',
                'catatan_dokter' => 'Anjurkan kompres hangat dan istirahat otot.'
            ],
            [
                'diagnosis' => 'Infeksi Saluran Kemih (ISK)',
                'terapi' => 'Antibiotik, banyak minum air putih, dan hindari menahan buang air kecil.',
                'catatan_dokter' => 'Kontrol ulang bila nyeri tidak berkurang dalam 3 hari.'
            ],
        ];

        // Buat 10 data rekam medis
        foreach (range(1, 10) as $index) {
            $data = $faker->randomElement($penyakitList);

            DB::table('rekam_medis')->insert([
                'id_kunjungan' => $faker->numberBetween(1, 10),
                'tanggal_pemeriksaan' => $faker->date(),
                'diagnosis' => $data['diagnosis'],
                'terapi' => $data['terapi'],
                'catatan_dokter' => $data['catatan_dokter'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
