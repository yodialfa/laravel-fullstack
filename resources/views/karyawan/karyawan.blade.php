@extends('layouts.main')
<div class="fixed top-0 z-50 w-full bg-cyan-400">
    @include('partials.navbar')
</div>
@include('partials.sidebar')
@section('container')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-20">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Karyawan ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Karyawan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alamat Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tempat Lahir
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tangggal Lahir
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawans as $karyawan)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <h1>{{ $karyawan->id }}</h1>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="/karyawan/{{ $karyawan->id }}">
                                <h1>{{ $karyawan->nama }}</h1>    
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            <h1>{{ $karyawan->email }}</h1>

                        </td>
                        <td class="px-6 py-4">
                            <h1>{{ $karyawan->tempat_lahir }}</h1>

                        </td>
                        <td class="px-6 py-4">
                            <h1>{{ $karyawan->tanggal_lahir }}</h1>
                        </td>
                        <td class="px-6 py-4">
                            <h1>{{ $karyawan->alamat }}</h1>
                        </td>
                        <td class="px-6 py-4">
                            {{-- <script>console.log({{ dd($karyawan) }})</script> --}}
                            <h1>{{ optional($karyawan->user)->username ?? 'N/A' }}</h1>
                            {{-- <h1>{{ $karyawan->user->username }}</h1> --}}

                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('karyawan.update', $karyawan->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                    @endforeach

                    
                </tbody>
            </table>
        </div>
        
        

    </div>

    

</div>

@endsection
