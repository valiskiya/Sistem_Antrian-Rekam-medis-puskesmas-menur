<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PemeriksaanSeeder extends Seeder
{
    public function run()
    {
        DB::table('pemeriksaan')->insert([
            [
                'id_kunjungan' => 6,
                'id_pegawai_pemeriksaan' => 3,
                'jenis_pemeriksaan' => 'Pemeriksaan Umum',
                'hasil_pemeriksaan' => 'Pasien mengalami demam tinggi dan nyeri sendi. Hasil pemeriksaan menunjukkan kemungkinan Demam Berdarah Dengue (DBD).',
                'rekomendasi' => 'Disarankan rawat inap untuk observasi lanjutan, jaga asupan cairan, dan lakukan pemeriksaan trombosit setiap 24 jam.',
                'tanggal_pemeriksaan' => '2025-10-18',
                'jam_pemeriksaan' => '09:00:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_kunjungan' => 7,
                'id_pegawai_pemeriksaan' => 2,
                'jenis_pemeriksaan' => 'Pemeriksaan Lab',
                'hasil_pemeriksaan' => 'Kadar gula darah puasa pasien mencapai 185 mg/dL. Tanda awal diabetes melitus tipe 2.',
                'rekomendasi' => 'Anjurkan pola makan sehat, olahraga rutin, dan kontrol gula darah setiap minggu. Pertimbangkan terapi metformin.',
                'tanggal_pemeriksaan' => '2025-10-18',
                'jam_pemeriksaan' => '10:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_kunjungan' => 8,
                'id_pegawai_pemeriksaan' => 1,
                'jenis_pemeriksaan' => 'Pemeriksaan Umum',
                'hasil_pemeriksaan' => 'Pasien mengeluh batuk berdahak lebih dari 2 minggu. Hasil awal mengarah ke ISPA kronis.',
                'rekomendasi' => 'Berikan antibiotik sesuai hasil kultur sputum, istirahat cukup, dan perbanyak minum air hangat.',
                'tanggal_pemeriksaan' => '2025-10-18',
                'jam_pemeriksaan' => '08:45:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_kunjungan' => 9,
                'id_pegawai_pemeriksaan' => 7,
                'jenis_pemeriksaan' => 'Pemeriksaan Lab',
                'hasil_pemeriksaan' => 'Tekanan darah mencapai 160/100 mmHg. Diagnosis awal hipertensi tingkat 1.',
                'rekomendasi' => 'Konseling gaya hidup sehat, kurangi garam, rutin olahraga, dan cek tekanan darah setiap 3 hari.',
                'tanggal_pemeriksaan' => '2025-10-18',
                'jam_pemeriksaan' => '14:10:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_kunjungan' => 10,
                'id_pegawai_pemeriksaan' => 8,
                'jenis_pemeriksaan' => 'Pemeriksaan Lab',
                'hasil_pemeriksaan' => 'Pasien mengalami kelelahan dan pucat. Hasil lab menunjukkan anemia defisiensi besi.',
                'rekomendasi' => 'Berikan suplemen zat besi, konsumsi makanan kaya zat besi seperti hati ayam dan bayam, kontrol ulang 2 minggu.',
                'tanggal_pemeriksaan' => '2025-10-18',
                'jam_pemeriksaan' => '15:30:00',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
