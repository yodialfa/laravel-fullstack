<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('public/css/app.css')
    <title>Cahaya Nusantara | {{ $title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500&family=Kantumruy+Pro:wght@700&display=swap" rel="stylesheet">

</head>
<body>
   

{{-- <div class="container w-full mx-auto min-h-screen "> --}}
  @yield('container')
{{-- </div> --}}
  
    
</body>
@vite('public/js/app.js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="{{ asset('js/add.js') }}"></script>

</html>