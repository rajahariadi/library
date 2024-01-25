<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\RakController;
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


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/', [DashboardController::class, 'index']);

Route::get('/kategori/dt', [KategoriController::class,'dtKategori'])->name('kategori.dt');
Route::get('/penerbit/dt', [PenerbitController::class,'dtPenerbit'])->name('penerbit.dt');
Route::get('/rak/dt', [RakController::class,'dtRak'])->name('rak.dt');
Route::get('/member/dt', [MemberController::class,'dtMember'])->name('member.dt');

Route::resource('kategori', KategoriController::class);
Route::resource('penerbit', PenerbitController::class);
Route::resource('rak', RakController::class);
Route::resource('member', MemberController::class);
