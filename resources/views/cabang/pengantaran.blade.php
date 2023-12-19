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
            

            <div class="bg-white w-full table-auto mb-3">
                <h1 class="text-center text-3xl">Update Pengantaran Barang</h1>
            </div>


                {{-- <input type="date" name="cabang_asal" id="cabang_asal" required> --}}
                <label for='kotatujuan'>Pilih Kecamatan :</label>
                <select name="pilihan" id="kotatujuan" class="w-1/7 py-2 px-3 border rounded-md">
                    <option value="" selected>-- Pilih Kota --</option>
                    @foreach($kota as $kotatujuan)
                    <option value="{{ $kotatujuan->id }}">{{ $kotatujuan->NamaKota }}</option>
                    @endforeach
                </select>
                     
                <button type="button" id="submitBtn">Cari Data</button>
                
            {{-- </form> --}}
            <div class="flex justify-center m-5">
                <button id="btnModal" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="hidden block text-black bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800" type="button">
                Buat RG Pemberangkatan
                </button>
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
    $(function(){
    // $(document).ready(function() {
        
        var start_date = moment().startOf('day').subtract(1, 'M');

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
            url : "{{ route('cabang.list-depdata') }}",
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
            {data: 'tujuan', name: 'tujuan'},
            {data: 'agen.agen', name: 'agen.agen'},
            {data: 'cabang.cabang', name: 'cabang.cabang'},
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
