<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import semua API Controller
use App\Http\Controllers\Api\PasienApiController;
use App\Http\Controllers\Api\DokterApiController;
use App\Http\Controllers\Api\PegawaiApiController;
use App\Http\Controllers\Api\PoliApiController;
use App\Http\Controllers\Api\KunjunganApiController;
use App\Http\Controllers\Api\RekamMedisApiController;
use App\Http\Controllers\Api\ResepObatApiController;
use App\Http\Controllers\Api\ObatApiController;
use App\Http\Controllers\Api\BiayaApiController;
use App\Http\Controllers\Api\PembayaranApiController;
use App\Http\Controllers\Api\LaporanApiController;
use App\Http\Controllers\Api\PemeriksaanApiController;
use App\Http\Controllers\Api\JadwalPraktikApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Route ini otomatis memiliki prefix '/api'
| dan tidak menggunakan session (stateless)
|--------------------------------------------------------------------------
*/

// Contoh route default Laravel
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ==========================
// 📦 ROUTE API PUSKESMAS
// ==========================

// Pasien
Route::apiResource('pasien', PasienApiController::class);

// Dokter
Route::apiResource('dokter', DokterApiController::class);

// Pegawai
Route::apiResource('pegawai', PegawaiApiController::class);

// Poli
Route::apiResource('poli', PoliApiController::class);

// Kunjungan
Route::apiResource('kunjungan', KunjunganApiController::class);

// Rekam Medis
Route::apiResource('rekam-medis', RekamMedisApiController::class);

// Resep Obat
Route::apiResource('resep-obat', ResepObatApiController::class);

// Obat
Route::apiResource('obat', ObatApiController::class);

// Biaya
Route::apiResource('biaya', BiayaApiController::class);

// Pembayaran
Route::apiResource('pembayaran', PembayaranApiController::class);

// Laporan
Route::apiResource('laporan', LaporanApiController::class);

// Pemeriksaan
Route::apiResource('pemeriksaan', PemeriksaanApiController::class);

// Jadwal Praktik
Route::apiResource('jadwal-praktik', JadwalPraktikApiController::class);
