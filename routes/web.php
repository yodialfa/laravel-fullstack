<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HargaController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransaksiController;

use App\Http\Middleware\CheckRole;


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


Route::middleware(['checkRoles:admin,user'])->group(function () {
    //route admin
    Route::get('/admin',[AdminController::class, 'index'])->name('admin');
    //transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
    Route::get('/transaksi/get-customer/{number}', [TransaksiController::class, 'getCust']);
    Route::post('/transaksi/store', [TransaksiController::class, 'create'])->name('transaksi.store');
    Route::get('/transaksi/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');

    //generate pdf
    Route::get('/generate-pdf/{no_resi}', [PdfController::class, 'generatePdf'])->name('generate-pdf');


    // Route yang dapat diakses oleh semua pengguna yang sudah login
    Route::middleware('admin')->group(function() {
        //route karyawan dan user 
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
        Route::get('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
        Route::put('/karyawan/{id}', [KaryawanController::class, 'updateKaryawan'])->name('karyawan.updatekaryawan');
        Route::delete('/karyawan/delete/{id}', [KaryawanController::class, 'hapusKaryawan'])->name('karyawan.hapus');

        //route harga
        Route::get('/tambahkar',[RegisterController::class, 'index'])->name('tambahkar');
        Route::post('/tambahkar',[RegisterController::class, 'store'])->name('store');
        Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
        Route::get('/karyawan/detail/{karyawan:id}',[KaryawanController::class, 'show']);

        //route harga
        Route::get('/hargaadmin', [HargaController::class, 'showView'])->name('harga.index');
        Route::get('/hargaadmin/tambahharga', [HargaController::class, 'formTambahHarga'])->name('harga.add');
        Route::post('/hargaadmin/tambahharga', [HargaController::class, 'create'])->name('harga.create');
        Route::get('/hargaadmin/updateharga/{id}', [HargaController::class, 'openViewUpdate'])->name('harga.update-view');
        Route::put('/hargaadmin/updateharga/{id}', [HargaController::class, 'updateHarga'])->name('harga.update');
        Route::delete('/hargaadmin/deleteharga/{id}', [HargaController::class, 'hapusHarga'])->name('harga.hapus');

        // city route
        Route::get('/kota', [CityController::class, 'index'])->name('kota');
        Route::get('/tambah-kota', [CityController::class, 'tambahKota'])->name('kota.add');
        Route::post('/tambah-kota', [CityController::class, 'create'])->name('kota.create');
        Route::get('/update-kota/{id}', [CityController::class, 'openViewUpdate'])->name('kota.update-view');
        Route::put('/update-kota/{id}', [CityController::class, 'updateKota'])->name('kota.update');
        Route::delete('/deletekota/{id}',[CityController::class, 'hapusKota'])->name('kota.hapus');

        //kecamatan
        Route::get('/kecamatan', [DistrictController::class, 'index'])->name('kecamatan');
        Route::get('/kecamatan/tambah/{id}', [DistrictController::class, 'tambahKecamatan'])->name('kecamatan.add');
        Route::post('/kecamatan/tambah/{id}', [DistrictController::class, 'create'])->name('kecamatan.create');
        Route::get('/kecamatan/update/{idKota}/{idKec}', [DistrictController::class, 'openViewUpdate'])->name('kecamatan.update-view');
        Route::put('/kecamatan/update/{idKec}', [DistrictController::class, 'updateKecamatan'])->name('kecamatan.update');
        Route::delete('/kecamatan/hapus/{id}', [DistrictController::class, 'hapusKecamatan'])->name('kecamatan.hapus');

        
    });

    // Route::middleware('checkRoles:user')->group(function() {

    //     //route admin
    //     Route::get('/admin',[AdminController::class, 'index'])->name('admin');

        
    // }); 
});

//route admin
// Route::get('/admin',[AdminController::class, 'index'])->name('admin')->middleware(['user','admin']);




Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::post('/register', [RegisterController::class, 'store'])->name('store')->middleware('admin');

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/', [HargaController::class, 'index'])->name('home');
// karyawan rute
// Route::post('/register', [RegisterController::class, 'store'])->name('store')->middleware('guest');


// harga route
Route::get('/harga', [HargaController::class, 'index'])->name('price');
Route::get('/harga/cek', [HargaController::class, 'show'])->name('cektarif');
Route::get('/get-price', [HargaController::class, 'getPrice'])->name('tampilharga');


Route::get('/kota/cek', [CityController::class, 'show'])->name('cekkota');


Route::get('/get-kecamatan/{id}', [DistrictController::class, 'getByKota']);





Route::get('/about ', function () {
    return view('about', [
        "title" => "About"
    ]);
});
