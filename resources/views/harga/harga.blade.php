@extends('layouts.main')

@section('container')

@include('partials.navbar')

<div class="container mx-auto h-screen p-4 text-white">

    
    @foreach ($prices as $price)
    {{-- <h1> {{ $price->id }}</h1> --}}
    <h1> {{ $price->cityFrom->NamaKota }}</h1>
    <h1> {{ $price->districtFrom->NamaKecamatan }}</h1>
    <h1> {{ $price->cityTo->NamaKota }}</h1>
    <h1> {{ $price->service->NamaLayanan }}</h1>
    <h1> {{ $price->Harga }}</h1>
    
    @endforeach
</div>


@endsection
