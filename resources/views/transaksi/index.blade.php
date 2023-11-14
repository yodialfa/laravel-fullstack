@extends('layouts.main')
<div class="fixed top-0 z-50 w-full bg-cyan-400">
    @include('partials.navbar')
</div>
@include('partials.sidebar')
@section('container')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-20">
       {{-- <div class="grid grid-cols-3 gap-4 mb-4"> --}}
        <div class="container mx-auto max-w-full min-h-full flex flex-col ">
            
            
            
            <div class="bg-gray-50 font-kanit dark:bg-gray-900 px-3 mt-4 rounded-xl w-full h-md">
            <h1 class="text-center text-2xl">Resi</h1>
            <form id="formTrx" action="{{ route('transaksi.store') }}" method="post" class="">
            @csrf

            <div class="grid mt-3 md:grid-cols-2 md:gap-6 border border-black border-1 py-6 px-3 rounded-xl">
            {{-- <div class="mb-3"> --}}
                <label for="no_resi" class="block w-1/3 mb-2 text-sm font-medium text-gray-900 dark:text-white">No. Resi</label>
                <input type="text" id="no_resi" name="no_resi" class="bg-gray-50 border w-2/3 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('no_resi') is-invalid @enderror" placeholder="No resi" readonly>
                @error('no_resi')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="grid mt-3 md:grid-cols-2 md:gap-6 border border-black border-1 py-6 px-3 rounded-xl">
                {{-- <div class="flex gap-3 "> --}}
                <div class="">
                    <div class="w-full">
                        <label for="phone-input-pengirim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. Pengirim</label>
                        <input type="text" id="phone-input-pengirim" name="phone-input-pengirim" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('name') is-invalid @enderror" placeholder="Phone Number" required value="{{ old('phone-input-pengirim') }}">
                        @error('phone-input-pengirim')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="w-full mb-3">
                        <label for="nama-pengirim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pengirim</label>
                        <input type="text" id="nama-pengirim" name="nama-pengirim" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('nama-pengirim') is-invalid @enderror"" placeholder="john.doe@company.com" required value="{{ old('nama-pengirim') }}">
                        @error('nama-pengirim')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="w-full mb-3">
                        <label for="alamat-pengirim" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Penerima</label>
                        <textarea type="textarea" name="alamat-pengirim" id="alamat-pengirim" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('alamat-pengirim') is-invalid @enderror" placeholder="Alamat Pengirim" required >
                        </textarea>
                        @error('alamat-pengirim')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div> 
                </div>


                <div class="">
                    <div class="w-full">
                        <label for="phone-input-penerima" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. Pengirim</label>
                        <input type="text" id="phone-input-penerima" name="phone-input-penerima" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('name') is-invalid @enderror" placeholder="Phone Number" required value="{{ old('phone-input-penerima') }}">
                        @error('phone-input-penerima')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="w-full mb-3">
                        <label for="nama-penerima" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Pengirim</label>
                        <input type="text" id="nama-penerima" name="nama-penerima" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('nama-penerima') is-invalid @enderror"" placeholder="john.doe@company.com" required value="{{ old('nama-pengirim') }}">
                        @error('nama-penerima')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="w-full mb-3">
                        <label for="alamat-penerima" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Penerima</label>
                        <textarea type="textarea" name="alamat-penerima" id="alamat-penerima" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('alamat-penerima') is-invalid @enderror" placeholder="Alamat Pengirim" required >
                        </textarea>
                        @error('alamat-penerima')
                        <div>
                            {{ $message }}
                        </div>
                        @enderror
                    </div> 
                </div>
            </div>

            <div class="grid mt-3 md:grid-cols-2 md:gap-6 border border-black border-1 py-6 px-3 rounded-xl">
                <div class="">
                    <label for="kotaasal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota Asal</label>
                    <select name="kotaasal" id="kotaasal" class=" px-3 border rounded-md w-full">
                        <option value="" selected>-- Pilih Kota --</option>
                        @foreach($kotaasals as $kotas)
                        <option value="{{ $kotas['id'] }}">{{ $kotas['NamaKota'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="kecasal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan Asal</label>
                    <select name="kecasal" id="kecasal" aria-placeholder="Pilih Kecamatan" class="py-2 px-3 border rounded-md w-full">
                        <option value="#">--Pilih Kecamatan--</option>
                    </select>
                </div>
            </div>

            <div class="grid mt-3 md:grid-cols-2 md:gap-6 border border-black border-1 py-6 px-3 rounded-xl">
                <div class="mb-6">
                    <label for="kotatujuan" class="block mb-2 text-sm w-full font-medium text-gray-900 dark:text-white">Kota Tujuan</label>
                    <select name="kotatujuan" id="kotatujuan" class="py-2 px-3 border w-full rounded-md">
                        <option value="" selected>-- Pilih Kota --</option>
                        @foreach($kotatujs as $kotuj)
                        <option value="{{ $kotuj['id'] }}">{{ $kotuj['NamaKota'] }}</option>
                        @endforeach
                    </select>
                </div> 

                <div class="">
                    <label for="kectujuan" class="block mb-2 text-sm w-full font-medium text-gray-900 dark:text-white">Kec Tujuan</label>
                    <select name="kectujuan" id="kectujuan" class="py-2 px-3 border w-full rounded-md">
                        <option value="#">--Pilih Kecamatan--</option>
                    </select>
                </div>
            </div>

            <div class="">
                <label for="layanan" class="block text-xl font-medium text-gray-900 dark:text-white">Layanan</label>
            
                <select name="layanan" id="layanan" class="w-full  border rounded-md">
                    <option value="" selected>--Pilih Layanan--</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service['NamaLayanan'] }}</option>
                    @endforeach

                    {{-- @if ($kotaasals)
                        @foreach ($layanan as $layan)
                            <option value="{{ $layan['id'] }}">{{ $layan['NamaLayanan'] }}</option>
                        @endforeach
                    @else
                        <option value="" selected>-- Pilih Kota --</option>
                    @endif --}}
                </select>
            </div>

            <div class="mb-6">
                <label for="jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Koli</label>
                <input type="text" id="jumlah" name="jumlah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('jumlah') is-invalid @enderror"" placeholder="" required value="{{ old('jumlah') }}">
                @error('jumlah')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="berat" class="proc block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berat / Volume</label>
                <input type="text" id="berat" name="berat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('berat') is-invalid @enderror"" placeholder="" required value="{{ old('berat') }}">
                @error('berat')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="harga" class="proc block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga per kg</label>
                <input type="text" id="harga" name="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('harga') is-invalid @enderror"" placeholder="" required value="{{ old('harga') }}" readonly>
                @error('harga')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="diskon" class="proc block mb-2 text-sm font-medium text-gray-900 dark:text-white">Diskon</label>
                <input type="text" id="diskon" name="diskon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('diskon') is-invalid @enderror"" placeholder="" required value="{{ old('diskon') }}">
                @error('diskon')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="biaya_surat" class="proc block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biaya Surat</label>
                <input type="text" id="biaya_surat" name="biaya_surat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('biaya_surat') is-invalid @enderror"" placeholder="" required value="{{ old('biaya_surat') }}">
                @error('biaya_surat')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="jenis_barang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Barang</label>
                <input type="text" id="jenis_barang" name="jenis_barang" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('jenis_barang') is-invalid @enderror"" placeholder="" required value="{{ old('jenis_barang') }}">
                @error('jenis_barang')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="total_harga" class="proc block mb-2 text-sm font-medium text-gray-900 dark:text-white">Asuransi</label>
                <input type="text" id="biaya_asuransi" name="biaya_asuransi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('biaya_asuransi') is-invalid @enderror"" placeholder="" required value="{{ old('biaya_asuransi') }}">
                @error('biaya_asuransi')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-6">
                <label for="total_harga" class="proc block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Bayar</label>
                <input type="text" id="total_harga" name="total_harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('total_harga') is-invalid @enderror"" placeholder="" required value="{{ old('total_harga') }} " readonly>
                @error('total_harga')
                <div>
                    {{ $message }}
                </div>
                @enderror
            </div>
{{-- 
            <div class="mb-6">
                <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('tanggal_lahir') is-invalid @enderror" placeholder="" required >
                @error('tanggal_lahir')
                <div>
                    {{ $message }}
                </div>
            @enderror
            </div> 

            <div class="mb-6">
                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('alamat') is-invalid @enderror" placeholder="Alamat Lengkap" required >
                @error('alamat')
                <div>
                    {{ $message }}
                </div>
            @enderror
            </div> 
            --}}

            <div class="flex items-center justify-center gap-3">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 flex">Submit</button>
                <button type="button" class="focus:outline-none text-white bg-red-700  hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><a href="{{ route('karyawan') }}">Batal</a></button>
            </div> 

            </form>

            </div>
        </div>
    </div>
</div>

@endsection