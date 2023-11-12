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

    public function tambahKecamatan($idKota)
    {
        $kota = City::findOrFail($idKota);
        
        return view('kota.tambahkecamatan', [
            'title' => "Tambah Kecamatan",
            'city' => $kota,

        ]);
    }

    public function create(Request $request, $idKota)
    {
        $validateKec = $request->validate([
            'namakecamatan' => 'required|unique:districts',
        ]);

        $dataKec = [
            'NamaKecamatan' => $validateKec['namakecamatan'],
            'IdCities' => $idKota,
        ];

        District::create($dataKec);

        return redirect()->route('kecamatan')->with('success', 'menambahkan kecamatan' );
        
    }

    public function openViewUpdate($idKota, $idKec)
    {
        $kota = City::findOrFail($idKota);
        $kec = District::findOrFail($idKec);
        return view('kota.update-kecamatan',[
            'title' => "Update Kecamatan",
            'city' => $kota,
            'kec' => $kec,
        ]);
    }

    public function updateKecamatan(Request $request, $idKec)
    {
        $this->validate($request,[
            'namakecamatan' => 'required',
        ]);

        $kecId = District::findOrFail($idKec);

        $kecId->update([
            'NamaKecamatan' => $request->namakecamatan,
        ]);

        return redirect()->route('kecamatan')->with('success','Kecamatan Berhasil diubah');
    }

    public function hapusKecamatan($id)
    {
        $data = District::findOrFail($id);
        $data->delete();

        return redirect()->route('kecamatan')->with('success','Kecamatan Berhasil dihapus');
    }
}
