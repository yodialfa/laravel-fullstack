{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('public/css/app.css')
    <title>Cahaya Nusantara | {{ $title }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&family=Kantumruy+Pro:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
 
    <script src="https://code.jquery.com/jquery-migrate-3.3.0.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/colreorder/1.7.0/js/dataTables.colReorder.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.3/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    @yield('container')
</body>

@vite('public/js/app.js')
<script src="{{ asset('js/add.js') }}"></script>

</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('public/css/app.css')
    <title>Cahaya Nusantara | {{ $title }}</title>
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">--}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&family=Kantumruy+Pro:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.7/dataRender/datetime.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script> 

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Tambahkan script DataTables Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.3/css/buttons.dataTables.min.css">

    {{-- <script src="https://cdn.datatables.net/buttons/2.1.3/js/dataTables.buttons.min.js"></script> --}}
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.13.7/dataRender/datetime.js"></script>

    <script src="https://cdn.datatables.net/colreorder/1.7.0/js/dataTables.colReorder.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.3/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <!-- Tambahkan gaya DataTables Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.7.0/css/colReorder.dataTables.min.css">

    {{-- {{-- <script src="https://cdn.datatables.net/buttons/2.1.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.3/js/buttons.flash.min.js"></script>
--}}
    <style>
      .dataTables_length select {
      width: 100px;
      /* -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none; */
      padding-right: 2rem; /* Adjust the padding as needed */
      margin-right: 0.5rem; /* Add margin to separate the number and arrow */
      /* background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512'%3E%3Cpath fill='currentColor' d='M299.3 194.7L268.7 224l-84.7 84.7V0H192c-13.3 0-24 10.7-24 24v288.7L75.3 224 44.7 194.7C38.3 188.3 32 192.7 32 200v304c0 13.3 10.7 24 24 24h192c13.3 0 24-10.7 24-24V200c0-7.3-6.3-11.7-11.7-5.3zM11.7 317.3C6.3 322.7 0 327 0 334.3v23.5c0 6.3 6.3 11 11.7 5.7l128-128c6.2-6.2 6.2-16.4 0-22.6l-128-128C6.3 162.1 0 166.3 0 173.6v23.5c0 7.2 6.3 11.6 11.7 5.7L160 96l-148.3 148.3z'%3E%3C/path%3E%3C/svg%3E") no-repeat right center; */
      background-size: 0.5rem; Adjust the size as needed
  }
  </style>


</head>
<body>
   

{{-- <div class="container w-full mx-auto min-h-screen "> --}}
  @yield('container')
{{-- </div> --}}
  
    
</body>
@vite('public/js/app.js')


<script src="{{ asset('js/add.js') }}"></script>

</html>
