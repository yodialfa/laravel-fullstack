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
        <div class="bg-gray-50 font-kanit pt-5 dark:bg-gray-900 px-3 rounded-xl w-full h-md">
            <h1>Edit Harga</h1>
            <form id="editHargaForm" action="{{ isset($hargaById['id']) ? route('harga.update', $hargaById['id']) : '' }}" method="post" class="">
            @csrf
            @method('PUT')

            <div class="grid mt-10 md:grid-cols-2 md:gap-6 border border-black border-4 py-6 px-3 rounded-xl">
                <div class="">
                    <label for="kotaasal" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Kota Asal</label>
                    <select name="kotaasal" id="kotaasal" class="py-2 px-3 border rounded-md w-full">
                        <option value="{{ $hargaById->cityFrom->id }}" selected>{{ $hargaById->cityFrom->NamaKota }} (Selected)</option>
                        @foreach($kotaasals as $kotas)
                        <option value="{{ $kotas['id'] }}">{{ $kotas['NamaKota'] }}</option>
                        @endforeach


                        {{-- @if ($kotaasals)
                            @foreach ($dataAll->kotaasals as $kotas)
                                <option value="{{ $kotas->id }}">{{ $kotas->NamaKota }}</option>
                            @endforeach
                        @else
                            <option value="">-- Pilih Kota --</option>
                        @endif --}}

                    </select>
                </div>

                <div>
                    <label for="kecasal" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Kecamatan Asal</label>
                    <select name="kecasal" id="kecasal" aria-placeholder="Pilih Kecamatan" class="py-2 px-3 border rounded-md w-full">
                        <option value="{{ $hargaById->IdKecAsal }}" selected>{{ $hargaById->districtFrom->NamaKecamatan }} (Selected)</option>
                        @foreach($kecasals as $kecamatan)
                            <option value="{{ $kecamatan['id'] }}">{{ $kecamatan['NamaKecamatan'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid mt-4 md:grid-cols-2 md:gap-6 border border-black border-4 py-6 px-3 rounded-xl">
                <div class="mb-6">
                    <label for="kotatujuan" class="block mb-2 text-xl w-full font-medium text-gray-900 dark:text-white">Kota Tujuan</label>
                    <select name="kotatujuan" id="kotatujuan" class="py-2 px-3 border w-full rounded-md">
                        {<option value="{{ $hargaById->cityTo->id }}" selected>{{ $hargaById->cityTo->NamaKota }} (Selected)</option>
                        @foreach($kotatujs as $kotuj)
                        <option value="{{ $kotuj['id'] }}">{{ $kotuj['NamaKota'] }}</option>
                        @endforeach --}}
                        @if ($kotaasals)
                        @foreach ($kotatujs as $tujs)
                            <option value="{{ $tujs['id'] }}">{{ $tujs['NamaKota'] }}</option>
                        @endforeach
                    @else
                        <option value="">-- Pilih Kota --</option>
                    @endif
                    </select>
                </div> 

                <div class="">
                    <label for="kectujuan" class="block mb-2 text-xl w-full font-medium text-gray-900 dark:text-white">Kec Tujuan</label>
                    <select name="kectujuan" id="kectujuan" class="py-2 px-3 border w-full rounded-md">
                        <option value="{{ $hargaById->districtTo->id }}" selected>{{ $hargaById->districtTo->NamaKecamatan }} (Selected)</option>
                        @foreach($kectujs as $kecamatan)
                            <option value="{{ $kecamatan['id'] }}">{{ $kecamatan['NamaKecamatan'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="grid mt-4 md:grid-cols-2 md:gap-6 border border-black py-6 border-4 px-3 rounded-xl">
                <div class="">
                    <label for="harga" class="block text-xl font-medium text-gray-900 dark:text-white">Layanan</label>
                
                    <select name="layanan" id="layanan" class="w-full  border rounded-md">
                        <option value="{{ $hargaById->IdLayanan }}" selected>{{ $hargaById->service->NamaLayanan }} (Selected)</option>
                        {{-- @foreach($layanan as $layan)
                        <option value="{{ $layan['id'] }}">{{ $layan['NamaLayanan'] }}</option>
                        @endforeach --}}

                        @if ($kotaasals)
                            @foreach ($layanan as $layan)
                                <option value="{{ $layan['id'] }}">{{ $layan['NamaLayanan'] }}</option>
                            @endforeach
                        @else
                            <option value="" selected>-- Pilih Kota --</option>
                        @endif
                    </select>
                </div>


                <div class="mb-6">
                    <label for="harga" class="block text-xl font-medium text-gray-900 dark:text-white">Harga</label>
                    <input type="text" name="harga" id="harga" class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('harga') is-invalid @enderror" value="{{ $hargaById->Harga }}" placeholder="" required >
                    @error('cityNow')
                    <div>
                        {{ $message }}
                    </div>
                    @enderror
                </div> 
            </div>

            <div class="flex justify-center mt-4">
                <div class="flex space-x-4 mx-auto">
                    <button type='submit' class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Submit</button>
                    <button class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-4 rounded"><a href="{{ route('harga.index') }}">Cancel</a></button>
                </div>
            </div>
            

            </form>

            </div>
        </div>

    </div>
</div>

  @endsection