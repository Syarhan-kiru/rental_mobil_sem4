<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PenyewaanController;

Route::get('/', function () {
    return view('login.index');
})->name('login');

Route::controller(LoginController::class)->group(function () {
    Route::post('/login/proses', 'proses')->name('login.proses');
    Route::get('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Halaman Admin - Wajib Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::view('/dashboard', 'dashboard.index')->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Manajemen User
    |--------------------------------------------------------------------------
    */

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/tambah', [UserController::class, 'tambah'])->name('tambah');
        Route::post('/simpan', [UserController::class, 'simpan'])->name('simpan');
        Route::get('/hapus/{id}', [UserController::class, 'hapus'])->name('hapus');
        Route::post('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('/update', [UserController::class, 'update'])->name('update');
    });

    /*
    |--------------------------------------------------------------------------
    | Data Mobil
    |--------------------------------------------------------------------------
    */

    Route::prefix('mobil')->name('mobil.')->group(function () {
        Route::get('/', [MobilController::class, 'index'])->name('index');
        Route::get('/tambah', [MobilController::class, 'tambah'])->name('tambah');
        Route::post('/simpan', [MobilController::class, 'simpan'])->name('simpan');
        Route::get('/hapus/{id}', [MobilController::class, 'hapus'])->name('hapus');
        Route::get('/edit/{id}', [MobilController::class, 'edit'])->name('edit');
        Route::get('/edit/{id}', [MobilController::class, 'edit'])->name('edit');
        Route::post('/update', [MobilController::class, 'update'])->name('update');
    });

    /*
    |--------------------------------------------------------------------------
    | Data Pelanggan
    |--------------------------------------------------------------------------
    */

    Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/', [PelangganController::class, 'index'])->name('index');
        Route::get('/tambah', [PelangganController::class, 'tambah'])->name('tambah');
        Route::post('/simpan', [PelangganController::class, 'simpan'])->name('simpan');
        Route::get('/hapus/{id}', [PelangganController::class, 'hapus'])->name('hapus');
        Route::post('/edit/{id}', [PelangganController::class, 'edit'])->name('edit');
        Route::post('/update', [PelangganController::class, 'update'])->name('update');
    });

   Route::prefix('penyewaan')->name('penyewaan.')->group(function () {
    Route::get('/', [PenyewaanController::class, 'index'])->name('index');
    Route::get('/tambah', [PenyewaanController::class, 'tambah'])->name('tambah');
    Route::post('/simpan', [PenyewaanController::class, 'simpan'])->name('simpan');
    Route::get('/detail/{id}', [PenyewaanController::class, 'show'])->name('detail');
    Route::get('/hapus/{id}', [PenyewaanController::class, 'destroy'])->name('hapus');
    Route::get('/edit/{id}', [PenyewaanController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [PenyewaanController::class, 'update'])->name('update');
});

    });
/*
    |--------------------------------------------------------------------------
    | Data penyewaan
    |--------------------------------------------------------------------------
    */
 
});