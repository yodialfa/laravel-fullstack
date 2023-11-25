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

    private $dataHarga = null;
    protected $dataList;
    protected $kotaasals;
    protected $kotatujs;
    protected $layanan;

    public function index()
    {
        return view('harga.harga', [
            "title" => "Pricing",
            "prices" => Price::all(),
        ]);
    
    }

    public function show()
    {
        $city = City::with('districts')->get();
        $district = District::all();
        $service = Service::all();
        $dataPrice = [

            "kotaasals" => $city,
            "kecasals" => $district,
            "kotatujs" => $city,
            "kectujs" => $district,
            "layanan" => $service,
        ];

        return response()->json($dataPrice);
    }

    // function untuk menampilkan data harga pada menu admin
    public function showView()
    {
        $dataHarga = Price::with(['cityFrom','districtFrom','cityTo','districtTo','service'])
                    ->filters(['search-asal' => request('search-asal'), 
                               'search-tujuan' => request('search-tujuan')])
                    ->paginate(10);
        return view(('harga.index'),[
            'title' => 'Daftar Harga',
            'hargas' => $dataHarga,
        ]);
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
            'kectujuan' => 'required',
            'layanan' => 'required',
            'harga' => 'integer',
        ]);

        $dataHargaCreate = [
            'IdKotaAsal' => $validateData['kotaasal'],
            'IdKecAsal' => $validateData['kecasal'],
            'IdKotaTujuan' => $validateData['kotatujuan'],
            'IdKecTujuan' => $validateData['kectujuan'],
            'IdLayanan' => $validateData['layanan'],
            'Harga' => $validateData['harga'],
        ];

        Price::create($dataHargaCreate);

        return redirect()->route('harga.index')->with('success', 'Tambah Harga Berhasil.');
    }

    // kontroler untuk tambah harga
    public function formTambahHarga()
    {
        $isEdit = false;


        $response = $this->show(); // Mengambil response JSON dari show method
        $this->dataList = json_decode($response->getContent(), true); // Mendekode response JSON menjadi array
        $this->kotaasals = $this->dataList['kotaasals']; // Mengambil data kota
        $this->kotatujs = $this->dataList['kotatujs']; // Mengambil List kota
        $this->layanan = $this->dataList['layanan'];   
        

        return view('harga.tambah-harga',[
            'title' => 'Tambah Harga',
            'data' => $this->dataList,
            'kotaasals' => $this->kotaasals, // Mengirimkan data kota ke view
            'kotatujs' => $this->kotatujs, // Mengirimkan data kota ke view
            'layanan' => $this->layanan,  
            'isEdit' => $isEdit,      
        ]); 
    }


    //menampilkan form update
    public function openViewUpdate(String $id)
    {
        // $response = Price::findOrFail($id);
        $response = $this->show();
        $allHarga = json_decode($response->getContent(), true); // Mengonversi respons JSON ke dalam array

        $dataHarga = Price::with(['cityFrom','districtFrom','cityTo','districtTo','service'])
        ->where('id', $id)
        ->first();

        // instansiasi dari districk controller
        $getKec = new DistrictController();

        $kotaasalGet = $allHarga['kotaasals'];

        $kecasalGet = $getKec->getByKota($dataHarga->IdKotaAsal);
        $kecasals = json_decode($kecasalGet->getContent(), true);
        // $kecamatansAsal = collect($kecasalGet)->pluck('NamaKecamatan', 'id');


        $kotatujuanGet = $allHarga['kotatujs'];

        $kectujsGet = $getKec->getByKota($dataHarga->IdKotaTujuan);
        $kectujs = json_decode($kectujsGet->getContent(), true);
        // $kecamatansTujuan = $kectujsGet['kecamatan'];
        // $kecamatansTujuan = collect($kectujsGet)->pluck('NamaKecamatan', 'id');



        $layananGet = $allHarga['layanan'];

        return view('harga.update',[
            'title' => 'Update Harga',
            'hargaById' => $dataHarga,
            'kotaasals' => $kotaasalGet,
            'kecasals' => $kecasals,
            'kotatujs' => $kotatujuanGet,
            'kectujs' => $kectujs,
            'layanan' => $layananGet,
        ]);
        // return $kotatujuanGet;
    }

    public function updateHarga(Request $request, $id)
    {
        $this->validate($request,[
            'kotaasal' => 'required',
            'kecasal' => 'required',
            'kotatujuan' => 'required',
            'kectujuan' => 'required',
            'layanan' => 'required',
            'harga' => 'required|integer',     
        ]);

        $hargaId = Price::findOrFail($id);

        $hargaId->update([
            'IdKotaAsal' => $request->kotaasal,
            'IdKecAsal' => $request->kecasal,
            'IdKotaTujuan' => $request->kotatujuan,
            'IdKecTujuan' => $request->kectujuan,
            'IdLayanan' => $request->layanan,
            'Harga' => $request->harga,
        ]);

        return redirect()->route('harga.index')->with(['success' => 'Data Harga Berhasil diubah.']);
    } 

    public function hapusHarga($id)
    {
        $data = Price::findOrFail($id);
        $data->delete();

        return redirect()->route('harga.index')->with('success','Harga Berhasil diahpus');
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
    // public function edit(Harga $harga)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateHargaRequest $request, Harga $harga)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Harga $harga)
    // {
    //     //
    // }
}
