<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;

class DistrictController extends Controller
{
    // public function getByKota($id)
    // {
    //     $kecamatan = District::where('IdCities', $id)->get();  
    //     Log::info('Data kecamatan:', ['kecamatan' => $kecamatan]); 
    //     return response()->json(['kecamatan' => $kecamatan]);
    // }


    public function getByKota($id) {
        $kecamatan = District::where('IdCities', $id)->get();   
        return response()->json(['kecamatan' => $kecamatan]);
        // return dd($kecamatan)
    }
}
