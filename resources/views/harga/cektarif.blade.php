@extends('layouts.main')

@section('container')

@include('partials.navbar')
<div class="w-full h-full ">
    <div class="container flex flex-wrap p-4 gap-3  h-screen justify-center mx-auto">

        <div class="mt-4">
            <select name="pilihan" id="kotaasal" class="w-1/7 py-2 px-3 border rounded-md">
                <option value="" selected>-- Pilih Kota --</option>
                @foreach($kotaasals as $kotas)
                <option value="{{ $kotas->id }}">{{ $kotas->NamaKota }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-4">
            <select name="pilihan" id="kecasal" aria-placeholder="Pilih Kecamatan" class="w-2/7 py-2 px-3 border rounded-md">
                <option value="#">Pilih Kecamatan</option>
            </select>
        </div>
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
                <option value="#">Pilih Kecamatan</option>
            </select>
        </div><div class="mt-4">
            <select name="pilihan" class="w-1/7 py-2 px-3 border rounded-md">
                @foreach($layanan as $layan)
                <option value="{{ $layan->id }}">{{ $layan->NamaLayanan }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
@endsection
