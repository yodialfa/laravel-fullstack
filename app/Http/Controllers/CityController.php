<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('kota.kota', [
            'title' => "Kota",
            'cities' => $cityData,

        ]);
    }

    public function show()
    {
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
            'namakota' => 'required|unique:Cities',
        ]);

        // Dapatkan nilai terbesar dari kolom ID
        $maxId = City::max('id');
        // Tambahkan 1 untuk mendapatkan ID baru
        $newId = $maxId + 1;

        // Buat data kota
        $dataKota = [
            'id' => $newId,
            'NamaKota' => $validateKota['namakota'],
        ];

        // Buat data cabang
        $dataCabang = [
            'id' => $newId,
            'cabang' => $validateKota['namakota'],
            'alamatCabang' => "On Process",
        ];

        // Simpan data kota
        City::create($dataKota);

        // Buat data untuk tabel 'cabangs'
        Cabang::create($dataCabang);

        return redirect()->route('kota')->with('success', 'Kota Ditambahkan');
    }



    //menampilkan form view update city
    public function openViewUpdate(String $id)
    {
        $cityData = City::findOrFail($id);

        return view('kota.update-kota', [
            'title' => "Update Kota",
            'cityNow' => $cityData,
        ]);

        // return $getCityId;
    }

    public function updateKota(Request $request, $id)
    {
        $this->validate($request, [
            'namakota' => 'required',
        ]);

        $cityId = City::findOrFail($id);
        $cabangId = Cabang::findOrFail($id);

        $cityId->update([
            'NamaKota' => $request->namakota,
        ]);
        $cabangId->update([
            'cabang' => $request->namakota,
        ]);
        return redirect()->route('kota')->with(['success' => 'Kota diubah']);
    }

    public function hapusKota($id)
    { {
            $data = City::findOrFail($id);
            $data->delete();

            return redirect()->route('kota')->with('success', 'Kota Berhasil dihapus');
        }
    }
}
