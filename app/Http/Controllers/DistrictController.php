<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    // public function getByKota($id)
    // {
    //     $kecamatan = District::where('IdCities', $id)->get();  
    //     Log::info('Data kecamatan:', ['kecamatan' => $kecamatan]); 
    //     return response()->json(['kecamatan' => $kecamatan]);
    // }

    public function index() 
    {
        $cities = City::all();

        return view('kota.kecamatan',[
            'title' => "Kecamatan",
            'cities' => $cities,
        ]);

        // return $cities;
    }


    public function getByKota($id) {
        $kecamatan = District::where('IdCities', $id)->get();   
        // return response()->json(['kecamatan' => $kecamatan]);
        return response()->json($kecamatan);
        // return dd($kecamatan)
    }
}
