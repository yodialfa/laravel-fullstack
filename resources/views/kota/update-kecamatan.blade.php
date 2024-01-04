@extends('layouts.main')
<div class="fixed top-0 z-50 w-full bg-cyan-400">
    <div class="hidden w-full lg:block md:w-auto" id="navbar-dropdown">
        @include('partials.navbar')
    </div>
</div>
@include('partials.sidebar')

@section('container')


<div class="p-4 sm:ml-64 -z-100">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-20">
        
        <div class=" overflow-x-auto bg-white shadow-md sm:rounded-lg min-h-full">
           
            {{-- session jika sukses --}}
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
            {{-- endseection --}}
            <div class="bg-white w-full table-auto mb-3">
                <h1 class="text-center text-3xl">Update Kecamatan</h1>
            </div>
            
            <form action="{{ route('kecamatan.update', $kec->id) }}" method="post">
            <div class="mb-4">
                <label for="namakota" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kota</label>
                <input type="text" id="namakota" name="namakota" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('namakota') is-invalid @enderror" placeholder="Nama Kota" required value="{{ $city->NamaKota }}" disabled>
                @error('namakota')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="namakecamatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kecamatan</label>
                <input type="text" id="namakecamatan" name="namakecamatan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('namakecamatan') is-invalid @enderror" placeholder="Nama Kecamatan" required value="{{ $kec->NamaKecamatan }}">
                @error('namakecamatan')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>
          
            <div class="flex items-center justify-center gap-3">
                
                @csrf
                @method('PUT')
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex">Submit</button>
                
                <form action="{{ route('kecamatan')}}" method="get">
                    <button type="submit" class="focus:outline-none text-white bg-red-700  hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><a href="{{ route('kota') }}">Batal</a></button>
                </form>
            </div>
            </form>


                        
            

            <div class="block z-70 w-full bg-transparent">
                @include('partials.modal')
            </div>

        </div>
    </div>
</div>


@endsection