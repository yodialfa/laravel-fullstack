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
                <h1 class="text-center text-3xl">Generate Shipment Kedatangan Barang</h1>
            </div>

            <form id="shipmentForm" method="get" onsubmit="return false;>
                @csrf
                <label for="start_date">Input Shipment ID Agen :</label>
                <input type="text" name="generate_shipment" id="generate_shipment" required>
                     
                <button type="button" id="submitBtn">Cari Data</button>
            </form>
                    <button type="button" name="updateShipment" id="updateShipment" class="hidden"><i class="glyphicon glyphicon-remove"></i>Update</button>


            <table id="tableShipment" class="hidden w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead>
                    <tr>
                    {{-- <td><input type="button" name="bulk_delete" id="bulk_delete"></td> --}}
                    {{-- <td><input type="checkbox" id="selectAll" class="resi_checkbox"></td> --}}
                    <th></th>
                    <th>No. </th>
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
                    <th>Total Transkasi</th>
                    <th>Agen</th>
                    </tr>

                </thead>
                <tbody>

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
        const shipment_id = $('#generate_shipment').val();
        
        $('#tableShipment').removeClass("hidden");
        $('#updateShipment').removeClass("hidden");
        

        // Hancurkan DataTable yang sudah ada (jika ada)
        if ($.fn.DataTable.isDataTable('#tableShipment')) {
            $('#tableShipment').DataTable().destroy();
        }
        var i = 1;
        var table = $('#tableShipment').DataTable({
        'processing': true,
        'serverSide': true,
        // data: data,
        'ajax': {
            url : '{{ route('cabang.generate-arrived') }}',
            // data : data.shipment_id;
            data : {shipment_id: shipment_id}, //data.shipment_id;
        },

        'columns': [
            { data:"checkbox", orderable:false, searchable:false},
            {data: null, sortable: false,
            render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }  
            },
            {data: 'created_at', name: 'created_at'},
            {data: 'no_resi', name: 'no_resi', "orderable": true, "searchable": true},
            {data: 'resi.nama_pengirim', name: 'resi.nama_pengirim'},
            {data: 'resi.nama_penerima', name: 'resi.nama_penerima'},
            {data: 'resi.kota_asal.NamaKota', name: 'kotaAsal.NamaKota'},
            {data: 'resi.kec_asal.NamaKecamatan', name: 'kecAsal.NamaKecamatan'},
            {data: 'resi.kota_tujuan.NamaKota', name: 'kotaTujuan.NamaKota'},
            {data: 'resi.kec_tujuan.NamaKecamatan', name: 'kotaTujuan.NamaKota'},
            
            {data: 'resi.service_id.NamaLayanan', name: 'service_id.NamaLayanan', searchable: false },
            {data: 'resi.berat', name: 'berat',searchable: false },
            {data: 'resi.jumlah', name: 'jumlah'},
            // {data: 'diskon', name: 'diskon'},
            // {data: 'biaya_surat', name: 'biaya_surat'},
            // {data: 'biaya_asuransi', name: 'biaya_asuransi'},                
            {data: 'resi.total_harga', name: 'total_harga', 
            render: $.fn.dataTable.render.number('.', ',', 0, '' )},
            // render: function ( data, type, row ) {
            //             return 'Rp.'+ data;
            //         }},
            
            {data: 'resi.karyawan.agen.agen', name: 'resi.karyawan.cabang_id', searchable: false },

        ],
        'columnDefs': [
            {
                targets: 0,
                'checkboxes': {
                'selectRow': true
                }
            },
            {
                "targets": 2, 
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
        'select': {
            'style': 'multi'
        },

        buttons: [
        'selectAll',
        'selectNone'
        ],
        language: {
            buttons: {
                selectAll: "Select all items",
                selectNone: "Select none"
            }
        },
        rowId: 'no_resi',
        
        
        // colReorder: true,
        dom: '<"flex justify-between items-center mb-4"lBf>rtip',
        // dom: 'Blfrtip',
        // select: true,
        lengthMenu: [[10, 25, 50, 75, 100, -1], [ '10 rows', '25 rows', '50 rows','75 rows','100 rows', 'Show all' ]],
        pageLength: 25,
        // // language: {
        // //     // Customize the "Show entries" dropdown text
        // //     lengthMenu: "_MENU_",
        // // },
        
        });
    



    $('#updateShipment',).on('click',  function(){
        // var form = this;

        // Find all checked checkboxes in the first column
        var checkboxes = $('#tableShipment tbody input[type="checkbox"]:checked');

        // Create an array to store specific values (e.g., "no_resi")
        var selectedValues = [];
        var row_selected = table.columns(2, {selected: true}).data();
        if(confirm("Apakah sudah yakin ingin mengupdate data?"))
        {

            // Iterate over all checked checkboxes
            checkboxes.each(function () {
                // Get the corresponding row data
                var rowData = table.row($(this).closest('tr')).data();

                if (rowData && rowData.no_resi) {
                    // Add the specific value to the array
                    selectedValues.push(rowData.no_resi);
                }
            });

            // Log the array of selected values
            // console.log(selectedValues);

  
            if(selectedValues.length > 0)
            {
            var requestData = [];

            selectedValues.forEach(function (no_resi) {
                requestData.push({
                    no_resi: no_resi,
                    status: '5',
                    ket: 'Sampai di gudang tujuan'
                });

                console.log(requestData);
            });
                $.ajax({
                    url:"{{ route('cabang.update-depdata') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method:"get",
                    data: { data: JSON.stringify(requestData),
                        shipment_id : shipment_id,
                    },
                    // {no_resi:selectedValues,
                    //      status: '2',
                    //      ket: 'Sampai di gudang'},

                    success:function(data)
                    {
                        console.log("sukses");
                        alert("suskes update data");
                        window.location.reload();

                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                });
            }
            else
            {
                alert("Please select atleast one checkbox");
            }
        }



});




    });

 });
</script>
@endsection