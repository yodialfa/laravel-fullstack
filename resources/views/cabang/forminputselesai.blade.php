@extends('layouts.main')

<div class="fixed top-0 z-50 w-full bg-cyan-400">
    <div class="hidden w-full lg:block md:w-auto" id="navbar-dropdown">
        @include('partials.navbar')
    </div>
</div>
@include('partials.sidebar')
@section('container')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-4 md:mt-20">
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
            @elseif(session()->has('error'))
                <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <!-- Add the SVG path for the error icon -->
                    </svg>
                    <span class="sr-only">Error</span>
                    <div class="ml-3 text-sm font-medium">
                        Error, {{ session('error') }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif

            <div class="bg-white w-full table-auto mb-3">
                <h1 class="text-center text-3xl">Update Selesai Pengantaran</h1>
            </div>

            {{-- <form id="shipmentForm" method="get" onsubmit="return false;"">
                @csrf
                <label for="gen_resi">Input No. Resi :</label>
                <input type="text" name="gen_resi" id="gen_resi" required>
                     
                <button type="button" id="submitBtn">Cari Data</button>
            </form> --}}

            <form action="{{ route('pengantaran-resiselesai', $resi) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid mt-3 md:grid-cols-2 md:gap-6 border border-black border-1 py-6 px-3 rounded-xl">
                    <label for="no_resi">No Resi</label>
                    <input type="text" id="get_resi" name="get_resi" value="{{ $resi }}" readonly>
                </div>
                <div class="grid mt-3 md:grid-cols-2 md:gap-6 border border-black border-1 py-6 px-3 rounded-xl">
                    <label for="status">Status</label>
                    <select name="selectStatus" id="selectStatus" class="@error('selectStatus') is-invalid @enderror">
                        <option value="" selected>--Pilih Status--</option>
                        <option value="0">Penerima tidak ditempat/ Antar ulang</option>
                        <option value="1">Diterima oleh yang bersangkutan</option>
                        <option value="2">Diterima oleh keluarga, tetangga dll</option>
                    </select>
                    @error('selectStatus')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="grid mt-3 md:grid-cols-2 md:gap-6 border border-black border-1 py-6 px-3 rounded-xl">
                    <label for="photo">Pilih Foto:</label>
                    <input type="file" name="photo" id="photo" accept="image/*">
                </div>
                <div class="grid mt-3 md:grid-cols-2 md:gap-6 border border-black border-1 py-6 px-3 rounded-xl">
                    <label for="penerima">Nama Penerima</label>
                    <input type="text" id="penerima" name="penerima">
                </div>
                {{-- <button type="submit">Update</button> --}}
                <div class="flex items-center justify-center mt-5">
                   <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
                    
                    {{-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button> --}}
                </div>
                
            </form>


            
            


        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#selectStatus').on('change', function () {
            var selectedStatus = $(this).val();
            
            if (selectedStatus === '0' || selectedStatus === '') {
                // Disable file input and text input
                $('#photo').prop('disabled', true);
                $('#penerima').prop('disabled', true);
            } else {
                // Enable file input and text input
                $('#photo').prop('disabled', false);
                $('#penerima').prop('disabled', false);
            }
        });
    });
</script>

@endsection