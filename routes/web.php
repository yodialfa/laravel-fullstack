<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AgenController;
use App\Http\Controllers\CityController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\DistrictController;

use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResiSelesaiController;
use App\Http\Controllers\ShipmentsController;
use App\Http\Controllers\TransaksiController;


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


Route::middleware(['checkRoles:admin,cabang,agen,kurir'])->group(function () {
    Route::get('/pengantaranupdateview', [ResiSelesaiController::class, 'pengantaranupdateview'])->name('pengantaran-view');
    Route::get('/pengantaranupdateview/get', [ResiSelesaiController::class, 'getPengantaranupdate'])->name('pengantaran-get');
    Route::get('/pengantaranupdateview/get/viewupdate/{no_resi}', [ResiSelesaiController::class, 'generateResiSelesaiUpdate'])->name('pengantaran-getviewupdate');
    Route::post('/pengantaranupdateview/get/viewupdate/{no_resi}', [ResiSelesaiController::class, 'updateResi'])->name('pengantaran-resiselesai');
    
    

    Route::middleware(['checkRoles:admin,cabang,agen'])->group(function () {
        //route admin
        Route::get('/admin',[AdminController::class, 'index'])->name('admin');
        //transaksi
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
        Route::get('/transaksi/get-customer/{number}', [TransaksiController::class, 'getCust']);
        Route::post('/transaksi/store', [TransaksiController::class, 'create'])->name('transaksi.store');
        Route::get('/transaksi/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
        Route::get('/transaksi/cetak', [TransaksiController::class, 'success'])->name('transaksi.success');

        //generate pdf
        Route::get('/generate-pdf/{no_resi}', [PdfController::class, 'generatePdf'])->name('generate-pdf');

        
        // Route::get('/agen/transaksi/', [AgenController::class, 'index'])->name('agen.transaksi');
        // Route::get('/agen/transaksi/get', [AgenController::class, 'getData'])->name('agen.getData');
        // Route::get('/agen/transaksi/{start}/{end}/', [AgenController::class, 'index'])->name('agen.date');
        Route::get('/agen/transaksi/', [AgenController::class, 'index'])->name('agen.transaksi');
        Route::get('/agen/transaksi/get', [AgenController::class, 'getData'])->name('agen.getData');
        // Route::get('/agen/transaksi/{start}/{end}/', [AgenController::class, 'index'])->name('agen.date');
        Route::get('/agen/transaksi/export/{start}/{end}/', [AgenController::class, 'exportAll'])->name('agen.export');

        Route::get('/agen/transaksi/rows', [AgenController::class, 'getRecords'])->name('agen.rows');
        Route::get('/agen/manivest', [AgenController::class, 'manivest'])->name('agen.manivest');
        Route::post('/agen/manivest', [AgenController::class, 'storeshipment'])->name('agen.shipment');
        Route::get('/agen/manivest/data', [AgenController::class, 'viewManivestData'])->name('agen.manivest-data');
        Route::get('/agen/manivest/data/detail/{ship_id}', [AgenController::class, 'fetchLoadingData'])->name('agen.manivest-detail-data');
        Route::get('/agen/manivest/data-fetch', [AgenController::class, 'fetchManivestData'])->name('agen.manivest-fetch');
        

        
        

        
        // Route yang dapat diakses oleh semua pengguna yang sudah login
        Route::middleware(['checkRoles:admin,cabang'])->group(function() {
            //menu cabang
            Route::get('/cabang/shipment/', [CabangController::class, 'genShipmentAgen'])->name('cabang.view-shipment-agen');
            Route::get('/cabang/shipment/data', [CabangController::class, 'genShipment'])->name('cabang.generate-shipment');
            Route::get('/cabang/auth', [CabangController::class, 'check'])->name('cabang.cek');
            Route::get('/cabang/shipment/update-agen', [CabangController::class, 'genUpdateShipmentGudangAsal'])->name('cabang.update-shipment-agen');
            Route::get('/cabang/shipment/loading', [CabangController::class, 'loadingView'])->name('cabang.loading');
            Route::get('/cabang/shipment/loading/loadingshipment', [CabangController::class, 'loadingShipment'])->name('cabang.loading-shipment');
            Route::get('/cabang/shipment/loading/updateloading', [CabangController::class, 'updateLoading'])->name('cabang.loading-update');
            Route::get('/cabang/shipment/listloading', [CabangController::class, 'listLoadingView'])->name('cabang.list-loading');
            Route::get('/cabang/shipment/listloading/data', [CabangController::class, 'getLoadingList'])->name('cabang.loading-shipment-data');
            Route::get('/cabang/shipment/departure', [CabangController::class, 'departureView'])->name('cabang.departure');
            Route::get('/cabang/shipment/departure/data', [CabangController::class, 'departureData'])->name('cabang.dep-data');
            Route::get('/cabang/shipment/departure/create', [CabangController::class, 'createDeparture'])->name('cabang.dep-create');
            Route::get('/cabang/shipment/departure/listdeparture', [CabangController::class, 'listDepartureView'])->name('cabang.list-departure');
            Route::get('/cabang/shipment/departure/listdeparture/data', [CabangController::class, 'fetchDepartureData'])->name('cabang.list-depdata');
            Route::get('/cabang/shipment/arrived/generate', [CabangController::class, 'getViewGenDep'])->name('cabang.view-arrived');
            Route::get('/cabang/shipment/arrived/generate/departure', [CabangController::class, 'genDeparture'])->name('cabang.generate-arrived');
            Route::get('/cabang/shipment/arrived/generate/update', [CabangController::class, 'genUpdateShipmentGudangTujuan'])->name('cabang.update-depdata');
            Route::get('/cabang/shipment/arrived/listarrived', [CabangController::class, 'listArrivedView'])->name('cabang.list-arrived');
            Route::get('/cabang/shipment/arrived/listarrived/data', [CabangController::class, 'getArrivedList'])->name('cabang.list-arrived-data');
            Route::get('/cabang/shipment/sorting', [CabangController::class, 'getSortirPengantaranView'])->name('cabang.sorting');
            Route::get('/cabang/shipment/sorting/data', [CabangController::class, 'loadDataSortirPengantaran'])->name('cabang.sorting-data');
            Route::get('/cabang/shipment/sorting/create', [CabangController::class, 'createSortingShipment'])->name('cabang.sorting-data-create');
            Route::get('/cabang/shipment/sorting/list', [CabangController::class, 'getViewListSortir'])->name('cabang.sorting-list-sortir');
            Route::get('/cabang/shipment/sorting/list/data', [CabangController::class, 'listSortir'])->name('cabang.sorting-list-sortir-data');
            Route::get('/cabang/shipment/pengantaran', [CabangController::class, 'pengantaranView'])->name('cabang.pengantaran-view');
            Route::get('/cabang/shipment/pengantaran/data', [CabangController::class, 'loadDataPengantaran'])->name('cabang.pengantaran-data');
            Route::get('/cabang/shipment/pengantaran/create', [CabangController::class, 'createDataPengantaran'])->name('cabang.pengantaran-shipment');
            Route::get('/cabang/shipment/pengantaran/list', [CabangController::class, 'getListPengantaranView'])->name('cabang.pengantaran-listview');
            Route::get('/cabang/shipment/pengantaran/listdata', [CabangController::class, 'loadListPengantaran'])->name('cabang.pengantaran-listview-data');
        
        });

    

        // Route yang dapat diakses oleh admin
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

            //agen

        });

    // Route::middleware('checkRoles:user')->group(function() {

    //     //route admin
    //     Route::get('/admin',[AdminController::class, 'index'])->name('admin');

        
    }); 
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

// cek resi

Route::get('/cek-resi', [StatusController::class, 'cekResiView'])->name('cekresi-view');
Route::get('/get-resi', [StatusController::class, 'cekResi'])->name('cekresi-get');


Route::get('/kota/cek', [CityController::class, 'show'])->name('cekkota');


Route::get('/get-kecamatan/{id}', [DistrictController::class, 'getByKota']);





Route::get('/about ', function () {
    return view('about', [
        "title" => "About"
    ]);
});

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
