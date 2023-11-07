<?php

use App\Http\Controllers\AdminController;
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

// Route::post('/register', [RegisterController::class, 'store'])->name('store')->middleware('guest');
Route::get('/tambahkar',[RegisterController::class, 'index'])->name('tambahkar')->middleware('admin');
Route::post('/tambahkar',[RegisterController::class, 'store'])->name('store')->middleware('admin');

Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan')->middleware(['admin']);
Route::get('/karyawan/{karyawan:id}',[KaryawanController::class, 'show']);


Route::get('/harga', [HargaController::class, 'index'])->name('price');
Route::get('/harga/cek', [HargaController::class, 'show'])->name('cektarif');
Route::get('/hargaadmin', [HargaController::class, 'showView'])->name('harga.index')->middleware('admin');
Route::get('/hargaadmin/tambahharga', [HargaController::class, 'formAddHarga'])->name('harga.add')->middleware('admin');
Route::post('/hargaadmin/tambahharga', [HargaController::class, 'create'])->name('harga.create')->middleware('admin');
Route::get('/get-kecamatan/{id}', [DistrictController::class, 'getByKota']);
Route::get('/get-price', [HargaController::class, 'getPrice'])->name('tampilharga');



Route::get('/about ', function () {
    return view('about', [
        "title" => "About"
    ]);
})->middleware('auth');
