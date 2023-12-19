<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $userId = $request->input('user_id');

        return Excel::download(new DataExport($startDate, $endDate, $userId), 'transactions.xlsx');
    }
}