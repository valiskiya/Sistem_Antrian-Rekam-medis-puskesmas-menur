<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel laporan.
     */
    public function run(): void
    {
        DB::table('laporan')->insert([
            [
                'id_pegawai' => 9,
                'jenis_laporan' => 'Harian',
                'tanggal_laporan' => '2025-10-18',
                'deskripsi_laporan' => 'Laporan kegiatan harian pemeriksaan pasien umum dan gigi berjalan lancar. Tidak ada keluhan dari pasien maupun tenaga medis.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pegawai' => 5,
                'jenis_laporan' => 'Bulanan',
                'tanggal_laporan' => '2025-09-30',
                'deskripsi_laporan' => 'Rekap data kunjungan pasien bulan September menunjukkan peningkatan kasus ISPA dan demam berdarah. Telah dilakukan penyuluhan kesehatan di lingkungan padat penduduk.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pegawai' => 8,
                'jenis_laporan' => 'Mingguan',
                'tanggal_laporan' => '2025-10-11',
                'deskripsi_laporan' => 'Laporan minggu kedua bulan Oktober: pemeriksaan ibu hamil dan imunisasi balita terlaksana 100%. Tidak ada kejadian luar biasa kesehatan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pegawai' => 6,
                'jenis_laporan' => 'Mingguan',
                'tanggal_laporan' => '2025-09-28',
                'deskripsi_laporan' => 'Kegiatan pelayanan laboratorium dan pemeriksaan darah rutin pasien berjalan sesuai jadwal. Persediaan reagen cukup untuk dua minggu ke depan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pegawai' => 3,
                'jenis_laporan' => 'Bulanan',
                'tanggal_laporan' => '2025-08-31',
                'deskripsi_laporan' => 'Laporan bulanan: telah dilakukan 15 kali kunjungan rumah bagi pasien lansia dan penyuluhan tentang hipertensi. Ditemukan peningkatan tekanan darah pada 3 pasien.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pegawai' => 5,
                'jenis_laporan' => 'Tahunan',
                'tanggal_laporan' => '2025-01-01',
                'deskripsi_laporan' => 'Evaluasi tahunan tahun 2024 menunjukkan penurunan angka stunting sebesar 10% di wilayah kerja Puskesmas. Program gizi balita akan terus ditingkatkan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pegawai' => 7,
                'jenis_laporan' => 'Tahunan',
                'tanggal_laporan' => '2024-12-31',
                'deskripsi_laporan' => 'Laporan tahunan mencatat 12.000 pasien terlayani dengan baik sepanjang tahun 2024. Fokus tahun depan adalah peningkatan pelayanan digital dan rekam medis elektronik.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pegawai' => 8,
                'jenis_laporan' => 'Mingguan',
                'tanggal_laporan' => '2025-10-05',
                'deskripsi_laporan' => 'Kegiatan minggu pertama Oktober: pemeriksaan tekanan darah massal dan pembagian brosur pencegahan diabetes di kelurahan Menur Pumpungan.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pegawai' => 9,
                'jenis_laporan' => 'Harian',
                'tanggal_laporan' => '2025-10-17',
                'deskripsi_laporan' => 'Pelayanan hari ini berlangsung kondusif. Terdapat 34 pasien dengan keluhan ringan seperti batuk, pilek, dan demam.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_pegawai' => 10,
                'jenis_laporan' => 'Harian',
                'tanggal_laporan' => '2025-10-16',
                'deskripsi_laporan' => 'Pelaporan harian bagian administrasi: semua data kunjungan pasien telah diinput ke sistem rekam medis tanpa kendala teknis.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
