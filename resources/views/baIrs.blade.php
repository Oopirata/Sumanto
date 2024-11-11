@extends('main')

@section('title', 'Bagian Akademik IRS')

@section('page')
<div class="bg-gray-100 h-screen flex flex-col">
    <div class="flex overflow-hidden">
        <x-side-bar-ba></x-side-bar-ba>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>
            <div class="border-b-4"></div>
            
            <!-- Konten Utama -->
            <div class="mx-8 bg-white py-16 px-8 rounded-2xl mt-8 shadow-lg">
                
                <!-- Bagian Dropdown (Div Terpisah) -->
                <div class="mb-8 grid grid-cols-3 gap-2">
                    
                    <!-- Dropdown Strata dengan Alpine.js -->
                    <div x-data="{ open: false, selected: 'S1' }" class="relative">
                        <button @click="open = !open" class="bg-blue-600 text-white px-4 py-2 rounded-full flex items-center justify-between w-40">
                            <span x-text="selected"></span>
                            <svg class="w-4 h-4 transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false" x-transition class="absolute mt-2 w-40 bg-white rounded-md shadow-lg z-10">
                            <ul class="py-2">
                                <li><button @click="selected = 'S1'; open = false" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">S1</button></li>
                                <li><button @click="selected = 'S2'; open = false" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">S2</button></li>
                                <li><button @click="selected = 'S3'; open = false" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">S3</button></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Dropdown Jurusan dengan Alpine.js -->
                    <div x-data="{ open: false, selected: 'Informatika' }" class="relative">
                        <button @click="open = !open" class="bg-blue-600 text-white px-4 py-4 rounded-full flex items-center justify-between w-40">
                            <span x-text="selected"></span>
                            <svg class="w-4 h-4 transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false" x-transition class="absolute mt-2 w-40 bg-white rounded-md shadow-lg z-10">
                            <ul class="py-2">
                                <li><button @click="selected = 'Informatika'; open = false" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Informatika</button></li>
                                <li><button @click="selected = 'Sistem Informasi'; open = false" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Sistem Informasi</button></li>
                                <li><button @click="selected = 'Teknik Elektro'; open = false" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Teknik Elektro</button></li>
                                <li><button @click="selected = 'Teknik Mesin'; open = false" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Teknik Mesin</button></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Dropdown Semester dengan Alpine.js -->
                    <div x-data="{ open: false, selected: '2024' }" class="relative">
                        <button @click="open = !open" class="bg-blue-600 text-white px-4 py-2 rounded-full flex items-center justify-between w-40">
                            <span x-text="selected"></span>
                            <svg class="w-4 h-4 transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false" x-transition class="absolute mt-2 w-40 bg-white rounded-md shadow-lg z-10">
                            <ul class="py-2">
                                <li><button @click="selected = '2021'; open = false" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">2021</button></li>
                                <li><button @click="selected = '2022'; open = false" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">2022</button></li>
                                <li><button @click="selected = '2023'; open = false" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">2023</button></li>
                                <li><button @click="selected = '2024'; open = false" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">2024</button></li>
                            </ul>
                        </div>
                    </div>

                </div>

                <!-- Pemisah antara Dropdown dan Tabel -->
                <div class="my-8 border-b-2"></div>
                
                <!-- Bagian Tabel -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border rounded-lg shadow-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-6 text-left text-sm font-medium text-gray-600">NO</th>
                                <th class="py-3 px-6 text-left text-sm font-medium text-gray-600">Nama</th>
                                <th class="py-3 px-6 text-left text-sm font-medium text-gray-600">NIM</th>
                                <th class="py-3 px-6 text-center text-sm font-medium text-gray-600">Aksi</th>
                                <th class="py-3 px-6 text-center text-sm font-medium text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $dataMahasiswa = [
                                    ['nama' => 'Muhammad Mirza Faiz Rabbani', 'nim' => '24060122140127', 'status' => 'Disetujui'],
                                    ['nama' => 'Bintang Syafrian Rizal', 'nim' => '24060122120031', 'status' => 'Ditolak'],
                                    ['nama' => 'Hanif Heroifa', 'nim' => '24060122120015', 'status' => 'Diproses'],
                                    ['nama' => 'Raka Maulana Yusuf', 'nim' => '24060122140119', 'status' => 'Disetujui'],
                                    ['nama' => 'Awang Pratama Putra Mulya', 'nim' => '24060122120039', 'status' => 'Ditolak'],
                                    ['nama' => 'Dul Samsi', 'nim' => '24060122122056', 'status' => 'Disetujui'],
                                ];
                            @endphp

                            @foreach($dataMahasiswa as $index => $mhs)
                            <tr class="border-b">
                                <td class="py-4 px-6 text-sm">{{ $index + 1 }}</td>
                                <td class="py-4 px-6 text-sm">{{ $mhs['nama'] }}</td>
                                <td class="py-4 px-6 text-sm">{{ $mhs['nim'] }}</td>
                                <td class="py-4 px-6 text-center">
                                    <button class="bg-gray-200 text-gray-600 py-1 px-4 rounded-lg hover:bg-gray-300">Detail</button>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    @if ($mhs['status'] == 'Disetujui')
                                    <span class="bg-green-200 text-green-700 py-1 px-4 rounded-full">Disetujui</span>
                                    @elseif ($mhs['status'] == 'Ditolak')
                                    <span class="bg-red-200 text-red-700 py-1 px-4 rounded-full">Ditolak</span>
                                    @else
                                    <span class="bg-yellow-200 text-yellow-700 py-1 px-4 rounded-full">Diproses</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Tombol Update -->
                <div class="flex justify-end mt-6">
                    <button class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-700 transition-all">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
