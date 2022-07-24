<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranZakatController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/zakat/excel', [App\Http\Controllers\PembayaranZakatController::class, 'excel'])->name('zakat.excel');
Route::resource('dashboard', DashboardController::class);
Route::resource('zakat', PembayaranZakatController::class);
Auth::routes();
