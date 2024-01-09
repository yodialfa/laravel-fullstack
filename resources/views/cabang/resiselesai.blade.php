@extends('layouts.main')

<div class="fixed top-0 z-50 w-full bg-cyan-400">
    <div class="hidden w-full lg:block md:w-auto" id="navbar-dropdown">
        @include('partials.navbar')
    </div>
</div>
@include('partials.sidebar')
@section('container')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-4 md:mt-20">
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
                <h1 class="text-center text-3xl">Selesai Pengantaran</h1>
            </div>
            
            <div class="flex items-center justify-center">
                <form id="shipmentForm" method="get" onsubmit="return false;"">
                    @csrf
                    <label for="gen_resi">Input No. Resi :</label>
                    <input type="text" name="gen_resi" id="gen_resi" required>
                    
                    {{-- <button type="button" id="submitBtn">Cari Data</button> --}}
                    <button type="button" id="submitBtn" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-3">Cari Data</button>
                    
                </form>
            </div>
                    {{-- <button type="button" name="updateShipment" id="updateShipment" class="hidden"><i class="glyphicon glyphicon-remove"></i>Update</button> --}}


            <table id="tableShipment" class="hidden w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead>
                    <tr>
                    {{-- <td><input type="button" name="bulk_delete" id="bulk_delete"></td> --}}
                    {{-- <td><input type="checkbox" id="selectAll" class="resi_checkbox"></td> --}}
                    <th>Tanggal </th>
                    <th>No. Resi</th>
                    <th>Nama Pengirim</th>
                    <th>Nama Penerima</th>
                    <th>Kota Pengirim</th>
                    <th>Kec Pengirim</th>
                    <th>Kota Penerima</th>
                    <th>Kec Penerima</th>
                    <th>Layanan</th>
                    <th>Berat</th>
                    <th>Jumlah Koli</th>
                    <th>Total Transaksi</th>
                    <th>Cara Bayar</th>
                    <th>Agen</th>
                    <th>Action</th>
                    </tr>

                </thead>
                <tbody>

                    {{-- @foreach ($resis as $resi)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <h1 class="text-center">{{ $resi->id }}</h1>
                        </th>
                        <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            
                            <h1>{{ $resi->created_at }}</h1>    
                           
                        </th>
                        <td class="px-4 py-4">
                            <h1>{{ $resi->no_resi }}</h1>

                        </td>
                        <td class="px-4 py-4">
                            <h1>{{ $resi->nama_pengirim }}</h1>

                        </td>
                        <td class="px-4 py-4">
                            <h1>{{ $resi->nama_penerima }}</h1>
                        </td>
                        <td class="px-4 py-4">
                            <h1>{{ $resi->kotaAsal->NamaKota }}</h1>
                        </td>
                        <td class="px-4 py-4">
                            <h1>{{ $resi->kecAsal->NamaKecamatan }}</h1>
                        </td>
                        <td class="px-4 py-4">
                            <h1>{{ $resi->kotaTujuan->NamaKota }}</h1>
                        </td>
                        <td class="px-4 py-4">
                            <h1>{{ $resi->kecTujuan->NamaKecamatan }}</h1>
                        </td>
                        <td class="px-4 py-4">
                            <h1>{{ $resi->serviceId->NamaLayanan }}</h1>
                        </td>
                        <td class="px-4 py-4">
                            <h1>{{ $resi->berat }}</h1>
                        </td>
                        <td class="px-4 py-4">
                            <h1>{{ $resi->jumlah }}</h1>
                        </td>
                        <td class="px-4 py-4">
                            <h1>{{ $resi->cara_bayar }}</h1>
                        </td>
                        <td class="px-4 py-4">
                            <h1>{{ $resi->karyawan->agen->agen }}</h1>
                        </td>
                           
                        <td class="px-4 py-4 text-right">
                            <a href="{{ route('karyawan.update', $resi->no_resi) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>

                        
                    </tr>
                    @endforeach --}}

                </tbody>
            </table>
            


        </div>
    </div>
</div>
<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>
<script>
 $(function(){
    $('#submitBtn').click(function(){
        const resi = $('#gen_resi').val();
        
        $('#tableShipment').removeClass("hidden");

        

        // Hancurkan DataTable yang sudah ada (jika ada)
        if ($.fn.DataTable.isDataTable('#tableShipment')) {
            $('#tableShipment').DataTable().destroy();
        }
        var i = 1;
        var table = $('#tableShipment').DataTable({
        'processing': true,
        'serverSide': true,
        // data: data,
        ajax: {
            url : "{{ route('pengantaran-get') }}",
            data : {
                resi: resi,
            }
        },
        columns: [
            
            {data: 'created_at', name: 'created_at'},
            {data: 'no_resi', name: 'no_resi'},
            {data: 'nama_pengirim', name: 'nama_pengirim'},
            {data: 'nama_penerima', name: 'nama_penerima'},
            {data: 'kota_asal.NamaKota', name: 'kota_asal.NamaKota'},
            {data: 'kec_asal.NamaKecamatan', name: 'kec_asal.NamaKecamatan'},
            {data: 'kota_tujuan.NamaKota', name: 'kota_tujuan.NamaKota'},
            {data: 'kec_tujuan.NamaKecamatan', name: 'kec_tujuan.NamaKecamatan'},
            {data: 'service_id.NamaLayanan', name: 'service_id.NamaLayanan'},
            {data: 'berat', name: 'berat'},
            {data: 'jumlah', name: 'jumlah'},
            
            {data: 'total_harga', name: 'total_harga'},
            // {data: 'cara_bayar', name: 'cara_bayar'},
            { 
                data: 'cara_bayar', 
                name: 'cara_bayar',
                render: function (data, type, row) {
                    switch (data) {
                        case '0':
                            return 'Cash';
                        case '1':
                            return 'Bayar Tujuan';
                        case '2':
                            return 'Kondisi lainnya';
                        // tambahkan kondisi lain jika diperlukan
                        default:
                            return 'Nilai tidak diketahui';
                    }
                }
            },
            {data: 'karyawan.agen.agen', name: 'karyawan.agen.agen'},
            {
                data: 'dynamic_link_column',
                name: 'dynamic_link_column',
                render: function(data, type, full, meta) {
                    // 'data' adalah nilai kolom
                    // 'type' adalah tipe rendering (biasanya 'display')
                    // 'full' adalah objek data lengkap untuk baris saat ini
                    // 'meta' berisi informasi tambahan, seperti indeks kolom
                    
                    // Contoh: Menyisipkan link dengan data sebagai bagian dari URL
                    // <button type="button" id="submitBtn" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-3">Cari Data</button>

                    return '<button type="button" id="submitBtn" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-3"><a href="/pengantaranupdateview/get/viewupdate/' + full.no_resi + '">Update</a></button>';
                }
            },
            

        ],
        "columnDefs": [
            {
                "targets": 0, 
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
            },
        ],
        buttons: [
            {
                extend: 'collection',
                text: 'Export',
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
                    }
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
        language: {
            // Customize the "Show entries" dropdown text
            lengthMenu: "_MENU_",
        },
        
        });
    



//     $('#updateShipment',).on('click',  function(){
//         // var form = this;

//         // Find all checked checkboxes in the first column
//         var checkboxes = $('#tableShipment tbody input[type="checkbox"]:checked');

//         // Create an array to store specific values (e.g., "no_resi")
//         var selectedValues = [];
//         var row_selected = table.columns(2, {selected: true}).data();
//         if(confirm("Apakah sudah yakin ingin mengupdate data?"))
//         {

//             // Iterate over all checked checkboxes
//             checkboxes.each(function () {
//                 // Get the corresponding row data
//                 var rowData = table.row($(this).closest('tr')).data();

//                 if (rowData && rowData.no_resi) {
//                     // Add the specific value to the array
//                     selectedValues.push(rowData.no_resi);
//                 }
//             });

//             // Log the array of selected values
//             // console.log(selectedValues);

  
//             if(selectedValues.length > 0)
//             {
//             var requestData = [];

//             selectedValues.forEach(function (no_resi) {
//                 requestData.push({
//                     no_resi: no_resi,
//                     status: '2',
//                     ket: 'Sampai di gudang'
//                 });

//                 console.log(requestData);
//             });
//                 $.ajax({
//                     url:"{{ route('cabang.update-shipment-agen') }}",
//                     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//                     method:"get",
//                     data: { data: JSON.stringify(requestData) },
//                     // {no_resi:selectedValues,
//                     //      status: '2',
//                     //      ket: 'Sampai di gudang'},

//                     success:function(data)
//                     {
//                         console.log("sukses");
//                         alert("suskes update data");
//                         window.location.reload();

//                     },
//                     error: function(data) {
//                         var errors = data.responseJSON;
//                         console.log(errors);
//                     }
//                 });
//             }
//             else
//             {
//                 alert("Please select atleast one checkbox");
//             }
//         }



// });




    });

 });
</script>
@endsection