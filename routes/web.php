<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Models\Produk;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('/kategori', \App\Http\Controllers\KategoriController::class);
Route::resource('/produk', \App\Http\Controllers\ProdukController::class);
Route::delete('/produks/deleteSelected', [ProdukController::class, 'deleteSelected'])->name('produk.deleteSelected');
