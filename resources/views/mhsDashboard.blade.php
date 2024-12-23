@extends('main')

@section('title', 'Dashboard')

@section('page')
    <div class="bg-gray-100 min-h-screen flex flex-col">
        <div class="flex overflow-hidden">
            <x-side-bar-mhs :mahasiswa="$mahasiswa"></x-side-bar-mhs>
            <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
                <x-nav-bar :mahasiswa="$mahasiswa" :user="$user"></x-nav-bar>
                <div class="mx-8 bg-white py-8 px-6 rounded-2xl mt-8">
                    <div class="grid grid-cols-3 justify-center font-bold">
                        <div class="text-center">
                            <h1>Status Akademik</h1>
                            <div class="bg-[#4BD37B] text-white py-2 rounded-3xl mx-[35%] mt-2">
                                <h1>Aktif</h1>
                            </div>
                        </div>
                        <div class="text-center">
                            <h1>IP Kumulatif</h1>
                            <div class="bg-[#000CB0] text-white py-2 rounded-3xl mx-[35%] mt-2">
                                <h1>{{ number_format($mahasiswa->IPK, 2) }}</h1>
                            </div>
                        </div>
                        <div class="text-center">
                            <h1>SKSk</h1>
                            <div class="bg-[#C8AB1C] text-white py-2 rounded-3xl mx-[35%] mt-2">
                                <h1>{{ $totalSks }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white mt-8 mx-8 px-6 py-8 rounded-2xl">
                    <div class="mb-3">
                        <h1 class="font-bold text-xl">Informasi Akademik</h1>
                        <h1 class="text-green-500">Mahasiswa Aktif</h1>
                    </div>
                    <div class="text-center font-bold">
                        <h1>Dosen Wali: {{ $dosenWali->nama }}</h1>
                        <h1>NIP : {{ $dosenWali->nip }}</h1>
                    </div>
                    <div class="grid grid-cols-3 mt-8">
                        <div class="text-center">
                            <h1>Semester Akademik Sekarang</h1>
                            <h1 class="font-extrabold text-xl">2024/2025 Ganjil</h1>
                        </div>
                        <div class="text-center border-x-black border-x-2">
                            <h1>Semester Studi</h1>
                            <h1 class="font-extrabold text-xl">{{ $mahasiswa->semester }}</h1>
                        </div>
                        <div class="text-center">
                            <h1>IP Semester</h1>
                            <h1 class="font-extrabold text-xl">3.77</h1>
                        </div>
                    </div>
                </div>
                <div class="flex mx-2 mt-8 px-6 gap-10">
                    <div class="w-[75%]">
                        <h1 class="font-extrabold text-xl">Jadwal Hari ini</h1>
                        <div class="bg-white rounded-2xl py-6 my-4">
                            <table class="text-center w-[100%]">
                                <thead>
                                    <tr>
                                        <th>Mata Kuliah</th>
                                        <th>Pertemuan Ke-</th>
                                        <th>Detail Jadwal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="pt-6">Proyek Perangkat Lunak</td>
                                        <td class="pt-6">3</td>
                                        <td class="pt-6">
                                            <h1>07.00 - 09.30</h1>
                                            <h1>K202</h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-6">Pengembangan Berbasis Platform</td>
                                        <td class="pt-6">4</td>
                                        <td class="pt-6">
                                            <h1>07.00 - 09.30</h1>
                                            <h1>E101</h1>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="w-[25%] h-full">
                        <h1 class="text-xl font-extrabold">Pengumuman</h1>
                        <div class="bg-white rounded-2xl py-6 my-4 h-full">
                            <img src="/images/poster.jpeg" alt="Poster Pengumuman"
                                class="max-w-[80%] h-auto mx-auto rounded-lg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
