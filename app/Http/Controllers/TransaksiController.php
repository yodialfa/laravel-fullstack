<?php

namespace App\Http\Controllers;
use Log;

use PDF;
use App\Models\City;
use App\Models\Status;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $getCity = City::all(); 
        } else {
            $getCity = City::where('id', '=', Auth::user()->karyawanuser->cabang_id)->get();
        }
        $getService = Service::all();
        $cityDestination = City::all(); 
        return view('transaksi.index', [
            'title' => 'Transaksi',
            'kotaasals' => $getCity,
            'kotatujs' => $cityDestination,
            'services' => $getService,
        ]);
        // return $getService;
    }

    public function getCust($number)
    {
        $dataCust = Customer::where('no_hp', $number)->first();
        return response()->json(['customer'=> $dataCust]);
        // return dd($number);
    }

    public function create(Request $request)
    {
        try {
            // Check if the provided 'no_resi' already exists
            $existingTransaction = Transaksi::where('no_resi', $request->input('no_resi'))->first();

            if ($existingTransaction) {
                // 'no_resi' already exists, handle accordingly (e.g., show an error message)
                return redirect()->back()->with('error', 'Transaction with this no_resi already exists.');
            }
            // membuat kode Menggunakan waktu saat ini
            $currentDateTime = now();

            // Mendapatkan tahun, bulan, tanggal, jam, menit, dan detik
            $cab_code = Auth::user()->karyawanuser->cabang_id;
            $year = $currentDateTime->year;
            $month = $currentDateTime->month;
            $day = $currentDateTime->day;
            $hour = $currentDateTime->hour;
            $minute = $currentDateTime->minute;
            $second = $currentDateTime->second;
            $milliseconds = round($currentDateTime->format('u') / 1000); // Konversi mikrodetik ke milidetik
            $no_resi = $cab_code . $year . $month . $day . $hour . $minute . $second .  $milliseconds;


            $validatedCustomerData = $request->validate([
                'phone-input-pengirim' => 'required|numeric',
                'nama-pengirim' => 'required|string',
                'alamat-pengirim' => 'required|max:255',
            ]);

             // Check if the customer already exists based on the phone number
            $customer = Customer::where('no_hp', $validatedCustomerData['phone-input-pengirim'])->first();

            // If the customer does not exist, insert a new customer
            if (!$customer) {
                $customer = Customer::create([
                    'no_hp' => $validatedCustomerData['phone-input-pengirim'],
                    'nama_customer' => $validatedCustomerData['nama-pengirim'],
                    'alamat_customer' => $validatedCustomerData['alamat-pengirim'],
                ]);
            }

            $validatedData = $request->validate([
                // 'no_resi' => 'required',
                'dopo' => "nullable",
                // 'phone-input-pengirim' => "required|numeric",
                // 'nama-pengirim' => "required",
                // 'alamat-pengirim' => "required|max:255",
                'phone-input-penerima' => "required|numeric",
                'nama-penerima' => "required|string",
                'alamat-penerima' => "required|max:255",
                'kotaasal' => "required",
                'kecasal' => "required",
                'kotatujuan' => "required",
                'kectujuan' => "required",

                // 'kotaasal' => "required_unless:kotaasal_disabled,true",
                // 'kecasal' => "required_unless:kecasal_disabled,true",
                // 'kotatujuan' => "required_unless:kotatujuan_disabled,true",
                // 'kectujuan' => "required_unless:kectujuan_disabled,true",
                'layanan' => "required",
                'jumlah' => "required|numeric",
                'berat' => "required|numeric",
                'diskon' => "required|numeric",
                'biaya_surat' => "required|numeric",
                'jenis_barang' => "required|string",
                'biaya_asuransi' => "required|numeric",    
            ]);

            $transaksiData = [
                
                'no_resi' => $no_resi,
                'dopo' => $validatedData['dopo'],
                'no_hp_pengirim' => $validatedCustomerData['phone-input-pengirim'],
                'nama_pengirim' => $validatedCustomerData['nama-pengirim'],
                'alamat_pengirim' => $validatedCustomerData['alamat-pengirim'],
                'no_hp_penerima' => $validatedData['phone-input-penerima'],
                'nama_penerima' => $validatedData['nama-penerima'],
                'alamat_penerima' => $validatedData['alamat-penerima'],

                'IdKotaAsal' => $validatedData['kotaasal'],
                'IdKecAsal' => $validatedData['kecasal'],
                'IdKotaTujuan' => $validatedData['kotatujuan'],
                'IdKecTujuan' => $validatedData['kotatujuan'],
                
                'IdLayanan' => $validatedData['layanan'],
                'cara_bayar' => $request->cara_bayar,
                'jumlah' => $validatedData['jumlah'],
                'berat' => $validatedData['berat'],
                'harga' => $request->harga,
                'diskon' => $validatedData['diskon'],
                'biaya_surat' => $validatedData['biaya_surat'],
                'jenis_barang' => $validatedData['jenis_barang'],
                'biaya_asuransi' => $validatedData['biaya_asuransi'],
                'total_harga' => $request->total_harga,
                'employeeId' => Auth::user()->id,

            ];

            $transaksi = Transaksi::create($transaksiData);
            $stat = Status::create(['no_resi' =>$no_resi, 
                                    'status' => '0',
                                    'ket' => 'Transaksi Agen',
                                    
                                ]);
            // Status::create(['no_resi' => $validatedData->no_resi, 'status' => '0', 'ket' => 'Transaksi Agen']);
            $pdfUrl = $transaksiData['no_resi'];
            // Your existing code here
            Log::info('Request data:', $request->all());
            Log::info('check: ' . $transaksi);
            

            // Clear the form input session
            $request->session()->forget([
                'phone-input-pengirim',
                'nama-pengirim',
                'alamat-pengirim',
                'phone-input-penerima',
                'nama-penerima',
                'alamat-penerima',
                'kotaasal',
                'kecasal',
                'kotatujuan',
                'kectujuan',
                'layanan',
                'jumlah',
                'berat',
                'diskon',
                'biaya_surat',
                'jenis_barang',
                'biaya_asuransi',
            ]);
            
            return view('transaksi.cetak', [
                'title' => 'Cetak',
                'resi' => $pdfUrl,
            ]);
            // Redirect to a new URL after successful form submission
            // return redirect()->route('transaksi.success')->with(['resi' => $pdfUrl]);

    
        } catch (\Exception $e) {
            Log::error('Error occurred: ' . $e->getMessage());
            // You might also want to dd or return a response indicating the error.
            dd('An error occurred. Please check the logs for details.');
            // Log::info('check: ' . $transaksi);

        }
        
        // Log::info('Validation passed', $validatedData);
        // return $validatedData;
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create($number)
    // {
        
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
