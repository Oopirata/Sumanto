@extends('main')

@section('title', 'Irs')

@section('page')

<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex overflow-hidden">
        <x-side-bar-mhs :mahasiswa="$mahasiswa"></x-side-bar-mhs>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar :mahasiswa="$mahasiswa" :user="$user"></x-nav-bar>
            <div class="mx-8 mt-8 bg-white py-8 px-6 rounded-2xl">
                <h1 class="font-extrabold text-xl">Isian Rencana Semester (IRS)</h1>
                <div x-data="{ open: false }" class="mb-4 border rounded-lg bg-[#F9FBFF] mt-12">
                    <div class="flex justify-between items-center p-4 cursor-pointer" @click="open = !open">
                        <div>
                            <h1 class="text-lg">Semester 1</h1>
                            <h1 class="text-sm text-gray-500">Jumlah SKS 24</h1>
                        </div>
                        <svg :class="{ 'rotate-180': open }" class="ml-2 w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    <!-- Tabel mata kuliah semester 1 (Dropdown Content) -->
                    <div x-show="open" class="p-4">
                        <table class="min-w-full table-auto bg-white border-collapse border border-gray-300">
                            <thead class="bg-[#5932EA] text-white">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2">Kode</th>
                                    <th class="border px-4 py-2">Mata Kuliah</th>
                                    <th class="border px-4 py-2">Kelas</th>
                                    <th class="border px-4 py-2">SKS</th>
                                    <th class="border px-4 py-2">Ruang</th>
                                    <th class="border px-4 py-2">Status</th>
                                    <th class="border px-4 py-2">Nama Dosen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div x-data="{ open: false }" class="mb-4 border rounded-lg bg-[#F9FBFF] mt-8">
                    <div class="flex justify-between items-center p-4 cursor-pointer" @click="open = !open">
                        <div>
                            <h1 class="text-lg">Semester 2</h1>
                            <h1 class="text-sm text-gray-500">Jumlah SKS 24</h1>
                        </div>
                        <svg :class="{ 'rotate-180': open }" class="ml-2 w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    <!-- Tabel mata kuliah semester 1 (Dropdown Content) -->
                    <div x-show="open" class="p-4">
                        <table class="min-w-full table-auto bg-white border-collapse border border-gray-300">
                            <thead class="bg-[#5932EA] text-white">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2">Kode</th>
                                    <th class="border px-4 py-2">Mata Kuliah</th>
                                    <th class="border px-4 py-2">Kelas</th>
                                    <th class="border px-4 py-2">SKS</th>
                                    <th class="border px-4 py-2">Ruang</th>
                                    <th class="border px-4 py-2">Status</th>
                                    <th class="border px-4 py-2">Nama Dosen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div x-data="{ open: false }" class="mb-4 border rounded-lg bg-[#F9FBFF] mt-8">
                    <div class="flex justify-between items-center p-4 cursor-pointer" @click="open = !open">
                        <div>
                            <h1 class="text-lg">Semester 2</h1>
                            <h1 class="text-sm text-gray-500">Jumlah SKS 24</h1>
                        </div>
                        <svg :class="{ 'rotate-180': open }" class="ml-2 w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    <!-- Tabel mata kuliah semester 1 (Dropdown Content) -->
                    <div x-show="open" class="p-4">
                        <table class="min-w-full table-auto bg-white border-collapse border border-gray-300">
                            <thead class="bg-[#5932EA] text-white">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2">Kode</th>
                                    <th class="border px-4 py-2">Mata Kuliah</th>
                                    <th class="border px-4 py-2">Kelas</th>
                                    <th class="border px-4 py-2">SKS</th>
                                    <th class="border px-4 py-2">Ruang</th>
                                    <th class="border px-4 py-2">Status</th>
                                    <th class="border px-4 py-2">Nama Dosen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div x-data="{ open: false }" class="mb-4 border rounded-lg bg-[#F9FBFF] mt-8">
                    <div class="flex justify-between items-center p-4 cursor-pointer" @click="open = !open">
                        <div>
                            <h1 class="text-lg">Semester 2</h1>
                            <h1 class="text-sm text-gray-500">Jumlah SKS 24</h1>
                        </div>
                        <svg :class="{ 'rotate-180': open }" class="ml-2 w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    <!-- Tabel mata kuliah semester 1 (Dropdown Content) -->
                    <div x-show="open" class="p-4">
                        <table class="min-w-full table-auto bg-white border-collapse border border-gray-300">
                            <thead class="bg-[#5932EA] text-white">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2">Kode</th>
                                    <th class="border px-4 py-2">Mata Kuliah</th>
                                    <th class="border px-4 py-2">Kelas</th>
                                    <th class="border px-4 py-2">SKS</th>
                                    <th class="border px-4 py-2">Ruang</th>
                                    <th class="border px-4 py-2">Status</th>
                                    <th class="border px-4 py-2">Nama Dosen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div x-data="{ open: false }" class="mb-4 border rounded-lg bg-[#F9FBFF] mt-8">
                    <div class="flex justify-between items-center p-4 cursor-pointer" @click="open = !open">
                        <div>
                            <h1 class="text-lg">Semester 2</h1>
                            <h1 class="text-sm text-gray-500">Jumlah SKS 24</h1>
                        </div>
                        <svg :class="{ 'rotate-180': open }" class="ml-2 w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    <!-- Tabel mata kuliah semester 1 (Dropdown Content) -->
                    <div x-show="open" class="p-4">
                        <table class="min-w-full table-auto bg-white border-collapse border border-gray-300">
                            <thead class="bg-[#5932EA] text-white">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2">Kode</th>
                                    <th class="border px-4 py-2">Mata Kuliah</th>
                                    <th class="border px-4 py-2">Kelas</th>
                                    <th class="border px-4 py-2">SKS</th>
                                    <th class="border px-4 py-2">Ruang</th>
                                    <th class="border px-4 py-2">Status</th>
                                    <th class="border px-4 py-2">Nama Dosen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAK1602</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">D</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A204</td>
                                    <td class="border px-4 py-2">BARU</td>
                                    <td class="border px-4 py-2">Dr. Eng. Adi Wibowo, S.Si, M.Kom</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
