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
            

            <div class="bg-white w-full table-auto mb-3">
                <h1 class="text-center text-3xl">Sortir Pengantaran Barang</h1>
            </div>

            <div class="flex justify-center items-center">
                {{-- <input type="date" name="cabang_asal" id="cabang_asal" required> --}}
                <label for='kectujuan'>Pilih Kecamatan :</label>
                <select name="kectujuan" id="kectujuan" class="w-1/7 py-2 px-3 border rounded-md ml-3">
                    <option value="" selected>-- Pilih Kota --</option>
                    @foreach($kecs as $kec)
                    <option value="{{ $kec->id }}">{{ $kec->NamaKecamatan }}</option>
                    @endforeach
                </select>
                <button type="button" id="submitBtn" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-3">Cari Data</button>
                  
                {{-- <button type="button" id="submitBtn">Cari Data</button> --}}
            </div>
            <div class="flex justify-center m-5">
                <button type="button" id="btnModal" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="hidden text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-3">Buat Laporan Sortir</button>

                {{-- <button id="btnModal" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="hidden block text-black bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
                Buat Laporan Sortir
                </button> --}}
            </div>
                <table class="display hidden w-full text-sm text-left text-gray-500 dark:text-gray-400" id="tableTransaksi">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            {{-- <th></th>
                            <th scope="col" class="px-4 py-3">
                                No
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Tanggal
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Manivest Code
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Tujuan
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Nama Agen
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Cabang
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Detail
                            </th> --}}
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

    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Sortir Barang
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="#">
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="pic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama PIC</label>
                            <input type="text" name="pic" id="pic" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nama PIC" required="">
                        </div>
                        {{-- <div>
                            <label for="nopol" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. Polisi</label>
                            <input type="text" name="nopol" id="nopol" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Isi No. Polisi" required="">
                        </div> --}}
                        {{-- <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="number" name="price" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="$2999" required="">
                        </div>
                        <div>
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected="">Select category</option>
                                <option value="TV">TV/Monitors</option>
                                <option value="PC">PC</option>
                                <option value="GA">Gaming/Console</option>
                                <option value="PH">Phones</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write product description here"></textarea>                    
                        </div>
                    </div> --}}
                    <button type="submit" id="updateShipment" class="text-black inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        {{-- <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg> --}}
                        Buat Laporan
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- endmodal --}}

    

</div>
<link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

<script>
    $(function(){
    $('#submitBtn').click(function(){
        
        const kec = $('#kectujuan').val();
        $('#tableTransaksi').removeClass("hidden");
        $('#btnModal').removeClass("hidden");
        

        // Destroy the DataTable if it already exists
        if ($.fn.DataTable.isDataTable('#tableTransaksi')) {
            $('#tableTransaksi').DataTable().destroy();
        }

        var i = 1;
        var table = $('#tableTransaksi').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : "{{ route('cabang.sorting-data') }}",
            data : {kec:kec},
            dataSrc: 'data', // Specify the property containing the data
        },
        columns: [
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
            {data: 'kec_asal.NamaKecamatan', name: 'kecAsal.NamaKecamatan'},
            {data: 'kota_tujuan.NamaKota', name: 'kotaTujuan.NamaKota'},
            {data: 'kec_tujuan.NamaKecamatan', name: 'kotaTujuan.NamaKota'},
            {data: 'service_id.NamaLayanan', name: 'service_id.NamaLayanan', searchable: false },
            {data: 'berat', name: 'berat',searchable: false },
            {data: 'jumlah', name: 'jumlah'},
            {data: 'total_harga', name: 'total_harga', 
            render: $.fn.dataTable.render.number('.', ',', 0, '' )},
            // render: function ( data, type, row ) {
            //             return 'Rp.'+ data;
            //         }},
            
            {data: 'karyawan.agen.agen', name: 'karyawan.agen.agen', searchable: false },
            

        ],
        "columnDefs": [
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
                    // var formattedDate = day + '-' + month + '-' + year + ' ' + hours + ':' + minutes + ':' + seconds;
                   // Format the date as dd-mm-yyyy
                    var formattedDate = padZero(day) + '-' + padZero(month) + '-' + year + ' ' + padZero(hours) + ':' + padZero(minutes) + ':' + padZero(seconds);


                    function padZero(number) {
                        return number < 10 ? '0' + number : number;
                    }

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
            'selectNone',
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
        // select: true,
        lengthMenu: [[10, 25, 50, 75, 100, -1], [ '10 rows', '25 rows', '50 rows','75 rows','100 rows', 'Show all' ]],
        pageLength: 10,
        language: {
            buttons: {
                selectAll: "Select all items",
                selectNone: "Select none"
            }
        },
        rowId: 'no_resi',
        
        });


        $('#updateShipment',).on('click',  function(){
        // const nopol = $('#nopol').val();
        const pic = $('#pic').val();

        // Find all checked checkboxes in the first column
        var checkboxes = $('#tableTransaksi tbody input[type="checkbox"]:checked');

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
            // console.log(selectedValues, nopol);
            // console.log(nopol);

  
            if(selectedValues.length > 0)
            {
                var requestData = [];

                selectedValues.forEach(function (no_resi) {
                    requestData.push({
                        no_resi: no_resi,
                        status: '6',
                        ket: 'Proses Sorting',
                    });
                });
                console.log(requestData);
                $.ajax({
                    url:'{{ route('cabang.sorting-data-create') }}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method:"get",
                    data: { data: JSON.stringify(requestData),
                            kec: kec,
                            // tujuan: tujuan,
                            pic:pic,
                        },
                    success:function(data)
                    {
                        console.log("sukses" + pic);
                        
                        alert("suskes update data");
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
            event.preventDefault();
            return false;
        }



        });

        table.buttons().container().appendTo($('.flex:eq(0)', table.table().container()));
        $('.dataTables_length select').addClass('text-sm');


        var data = table.buttons.exportData();



        
    });  
    });

</script>


@endsection
