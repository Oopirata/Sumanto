@extends('main')

@section('title', 'Dashboard')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col font-poppins">
    <div class="flex overflow-hidden">
        <x-side-bar-pa :dosens="$dosens"></x-side-bar-pa>
        <div id="main-content" class="relative text-black ml-64 w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>

            <!-- Main content -->
            <div class="mx-8 rounded-2xl mt-8">
                <!-- User Information Section in One Div -->
                <div class="bg-white rounded-lg shadow p-8 mb-6">
                    <!-- Image, Name, and NIP in a Row -->
                    <div class="flex justify-center items-center">
                        <!-- User Image -->
                        <div class="w-32 h-32 rounded-full mr-12">
                            <img src="path_to_image.jpg" alt="User Image" class="object-cover w-full h-full">
                        </div>
                        <!-- Name and NIP -->
                        <div class="flex flex-col items-center">
                            <h1 class="text-2xl font-bold">Dr.Eng. Mukidi Sukidi, S.Si., M.Kom.</h1>
                            <h1 class="text-gray-500">NIP: 2298976546789</h1>
                        </div>
                    </div>

                    <!-- Functional Position, Faculty, Study Program in a Grid aligned with Schedule -->
                    <div class="grid grid-cols-3 divide-x divide-black text-center font-bold py-2">
                        <div class="px-4">
                            <h1 class="text-gray-500 mb-1">Jabatan Fungsional</h1>
                            <h1 class="font-bold">Sekretaris</h1>
                        </div>
                        <div class="px-4">
                            <h1 class="text-gray-500 mb-1">Fakultas</h1>
                            <h1 class="font-bold">Sains dan Matematika</h1>
                        </div>
                        <div class="px-4">
                            <h1 class="text-gray-500 mb-1">Program Studi</h1>
                            <h1 class="font-bold">Informatika</h1>
                        </div>
                    </div>
                </div>

                <!-- Schedule Section -->
                <div class="bg-white rounded-lg shadow p-8">
                    <h1 class="text-lg font-semibold mb-4">Jadwal Hari Ini</h1>
                    <div class="grid grid-cols-3 divide-x divide-black text-center bg-gray-100 font-bold py-2">
                        <div>Mata Kuliah</div>
                        <div>Pertemuan Ke-</div>
                        <div>Detail Jadwal</div>
                    </div>
                    <!-- Jadwal List -->
                    <div class="divide-y">
                        <div class="grid grid-cols-3 py-2">
                            <div class="text-center">Proyek Perangkat Lunak</div>
                            <div class="text-center">3</div>
                            <div class="text-center">
                                Selasa, 3 September 2024 <br> 07:00 - 09:30 <br> E101
                            </div>
                        </div>
                        <div class="grid grid-cols-3 py-2">
                            <div class="text-center">Pembelajaran Mesin</div>
                            <div class="text-center">3</div>
                            <div class="text-center">
                                Selasa, 3 September 2024 <br> 10:00 - 12:30 <br> K102
                            </div>
                        </div>
                        <div class="grid grid-cols-3 py-2">
                            <div class="text-center">Pembelajaran Mesin</div>
                            <div class="text-center">3</div>
                            <div class="text-center">
                                Selasa, 3 September 2024 <br> 13:30 - 16:00 <br> K101
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
