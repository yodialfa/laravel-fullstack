<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class PdfController extends Controller
{
    public function generatePdf($no_resi)
    {
        $data = [
            'title' => 'Contoh PDF',
            'content' => 'Ini adalah konten PDF yang dihasilkan dari Laravel menggunakan TCPDF.',
        ];

        $pdf = PDF::loadView('pdf.invoice', $data);

        return $pdf->stream('invoice.pdf');
    }
}
