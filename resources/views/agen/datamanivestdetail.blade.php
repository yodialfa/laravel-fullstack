@extends('layouts.main')
{{-- //cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css --}}


<div class="fixed top-0 z-50 w-full bg-cyan-400">
    @include('partials.navbar')
</div>
@include('partials.sidebar')
@section('container')


<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-20">
        <div class="relative overflow-x-auto bg-white shadow-md sm:rounded-lg min-h-full">
            

            @if(session()->has('success'))
            <div id="alert-1" class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="ml-3 text-sm font-medium">
                Berhasil, {{ session('success') }}
                </div>
                <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            @endif


            <div class="bg-white w-full table-auto mb-3">
                <h1 class="text-center text-3xl">Detail Manivest {{ $ship_id }}</h1>
            </div>




        <div>
            
        </div>
                <table class="display w-full text-sm text-left text-gray-500 dark:text-gray-400" id="tableTransaksi">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
 
                            <th scope="col" class="px-4 py-3">
                                No
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-4 py-3">
                                No. Resi
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Nama Pengirim
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Nama Penerima
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kota Asal
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kec Asal
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kota Tujuan
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kec Tujuan
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Layanan
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Berat
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Koli
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Diskon
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Biaya Surat
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Asuransi
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Total Harga
                            </th>
                            <th scope="col" class="px-4 py-3">
                                PIC
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>



            </div>

        
        
        

    </div>

    

</div>
<script>
    @php
        // Assume $dataTable is your Blade variable containing JSON data
        // $jsonData = json_encode($dataTable);
        $jsonData = $dataTable ;
        // dd($dataTable);
    @endphp
    
    $(function(){
        const jsonData = @json($jsonData);
        console.log(jsonData);
        // console.log('jsonData structure:', jsonData);
        // console.log(jsonData.original.data);
        $(document).ready(function() {
            const shipId = @json($ship_id);
            // Cek apakah jsonData memiliki setidaknya satu elemen
            if (jsonData.length > 0) {
                // Ambil data pertama
                var firstData = jsonData[0];

                // Isi additionalInfo dengan data pertama dari JSON response
                var additionalInfo = {
                    judul : 'Data Manivest ' + shipId,
                    Kota_Tujuan: firstData.resi.kota_tujuan.NamaKota,
                    Kec_Tujuan: firstData.resi.kec_tujuan.NamaKecamatan,
                    pic: firstData.shipment.pic,
                };

                // Gunakan additionalInfo sesuai kebutuhan Anda
                console.log(additionalInfo);

                // Sekarang additionalInfo berisi data pertama dari JSON response
            } else {
                // jsonData kosong, atur additionalInfo sesuai kebutuhan
                var additionalInfo = {
                    judul : 'Data Manivest',
                    Kota_Tujuan: 'Kota Tujuan',
                    Kec_Tujuan: 'Kec. Tujuan',
                    pic: 'PIC',
                };

                console.log('JSON data is empty. Using default values.');
            }
        $('#tableTransaksi').DataTable(
                {
                    'data': jsonData,// Pass the data array
                    'columns': [
                        {data: null, sortable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                {data: 'created_at', name: 'created_at'},
                { data: 'no_resi' },
                { data: 'resi.nama_pengirim' },
                { data: 'resi.nama_penerima' },
                { data: 'resi.kota_asal.NamaKota' },
                { data: 'resi.kec_asal.NamaKecamatan' },
                { data: 'resi.kota_tujuan.NamaKota' },
                { data: 'resi.kec_tujuan.NamaKecamatan' },
                { data: 'resi.service_id.NamaLayanan' },
                { data: 'resi.berat' },
                { data: 'resi.jumlah' },
                { data: 'resi.diskon' },
                { data: 'resi.biaya_surat' },
                { data: 'resi.biaya_asuransi' },
                { data: 'resi.total_harga' },
                { data: 'shipment.pic' },
                // Add more columns as needed
            ],
            'columnDefs': [
            {
                "targets": 1, 
                "render": function (data, type, row) {
                    // data adalah nilai dalam kolom (created_at)
                    // type adalah tipe render (display, filter, sort, type, set)
                    // row adalah data dari baris saat ini

                    // Lakukan parsing tanggal
                    var date = new Date(data);
                    
                    // Ekstrak komponen tanggal
                    var day = date.getDate();
                    var month = date.getMonth() + 1; // Perlu ditambah 1 karena bulan dimulai dari 0
                    var year = date.getFullYear();
                    var hours = date.getHours();
                    var minutes = date.getMinutes();
                    var seconds = date.getSeconds();

                    // Format tanggal sesuai keinginan (contoh: dd-mm-yyyy HH:MM:SS)
                    var formattedDate = day + '-' + month + '-' + year + ' ' + hours + ':' + minutes + ':' + seconds;

                    // Kembalikan nilai yang sudah diformat
                    return formattedDate;
                },
            }
            
            ],
            buttons: [
            {
                // extend: 'collection',
                extend: 'excelHtml5',
                text: 'Export',
                title: getExportTitle(additionalInfo),
                buttons: ['export', 'excel', 'csv', 'pdf', 
                {
                    extend: 'excel',
                    text: 'Export All Data',
                    action: function(e, dt, button, config) {
                        // Use the built-in buttons.exportData() function to get all data
                        var exportData = dt.buttons.exportData({
                            modifier: {
                                page: 'all'
                            }
                        });

                        // Create a Blob containing the data
                        var blob = new Blob([exportData.excel]);

                        // Create an object URL for the Blob
                        var url = URL.createObjectURL(blob);

                        // Create a link and click it to trigger the download
                        var a = document.createElement('a');
                        a.href = url;
                        a.download = 'exported_data.xlsx';
                        a.click();

                        // Release the Blob URL
                        URL.revokeObjectURL(url);
                    },

                },
                {
                    text: 'Export All to Excel',
                    action: function (e, dt, button, config)
                    {
                        dt.one('preXhr', function (e, s, data)
                        {
                            data.length = -1;
                        }).one('draw', function (e, settings, json, xhr)
                        {
                            var excelButtonConfig = $.fn.DataTable.ext.buttons.excelHtml5;
                            var addOptions = { exportOptions: { 'columns': ':all'} };

                            $.extend(true, excelButtonConfig, addOptions);
                            excelButtonConfig.action(e, dt, button, excelButtonConfig);
                        }).draw();
                    }
                },
                {
                    extend: 'excel',
                    text: 'Export All Data',
                    action: function (e, dt, button, config) {
                        // Trigger the exportAll endpoint to generate and download the Excel file
                        var exportUrl = "{{ route('agen.export', ['start' => ':start', 'end' => ':end']) }}"
                            .replace(':start', start_date.format('YYYY-MM-DD HH:mm:ss'))
                            .replace(':end', end_date.format('YYYY-MM-DD HH:mm:ss'));

                        window.location.href = exportUrl;
                    }
                },
                ]
            }
        
        
            ],
            colReorder: true,
            dom: '<"flex justify-between items-center mb-4"lBf>rtip',
            // dom: 'Bfrtip',
            select: true,
            lengthMenu: [[10, 25, 50, 75, 100, -1], [ '10 rows', '25 rows', '50 rows','75 rows','100 rows', 'Show all' ]],
            pageLength: 10,
            }
        );

        function getExportTitle(info) {
            // Use <br> for HTML line breaks
            return `${info.judul} Kota Tujuan: ${info.Kota_Tujuan}  Kec. Tujuan: ${info.Kec_Tujuan}   PIC:${info.pic}`;
        }

        });

       
        
    });

</script>


@endsection
