<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranZakatController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/zakat/excel', [App\Http\Controllers\PembayaranZakatController::class, 'excel'])->name('zakat.excel');
    Route::get('/zakat/invoice/{zakat}', [App\Http\Controllers\PembayaranZakatController::class, 'invoice'])->name('zakat.invoice');
    Route::post('/laporan/keseluruhan', [App\Http\Controllers\LaporanController::class, 'cetakKeseluruhan'])->name('laporan.keseluruhan');
    Route::resource('dashboard', DashboardController::class);
    Route::resource('zakat', PembayaranZakatController::class);
    Route::resource('laporan', LaporanController::class);
});
Auth::routes();
