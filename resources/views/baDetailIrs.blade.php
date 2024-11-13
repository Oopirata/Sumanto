@extends('main')

@section('title', 'Staff Detail IRS')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col font-poppins">
    <div class="flex overflow-hidden">
        <x-side-bar-ba :dosens="$dosens"></x-side-bar-ba>
        <div id="main-content" class="relative text-black ml-64 w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>
            
            <!-- Judul dan Dropdown -->
            <div class="bg-white px-4 py-8 mx-8 mt-8 rounded-xl">
                <div class="flex items-center justify-between">
                    <h1 class="text-black font-semibold text-2xl ml-6">IRS Mahasiswa</h1>
                    <div x-data="{ open: false, selected: '1' }" class="relative">
                        <button @click="open = !open" class="bg-blue-600 text-white px-4 py-2 rounded-xl flex items-center w-40">
                            <span class="flex-grow text-left" x-text="selected"></span>
                            <svg class="w-4 h-4 ml-2 transform transition-transform duration-200" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" 
                             class="fixed mt-2 w-40 bg-white rounded-md shadow-lg z-50"> 
                            <ul class="py-2">
                                <li><button @click="selected = '1'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">1</button></li>
                                <li><button @click="selected = '2'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">2</button></li>
                                <li><button @click="selected = '3'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">3</button></li>
                                <li><button @click="selected = '4'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">4</button></li>
                                <li><button @click="selected = '5'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">5</button></li>
                                <li><button @click="selected = '6'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">6</button></li>
                                <li><button @click="selected = '7'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">7</button></li>
                                <li><button @click="selected = '8'; open = false" class="w-full text-left px-4 py-2 hover:bg-gray-100">8</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bagian Tabel IRS -->
            <div class="bg-white p-8 mx-8 mt-8 rounded-2xl">
                <table class="w-full text-sm text-left text-gray-500 border-collapse">
                    <thead class="text-[#F9FBFF] bg-[#5932EA] text-md font-semibold">
                        <tr>
                            <th class="px-4 py-3 text-center border border-white text-white">No</th>
                            <th class="px-4 py-3 border border-white text-white">Kode</th>
                            <th class="px-4 py-3 border border-white text-white">Mata Kuliah</th>
                            <th class="px-4 py-3 text-center border border-white text-white">Kelas</th>
                            <th class="px-4 py-3 text-center border border-white text-white">SKS</th>
                            <th class="px-4 py-3 border border-white text-white">Ruang</th>
                            <th class="px-4 py-3 border border-white text-white">Status</th>
                            <th class="px-4 py-3 border border-white text-white">Nama Dosen</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        <!-- Contoh Baris - Ulangi sesuai jumlah data -->
                        <tr class="bg-gray-100 border-b">
                            <td class="px-4 py-4 text-center border border-gray-200">1</td>
                            <td class="px-4 py-4 border border-gray-200">PAIK102</td>
                            <td class="px-4 py-4 border border-gray-200">Dasar Pemrograman</td>
                            <td class="px-4 py-4 text-center border border-gray-200">D</td>
                            <td class="px-4 py-4 text-center border border-gray-200">3</td>
                            <td class="px-4 py-4 border border-gray-200">A204</td>
                            <td class="px-4 py-4 border border-gray-200">BARU</td>
                            <td class="px-4 py-4 border border-gray-200">Dr.Eng. Adi Wibowo, S.Si., M.Kom.<br>Khadijah, S.Kom., M.Cs.</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-6">
                    <button onclick="window.location.href='{{ url('staff/irs') }}'" class="bg-blue-600 px-4 py-2 text-white rounded-lg">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
