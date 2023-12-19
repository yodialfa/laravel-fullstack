<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Karyawan;
use App\Models\Shipments;
use App\Models\Transaksi;
use App\Exports\DataExport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\CabangController;

// use Yajra\DataTables\Facades\DataTables;

class AgenController extends Controller
{

    public function index() {
        return view('agen.transaksi',[
            'title' => "Transaksi",
        ]);

    }

    private function fetchData(Request $request)
    {
        $start_date = Carbon::parse($request->input('from_date'));
        $end_date = Carbon::parse($request->input('to_date'));

        if ($end_date->greaterThan($start_date)) {
            $model = Transaksi::with(['kotaAsal', 'kecAsal', 'kotaTujuan', 'kecTujuan', 'serviceId', 'userId'])
                ->whereBetween('created_at', [$start_date, $end_date]);

            if (Auth::user()->role !== 'admin') {
                $model->where('employeeId', Auth::user()->id);
            }

            $data = $model->get();

            // return dd($data); 

            return $data;
        }

        // return collect(); // Return an empty collection if conditions are not met
    }

    public function getRecords(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->fetchData($request);

            return DataTables::of($data)
                // Add your columns and other DataTables configurations here
                ->toJson();
        }
    }

    public function exportAll(Request $request)
    {   
        $data = $this->fetchData($request);
        // dd($data); 

        return Excel::download(new DataExport($data), 'exported_data.xlsx');
    }


  


  

    public function manivest()
    {
        if (Auth::user()->role == 'admin')
        {
            $trxAgen = Transaksi::with(['kotaAsal', 'kecAsal', 'kotaTujuan', 'kecTujuan', 'serviceId', 'userId', 'resi'])
                                ->where('status', 0)
                                ->get();
        }
        else 
        {

            $trxAgen = Transaksi::with(['kotaAsal', 'kecAsal', 'kotaTujuan', 'kecTujuan', 'serviceId', 'userId', 'resi'])
                                ->where('employeeId', Auth::user()->id)
                                // ->whereHas('resi', function ($query) {
                                //     $query->where('status', 0);
                                // })
                                ->where('status', 0)    
                                ->get();
        }
        return view('agen.manivest', [
            'title' => "Manivest",
            'transaksis' => $trxAgen,
            
        ]);
        return view('agen.transaksi', [
                    'title' => "Agen",
                    'transaksis' => $trxAgen,
                ]);
        // return $trxAgen;
    }

    public function storeshipment(Request $request)
    {
        $user = Auth::user()->id;
        $karyawanUser = Karyawan::select('cabang_id', 'agen_id')
                                ->where('id', $user)->first();
        $randomCode = Str::random(8);
    
        // $karyawanUser = $user->karyawanuser; 

        if ($karyawanUser) {
            // $cabang = $karyawanUser->cabang_id;
            // $agen = $karyawanUser->agen_id;
            // $selectedResis = $request->input('no_resi');
            // // Encode data resi sebagai JSON
            // $jsonResi = json_encode($selectedResis);

            // for ($i = 0; $i < count($selectedResis); $i++) {
            //     // Update status
            //     // $resi = $selectedResis[$i];
            //     Status::create(['no_resi' => $selectedResis[$i], 
            //                     'status' => '1',
            //                     'ket' => 'Menuju gudang Asal',
                                
            //                 ]);
                
            //     Transaksi::where('no_resi', $selectedResis[$i])->update(['status' => 1]);
            // }

            $cabang = $karyawanUser->cabang_id;
            $agen = $karyawanUser->agen_id;
            $selectedResis = $request->input('no_resi');
            // $jsonResi = json_encode($selectedResis);


            // Membuat array untuk status dan no_resi
            $statuses = [];
            $noResis = [];

            // Memasukkan data ke dalam array
            foreach ($selectedResis as $resi) {
                $statuses[] = [
                    'no_resi' => $resi, 
                    'status' => '1', 
                    'ket' => 'Menuju gudang Asal',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $noResis[] = $resi;
            }

            // Melakukan create untuk status sekaligus
            Status::insert($statuses);

            // Melakukan update status pada transaksi
            Transaksi::whereIn('no_resi', $noResis)->update(['status' => 1]);

            $shipmentData = [
                'agen_id' => $agen,
                'cabang_id' => $cabang,
                'ship_id' => $randomCode,
                'status' => '1',
                'tujuan' => Auth::user()->karyawanuser->cabang_id,
             ];
            
            $shipment = Shipments::create($shipmentData);
            
            // Membuat array untuk detail shipment
            $detailShipments = [];
            
            // Memasukkan data ke dalam array
            foreach ($noResis as $resi) {
                $detailShipments[] = ['no_resi' => $resi];
            }
            
            // Melakukan saveMany untuk detail shipment
            $shipment->detailShipments()->createMany($detailShipments);
            

            // return $noResis;
            return redirect('/agen/manivest/data/detail/'.$randomCode)->with('success', 'Manivest dibuat');
      
        } else
        {
            echo "Data Tidak Ada";
        }
        
        // return $karyawanUser;
    }


    public function viewManivestData()
    {
        return view('agen.datamanivest', [
            'title' => "Data Manivest",
        ]);
    }

    public function fetchManivestData(Request $request)
    {
        $start_date = Carbon::parse($request->input('from_date'));
        $end_date = Carbon::parse($request->input('to_date'));

        if ($end_date->greaterThan($start_date)) {
            $model = Shipments::with(['agen:id,agen,cabang_id', 'cabang:id,cabang', 'cabangTujuan:id,cabang'])
                                ->whereBetween('created_at', [$start_date, $end_date])
                                ->where('status', 1);

            if (Auth::user()->role !== 'admin') {
                $model->where('agen_id', Auth::user()->karyawanuser->agen_id)
                        ->where('cabang_id', Auth::user()->karyawanuser->cabang_id);
            }

            $data = $model->get();

           

            // return $data;
            return DataTables::of($data)
                ->toJson();
        }
    }

    //menampilkan data berdasrkan ship_id
    public function fetchLoadingData($ship_id)
    {
        // Membuat instance dari CabangController

        $res = (new CabangController)->fetchManivestDetail($ship_id);

        return view('agen.datamanivestdetail', [
            'title' => 'Detail Shipment',
        //     // 'dataTable' => DataTables::of($res)->toJson(),
            'ship_id'=> $ship_id,
            'dataTable' => $res,
        ]);
        return $res;
                                
    }
}
