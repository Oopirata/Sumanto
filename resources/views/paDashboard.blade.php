@extends('main')

@section('title', 'Dashboard')

@section('page')
    <div class="bg-gray-100 min-h-screen flex flex-col font-poppins">
        <div class="flex overflow-hidden">
            <x-side-bar-pa :dosen="$dosen" :dosens="$dosens"></x-side-bar-pa>
            <div id="main-content" class="relative text-black ml-64 w-full h-full overflow-y-auto">
                <x-nav-bar :dosen="$dosen" :dosens="$dosens"></x-nav-bar>

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
                                <h1 class="text-2xl font-bold">{{ $dosen->nama ?? 'Nama Tidak Ditemukan' }}</h1>
                                <h1 class="text-gray-500">{{ $dosen->nip ?? 'NIP Tidak Tersedia' }}</h1>
                            </div>
                        </div>

                        <!-- Functional Position, Faculty, Study Program in a Grid aligned with Schedule -->
                        <div class="grid grid-cols-2 divide-x divide-black text-center font-bold py-2">
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
                        <!-- Header row -->
                        <div class="grid grid-cols-4 divide-x divide-black text-center bg-gray-100 font-bold py-2">
                            <div>Mata Kuliah</div>
                            <div>Jam</div>
                            <div>Ruang</div>
                            <div>Kelas</div>
                        </div>
                        <!-- Content rows -->
                        <div class="divide-y">
                            @forelse ($jadwals as $jadwal)
                                <div class="grid grid-cols-4 py-2"> <!-- Changed from grid-cols-5 to grid-cols-4 -->
                                    <div class="text-center">{{ $jadwal->nama_mk }}</div>
                                    <div class="text-center">
                                        {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                    </div>
                                    <div class="text-center">{{ $jadwal->ruang }}</div>
                                    <div class="text-center">{{ $jadwal->kelas }}</div>
                                </div>
                            @empty
                                <div class="text-center py-4">Tidak ada jadwal hari ini.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
