<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\StoreHargaRequest;
use App\Http\Requests\UpdateHargaRequest;
use App\Models\District;
use App\Models\Price;
use App\Models\City;

use App\Models\Service;



class HargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('harga.harga', [
            "title" => "Pricing",
            "prices" => Price::all(),
        ]);
    
    }

    public function show()
    {
        $dataPrice = [

            "kotaasals" => City::with('districts')->get(),
            "kecasals" => District::all(),
            "kotatujs" => City::with('districts')->get(),
            "kectujs" => District::all(),
            "layanan" => Service::all() 
        ];

        return response()->json($dataPrice);
    }

    public function getPrice(Request $request)
    {
        // Ambil pilihan dari permintaan AJAX
        $kotaAsal = $request->input('kotaasal');
        $kecAsal = $request->input('kecasal');
        $kotaTujuan = $request->input('kotatujuan');
        $kecTujuan = $request->input('kectujuan');
        $layanan = $request->input('layanan');


        // query berdasarkan data inputan ajax
        $price = Price::where([
            'IdKotaAsal' => $kotaAsal,
            'IdKecAsal' => $kecAsal,
            'IdKotaTujuan' => $kotaTujuan,
            'IdKectujuan' => $kecTujuan,
            'IdLayanan' => $layanan,
        ])->value('Harga');

        return response()->json(['price' => $price]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validateData = $request->validate([
            'kotaasal' => 'required',
            'kecasal' => 'required',
            'kotatujuan' => 'required',
            'layanan' => 'required',
            'harga' => 'decimal',
        ]);

        Harga::create($validateData);

        return redirect()->route('harga.index')->with('success', 'Tambah Harga Berhasil.');
    }

    public function formAddHarga()
    {
        // $allCityDistrics = $this->show();
        $response = $this->show(); // Mengambil response JSON dari show method
        $data = json_decode($response->getContent(), true); // Mendekode response JSON menjadi array
        $kotaasals = $data['kotaasals']; // Mengambil data kota
        $kotatujs = $data['kotatujs']; // Mengambil data kota
        $layanan = $data['layanan'];        
        return view('harga.tambah-harga',[
            'title' => 'Tambah Harga',
            'data' => $data,
            'kotaasals' => $kotaasals, // Mengirimkan data kota ke view
            'kotatujs' => $kotatujs, // Mengirimkan data kota ke view
            'layanan' => $layanan,
        ]);
    }

    public function showView()
    {
        $dataHarga = Price::with(['cityFrom','districtFrom','cityTo','districtTo','service'])->get();
        return view(('harga.index'),[
            'title' => 'Daftar Harga',
            'hargas' => $dataHarga,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHargaRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    // public function show(Harga $harga)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Harga $harga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHargaRequest $request, Harga $harga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Harga $harga)
    {
        //
    }
}
