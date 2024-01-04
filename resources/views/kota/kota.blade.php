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
                <h1 class="text-center text-3xl">Daftar Kota</h1>
            </div>

            <div class="bg-white w-full table-auto mb-3 flex justify-center">
                <button class="w-1/4 flex justify-center rounded-full bg-gray-500"><a class="w-full" href="{{ route('kota.add') }}">Tambah Kota</a></button>
            </div>

            <form class="flex items-center justify-center mx-auto gap-2">   
              
                <div class="flex flex-wrap">
                    <input type="search" id="search" name="search" class=" flex flex-wrap mx-auto w-13 p-2  justify-center ps-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Kota.." value="{{ request('search') }}" required>
                </div>
                <div  class="flex flex-wrap">
                    <button type="submit" class="text-white flex mx-auto flex-wrap  bottom-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
                        
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ml-1 mr-2">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-center">
                            Kota ID
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Nama Kota
                        </th>
                        <th scope="col" class="px-4 py-3 text-center">
                            <span class="sr-only">Edit</span>
                            Edit
                        </th>
                        <th scope="col" class="px-4 py-3 text-center">
                            <span class="sr-only">Hapus</span>
                            Hapus
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <h1 class="text-center">{{ $city->id }}</h1>
                        </th>
                        <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="/karyawan/detail/{{ $city->id }}">
                                <h1>{{ $city->NamaKota }}</h1>    
                            </a>
                        </th>
                        <td class="px-4 py-4 text-right w-3 text-center">
                            <a href="{{ route('kota.update-view', $city->id ) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">

                                <svg class="h-5 w-5 text-gray-500 item-cente" <svg  width="4"  height="4"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" /></svg>
                                {{-- >Edit</a> --}}
                            </a>
                        </td>
                        <td class="px-4 py-4 text-right w-3 text-center">
                            
                            <form id="delete-form" action="{{ route('kota.hapus', $city->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')">

                                    <a class="w-full">
                                        <svg class="h-4 w-4 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z" />  <line x1="18" y1="9" x2="12" y2="15" />  <line x1="12" y1="9" x2="18" y2="15" /></svg>
                                    </a>
                                    
                                </button>
                                </form>
                        </td>

                    </tr>
                    @endforeach

                    
                </tbody>
            </table>
            {{ $cities->links() }}

        </div>
        
        

    </div>

    

</div>


@endsection