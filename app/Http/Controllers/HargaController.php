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

    // public function show()
    // {
    //     return view('harga.cektarif', [
    //         "title" => "Home |Tarif",
    //         "kotaasals" => City::all(),
    //         "kecasals" => District::all(),
    //         "kotatujs" => City::all(),
    //         "kectujs" => District::all(),
    //         "layanan" => Service::all() 
    //     ]
    // );
    // }

    public function show()
    {
        $data = [
            "title" => "Home | Tarif",
            "kotaasals" => City::with('districts')->get(),
            "kecasals" => District::all(),
            "kotatujs" => City::with('districts')->get(),
            "kectujs" => District::all(),
            "layanan" => Service::all() 
        ];

        return response()->json($data);


        // $kotaasals = City::with('districts')->get();
        // $kotatujs = City::with('districts')->get();
        
        // $filteredKotaasalDistricts = $kotaasals->flatMap->districts;
        // $filteredKotatujDistricts = $kotatujs->flatMap->districts;
        
        // $data = [
            // "title" => "Home | Tarif",
            // "kotaasals" => $kotaasals,
            // "kecasals" => District::all(),
            // "kotatujs" => $kotaasals,
            // "kectujs" => District::all(),
            // "layanan" => Service::all(),
            // "filteredKotaasalDistricts" => $filteredKotaasalDistricts,
            // "filteredKotatujDistricts" => $filteredKotatujDistricts,
        // ];

        // return response()->json($data);

        // $kotaasals = City::with('districts')->get();

        // $filteredKotaasalDistricts = [];

        // foreach ($kotaasals as $kotaasal) {
        //     $districts = $kotaasal->districts;
        //     // You can apply any additional filtering or logic here if needed.
        //     $filteredKotaasalDistricts = array_merge($filteredKotaasalDistricts, $districts->toArray());
        // }

        // $data = [
        //     "title" => "Home | Tarif",
        //     "kotaasals" => $kotaasals,
        //     "kecasals" => District::all(),
        //     "kotatujs" => City::with('districts')->get(),
        //     "kectujs" => District::all(),
        //     "layanan" => Service::all(),
        //     "filteredKotaasalDistricts" => $filteredKotaasalDistricts,
        // ];

        // return response()->json($data);
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHargaRequest $request)
    {
        //
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
