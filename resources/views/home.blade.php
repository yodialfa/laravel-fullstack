@extends('layouts.main')



@section('container')

<div class="fixed top-0 z-50 w-full bg-cyan-400">
    @include('partials.navbar')
</div>

<div class="bg-index w-full mx-auto">



   
<div class="container w-full  mx-auto pt-20  p-4">
    <div class="flex flex-wrap">
        <!-- <div class="hero"> -->
        <div class="align-center font-kanit mt-28 justify-center w-full md:w-1/2">
            <h3 class="text-3xl mb-3">Welcome</h3>
            <p>
                <h1 class="text-5xl  font-extrabold text-white tracking-wide mb-3 font-kanit">Temukan angkutan <br>yang sesuai dengan <br>budget kamu</h1>
            </p>
            <h4 class="text-xl">Kami menawarkan berbagai jenis armada untuk angkutan barangmu. <br>Hubungi kami sekarang juga.</h4>
        </div>

        <div class="w-full md:w-1/2 justify-items-center">
            <img src="{{ asset('src/truck.png') }}" class="mx-auto" alt="" srcset="">
            <div class="motto">
                <h1 class="text-center text-white text-2xl font-semibold font-kanit">"Our Company is Your Solution"</h1>
            </div>
        </div>
    </div>
    {{-- @foreach ($karyawans as $karyawan)
    <h1>{{ $karyawan->id }}</h1>
    
    <a href="/karyawan/{{ $karyawan->id }}">
        <h1>{{ $karyawan->nama }}</h1>    
    </a>
        <h1>{{ $karyawan->tanggal_lahir }}</h1>
        <h1>{{ $karyawan->alamat }}</h1>
    @endforeach --}}

</div>

<section class="container flex flex-wrap p-4 gap-3 mt-10 my-10 justify-center mx-auto">
<div class="h-fit mb-1">
    <h1 class="text-3xl font-kanit">Cek Tarif</h1>
</div>
<div class=" w-full flex flex-wrap justify-center gap-3">

    <div class="mt-4">
        <select name="kotaasal" id="kotaasal" class="w-1/7 py-2 px-3 border rounded-md">
            <option value="" selected>-- Pilih Kota --</option>
            @foreach($kotaasals as $kotas)
            <option value="{{ $kotas->id }}">{{ $kotas->NamaKota }}</option>
            @endforeach
        </select>
    </div>
    <div class="mt-4">
        <select name="kecasal" id="kecasal" aria-placeholder="Pilih Kecamatan" class="w-2/7 py-2 px-3 border rounded-md">
            <option value="#">--Pilih Kecamatan--</option>
        </select>
    </div>

    {{-- <div class="mt-4">
        <select name="pilihan" id="kecasal" aria-placeholder="Pilih Kecamatan" class="w-2/7 py-2 px-3 border rounded-md">
            <option value="" selected>-- Pilih Kecamatan --</option>
            @foreach($kotaasals as $city)
                @if ($city->kecasals)
                    @foreach($city->kecasals as $district)
                        <option value="{{ $district->id }}">{{ $district->NamaKecamatan }}</option>
                    @endforeach
                @endif
            @endforeach
        </select>
    </div> --}}

    
    <div class="mt-4">
        <select name="pilihan" id="kotatujuan" class="w-1/7 py-2 px-3 border rounded-md">
            <option value="" selected>-- Pilih Kota --</option>
            @foreach($kotatujs as $kotuj)
            <option value="{{ $kotuj->id }}">{{ $kotuj->NamaKota }}</option>
            @endforeach
        </select>
    </div>
    <div class="mt-4">
        <select name="pilihan" id="kectujuan" class="w-2/7 py-2 px-3 border rounded-md">
            <option value="#">--Pilih Kecamatan--</option>
        </select>
    </div><div class="mt-4">
        <select name="pilihan" id="layanan" class="w-1/7 py-2 px-3 border rounded-md">
            <option value="" selected>-- Pilih Layanan --</option>
            @foreach($layanan as $layan)
            <option value="{{ $layan['id'] }}">{{ $layan['NamaLayanan'] }}</option>
            @endforeach
        </select>
    </div>
    <div class=" text-white bg-zinc-900 mt-4"><button id="ambil" class="w-1/7 py-2 px-3 border rounded-md">Cek Harga</button></div>
</div>
<div>
    {{-- <input type="text" id="harga" name="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 placeholder="" disabled> --}}
    <h1 id="harga" class="text-3xl text-white"></h1>
</div>
</div>
</section>


<div>
    @include('partials.footer')
</div>

@endsection
