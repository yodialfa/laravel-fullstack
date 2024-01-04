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
                <h1 class="text-center text-3xl">List Sortir Barang</h1>
            </div>



            <h1>Pilih Tanggal</h1> 
            <div id="daterange"  class="float-end" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; text-align:center">
                
                <i class="fa fa-calendar"></i>&nbsp;
                <span>
                   
                </span> 
                <i class="fa fa-caret-down"></i>
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
                                Manivest Code
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Cabang Tujuan
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kec. Tujuan
                            </th>

                            <th scope="col" class="px-4 py-3">
                                Cabang Asal
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Nama Agen
                            </th>
                            <th scope="col" class="px-4 py-3">
                                PIC
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Detail
                            </th>
                            {{-- <th scope="col" class="px-4 py-3">
                                Detail
                            </th> --}}
                            
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>

        
        
        

    </div>

    

</div>
<script>
    $(function(){
    // $(document).ready(function() {
        //set default 7 days
        var start_date = moment().startOf('day').subtract(6, 'days');

        var end_date = moment().endOf('day');



        $('#daterange span').html(start_date.format('DD MMMM YYYY HH:mm:ss') + ' - ' + end_date.format('DD MMMM YYYY HH:mm:ss'));

        $('#daterange').daterangepicker({
            startDate : start_date,
            endDate : end_date
        }, function(start_date, end_date){
            $('#daterange span').html(start_date.format('DD MMMM YYYY HH:mm:ss') + ' - ' + end_date.format('DD MMMM YYYY HH:mm:ss'));

            table.draw();
        });

        var i = 1;
        var table = $('#tableTransaksi').DataTable({
        processing: true,
        serverSide: true,
        // data: data,
        ajax: {
            url : "{{ route('cabang.sorting-list-sortir-data') }}",
            data : function(data){
                data.from_date = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
                data.to_date = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
            }
        },
        columns: [
            {data: null, sortable: false,
            render: function (data, type, row, meta) {
                 return meta.row + meta.settings._iDisplayStart + 1;
                }  
            },
            {data: 'created_at', name: 'created_at'},
            {data: 'ship_id', name: 'ship_id'},
            {data: 'cabang_tujuan.cabang', name: 'tujuan'},
            {data: 'kec_tujuan_pengantaran.NamaKecamatan', name: 'agen.agen'},
            {data: 'cabang.cabang', name: 'cabang.cabang'},
            
            {data: 'agen.agen', name: 'cabang.cabang'},
            {data: 'pic', name: 'pic'},
            {
                data: 'dynamic_link_column',
                name: 'dynamic_link_column',
                render: function(data, type, full, meta) {
                    // 'data' adalah nilai kolom
                    // 'type' adalah tipe rendering (biasanya 'display')
                    // 'full' adalah objek data lengkap untuk baris saat ini
                    // 'meta' berisi informasi tambahan, seperti indeks kolom
                    
                    // Contoh: Menyisipkan link dengan data sebagai bagian dari URL
                    return '<a href="/agen/manivest/data/detail/' + full.ship_id + '">Lihat Detail</a>';
                }
            },
            

        ],
        "columnDefs": [
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

        table.buttons().container().appendTo($('.flex:eq(0)', table.table().container()));
        $('.dataTables_length select').addClass('text-sm');


        var data = table.buttons.exportData();



        
        
    });

</script>


@endsection
