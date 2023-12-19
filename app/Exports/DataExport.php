<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    // protected $startDate;
    // protected $endDate;
    // protected $userId;
    protected $data;

    public function __construct($data)
    {
        // $this->startDate = $startDate;
        // $this->endDate = $endDate;
        // $this->userId =  Auth::user()->role;
        // dd($data);
        $this->data = $data;
    }


    public function collection()
    {
        // return Data::all(); // Ganti dengan query sesuai kebutuhan Anda
        // if ($this->userId == 'admin') {
            // $query = Transaksi::query()
            //     ->whereBetween('created_at', [$this->startDate, $this->endDate])
            //     ->get();

        // }
        // else {

        //     $query = Transaksi::query()
        //     ->whereBetween('created_at', [$this->startDate, $this->endDate])
        //     ->when($this->userId, function ($query) {
        //         return $query->where('employeeId', $this->userId);
        //     })
        //     ->get();
        // }

        // return Transaksi::query()->whereIn('id', $this->data->pluck('id'));
        return $this->data;

        // return $query;
    }

    // public function headings(): array
    // {
    //     // Sesuaikan dengan nama kolom pada model Transaction
    //     return [
    //         'ID',
    //         'Transaction Date',
    //         'Amount',
    //         // Tambahkan kolom lainnya sesuai kebutuhan
    //     ];
    // }
}
