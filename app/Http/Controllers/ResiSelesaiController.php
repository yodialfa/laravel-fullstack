<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Transaksi;
use App\Models\ResiSelesai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ResiSelesaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function pengantaranupdateview()
    {
        return view('cabang.resiselesai', [
            'title' => 'Update Pengantaran Kurir'
        ]);
    }

    public function getPengantaranupdate(Request $request)
    {
        $resi = $request->input('resi');
        $cabang = Auth::user()->karyawanuser->cabang_id;
        $data = Transaksi::with('kotaAsal:id,NamaKota','kotaTujuan:id,NamaKota',
                            'kecAsal:id,NamaKecamatan','kecTujuan:id,NamaKecamatan',
                            'serviceId:id,NamaLayanan','karyawan:id,agen_id,cabang_id','karyawan.agen:id,agen')
                            ->where('no_resi', $resi)
                            ->whereIn('status', [7,8,9]);

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

    public function generateResiSelesaiUpdate(string $no_resi)
    {
        return view('cabang.forminputselesai', [
            'title' => 'Update Selesai Pengantaran',
            'resi' => $no_resi,
        ]);
    }

    public function updateResi(string $resi, Request $request)
    {
        try {
            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'get_resi' => 'required',
                'selectStatus' => 'required|in:0,1,2',
                'penerima' => 'nullable',
            ]);

            // $namaFile = $resi;

            // if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            //     $namaFile .= '.' . $request->photo->extension();
            //     $request->photo->move(public_path('uploads'), $namaFile);
            // }
            $namaFile = $resi;

            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                $namaFile .= '.' . $request->photo->extension();
                $path = $request->photo->storeAs('uploads/bukti_penerimaan', $namaFile, 'private');
            }



            $cekresi = ResiSelesai::where('no_resi', $resi)->first();
            $resitrx = Transaksi::where('no_resi', $resi)->first();
            $statusTrx = Status::where('no_resi', $resi)
                                ->whereIn('status', [8,9])->first();


            $statPenerima = $request->input('selectStatus');
            switch ($statPenerima) {
                case 0:
                    $ket = "Penerima tidak ditempat/ antar ulang";
                    $statTrx_update = 8;
                break;
                case 1:
                    $ket = "Diterima oleh yang bersangkutan";
                    $statTrx_update = 9;
                break;
                case 2:
                    $ket = "Diterima oleh keluarga, tetangga/lain lain";
                    $statTrx_update = 9;
                break;
                default:
                    $ket = "Diterima oleh yang bersangkutan";
                    $statTrx_update = 9;
            }
    
    

            if (!$cekresi)
            {
                ResiSelesai::create([
                    'bukti_penerimaan' => $namaFile,
                    'status' => $statPenerima,
                    'ket' => $ket,
                    'ybs' => $request->input('penerima'),
                    'no_resi' => $resi,
                    
                ]);

                Status::create([
                    'no_resi' => $resi,
                    'status' => $statTrx_update,
                    'ket' => $ket,
                    'created_at' => now(),
                    'updated_at' => now(),
                    
                ]);
                
            } else {
                $cekresi->update([
                    'bukti_penerimaan' => $namaFile,
                    'status' => $statPenerima,
                    'ket' => $ket,
                    'ybs' => $request->input('penerima'),
                    // 'no_resi' => $no_resi,
                ]);
                $statusTrx->update([
                    'status' => $statTrx_update,
                    'ket' => $ket,
                ]);
            }

            $resitrx->update([
                'status' => $statTrx_update,
            ]);
            
            // Log:info($cekresi->get());
            return redirect(route('pengantaran-view'))->with('success', 'Resi Penerimaan Barang diupdate');
        } catch (\Exception $e) {
            // Log the exception or echo for debugging
            Log::error($e->getMessage());
            // return response()->json(['error' => 'Internal Server Error'], 500);
            return redirect(route('pengantaran-resiselesai', $resi ))->with('error', 'Silahkan Pilih status terlebih dahulu');
        }
    }
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ResiSelesai $resiSelesai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResiSelesai $resiSelesai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResiSelesai $resiSelesai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResiSelesai $resiSelesai)
    {
        //
    }
}
