{{-- @dd($karyawan) --}}
@extends('layouts.main')

@section('container')

@include('partials.navbar')


<h1>{{ $karyawan['id'] }}</h1>
<h1>{{ $karyawan['nama'] }}</h1>
<h1>{{ $karyawan['tanggal_lahir'] }}</h1>
<h1>{{ $karyawan['alamat'] }}</h1>



<a href="/karyawan">Back to Index</a>

@endsection
