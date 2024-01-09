<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Cabang;
use App\Models\Status;
use App\Models\Karyawan;
use App\Models\Shipments;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DetailShipments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreCabangRequest;
use App\Http\Requests\UpdateCabangRequest;
use App\Models\District;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    //fungsi menampilkan generate shipment
    public function genShipmentAgen()
    {
        return view('cabang.generate-shipment-agen', [
            'title' => "Generate Shipment Agen",
        ]);
    }

    //fungsi untuk mendapatkan data shipment
    private function fetchData($ship_id, $addCond)
    {

        
        $model = DetailShipments::with(['resi','shipment',
                                        // 'shipment.cabang_id',    
                                        'resi.karyawan:id,cabang_id,agen_id', 
                                        'resi.kotaAsal:id,NamaKota',
                                        'resi.kecAsal:id,NamaKecamatan',
                                        'resi.kotaTujuan:id,NamaKota',
                                        'resi.kecTujuan:id,NamaKecamatan',
                                        'resi.serviceId:id,NamaLayanan',
                                        'resi.karyawan.agen:id,agen'])
                ->where('ship_id',$ship_id);

        // $checkroles = $model->whereHas('shipment', function ($query) use ($auth) {
        //     $query->where('tujuan', $auth);
        // })->count();

        if (Auth::user()->role !== 'admin') {
            if ($addCond == 'asal') {
                $model->whereHas('shipment', function ($query) {
                    $query->where('cabang_id', Auth::user()->karyawanuser->cabang_id);
                });
            } elseif ($addCond == 'tujuan') {
                $model->whereHas('shipment', function ($query) {
                    $query->where('tujuan', '=', Auth::user()->karyawanuser->cabang_id);
                });
            }
        }
        // if (Auth::user()->role !== 'admin') {
        //     if ($addCond == 'asal') {
        //         $model->whereHas('shipment', function ($query) {
        //             $query->where('cabang_id', Auth::user()->karyawanuser->cabang_id);
        //         });
        //     } elseif ($addCond == 'tujuan' && $checkroles > 0) {
        //         $model->whereHas('shipment', function ($query) {
        //             // $query->where('cabang_id', Auth::user()->karyawanuser->cabang_id);
        //             $query->where('tujuan', '=', Auth::user()->karyawanuser->cabang_id);
        //         });
        //     } elseif ($addCond == 'tujuan') {
        //         $model->whereHas('shipment', function ($query) {
        //             $query->where('cabang_id', '!=', Auth::user()->karyawanuser->cabang_id);
        //         });
        //     }

        // } elseif (Auth::user()->role === 'admin') {
        
        //     if ($addCond == 'tujuan') {
        //         // $model->whereHas('shipment', function ($query) {
        //         //     // $query->where('cabang_id', Auth::user()->karyawanuser->cabang_id);
        //         //     $query->where('tujuan', '=', Auth::user()->karyawanuser->cabang_id);
        //         // });
        //         $model = $model;
        //     }

        // }


        \Log::info($model->toSql());

        

        // var_dump(DB::getQueryLog());


        // return dd($model); 

        return $model;
    

        // return collect(); // Return an empty collection if conditions are not met
    }

    //fungsi untuk mendapatkan data shipment
    public function fetchManivestDetail($ship_id)
    {
        $addCond = 'asal';
        $data = $this->fetchData($ship_id, $addCond)->get();

        return $data;
    }

    //cek 
    public function check() {
        $auth = Auth::user()->karyawanuser->cabang_id;
        return $auth;
    }

    //generate shipment
    public function loadShipment($ship_id, $statship, $addCond) 
    {
        
        // if ($request->ajax()) {

            // Mengambil nilai shipment_id dari request
            // $ship_id = $request->input('shipment_id');
            $data = $this->fetchData($ship_id, $addCond);

            // DB::enableQueryLog();
            $res = $data->join('transaksis', 'transaksis.no_resi', '=', 'detail_shipments.no_resi')
                        ->where('transaksis.status', $statship)
                        ->get();
                    

            return $res;
    }

    //fungsi generate kedatangan barang dari agen
    public function genShipment(Request $request)
    {
        $statship = 1;
        try {
            if ($request->ajax()) {

                // Mengambil nilai shipment_id dari request
                $ship_id = $request->input('shipment_id');
                $addCond = 'asal';
                $data = $this->loadShipment($ship_id, $statship, $addCond);
                return DataTables::of($data)
                    // Add your columns and other DataTables configurations here
                        ->addColumn('checkbox', '<input type="checkbox" name="resi_checkbox[]" id="{{$no_resi}}" class="resi_checkbox" value="{{$no_resi}}" />')
                        ->rawColumns(['checkbox','action'])
                        ->make(true);
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    //fungsi generate kedatangan barang lintas cabang
    public function genDeparture(Request $request)
    {
        $statship = 4;
        try {
            if ($request->ajax()) {
                // Mengambil nilai shipment_id dari request
                $ship_id = $request->input('shipment_id');
                // Menambahkan kondisi tambahan
                $addCond = 'tujuan';
                $data = $this->loadShipment($ship_id, $statship, $addCond);
        
                return DataTables::of($data)
                    // Add your columns and other DataTables configurations here
                        ->addColumn('checkbox', '<input type="checkbox" name="resi_checkbox[]" id="{{$no_resi}}" class="resi_checkbox" value="{{$no_resi}}" />')
                        ->rawColumns(['checkbox','action'])
                        ->make(true);
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    //update shipment
    public function updateShipment(Request $request) 
    {
        try {
            
            // $requestData = $request->$requestData;
            $requestData = json_decode($request->input('data'), true);

            $statuses = [];
            $noResis = [];
            $statShip = [];

            foreach ($requestData as $data) {
                $statuses[] = [
                    'no_resi' => $data['no_resi'],
                    'status' =>$data['status'],
                    'ket' => $data['ket'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $noResis[] = $data['no_resi'];
                $statShip[] = $data['status'];

            }
            // insert data status
            Status::insert($statuses);
            // Melakukan update status pada transaksi
            Transaksi::whereIn('no_resi', $noResis)->update(['status' =>$statShip[0]]);
             
            // Debugging statements
            Log::info('Received data:', $requestData);
            // return $noResis;
            // return response()->json($statuses);
        } catch (\Exception $e) {
            // Log the exception or echo for debugging
            Log::error($e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
        
    } 

    //update shipment gudang asal
    public function genUpdateShipmentGudangAsal(Request $request)
    {
        if($request->ajax()){
            // $requestData = json_decode($request->input('data'), true);

            $this->updateShipment($request);
        }
    }

    //update shipment gudang tujuan
    // public function genUpdateShipmentGudangTujuan(Request $request)
    // {
    //     if($request->ajax()){
    //         // $requestData = json_decode($request->input('data'), true);
    //         $ship_id = $request->input('ship_id');
    //         $this->updateShipment($request);
    //         Shipments::where('ship_id', $ship_id)->update(['status' => 4]);
    //     }
    // }
    public function genUpdateShipmentGudangTujuan(Request $request)
    {
        if ($request->ajax()) {
            try {
                // $requestData = json_decode($request->input('data'), true);
                $ship_id = $request->input('shipment_id');
                // Menggunakan findOrFail untuk mencari rekaman berdasarkan ship_id
                $shipment = Shipments::where('ship_id', $ship_id)
                                        ->first();


                // Pastikan fungsi ini telah didefinisikan dengan benar
                $this->updateShipment($request);

                if ($shipment) {
                    // Update status di tabel Shipments
                    $shipment->update(['status' => 4]);
    
                    \Log::info("Shipment ID: $ship_id");
    
                    return response()->json(['success' => true]);
                } else {
                    // Handle case when shipment record is not found
                    return response()->json(['error' => 'Shipment not found.'], 404);
                }

                // // Update status di tabel Shipments
                // $shipment->update(['status' => 4]);
                // // Shipments::where('ship_id', $ship_id)->update(['status' => 4]);


                \Log::info("Shipment ID: $ship_id");


                return response()->json(['success' => true]);
                // return $shipment;

            } catch (\Exception $e) {
                // Tangani kesalahan
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }

    //menampilkan view loading barang
    function loadingView()
    {
        $cabs = Auth::user()->karyawanuser->cabang_id;
        if (Auth::user()->role === 'admin') {
            $kotaAsal = City::all();
        } else {
            $kotaAsal = City::where('id', $cabs)->get();
        }
        return view('cabang.loadingbarang', [
            'title' => "Loading Barang",
            'asal' => $kotaAsal,
            'kota' => City::all(),
        ]);
    }

    //fetching data loading
    private function getData(Request $request)
    {
        $asal = $request->input('asal');
        $tujuan = $request->input('tujuan');

        $model = Transaksi::with(['kotaAsal:id,NamaKota','kotaTujuan:id,NamaKota','kecAsal:id,NamaKecamatan',
                                'kecTujuan:id,NamaKecamatan', 'serviceId:id,NamaLayanan', 
                                'karyawan:id,agen_id,cabang_id', 'karyawan.agen:id,agen'])
                            ->where('IdKotaAsal', $asal)
                            ->where('IdKotaTujuan', $tujuan);

        if (Auth::user()->role !== 'admin') {
            $model->whereHas('karyawan', function ($query) {
                $query->where('cabang_id', Auth::user()->karyawanuser->cabang_id);
                });
            // $model->where('karyawan.cabang_id', Auth::user()->karyawanuser->cabang_id);
            
        }

        DB::enableQueryLog();
        return $model;

        
    }

    public function loadingData(Request $request, $stat)
    {
        $model = $this->getData($request);
        $data = $model->where('status', $stat)
                    ->get();

        return $data;
    }


    //controller laoding shipment
    public function loadingShipment(Request $request) 
    {
        if ($request->ajax()) {
            $stat = 2;
            $data = $this->loadingData($request, $stat);
                    

            return DataTables::of($data)
               // Add your columns and other DataTables configurations here
                ->addColumn('checkbox', '<input type="checkbox" name="resi_checkbox[]" id="{{$no_resi}}" class="resi_checkbox" value="{{$no_resi}}" />')
                ->rawColumns(['checkbox','action'])
                ->make(true);

        }
    }

    public function updateLoading(Request $request) 
    {
        if($request->ajax()){
            $requestData = json_decode($request->input('data'), true);
            $tujuan = $request->input('kota_tujuan');
            // $des = City::select('id','NamaKota')
            //                     ->where('id', $tujuan)->first();

            $this->updateShipment($request);

            $user = Auth::user()->id;
            $karyawanUser = Karyawan::select('cabang_id', 'agen_id')
                                    ->where('id', $user)->first();
            $randomCode = Str::random(8);

            $cabang = $karyawanUser->cabang_id;
            $agen = $karyawanUser->agen_id;

            // $noResis = $this->$noResis;

            $shipmentData = [
                'agen_id' => $agen,
                'cabang_id' => $cabang,
                'ship_id' => 'LOAD'.$randomCode,
                'status' => '2',
                // 'tujuan' => $des->NamaKota,
                'tujuan' => Auth::user()->karyawanuser->cabang_id,
            ];

            //simpan data shipment
            $shipment = Shipments::create($shipmentData);
            
            // Membuat array untuk detail shipment
            $detailShipments = [];

                        
            // Memasukkan data ke dalam array
            foreach ($requestData as $resi) {
                // $detailShipments[] = ['no_resi' => $resi];
                $detailShipments[] = ['no_resi' => $resi['no_resi']];
            }
            
            // Melakukan saveMany untuk detail shipment
            $shipment->detailShipments()->createMany($detailShipments);
            // return redirect()->route('agen.detail-manivest-data', ['ship_id' => $randomCode])->with('success', 'Manivest dibuat');

            // return redirect('/agen/manivest/data/detail/'.$randomCode)->with('success', 'Manivest dibuat');
            $response = [
                'success' => true,
                'message' => 'Data berhasil diupdate.',
                'redirect' => '/agen/manivest/data/detail/'.$shipmentData['ship_id'],
            ];
            
            return response()->json($response);
            
        }
    } 

    //menampilkan view loading list
    public function listLoadingView()
    {
        return view('cabang.dataloading', [
            'title' => "List Loading",
        ]);
    }

    //fetching list loading
    public function fetchLoadingData(Request $request, $stat_shipid, $tujuan = false)
    {
        $start_date = Carbon::parse($request->input('from_date'));
        $end_date = Carbon::parse($request->input('to_date'));

        if ($end_date->greaterThan($start_date)) {
            $model = Shipments::with(['agen:id,agen,cabang_id', 'cabang:id,cabang', 'cabangTujuan:id,cabang'])
                ->whereBetween('created_at', [$start_date, $end_date])
                ->where('status', $stat_shipid);
            if ($tujuan == true)
            {
                $model = $model->with(['kecTujuanPengantaran:id,NamaKecamatan']);
            } 
            

            if (Auth::user()->role !== 'admin') {
                if (!in_array($stat_shipid, [4, 5, 6])) {
                    $model->where('cabang_id', Auth::user()->karyawanuser->cabang_id);
                    // where('agen_id', Auth::user()->karyawanuser->agen_id)
                } else {
                    $model->where('tujuan', Auth::user()->karyawanuser->cabang_id);
                }
            }

            $data = $model->get();
            return $data;
            
        }
    }

    
    //menampilkan data loading
    public function getLoadingList(Request $request)
    {
        $stat_shipid = 2;
        $load = 'asal';
        $data = $this->fetchLoadingData($request, $stat_shipid);
        // dd($data);
        // return $data;
        return DataTables::of($data)
                ->toJson();
    }

    //menampilkan data pemberangkatan
    public function getDepList(Request $request, $stat_shipid)
    {
        // $stat_shipid = 3;
        // $load = 'asal';
        $data = $this->fetchLoadingData($request, $stat_shipid);
        return $data;
        
    }

    //turunan data pemberangkatan dengan status 3 (berangkat dari gudang)
    public function fetchDepartureData(Request $request)
    {
        // $load = 'asal';
        $data = $this->getDepList($request, 3);
        return DataTables::of($data)
                ->toJson();
    }

    //turunan data pemberangkatan untuk menampilkan data dengan status 4 (sampai di gdg tujuan)
    public function fetchArrivedData(Request $request)
    {
        // $load = 'tujuan';
        $data = $this->getDepList($request, 4);
        return DataTables::of($data)
                ->toJson();
    }

    //menampilkan view pemberangkatan
    function departureView()
    {
        $cabs = Auth::user()->karyawanuser->cabang_id;
        if (Auth::user()->role === 'admin') {
            $kotaAsal = City::all();
        } else {
            $kotaAsal = City::where('id', $cabs)->get();
        }
        return view('cabang.pemberangkatan', [
            'title' => "Loading Barang",
            'asal' => $kotaAsal,
            'kota' => City::all(),
        ]);
    }

    //fetching data loading untuk diberangkatkan
    public function departureData(Request $request)
    {
        if ($request->ajax()) {
            $stat = 3; //status 3 yaitu barang yang sudah diproses loading
            $data = $this->loadingData($request, $stat);
                    

            return DataTables::of($data)
               // Add your columns and other DataTables configurations here
                ->addColumn('checkbox', '<input type="checkbox" name="resi_checkbox[]" id="{{$no_resi}}" class="select-checkbox" value="{{$no_resi}}" />')
                ->rawColumns(['checkbox','action'])
                ->make(true);

        }
    }

    //fungsi buat rg pemberangkatan
    public function createDeparture(Request $request)
    {
        $this->updateShipment($request);
        $requestData = json_decode($request->input('data'), true);

        $kotaasal = $request->input('asal');
        $kotatujuan = $request->input('tujuan');
        $sopir = $request->input('sopir');
        $nopol = $request->input('nopol');
        

        $user = Auth::user()->id;
        $karyawanUser = Karyawan::select('cabang_id', 'agen_id')
                                ->where('id', $user)->first();
        $randomCode = Str::random(8);

        $cabang = $karyawanUser->cabang_id;
        $agen = $karyawanUser->agen_id;

        // $noResis = $this->$noResis;



        $shipmentData = [
            'agen_id' => $agen,
            'cabang_id' => $kotaasal,
            'ship_id' => 'RG'.$randomCode,
            'nopol' => $nopol,
            'pic' => $sopir,
            'status' => '3',
            // 'tujuan' => $des->NamaKota,
            'tujuan' => $kotatujuan,
        ];
  

        //simpan data shipment
        $shipment = Shipments::create($shipmentData);
        
        // Membuat array untuk detail shipment
        $detailShipments = [];

                    
        // Memasukkan data ke dalam array
        foreach ($requestData as $resi) {
            // $detailShipments[] = ['no_resi' => $resi];
            $detailShipments[] = ['no_resi' => $resi['no_resi']];
        }
        
        // Melakukan saveMany untuk detail shipment
        $shipment->detailShipments()->createMany($detailShipments);

        // Log::info('Received nopol: ' . $shipmentData);
        // // or
        // dd($shipmentData);
        // return $shipmentData;

        $response = [
            'success' => true,
            'message' => 'Data berhasil diupdate.',
            'redirect' => '/agen/manivest/data/detail/'.$shipmentData['ship_id'],
        ];
        
        return response()->json($response);


    }

    //menampilkan view kedatangan barang
    public function getViewGenDep()
    {
        return view('cabang.datangbarang', [
            'title' => "Kedatangan Barang",
        ]);
    }

    public function listDepartureView()
    {
        return view('cabang.datapemberangkatan', [
            'title' => "Data Pemberangkatan",
        ]);
    }

    public function listArrivedView()
    {
        return view('cabang.datadatangbarang', [
            'title' => "List Datang Barang",
        ]);
    }

    public function getArrivedList(Request $request)
    {
        $stat_shipid = 4;
        $load = 'tujuan';
        $data = $this->fetchLoadingData($request, $stat_shipid);
        // if (Auth::user()->role !== 'admin') {
            
        
        // }
        // dd($data);
        // return $data;
        return DataTables::of($data)
                ->toJson();
    }

    public function getSortirPengantaranView()
    {
        $cabang = Auth::user()->karyawanuser->cabang_id;
        $kec = District::where('IdCities', $cabang)->get();
        return view('cabang.sortirpengantaran', [
            'title' => "Pengantaran",
            'kecs' => $kec
        ]);

    }

    public function loadDataSortirPengantaran(Request $request)
    {
        $cabang = Auth::user()->karyawanuser->cabang_id;
        $kec = $request->input('kec');
        $data = Transaksi::with('kotaAsal:id,NamaKota','kotaTujuan:id,NamaKota',
                            'kecAsal:id,NamaKecamatan','kecTujuan:id,NamaKecamatan',
                            'serviceId:id,NamaLayanan','karyawan:id,agen_id,cabang_id','karyawan.agen:id,agen')
                            ->where('IdKecTujuan', $kec)
                            ->where('status', 5);
        if (Auth::user()->role !== 'admin') {
            $data = $data->where('IdKotaTujuan', $cabang);
        }

        $data = $data->get();
        

        return DataTables::of($data)
                        ->addColumn('checkbox', '<input type="checkbox" name="resi_checkbox[]" id="{{$no_resi}}" class="resi_checkbox" value="{{$no_resi}}" />')
                        ->rawColumns(['checkbox','action'])
                        ->make(true);
        // return $data;
    }

    public function createSortingShipment(Request $request)
    {
        $this->updateShipment($request);
        $requestData = json_decode($request->input('data'), true);
        $kec = $request->input('kec');

        // $kotaasal = $request->input('asal');
        $kota = Auth::user()->karyawanuser->cabang_id;
        // $kotatujuan = $request->input('tujuan');
        $kotaasal = $kota;
        $kotatujuan = $kota;
        
        $pic = $request->input('pic');
        

        $user = Auth::user()->id;
        $karyawanUser = Karyawan::select('cabang_id', 'agen_id')
                                ->where('id', $user)->first();
        $randomCode = Str::random(8);

        // $cabang = $karyawanUser->cabang_id;
        $agen = $karyawanUser->agen_id;

        // $noResis = $this->$noResis;



        $shipmentData = [
            'agen_id' => $agen,
            'cabang_id' => $kotaasal,
            'ship_id' => 'SORTIR'.$randomCode,
            'nopol' => 'SORTIR',
            'pic' => $pic,
            'status' => '5',
            'tujuan' => $kotatujuan,
            'kecTujuan' => $kec,
        ];
  

        //simpan data shipment
        $shipment = Shipments::create($shipmentData);
        
        // Membuat array untuk detail shipment
        $detailShipments = [];

                    
        // Memasukkan data ke dalam array
        foreach ($requestData as $resi) {
            // $detailShipments[] = ['no_resi' => $resi];
            $detailShipments[] = ['no_resi' => $resi['no_resi']];
        }
        
        // Melakukan saveMany untuk detail shipment
        $shipment->detailShipments()->createMany($detailShipments);

        // Log::info('Cek Data: ' . $shipmentData);
        // // or
        // dd($shipmentData);
        // return $shipmentData;
        // return redirect('/agen/manivest/data/detail/'.$randomCode)->with('success', 'Manivest dibuat');
        $response = [
            'success' => true,
            'message' => 'Data berhasil diupdate.',
            'redirect' => '/agen/manivest/data/detail/'.$shipmentData['ship_id'],
        ];

        return response()->json($response);
    }

    public function getViewListSortir()
    {
        return view('cabang.datasortir', [
            'title' => 'List Sortir Barang',
        ]);
    }

    public function listSortir(Request $request)
    {
        $stat_shipid = 5;
        $sortir = true;
        $data = $this->fetchLoadingData($request, $stat_shipid, $sortir);
        // if (Auth::user()->role !== 'admin') {
            
        // }
        // dd($data);
        // return $data;
        return DataTables::of($data)
                ->toJson();
    }

    public function pengantaranView()
    {
        $cabang = Auth::user()->karyawanuser->cabang_id;
        $kec = District::where('IdCities', $cabang)->get();
        return view('cabang.pengantaran', [
            'title' => 'List Sortir Barang',
            'kecs' => $kec
        ]);
    }

    public function listPengantaran(Request $request)
    {
        $stat_shipid = 5;
        $tujuan = true;
        $data = $this->fetchLoadingData($request, $stat_shipid, $tujuan);

        return DataTables::of($data)
                ->toJson();
    }

    public function loadDataPengantaran(Request $request)
    {
        $cabang = Auth::user()->karyawanuser->cabang_id;
        $kec = $request->input('kec');
        $data = Transaksi::with('kotaAsal:id,NamaKota','kotaTujuan:id,NamaKota',
                            'kecAsal:id,NamaKecamatan','kecTujuan:id,NamaKecamatan',
                            'serviceId:id,NamaLayanan','karyawan:id,agen_id,cabang_id','karyawan.agen:id,agen')
                            ->where('IdKecTujuan', $kec)
                            ->where('status',6);
        if (Auth::user()->role !== 'admin') {
            $data = $data->where('IdKotaTujuan', $cabang);
        }

        $data = $data->get();
        

        return DataTables::of($data)
                        ->addColumn('checkbox', '<input type="checkbox" name="resi_checkbox[]" id="{{$no_resi}}" class="resi_checkbox" value="{{$no_resi}}" />')
                        ->rawColumns(['checkbox','action'])
                        ->make(true);
        // return $data;
    }

    public function createDataPengantaran(Request $request)
    {
        $this->updateShipment($request);
        $requestData = json_decode($request->input('data'), true);
        $kec = $request->input('kec');

        // $kotaasal = $request->input('asal');
        $kota = Auth::user()->karyawanuser->cabang_id;
        // $kotatujuan = $request->input('tujuan');
        $kotaasal = $kota;
        $kotatujuan = $kota;
        
        $pic = $request->input('pic');
        

        $user = Auth::user()->id;
        $karyawanUser = Karyawan::select('cabang_id', 'agen_id')
                                ->where('id', $user)->first();
        $randomCode = Str::random(8);

        // $cabang = $karyawanUser->cabang_id;
        $agen = $karyawanUser->agen_id;

        // $noResis = $this->$noResis;



        $shipmentData = [
            'agen_id' => $agen,
            'cabang_id' => $kotaasal,
            'ship_id' => 'ANTAR'.$randomCode,
            'nopol' => 'ANTAR',
            'pic' => $pic,
            'status' => '6',
            'tujuan' => $kotatujuan,
            'kecTujuan' => $kec,
        ];
  

        //simpan data shipment
        $shipment = Shipments::create($shipmentData);
        
        // Membuat array untuk detail shipment
        $detailShipments = [];

                    
        // Memasukkan data ke dalam array
        foreach ($requestData as $resi) {
            // $detailShipments[] = ['no_resi' => $resi];
            $detailShipments[] = ['no_resi' => $resi['no_resi']];
        }
        
        // Melakukan saveMany untuk detail shipment
        $shipment->detailShipments()->createMany($detailShipments);

        $response = [
            'success' => true,
            'message' => 'Data berhasil diupdate.',
            'redirect' => '/agen/manivest/data/detail/'.$shipmentData['ship_id'],
        ];
        
        return response()->json($response);
    }

    public function getListPengantaranView(Request $request)
    {
        return view('cabang.datapengantaran', [
            'title' => 'List Penganraran'
        ]);

        
    }

    public function loadListPengantaran(Request $request)
    {
        $stat_shipid = 6;
        $tujuan = true;
        $data = $this->fetchLoadingData($request, $stat_shipid, $tujuan);

        return DataTables::of($data)
                ->toJson();
    }
}



 // Get customer data from the form
        // $customerData = $request->only(['phone-input-pengirim', 'nama-pengirim', 'alamat-pengirim']);

        // Validation for customer data
        // $validatedCustomerData = $request->validate([
        //     'phone-input-pengirim' => 'required|numeric',
        //     'nama-pengirim' => 'required|string',
        //     'alamat-pengirim' => 'required|max:255',
        // ]);

        // // Check if the customer already exists based on the phone number
        // $customer = Customer::where('no_hp', $validatedCustomerData['phone-input-pengirim'])->first();

        // // If the customer does not exist, insert a new customer
        // if (!$customer) {
        //     $customer = Customer::create([
        //         'no_hp' => $validatedCustomerData['phone-input-pengirim'],
        //         'nama_customer' => $validatedCustomerData['nama-pengirim'],
        //         'alamat_customer' => $validatedCustomerData['alamat-pengirim'],
        //     ]);
        // }

