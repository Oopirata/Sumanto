@extends('main')

@section('title', 'Buat Jadwal')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex">
        <x-side-bar></x-side-bar>
        <div id="main-content" class="my-8 relative text-black font-poppins w-full h-full overflow-y-auto">
            <div class="border-b-4"></div>
            <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center">
                    <!-- Sidebar -->
                    <div class=" bg-gray-800">
                        <h1 class="text-black font-bold items-center">Jadwal</h1>
                    </div>
                    
                    <!-- Main Content -->
                    <div>
                        <!-- Tambahkan margin di antara dropdown -->
                        <div class="flex  justify-between">
                            <div >
                                <x-jurusan></x-jurusan>
                            </div>
                            <div class="px-4  bg-white"> </div>
                            <div >
                                <x-jurusan></x-jurusan>
                            </div>
                            <div class="px-4  bg-white"> </div>
                            <div >
                                <x-jurusan></x-jurusan>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
