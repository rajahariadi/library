<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Models\Penerbit;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin.index');
});

Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

Route::get('/kategori/dt', [KategoriController::class,'dtKategori'])->name('kategori.dt');
Route::get('/penerbit/dt', [PenerbitController::class,'dtPenerbit'])->name('penerbit.dt');

Route::resource('kategori', KategoriController::class);
Route::resource('penerbit', PenerbitController::class);
