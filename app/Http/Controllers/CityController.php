<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    //mengakses data kota dari DB
    public function getAll()
    {
        return City::all();
    }
    public function index()
    {
        $cityData = City::filters(['search' => request('search')])
                                ->paginate(10);
        return view('kota.kota',[
            'title' => "Kota",
            'cities' => $cityData, 

        ]);
    }

    public function show(){
        $cityData = self::getAll();
        return response()->json($cityData);
    }

    public function tambahKota()
    {
        return view('kota.tambahkota', [
            'title' => "Tambah Kota"
        ]);
    }

    public function create(Request $request)
    {
        $validateKota = $request->validate([
            'namakota' => 'required|unique:cities',
        ]);

        $dataKota = [
            'NamaKota' => $validateKota['namakota'],
        ];

        City::create($dataKota);

        return redirect()->route('kota')->with('success', 'Kota Ditambahkan');
    }


    //menampilkan form view update city
    public function openViewUpdate(String $id)
    {
        $cityData = City::findOrFail($id);

        return view('kota.update-kota',[
            'title' => "Update Kota",
            'cityNow' => $cityData,
        ]);

        // return $getCityId;
    }

    public function updateKota(Request $request, $id)
    {
        $this->validate($request,[
            'namakota' => 'required',
        ]);

        $cityId = City::findOrFail($id);

        $cityId->update([
            'NamaKota' => $request->namakota,
        ]);
        return redirect()->route('kota')->with(['success' => 'Kota diubah']);

    }

    public function hapusKota($id)
    {
        {
            $data = City::findOrFail($id);
            $data->delete();
    
            return redirect()->route('kota')->with('success','Kota Berhasil dihapus');
        }
    }


    
}
