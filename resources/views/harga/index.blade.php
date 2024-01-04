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
        {{-- <div class="grid grid-cols-3 gap-4 mb-4"> --}}
            <div class="container mx-auto max-w-full min-h-full flex flex-col ">
                <div>

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
                    <a href="{{ route('harga.add') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Harga</a>
                </div>

                <form class="flex items-center justify-center mx-auto gap-2">   
              
                    <div class="flex flex-wrap">
                        <input type="search" id="search-asal" name="search-asal" class=" flex flex-wrap mx-auto w-13 p-2  justify-center ps-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Asal.." value="{{ request('search-asal') }}" required>
                    </div>
                    <div  class="flex flex-wrap">
                        <button type="submit" class="text-white flex mx-auto flex-wrap  bottom-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>
                <form class="flex items-center justify-center mx-auto gap-2">   
              
                    <div class="flex flex-wrap">
                        <input type="search" id="search-tujuan" name="search-tujuan" class=" flex flex-wrap mx-auto w-13 p-2  justify-center ps-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Tujuan.." value="{{ request('search-tujuan') }}" required>
                    </div>
                    <div  class="flex flex-wrap">
                        <button type="submit" class="text-white flex mx-auto flex-wrap  bottom-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">
                                ID Harga
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kota Asal
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kecamatan Asal
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kota Tujuan
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kecamatan Tujuan
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Layanan
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Harga
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Edit
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Edit</span>
                                Hapus
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hargas as $harga)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <h1 class="text-center">{{ $harga->id }}</h1>
                            </th>
                            <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <a href="/karyawan/{{ $harga->id }}">
                                    <h1>{{ $harga->cityFrom->NamaKota }}</h1>    
                                </a>
                            </th>
                            <td class="px-4 py-4">
                                <h1>{{ $harga->districtFrom->NamaKecamatan }}</h1>
    
                            </td>
                            <td class="px-4 py-4">
                                <h1>{{ $harga->cityTo->NamaKota }}</h1>
    
                            </td>
                            <td class="px-4 py-4">
                                <h1>{{ $harga->districtTo->NamaKecamatan }}</h1>
                            </td>
                            <td class="px-4 py-4">
                                <h1>{{ $harga->service->NamaLayanan }}</h1>
                            </td>
                            <td class="px-4 py-4">
                                <h1>Rp. {{ $harga->Harga }}</h1>
                            </td>
                            <td class="px-4 py-4">
                                <button><a href="{{ route('harga.update-view', $harga->id) }}">Edit</a></button>
                            </td>
                            <td class="px-4 py-4">
                                <form id="delete-form" action="{{ route('harga.hapus', $harga->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')">Hapus</button>
                                    
                                </form>
                            </td>
                        </tr>
                        @endforeach
    
                        
                    </tbody>
                </table>
                {{ $hargas->links() }}


            </div>
        </div>
    </div>


@endsection