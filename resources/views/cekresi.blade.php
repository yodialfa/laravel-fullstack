@extends('layouts.main')



@section('container')

<div class="fixed top-0 z-50 w-full bg-cyan-400">
    @include('partials.navbar')
</div>

<div class="bg-index w-full mx-auto">



   
<section class="container w-full mx-auto pt-20  p-4 mt-8">
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/2 justify-items-center">
            <img src="{{ asset('src/truck.png') }}" class="mx-auto" alt="" srcset="">
            <div class="motto">
                <h1 class="text-center text-white text-2xl font-semibold font-kanit">"Our Company is Your Solution"</h1>
            </div>
        </div>
        <div class="w-full md:w-1/2 justify-items-center">
            <div class="h-fit mb-1">
                <h1 class="text-3xl font-kanit text-center">Cek Resi</h1>
            </div>
            <div class=" w-full flex flex-wrap justify-center gap-3">
                <input type="text" id="resi" name="resi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <div class=" text-white bg-zinc-900 mt-4"><button id="cek_resi" class="w-1/7 py-2 px-3 border rounded-md">Cek Resi</button></div>
            </div>
            <div id="result_resi">
    

            </div>
        </div>
    </div>
</section>
</div>

<div class="mt-10">
    <h1 class="text-center font-bold">Quality is Our Tradition</h1>
</div>
<div>
    @include('partials.footer')
</div>
@endsection
