<!-- resources/views/partial/kecamatan.blade.php -->
@if ($kecamatan->count() > 0)
    @foreach ($kecamatan as $kec)
      <option value="{{ $kec->id }}">{{ $kec->NamaKota }}</option>
    @endforeach
@else
  <p>Tidak ada data kecamatan yang ditemukan.</p>
  <option value="#"">Tidak ada data</option>

@endif
