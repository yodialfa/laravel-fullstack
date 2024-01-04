<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    @vite('public/css/app.css')
    <style>
        @font-face {
            font-family: 'kanit';
            src: url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&family=Kantumruy+Pro:wght@700&display=swap');
            /* Add additional src declarations for different font formats (e.g., woff, ttf) */
        }
        /* @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&family=Kantumruy+Pro:wght@700&display=swap'); */
        body {
            font-family: 'kanit', sans-serif;
        }

        .my-container {
            display: grid;
            margin: 1px;
            padding: 1px;
            /* border: 1px solid #ccc; */
            width: 100%;
            height: 100%;
            margin-top: -40px;
        }
        .title{
            text-align:center;
            margin: -30px;
            font-size:  20px;
        }

        .barcode{
            margin-top: 10px;
        }

        .ab {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        .ab thead th {
            height: 28px;
            text-align: left;
            font-size: 14px;
            font-family: sans-serif;
        }
        .ab, th, td {
            /* border: 1px solid #ddd; */
            padding: 1px;
            font-size: 12px;
            border-bottom: 1px solid #ddd;

        }

        .heading {
            font-size: 24px;
            margin-top: 0px;
            margin-bottom: 0px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
            font-size: 12px;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
            font-size: 12px;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 0px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 12px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-gray {
            background-color: #808080;
            color: #fff;
        }

        .left
        {
            text-align: left;
        }
        .layanan{
            text-align: center;
        }
        .destination {
            border-collapse: collapse;
            width: 100%;
            /* Tambahkan gaya lain yang Anda inginkan */
        }
        .destination th, .destination tr .destination td{
            /* text-align: center; */
            border: 0px solid black;
            border-style: dotted;
            padding: 1px;
            margin-top: -10px;
            font-size: 12px;
        }

        

    </style>
    
<body>
    <div class="my-container">
        {{-- <h1 class="title">{{ $title }}</h1>
    
        <a href="#" class="flex items-center">
            <span class="self-center text-3xl font-semibold  font-kanit whitespace-nowrap text-white">Cahaya Nusantara</span>
          </a>

          

        
        <p class="text-center">{{ $transaksi['no_resi'] }}</p>
        <p>{{ $transaksi['phone-input-pengirim'] }}</p>
        <p>{{ $transaksi['nama-pengirim'] }}</p>
        <p>{{ $transaksi['alamat-kirim'] }}</p>
        <p>{{ $transaksi['phone-input-penerima'] }}</p>
        <p>{{ $transaksi['nama-penerima'] }}</p>
        <p>{{ $transaksi['alamat-penerima'] }}</p>
        {{-- <p>{{ $transaksi->no_resi }}</p>
        <p>{{ $transaksi->no_resi }}</p>
        <p>{{ $transaksi->no_resi }}</p> --}}

        <table class="order-details">
            <thead>
                <tr>
                    <th width="50%" colspan="4">
                        <h2 class="text-start">{{ $title }}</h2>
                        <span>

                            <h3 class="text-start"><a href="www.cahaya-nusantara.co.id">www.cahaya-nusantara.co.id</a></h3>
                        </span>
                    </th>
                    
                    <th width="50%" colspan="4" class="text-end company-data">
                        
                        <span><img class="barcode" src="data:image/png;base64,{{ base64_encode($barcode) }}" alt="Barcode"></span>
                        <span>{{ $transaksi['no_resi'] }}</span> <br>
                        {{-- <span>Zip code : 560077</span> <br> --}}
                        <span>Address: Jl. Jenderal Ahmad Yani No. 288 Kota Bandung 082219082230</span> 
                    </th>
                </tr>
            </thead>
        
            <thead>
                <tr class="bg-gray">
                    <th colspan="3">No. Resi : {{ $transaksi['no_resi']  }} </th>
                    <th width="50%" colspan="3" >{{ $transaksi['tgl'] }}</th>

                    <th width="50%" colspan="2" class="layanan">{{ $transaksi['layanan'] }}</th>
                </tr>
                <tr class="bg-gray">
                    <th>Tujuan : {{ $transaksi['kotaasal'] }}</th>
                    <th colspan="2">{{ $transaksi['kectujuan'] }}</th>
                    <th colspan="2">Asal : {{ $transaksi['kotaasal'] }}</th>
                    <th colspan="3">{{ $transaksi['kecasal'] }}</th>
                </tr>
            </thead>
            <tbody class="fs">
                <tr>
                    <td>Nama Penerima :</td>
                    {{-- <td>:</td> --}}
                    <td colspan="3">{{ $transaksi['nama-penerima'] }}</td>
                    
    
                    <td>Nama Pengirim :</td>
                    {{-- <td>:</td> --}}
                    <td colspan="3">{{ $transaksi['nama-pengirim'] }}</td>
              

                </tr>
                <tr>
                    <td >No Handphone :</td>
                    {{-- <td></td> --}}
                    <td colspan="3" class="left">{{ $transaksi['phone-input-penerima'] }}</td>
                    {{-- <td></td> --}}

    
                    <td>No Handphone </td>
                    <td colspan="3" class="left"><{{ $transaksi['phone-input-pengirim'] }}</td>
                    {{-- <td></td> --}}
                    

                </tr>
                <tr>
                    <td rowspan="2">Alamat :</td>
                    {{-- <td>:</td> --}}

                    <td colspan="3" rowspan="2" style="max-width: 200px; word-wrap: break-word;">{{ $transaksi['alamat-penerima'] }}</td>
    
                    <td rowspan="2">Alamat</td>
                    {{-- <td rowspan="2">:</td> --}}

                    <td colspan="" rowspan="2" style="max-width: 200px; word-wrap: break-word;">{{ $transaksi['alamat-kirim'] }}</td>
                    <td></td>
                </tr>
                <tr>


                    {{-- <td colspan="2">Cash on Delivery</td>
    
                    <td>Address:</td>
                     --}}
                    {{-- <td>No Handphone </td> --}}
                    {{-- 

                    <td colspan="3">asda asdad asdad adsasd</td> --}}
                </tr>
                <tr>
                    <td>Jml Barang:</td>
                    <td>{{ $transaksi['jumlah'] }} Koli</td>
                    <td>Berat/ Volume:</td>
                    <td>{{ $transaksi['berat'] }} Kg</td>
    
                    <td>Jenis Barang:</td>

                    <td colspan="2">{{ $transaksi['jenis_barang'] }}</td>
                    <td>TTD</td>
                </tr>
            </tbody>
        </table>

            {{-- <table class="destination">
                <tr>
                    <td>
                        <h3>Tujuan :</h3>
                    </td>
                    <td>
                        <h3>Kec :{{ $transaksi['kectujuan'] }}</h3>
                    </td>
                    <td>
                        <h3>Kota :{{ $transaksi['kotatujuan'] }} </h3>
                    </td>
                    <td>
                        <h3>Asal :</h3>
                    </td>
                    <td><h3>{{ $transaksi['kecasal'] }}</h3></td>
                    <td>
                        <h3>{{ $transaksi['kotaasal'] }}</h3>
                    </td>
                </tr>
            </table> --}}

    
        <table class="order-details">
            {{-- <thead> --}}
                {{-- <tr>
                    <th class="no-border text-start heading" colspan="5">
                        Order Items
                    </th>
                </tr>
                <tr class="bg-blue">
                    <th>ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr> --}}
            {{-- </thead> --}}
            <thead>
                {{-- <tr>
                    <td width="10%">16</td>
                    <td>
                        Mi Note 7
                    </td>
                    <td width="10%">$14000</td>
                    <td width="10%">1</td>
                    <td width="15%" class="fw-bold">$14000</td>
                </tr>
                <tr>
                    <td width="10%">17</td>
                    <td>
                        Vivo V19
                    </td>
                    <td width="10%">$699</td>
                    <td width="10%">1</td>
                    <td width="15%" class="fw-bold">$699</td>
                </tr>
                <tr>
                    <td colspan="4" class="total-heading">Total Amount - <small>Inc. all vat/tax</small> :</td>
                    <td colspan="1" class="total-heading">$14699</td>
                </tr> --}}
                <tr class="">
                    <td>Harga/kg :</td>
                    {{-- <td>:</td> --}}
                    <td>Rp. {{ $transaksi['harga'] }}</td>
                    <td>Biaya Surat :</td>
                    <td>{{ $transaksi['biaya_surat'] }}</td>
                    <td><h4>Total Ongkir :</h4></td>
                    <td><h4>Rp. {{ $transaksi['total_harga'] }}</h4></td>
                </tr>
                <tr class="no-border">
                    <td>Diskon</td>
                    <td>:</td>
                    <td>{{ $transaksi['diskon'] }} %</td>
                    <td>Asuransi :</td>
                    <td>{{ $transaksi['biaya_asuransi'] }}</td>
                    <td>Petugas :</td>
                    <td colspan="2">{{ $transaksi['user'] }}</td>
                    <td width="30%"></td>
                    <td>TTD {{ $transaksi['nama-penerima'] }}</td>
                </tr>
            </thead>
        </table>
        <table class="order-details">
            <thead>
                <tr>
                    <th width="50%" colspan="4">
                        <h2 class="text-start">{{ $title }}</h2>
                        <span>

                            <h3 class="text-start"><a href="www.cahaya-nusantara.co.id">www.cahaya-nusantara.co.id</a></h3>
                        </span>
                    </th>
                    
                    <th width="50%" colspan="4" class="text-end company-data">
                        
                        <span><img class="barcode" src="data:image/png;base64,{{ base64_encode($barcode) }}" alt="Barcode"></span>
                        <span>{{ $transaksi['no_resi'] }}</span> <br>
                        {{-- <span>Zip code : 560077</span> <br> --}}
                        <span>Address: Jl. Jenderal Ahmad Yani No. 288 Kota Bandung 082219082230</span> 
                    </th>
                </tr>
            </thead>
        
            <thead>
                <tr class="bg-gray">
                    <th colspan="3">No. Resi : {{ $transaksi['no_resi']  }} </th>
                    <th width="50%" colspan="3" >{{ $transaksi['tgl'] }}</th>

                    <th width="50%" colspan="2" class="layanan">{{ $transaksi['layanan'] }}</th>
                </tr>
                <tr class="bg-gray">
                    <th>Tujuan : {{ $transaksi['kotaasal'] }}</th>
                    <th colspan="2">{{ $transaksi['kectujuan'] }}</th>
                    <th colspan="2">Asal : {{ $transaksi['kotaasal'] }}</th>
                    <th colspan="3">{{ $transaksi['kecasal'] }}</th>
                </tr>
            </thead>
            <tbody class="fs">
                <tr>
                    <td>Nama Penerima :</td>
                    {{-- <td>:</td> --}}
                    <td colspan="3">{{ $transaksi['nama-penerima'] }}</td>
                    
    
                    <td>Nama Pengirim :</td>
                    {{-- <td>:</td> --}}
                    <td colspan="3">{{ $transaksi['nama-pengirim'] }}</td>
              

                </tr>
                <tr>
                    <td >No Handphone :</td>
                    {{-- <td></td> --}}
                    <td colspan="3" class="left">{{ $transaksi['phone-input-penerima'] }}</td>
                    {{-- <td></td> --}}

    
                    <td>No Handphone </td>
                    <td colspan="3" class="left"><{{ $transaksi['phone-input-pengirim'] }}</td>
                    {{-- <td></td> --}}
                    

                </tr>
                <tr>
                    <td rowspan="2">Alamat :</td>
                    {{-- <td>:</td> --}}

                    <td colspan="3" rowspan="2" style="max-width: 200px; word-wrap: break-word;">{{ $transaksi['alamat-penerima'] }} gcgcygcgjcgjhcgcjcjhchjcghjchjchjchjchgchccjhchjchjchjgchchgcgcygcgjcgjhcgcjcjhchjcghjchjchjchjchgchccjhchjchjchjgchch</td>
    
                    <td rowspan="2">Alamat</td>
                    {{-- <td rowspan="2">:</td> --}}

                    <td colspan="" rowspan="2" style="max-width: 200px; word-wrap: break-word;">{{ $transaksi['alamat-kirim'] }}</td>
                    <td></td>
                </tr>
                <tr>


                    {{-- <td colspan="2">Cash on Delivery</td>
    
                    <td>Address:</td>
                     --}}
                    {{-- <td>No Handphone </td> --}}
                    {{-- 

                    <td colspan="3">asda asdad asdad adsasd</td> --}}
                </tr>
                <tr>
                    <td>Jml Barang:</td>
                    <td>{{ $transaksi['jumlah'] }} Koli</td>
                    <td>Berat/ Volume:</td>
                    <td>{{ $transaksi['berat'] }} Kg</td>
    
                    <td>Jenis Barang:</td>

                    <td colspan="2">{{ $transaksi['jenis_barang'] }}</td>
                    <td>TTD</td>
                </tr>
            </tbody>
        </table>

            {{-- <table class="destination">
                <tr>
                    <td>
                        <h3>Tujuan :</h3>
                    </td>
                    <td>
                        <h3>Kec :{{ $transaksi['kectujuan'] }}</h3>
                    </td>
                    <td>
                        <h3>Kota :{{ $transaksi['kotatujuan'] }} </h3>
                    </td>
                    <td>
                        <h3>Asal :</h3>
                    </td>
                    <td><h3>{{ $transaksi['kecasal'] }}</h3></td>
                    <td>
                        <h3>{{ $transaksi['kotaasal'] }}</h3>
                    </td>
                </tr>
            </table> --}}

    
        <table class="order-details">
            {{-- <thead> --}}
                {{-- <tr>
                    <th class="no-border text-start heading" colspan="5">
                        Order Items
                    </th>
                </tr>
                <tr class="bg-blue">
                    <th>ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr> --}}
            {{-- </thead> --}}
            <thead>
                {{-- <tr>
                    <td width="10%">16</td>
                    <td>
                        Mi Note 7
                    </td>
                    <td width="10%">$14000</td>
                    <td width="10%">1</td>
                    <td width="15%" class="fw-bold">$14000</td>
                </tr>
                <tr>
                    <td width="10%">17</td>
                    <td>
                        Vivo V19
                    </td>
                    <td width="10%">$699</td>
                    <td width="10%">1</td>
                    <td width="15%" class="fw-bold">$699</td>
                </tr>
                <tr>
                    <td colspan="4" class="total-heading">Total Amount - <small>Inc. all vat/tax</small> :</td>
                    <td colspan="1" class="total-heading">$14699</td>
                </tr> --}}
                <tr class="">
                    <td>Harga/kg :</td>
                    {{-- <td>:</td> --}}
                    <td>Rp. {{ $transaksi['harga'] }}</td>
                    <td>Biaya Surat :</td>
                    <td>{{ $transaksi['biaya_surat'] }}</td>
                    <td><h4>Total Ongkir :</h4></td>
                    <td><h4>Rp. {{ $transaksi['total_harga'] }}</h4></td>
                </tr>
                <tr class="no-border">
                    <td>Diskon</td>
                    <td>:</td>
                    <td>{{ $transaksi['diskon'] }} %</td>
                    <td>Asuransi :</td>
                    <td>{{ $transaksi['biaya_asuransi'] }}</td>
                    <td>Petugas :</td>
                    <td colspan="2">{{ $transaksi['user'] }}</td>
                    <td width="30%"></td>
                    <td>TTD {{ $transaksi['nama-penerima'] }}</td>
                </tr>
            </thead>
        </table>
        <table class="order-details">
            <thead>
                <tr>
                    <th width="50%" colspan="4">
                        <h2 class="text-start">{{ $title }}</h2>
                        <span>

                            <h3 class="text-start"><a href="www.cahaya-nusantara.co.id">www.cahaya-nusantara.co.id</a></h3>
                        </span>
                    </th>
                    
                    <th width="50%" colspan="4" class="text-end company-data">
                        
                        <span><img class="barcode" src="data:image/png;base64,{{ base64_encode($barcode) }}" alt="Barcode"></span>
                        <span>{{ $transaksi['no_resi'] }}</span> <br>
                        {{-- <span>Zip code : 560077</span> <br> --}}
                        <span>Address: Jl. Jenderal Ahmad Yani No. 288 Kota Bandung 082219082230</span> 
                    </th>
                </tr>
            </thead>
        
            <thead>
                <tr class="bg-gray">
                    <th colspan="3">No. Resi : {{ $transaksi['no_resi']  }} </th>
                    <th width="50%" colspan="3" >{{ $transaksi['tgl'] }}</th>

                    <th width="50%" colspan="2" class="layanan">{{ $transaksi['layanan'] }}</th>
                </tr>
                <tr class="bg-gray">
                    <th>Tujuan : {{ $transaksi['kotaasal'] }}</th>
                    <th colspan="2">{{ $transaksi['kectujuan'] }}</th>
                    <th colspan="2">Asal : {{ $transaksi['kotaasal'] }}</th>
                    <th colspan="3">{{ $transaksi['kecasal'] }}</th>
                </tr>
            </thead>
            <tbody class="fs">
                <tr>
                    <td>Nama Penerima :</td>
                    {{-- <td>:</td> --}}
                    <td colspan="3">{{ $transaksi['nama-penerima'] }}</td>
                    
    
                    <td>Nama Pengirim :</td>
                    {{-- <td>:</td> --}}
                    <td colspan="3">{{ $transaksi['nama-pengirim'] }}</td>
              

                </tr>
                <tr>
                    <td >No Handphone :</td>
                    {{-- <td></td> --}}
                    <td colspan="3" class="left">{{ $transaksi['phone-input-penerima'] }}</td>
                    {{-- <td></td> --}}

    
                    <td>No Handphone </td>
                    <td colspan="3" class="left"><{{ $transaksi['phone-input-pengirim'] }}</td>
                    {{-- <td></td> --}}
                    

                </tr>
                <tr>
                    <td rowspan="2">Alamat :</td>
                    {{-- <td>:</td> --}}

                    <td colspan="3" rowspan="2" style="max-width: 200px; word-wrap: break-word;">{{ $transaksi['alamat-penerima'] }} gcgcygcgjcgjhcgcjcjhchjcghjchjchjchjchgchccjhchjchjchjgchchgcgcygcgjcgjhcgcjcjhchjcghjchjchjchjchgchccjhchjchjchjgchch</td>
    
                    <td rowspan="2">Alamat</td>
                    {{-- <td rowspan="2">:</td> --}}

                    <td colspan="" rowspan="2" style="max-width: 200px; word-wrap: break-word;">{{ $transaksi['alamat-kirim'] }}</td>
                    <td></td>
                </tr>
                <tr>


                    {{-- <td colspan="2">Cash on Delivery</td>
    
                    <td>Address:</td>
                     --}}
                    {{-- <td>No Handphone </td> --}}
                    {{-- 

                    <td colspan="3">asda asdad asdad adsasd</td> --}}
                </tr>
                <tr>
                    <td>Jml Barang:</td>
                    <td>{{ $transaksi['jumlah'] }} Koli</td>
                    <td>Berat/ Volume:</td>
                    <td>{{ $transaksi['berat'] }} Kg</td>
    
                    <td>Jenis Barang:</td>

                    <td colspan="2">{{ $transaksi['jenis_barang'] }}</td>
                    <td>TTD</td>
                </tr>
            </tbody>
        </table>

            {{-- <table class="destination">
                <tr>
                    <td>
                        <h3>Tujuan :</h3>
                    </td>
                    <td>
                        <h3>Kec :{{ $transaksi['kectujuan'] }}</h3>
                    </td>
                    <td>
                        <h3>Kota :{{ $transaksi['kotatujuan'] }} </h3>
                    </td>
                    <td>
                        <h3>Asal :</h3>
                    </td>
                    <td><h3>{{ $transaksi['kecasal'] }}</h3></td>
                    <td>
                        <h3>{{ $transaksi['kotaasal'] }}</h3>
                    </td>
                </tr>
            </table> --}}

    
        <table class="order-details">
            {{-- <thead> --}}
                {{-- <tr>
                    <th class="no-border text-start heading" colspan="5">
                        Order Items
                    </th>
                </tr>
                <tr class="bg-blue">
                    <th>ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr> --}}
            {{-- </thead> --}}
            <thead>
                {{-- <tr>
                    <td width="10%">16</td>
                    <td>
                        Mi Note 7
                    </td>
                    <td width="10%">$14000</td>
                    <td width="10%">1</td>
                    <td width="15%" class="fw-bold">$14000</td>
                </tr>
                <tr>
                    <td width="10%">17</td>
                    <td>
                        Vivo V19
                    </td>
                    <td width="10%">$699</td>
                    <td width="10%">1</td>
                    <td width="15%" class="fw-bold">$699</td>
                </tr>
                <tr>
                    <td colspan="4" class="total-heading">Total Amount - <small>Inc. all vat/tax</small> :</td>
                    <td colspan="1" class="total-heading">$14699</td>
                </tr> --}}
                <tr class="">
                    <td>Harga/kg :</td>
                    {{-- <td>:</td> --}}
                    <td>Rp. {{ $transaksi['harga'] }}</td>
                    <td>Biaya Surat :</td>
                    <td>{{ $transaksi['biaya_surat'] }}</td>
                    <td><h4>Total Ongkir :</h4></td>
                    <td><h4>Rp. {{ $transaksi['total_harga'] }}</h4></td>
                </tr>
                <tr class="no-border">
                    <td>Diskon</td>
                    <td>:</td>
                    <td>{{ $transaksi['diskon'] }} %</td>
                    <td>Asuransi :</td>
                    <td>{{ $transaksi['biaya_asuransi'] }}</td>
                    <td>Petugas :</td>
                    <td colspan="2">{{ $transaksi['user'] }}</td>
                    <td width="30%"></td>
                    <td>TTD {{ $transaksi['nama-penerima'] }}</td>
                </tr>
            </thead>
        </table>
        <br>

        
        <span style="page-break-after:always;"></span>
    
    </div>
    
    
</body>
</html>
