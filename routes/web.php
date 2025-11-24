<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalPraktikController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\ResepObatController;
use App\Http\Controllers\BiayaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KunjunganController;

// ✅ Halaman utama (Dashboard)
Route::get('/', function () {
    return view('welcome'); // Ganti dengan dashboard.blade.php kalau ada
})->name('home');

// ✅ Web routes dengan prefix dan nama route untuk setiap modul
Route::prefix('jadwal-praktik')->group(function () {
    Route::get('/', [JadwalPraktikController::class, 'index'])->name('jadwal.index');
    Route::get('/tambah', [JadwalPraktikController::class, 'create'])->name('jadwal.create');
    Route::post('/', [JadwalPraktikController::class, 'store'])->name('jadwal.store');
    Route::get('/{id}/edit', [JadwalPraktikController::class, 'edit'])->name('jadwal.edit');
    Route::put('/{id}', [JadwalPraktikController::class, 'update'])->name('jadwal.update');
    Route::delete('/{id}', [JadwalPraktikController::class, 'destroy'])->name('jadwal.destroy');
});

Route::resource('laporan', LaporanController::class);
Route::resource('pembayaran', PembayaranController::class);
Route::resource('rekam-medis', RekamMedisController::class);
Route::resource('resep-obat', ResepObatController::class);
Route::resource('biaya', BiayaController::class);
Route::resource('obat', ObatController::class);
Route::resource('pemeriksaan', PemeriksaanController::class);
Route::resource('poli', PoliController::class);
Route::resource('dokter', DokterController::class);
Route::resource('pegawai', PegawaiController::class);
Route::resource('kunjungan', KunjunganController::class);
