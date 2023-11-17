<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Picqer\Barcode\BarcodeGeneratorPNG;
// use Barryvdh\DomPDF\Facade as PDF;


class PdfController extends Controller
{
    public function generatePdf($no_resi)
    {
        $transaksi = Transaksi::where('no_resi', $no_resi)->first();
        
        if(!$transaksi)
        {
            abort(404);
        }

        $tanggalFormatted = Carbon::parse($transaksi->created_at)->format('d-m-Y H:i:s');

        $trxData = [
            'no_resi' => $transaksi->no_resi,
            'phone-input-pengirim' => $transaksi->no_hp_pengirim,
            'nama-pengirim' => $transaksi->nama_pengirim,
            'alamat-kirim' => $transaksi->alamat_pengirim,
            'phone-input-penerima' => $transaksi->no_hp_penerima,
            'nama-penerima' => $transaksi->nama_penerima,
            'alamat-penerima' => $transaksi->alamat_penerima,
            'kotaasal' => $transaksi->kotaAsal->NamaKota,
            'kecasal' => $transaksi->kecAsal->NamaKecamatan,
            'kotatujuan' => $transaksi->kotaTujuan->NamaKota,
            'kectujuan' => $transaksi->kecAsal->NamaKecamatan,
            'layanan' => $transaksi->serviceId->NamaLayanan,
            'jumlah' => $transaksi->jumlah,
            'berat' => $transaksi->berat,
            'harga' => $transaksi->harga,
            'diskon' => $transaksi->diskon,
            'biaya_surat' => $transaksi->biaya_surat,
            'jenis_barang' => $transaksi->jenis_barang,
            'biaya_asuransi' => $transaksi->biaya_asuransi,
            'total_harga' => $transaksi->total_harga,
            'user' => $transaksi->userId->username,
            'tgl' => $tanggalFormatted,
        ];
        $data = [
            'title' => 'CAHAYA NUSANTARA',
            'transaksi' => $trxData,
        ];

        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($no_resi, $generator::TYPE_CODE_128);


        $pdf = PDF::loadview('pdf.invoice', ['barcode' => $barcode], $data);

        $pdf->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => true,
        ]);
    
        return $pdf->setPaper('A4')->stream('invoice.pdf');
        // return $pdf->download('invoice.pdf');

        // return $trxData;
    }
}
