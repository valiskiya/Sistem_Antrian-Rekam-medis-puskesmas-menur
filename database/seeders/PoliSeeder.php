<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        // Nonaktifkan sementara foreign key agar bisa truncate
        Schema::disableForeignKeyConstraints();
        DB::table('poli')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('poli')->insert([
            [
                'nama_poli' => 'Poli Umum',
                'deskripsi' => 'Layanan kesehatan untuk pemeriksaan umum bagi semua pasien.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_poli' => 'Poli Gigi',
                'deskripsi' => 'Layanan khusus untuk perawatan dan pemeriksaan gigi dan mulut.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_poli' => 'Poli KIA',
                'deskripsi' => 'Layanan kesehatan ibu dan anak, termasuk pemeriksaan kehamilan dan tumbuh kembang anak.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_poli' => 'Poli Gizi',
                'deskripsi' => 'Layanan untuk pemantauan gizi, penanganan malnutrisi, dan penyuluhan gizi.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_poli' => 'Poli Anak',
                'deskripsi' => 'Layanan kesehatan yang ditujukan untuk anak-anak, mulai dari bayi hingga remaja.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_poli' => 'Poli Paru-paru',
                'deskripsi' => 'Layanan kesehatan yang berfokus pada pemeriksaan dan pengobatan penyakit paru-paru.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_poli' => 'Poli Batra',
                'deskripsi' => 'Layanan kesehatan untuk pemeriksaan dan pengobatan penyakit Batang Paru.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_poli' => 'Poli Psikologi',
                'deskripsi' => 'Layanan psikologis untuk konseling, terapi, dan evaluasi kesehatan mental.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_poli' => 'Poli Rehabilitasi Medik',
                'deskripsi' => 'Layanan rehabilitasi untuk pemulihan fisik pasien pasca cedera atau operasi.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_poli' => 'Poli Medical Check Up',
                'deskripsi' => 'Layanan pemeriksaan kesehatan secara menyeluruh untuk deteksi dini penyakit.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_poli' => 'Poli Lansia',
                'deskripsi' => 'Layanan kesehatan untuk lansia, termasuk pemeriksaan kesehatan dan pemantauan kondisi fisik.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_poli' => 'Poli PKG',
                'deskripsi' => 'Layanan pemeriksaan kesehatan untuk pekerja dan kelompok yang membutuhkan layanan PKG.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
