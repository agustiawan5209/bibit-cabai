<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\NilaiController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\LatihController;
use App\Http\Controllers\Petani\BerandaController as PetaniBerandaController;
use App\Http\Controllers\Petani\LahanController;

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
})->name('index');
Route::get('/masuk', [LoginController::class, 'index'])->name('masuk');
Route::post('/masuk/proses', [LoginController::class, 'prosesmasuk'])->name('masuk.proses');
Route::get('/daftar', [LoginController::class, 'daftar'])->name('daftar');
Route::post('/daftar/proses', [LoginController::class, 'prosesdaftar'])->name('daftar.proses');
Route::post('/keluar', [LoginController::class, 'keluar'])->name('keluar');

Route::group(['middleware' => 'petani'], function (){ 
    Route::group(['prefix' => 'petani'], function () {
        Route::get('/', [PetaniBerandaController::class, 'index'])->name('petani.dashboard');

        //profil
        Route::get('/password', [PetaniBerandaController::class, 'password'])->name('petani.password');
        Route::post('/password/update', [PetaniBerandaController::class, 'passwordupdate'])->name('petani.password.update');

        //lahan
        Route::get('/lahan', [LahanController::class, 'index'])->name('petani.lahan');
        Route::post('/lahan/uji', [LahanController::class, 'uji'])->name('petani.lahan.uji');
        Route::get('/history', [LahanController::class, 'history'])->name('petani.lahan.history');
    });
});

Route::group(['middleware' => 'admin'], function (){ 
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [BerandaController::class, 'index'])->name('admin.dashboard');

        //profil
        Route::get('/profil', [BerandaController::class, 'profil'])->name('admin.profil');
        Route::post('/profil/simpan', [BerandaController::class, 'profilsimpan'])->name('admin.profil.simpan');

        //pengguna
        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('admin.pengguna');
        Route::get('/pengguna/tambah', [PenggunaController::class, 'tambah'])->name('admin.pengguna.tambah');
        Route::post('/pengguna/simpan', [PenggunaController::class, 'simpan'])->name('admin.pengguna.simpan');
        Route::get('/pengguna/edit/{id}', [PenggunaController::class, 'edit'])->name('admin.pengguna.edit');
        Route::post('/pengguna/update', [PenggunaController::class, 'update'])->name('admin.pengguna.update');
        Route::get('/pengguna/hapus/{id}', [PenggunaController::class, 'hapus'])->name('admin.pengguna.hapus');

        //kriteria
        Route::get('/kriteria', [KriteriaController::class, 'index'])->name('admin.kriteria');
        Route::get('/kriteria/tambah', [KriteriaController::class, 'tambah'])->name('admin.kriteria.tambah');
        Route::post('/kriteria/simpan', [KriteriaController::class, 'simpan'])->name('admin.kriteria.simpan');
        Route::get('/kriteria/edit/{id}', [KriteriaController::class, 'edit'])->name('admin.kriteria.edit');
        Route::post('/kriteria/update', [KriteriaController::class, 'update'])->name('admin.kriteria.update');
        Route::get('/kriteria/hapus/{id}', [KriteriaController::class, 'hapus'])->name('admin.kriteria.hapus');

        //nilai
        Route::get('/nilai', [NilaiController::class, 'index'])->name('admin.nilai');
        Route::get('/nilai/tambah', [NilaiController::class, 'tambah'])->name('admin.nilai.tambah');
        Route::post('/nilai/simpan', [NilaiController::class, 'simpan'])->name('admin.nilai.simpan');
        Route::get('/nilai/edit/{id}', [NilaiController::class, 'edit'])->name('admin.nilai.edit');
        Route::post('/nilai/update', [NilaiController::class, 'update'])->name('admin.nilai.update');
        Route::get('/nilai/hapus/{id}', [NilaiController::class, 'hapus'])->name('admin.nilai.hapus');

        //latih
        Route::get('/latih', [LatihController::class, 'index'])->name('admin.latih');
        Route::get('/latih/tambah', [LatihController::class, 'tambah'])->name('admin.latih.tambah');
        Route::post('/latih/simpan', [LatihController::class, 'simpan'])->name('admin.latih.simpan');
        Route::get('/latih/edit/{id}', [LatihController::class, 'edit'])->name('admin.latih.edit');
        Route::post('/latih/update', [LatihController::class, 'update'])->name('admin.latih.update');
        Route::get('/latih/hapus/{id}', [LatihController::class, 'hapus'])->name('admin.latih.hapus');
    });
});
