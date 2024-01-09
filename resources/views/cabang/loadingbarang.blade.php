@extends('layouts.main')
<div class="fixed top-0 z-50 w-full bg-cyan-400">
    <div class="hidden w-full lg:block md:w-auto" id="navbar-dropdown">
        @include('partials.navbar')
    </div>
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
                <h1 class="text-center text-3xl">Loading Barang</h1>
            </div>
            

            {{-- </div> --}}
            <div class="flex items-center justify-center">
            <form id="shipmentForm" method="get" onsubmit="return false;">
                @csrf
                <label for='kotaasal'>Cabang Asal :</label>
                <select name="pilihan" id="kotaasal" class="w-1/7 py-2 px-3 border rounded-md">
                    <option value="" selected>-- Pilih Kota --</option>
                    @foreach($asal as $kotaasal)
                    <option value="{{ $kotaasal->id }}">{{ $kotaasal->NamaKota }}</option>
                    @endforeach
                </select>
                {{-- <input type="date" name="cabang_asal" id="cabang_asal" required> --}}
                <label for='kotatujuan'>Cabang Tujuan :</label>
                <select name="pilihan" id="kotatujuan" class="w-1/7 py-2 px-3 border rounded-md">
                    <option value="" selected>-- Pilih Kota --</option>
                    @foreach($kota as $kotatujuan)
                    <option value="{{ $kotatujuan->id }}">{{ $kotatujuan->NamaKota }}</option>
                    @endforeach
                </select>
                {{-- <input type="date" name="cabang_tujuan" id="cabang_tujuan" required> --}}
                     
                {{-- <button type="button" id="submitBtn">Cari Data</button> --}}
                <button type="button" id="submitBtn" name="submitBtn" class=" text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Cari Data</button>
            </form>
            </div>
            <div class="flex items-center justify-center">
                <button type="button" id="updateShipment" name="updateShipment" class="hidden text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Update Data</button>
            </div>
                
                {{-- <button type="button" name="updateShipment" id="updateShipment" class="hidden btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i>Buat laporan</button> --}}
            

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
                    {{-- <th>Kec Pengirim</th> --}}
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
        const asal = $('#kotaasal').val();
        const tujuan = $('#kotatujuan').val();
        console.log('klik');

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
        'ajax': {
            url : '{{ route('cabang.loading-shipment') }}',

            data : {asal: asal,
                    tujuan: tujuan},
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
            {data: 'nama_pengirim', name: 'nama_pengirim'},
            {data: 'nama_penerima', name: 'nama_penerima'},
            {data: 'kota_asal.NamaKota', name: 'kotaAsal.NamaKota'},
            // {data: 'resi.kec_asal.NamaKecamatan', name: 'kecAsal.NamaKecamatan'},
            {data: 'kota_tujuan.NamaKota', name: 'kotaTujuan.NamaKota'},
            {data: 'kec_tujuan.NamaKecamatan', name: 'kecTujuan.NamaKecamatan'},      
            {data: 'service_id.NamaLayanan', name: 'service_id.NamaLayanan', searchable: false },
            {data: 'berat', name: 'berat',searchable: false },
            {data: 'jumlah', name: 'jumlah'},
            {data: 'total_harga', name: 'total_harga', 
            render: $.fn.dataTable.render.number('.', ',', 0, '' )},
            // render: function ( data, type, row ) {
            //             return 'Rp.'+ data;
            //         }},
            
            {data: 'karyawan.agen.agen', name: 'resi.karyawan.cabang_id', searchable: false },

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
                "render": DataTable.render.datetime('DD-MM-YYYY HH:mm:ss'),
                
            }
            
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
            console.log(selectedValues);

  
            if(selectedValues.length > 0)
            {
                const kotaTujuan = $
                var requestData = [];

                selectedValues.forEach(function (no_resi) {
                    requestData.push({
                        no_resi: no_resi,
                        status: '3',
                        ket: 'Proses muat barang',
                    });
                });
                $.ajax({
                    url:"{{ route('cabang.loading-update') }}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method:"get",
                    data: { data: JSON.stringify(requestData),
                            kota_tujuan: tujuan },
                    success:function(data)
                    {
                        console.log("sukses");
                        alert(data.message);
                        if (data.success && data.redirect) {
                            window.location.href = data.redirect;
                        }

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