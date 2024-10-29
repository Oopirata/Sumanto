@extends('main')

@section('title', 'Dashboard')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex overflow-hidden">
        <x-side-bar-pa></x-side-bar-pa>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>

            <!-- Main content -->
            <div class="p-6">
                <!-- User Information Section in One Div -->
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <!-- Image, Name, and NIP horizontally aligned -->
                    <div class="flex items-center justify-start"> <!-- justify-start to align left -->
                        <div class="w-24 h-24 rounded-full overflow-hidden mr-10 ml-20"> <!-- Margin-right to space between image and text -->
                            <img src="path_to_image.jpg" alt="User Image" class="object-cover w-full h-full">
                        </div>

                        <div class="text-left ml-4"> <!-- Decreased margin-left for closer spacing -->
                            <h1 class="text-2xl font-bold">Dr.Eng. Mukidi Sukidi, S.Si., M.Kom.</h1>
                            <h1 class="text-gray-500">NIP: 2298976546789</h1>
                        </div>
                    </div>

                    <!-- Functional Position, Faculty, Study Program centered below -->
                    <div class="mt-6 flex justify-between text-center">
                        <div class="mx-4"> <!-- Added horizontal margin for spacing -->
                            <h1 class="text-gray-500">Jabatan Fungsional</h1>
                            <h1 class="font-bold">Sekretaris</h1>
                        </div>

                        <!-- Border between sections -->
                        <div class="border-x-2 border-gray-300 mx-4"></div> <!-- Added horizontal margin -->

                        <div class="mx-4"> <!-- Added horizontal margin for spacing -->
                            <h1 class="text-gray-500">Fakultas</h1>
                            <h1 class="font-bold">Sains dan Matematika</h1>
                        </div>

                        <!-- Border between sections -->
                        <div class="border-x-2 border-gray-300 mx-4"></div> <!-- Added horizontal margin -->

                        <div class="mx-4"> <!-- Added horizontal margin for spacing -->
                            <h1 class="text-gray-500">Program Studi</h1>
                            <h1 class="font-bold">Informatika</h1>
                        </div>
                    </div>
                </div>

                <!-- Schedule Section -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h1 class="text-lg font-semibold mb-4">Jadwal Hari Ini</h1>
                    <div>
                        <div class="bg-gray-200 grid grid-cols-3 px-4 py-2 font-bold">
                            <div>Mata Kuliah</div>
                            <div>Pertemuan Ke-</div>
                            <div>Detail Jadwal</div>
                        </div>
                        <div class="border-b grid grid-cols-3 px-4 py-2">
                            <div>Proyek Perangkat Lunak</div>
                            <div class="text-center">3</div>
                            <div>Selasa, 3 September 2024 <br> 07:00 - 09:30 <br> E101</div>
                        </div>
                        <div class="border-b grid grid-cols-3 px-4 py-2">
                            <div>Pembelajaran Mesin</div>
                            <div class="text-center">3</div>
                            <div>Selasa, 3 September 2024 <br> 10:00 - 12:30 <br> K102</div>
                        </div>
                        <div class="grid grid-cols-3 px-4 py-2">
                            <div>Pembelajaran Mesin</div>
                            <div class="text-center">3</div>
                            <div>Selasa, 3 September 2024 <br> 13:30 - 16:00 <br> K101</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
