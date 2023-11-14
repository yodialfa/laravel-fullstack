<?php

namespace App\Http\Controllers;
use App\Models\City;

use App\Models\Service;
use App\Models\Customer;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getCity = City::all();
        $getService = Service::all();
        
        return view('transaksi.index', [
            'title' => 'Transaksi',
            'kotaasals' => $getCity,
            'kotatujs' => $getCity,
            'services' => $getService,
        ]);
        // return $getService;
    }

    public function getCust($number)
    {
        $dataCust = Customer::where('no_hp', $number)->first();
        return response()->json(['customer'=> $dataCust]);
        // return dd($number);
    }

    public function create(Request $request) 
    {
        $validatedData = request()->validate([
            // 'no_resi' => "required",
            'phone-input-pengirim' => "required|numeric",
            'nama-pengirim' => ['required', 'string'],
            'alamat-pengirim' => "required|max:255",
            'phone-input-penerima' => "required|numeric",
            'nama-penerima' => ['required', 'string'],
            'alamat-penerima' => "required|max:255",
            'kotaasal' => "required",
            'kecasal' => "required",
            'kotatujuan' => "required",
            'kectujuan' => "required",
            'layanan' => "required",
            'jumlah' => "required|numeric",
            'berat' => "required|numeric",
            'diskon' => "required|numeric",
            'biaya_surat' => "required|numeric",
            'jenis_barang' => "required|string",
            'biaya_asuransi' => "required|numeric",
           

        ]);





        $transaksiData = [
            
            'no_resi' => $request->no_resi,
            'no_hp_pengirim' => $validatedData['phone-input-pengirim'],
            'nama_pengirim' => $validatedData['nama-pengirim'],
            'alamat_pengirim' => $validatedData['alamat-pengirim'],
            'no_hp_penerima' => $validatedData['phone-input-penerima'],
            'nama_penerima' => $validatedData['nama-penerima'],
            'alamat_penerima' => $validatedData['alamat-penerima'],
            'IdKotaAsal' => $validatedData['kotaasal'],
            'IdKecAsal' => $validatedData['kecasal'],
            'IdKotaTujuan' => $validatedData['kotatujuan'],
            'IdKecTujuan' => $validatedData['kectujuan'],
            'IdLayanan' => $validatedData['layanan'],
            'jumlah' => $validatedData['jumlah'],
            'berat' => $validatedData['berat'],
            'harga' => $request->harga,
            'diskon' => $validatedData['diskon'],
            'biaya_surat' => $validatedData['biaya_surat'],
            'jenis_barang' => $validatedData['jenis_barang'],
            'biaya_asuransi' => $validatedData['biaya_asuransi'],
            'total_harga' => $request->total_harga,
            'employeeId' => Auth::user()->id,

        ];

        // $transaksi = Transaksi::create($validatedData);
        return $transaksiData;
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create($number)
    // {
        
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
