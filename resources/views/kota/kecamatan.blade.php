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
                <h1 class="text-center text-3xl">Daftar Kecamatan</h1>
            </div>
            
            <div class="bg-white w-full table-auto mb-3 flex justify-center">
            
                <select name="selectKota" id="selectKota">
                    <option value="" selected>--Pilih Kota--</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->NamaKota }}</option>
                    @endforeach
                </select>
            </div>

            <div class="bg-white w-full table-auto mb-3 flex justify-center">
                <button id="tambahkec" class="w-1/4 flex justify-center rounded-full bg-gray-500"><a class="w-full">Tambah Kecamatan</a></button>
            </div>
                        
            <table id="tableKecamatan" class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ml-1 mr-2">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-center">
                            Kecamatan ID
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Nama Kecamatan
                        </th>
                        <th scope="col" class="px-4 py-3 text-center">
                            <span class="sr-only">Actions</span>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    

                    
                </tbody>
            </table>

            <div class="block z-70 w-full bg-transparent">
                @include('partials.modal')
            </div>

        </div>
    </div>
</div>
    
@endsection