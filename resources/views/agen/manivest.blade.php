@extends('layouts.main')
<div class="fixed top-0 z-50 w-full bg-cyan-400">
    @include('partials.navbar')
</div>
@include('partials.sidebar')
@section('container')
{{-- session alert jika berhasil registrasi --}}

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-20">
        <div class="relative overflow-x-auto bg-white shadow-md sm:rounded-lg min-h-full">
            




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

            <div class="bg-white w-full table-auto mb-3">
                <h1 class="text-center text-3xl">Data Transaksi</h1>
            </div>


            {{-- <form class="flex items-center justify-center mx-auto gap-2">   
              
                <div class="flex flex-wrap">
                    <input type="search" id="search" name="search" class=" flex flex-wrap mx-auto w-13 p-2  justify-center ps-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Karyawan.." value="{{ request('search') }}" required>
                </div>
                <div  class="flex flex-wrap">
                    <button type="submit" class="text-white flex mx-auto flex-wrap  bottom-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form> --}}

            
        @if ($transaksis->count() != 0)
            <form id="get-manivest" action="{{ route('agen.shipment') }}" method="POST">     
                @csrf  
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-4 py-3">
                                No
                            </th>
                            <th scope="col" class="px-4 py-3">
                                <input id="get-all" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </th>
                            <th scope="col" class="px-4 py-3">
                                No Resi
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Nama Pengirim
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Nama Penerima
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kota Asal
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kec Asal
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kota Tujuan
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Kec Tujuan
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Layanan
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Berat
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Koli
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Diskon
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Biaya Surat
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Asuransi
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Total Harga
                            </th>
                            <th scope="col" class="px-4 py-3">
                                User
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @foreach ($transaksis as $transaksi)
                        <tr>
                            <td scope="col" class="px-4 py-3">
                                {{ $no++ }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                <input id="default-checkbox" name="no_resi[]" type="checkbox" value="{{ $transaksi['no_resi'] }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 checkbox-item">
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi['no_resi'] }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->nama_pengirim }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->nama_penerima }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->kotaAsal->NamaKota }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->kecAsal->NamaKecamatan }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->kotaTujuan->NamaKota }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->kecTujuan->NamaKecamatan }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->serviceId->NamaLayanan }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->berat }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->jumlah }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->diskon }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->biaya_surat }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->biaya_asuransi }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->total_harga }}
                            </td>
                            <td scope="col" class="px-4 py-3">
                                {{ $transaksi->userId->username }}
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
                @endif
                <div class="flex justify-center items-center">
                    <button type="submit" onclick="return confirm('Apakah sudah yakin ?')" id="submitBtn" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-3">Buat Manivest</button>
                </div>

                {{-- <button type="submit" onclick="return confirm('Are you sure?')">Buat Manivest</button> --}}

            </div>
        </form>
        
        
        

    </div>

    

</div>
<script>
    document.getElementById('get-all').addEventListener('change', function () {
        // Ambil semua elemen checkbox dengan class 'checkbox-item'
        var checkboxes = document.querySelectorAll('.checkbox-item');

        // Setel properti 'checked' pada setiap checkbox sesuai dengan status checkbox 'select all'
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = this.checked;
        }, this);
    });
</script>



@endsection
