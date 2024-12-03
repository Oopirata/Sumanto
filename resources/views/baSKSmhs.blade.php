@extends('main')

@section('title', 'SKS Mahasiswa')

@section('page')
<div class="bg-gray-100 h-screen flex flex-col">
    <div class="flex overflow-hidden">
        <x-side-bar-ba :dosen="$dosen" :dosens="$dosens"></x-side-bar-ba>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar :dosens="$dosens" :dosen="$dosen"></x-nav-bar>
            <div class="border-b-4"></div>
            <div class="bg-white px-4 py-8 rounded-xl mx-8 mt-8 flex items-center justify-between">
                <div class="font-semibold text-xl">SKS Mahasiswa</div>
                <!-- Dropdown Section (Right aligned) -->
                <div class="flex space-x-4 items-center">
                    <div>
                        <div x-data="{ open: false, selected: 'Strata' }" class="relative">
                            <button @click="open = !open" class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center justify-between w-40">
                                <span x-text="selected"></span>
                                <svg class="w-4 h-4 transform transition-transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Dropdown menu with smooth transition -->
                            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute mt-2 w-40 bg-white rounded-md shadow-lg z-10">
                                <ul class="py-2">
                                    <li><button @click="selected = 'S1'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">S1</button></li>
                                    <li><button @click="selected = 'S2'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">S2</button></li>
                                    <li><button @click="selected = 'S3'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">S3</button></li>
                                    <li><button @click="selected = 'D3'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">D3</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div x-data="{ open: false, selected: 'Jurusan' }" class="relative">
                            <button @click="open = !open" class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center justify-between w-40">
                                <span x-text="selected"></span>
                                <svg class="w-4 h-4 transform transition-transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Dropdown menu with smooth transition -->
                            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute mt-2 w-40 bg-white rounded-md shadow-lg z-10">
                                <ul class="py-2">
                                    <li><button @click="selected = 'Informatika'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">Informatika</button></li>
                                    <li><button @click="selected = 'Fisika'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">Fisika</button></li>
                                    <li><button @click="selected = 'Kimia'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">Kimia</button></li>
                                    <li><button @click="selected = 'Matematika'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">Matematika</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div x-data="{ open: false, selected: 'Tahun' }" class="relative">
                            <button @click="open = !open" class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center justify-between w-40">
                                <span x-text="selected"></span>
                                <svg class="w-4 h-4 transform transition-transform" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Dropdown menu with smooth transition -->
                            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2" class="absolute mt-2 w -40 bg-white rounded-md shadow-lg z-10">
                                <ul class="py-2">
                                    <li><button @click="selected = '2021'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">2021</button></li>
                                    <li><button @click="selected = '2022'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">2022</button></li>
                                    <li><button @click="selected = '2023'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">2023</button></li>
                                    <li><button @click="selected = '2024'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">2024</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10 p-8 mx-8 bg-white rounded-xl shadow-md overflow-hidden">
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-black uppercase border-b-2 border-black">NO</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-black uppercase border-b-2 border-black">Nama</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-black uppercase border-b-2 border-black">NIM</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-black uppercase border-b-2 border-black">Semester</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-black uppercase border-b-2 border-black">SKS Tersedia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-3 text-center">1</td>
                            <td class="px-4 py-3">Muhammad Mirza Faiz Rabbani</td>
                            <td class="px-4 py-3 text-center">24060122140127</td>
                            <td class="px-4 py-3 text-center">5</td>
                            <td class="px-4 py-3 text-center">24</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 text-center">2</td>
                            <td class="px-4 py-3">Bintang Syafrian Rizal</td>
                            <td class="px-4 py-3 text-center">24060122120031</td>
                            <td class="px-4 py-3 text-center">5</td>
                            <td class="px-4 py-3 text-center">24</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 text-center">3</td>
                            <td class="px-4 py-3">Hanif Herofa</td>
                            <td class="px-4 py-3 text-center">24060122120015</td>
                            <td class="px-4 py-3 text-center">5</td>
                            <td class="px-4 py-3 text-center">20</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection