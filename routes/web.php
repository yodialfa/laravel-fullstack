<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\DistrictController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\RegisterController;


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


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('admin');
// Route::post('/register', [RegisterController::class, 'store'])->name('store')->middleware('admin');

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan')->middleware('admin');
Route::get('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update')->middleware('admin');
Route::put('/karyawan/{id}', [KaryawanController::class, 'updateKaryawan'])->name('karyawan.updatekaryawan')->middleware('admin');
Route::delete('/karyawan/delete/{id}', [KaryawanController::class, 'hapusKaryawan'])->name('karyawan.hapus')->middleware('admin');


// Route::get('/', [HargaController::class, 'index'])->name('home');

Route::get('/admin',[AdminController::class, 'index'])->name('admin')->middleware('admin');
// karyawan rute
// Route::post('/register', [RegisterController::class, 'store'])->name('store')->middleware('guest');
Route::get('/tambahkar',[RegisterController::class, 'index'])->name('tambahkar')->middleware('admin');
Route::post('/tambahkar',[RegisterController::class, 'store'])->name('store')->middleware('admin');

Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan')->middleware(['admin']);
Route::get('/karyawan/detail/{karyawan:id}',[KaryawanController::class, 'show']);

// harga route
Route::get('/harga', [HargaController::class, 'index'])->name('price');
Route::get('/harga/cek', [HargaController::class, 'show'])->name('cektarif');
Route::get('/hargaadmin', [HargaController::class, 'showView'])->name('harga.index')->middleware('admin');
Route::get('/hargaadmin/tambahharga', [HargaController::class, 'formTambahHarga'])->name('harga.add')->middleware('admin');
Route::post('/hargaadmin/tambahharga', [HargaController::class, 'create'])->name('harga.create')->middleware('admin');
Route::get('/hargaadmin/updateharga/{id}', [HargaController::class, 'openViewUpdate'])->name('harga.update-view')->middleware('admin');
Route::put('/hargaadmin/updateharga/{id}', [HargaController::class, 'updateHarga'])->name('harga.update')->middleware('admin');
Route::delete('/hargaadmin/deleteharga/{id}', [HargaController::class, 'hapusHarga'])->name('harga.hapus')->middleware('admin');
Route::get('/get-price', [HargaController::class, 'getPrice'])->name('tampilharga');

// city route
Route::get('/kota', [CityController::class, 'index'])->name('kota')->middleware('admin');
Route::get('/get-kecamatan/{id}', [DistrictController::class, 'getByKota']);
Route::get('/tambah-kota', [CityController::class, 'tambahKota'])->name('kota.add')->middleware('admin');
Route::post('/tambah-kota', [CityController::class, 'create'])->name('kota.create')->middleware('admin');
Route::get('/update-kota/{id}', [CityController::class, 'openViewUpdate'])->name('kota.update-view')->middleware('admin');
Route::put('/update-kota/{id}', [CityController::class, 'updateHarga'])->name('kota.update')->middleware('admin');
Route::delete('/deletkota/{id}',[CityController::class, 'hapusKota'])->name('kota.hapus')->middleware('admin');
Route::get('/kota/cek', [CityController::class, 'show'])->name('cekkota');

    



Route::get('/about ', function () {
    return view('about', [
        "title" => "About"
    ]);
});
