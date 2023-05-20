<?php

use App\Http\Controllers\AmilController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MuzakkiController;
use App\Http\Controllers\PembayaranZakatController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\ZakatMalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/zakat/excel', [App\Http\Controllers\PembayaranZakatController::class, 'excel'])->name('zakat.excel');
    Route::get('/zakat/invoice/{zakat}', [App\Http\Controllers\PembayaranZakatController::class, 'invoice'])->name('zakat.invoice');
    Route::post('/laporan/keseluruhan', [App\Http\Controllers\LaporanController::class, 'cetakKeseluruhan'])->name('laporan.keseluruhan');
    Route::post('/laporan/distribusi', [App\Http\Controllers\LaporanController::class, 'cetakDistribusi'])->name('laporan.distribusi');
    Route::get('/penerima/distribusi', [App\Http\Controllers\PenerimaController::class, 'distribusi'])->name('penerima.distribusi');
    Route::resource('dashboard', DashboardController::class);
    Route::resource('muzakki', MuzakkiController::class);
    Route::resource('zakat', PembayaranZakatController::class);
    Route::resource('zakat_mal', ZakatMalController::class);
    Route::resource('amil', AmilController::class);
    Route::resource('laporan', LaporanController::class);
    Route::resource('penerima', PenerimaController::class);
});
Auth::routes();
