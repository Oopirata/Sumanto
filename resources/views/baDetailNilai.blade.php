@extends('main')

@section('title', 'Detail Nilai Mahasiswa')

@section('page')
<div class="bg-gray-100 h-screen flex flex-col">
    <div class="flex overflow-hidden">
        <x-side-bar-ba :dosen="$dosen" :dosens="$dosens"></x-side-bar-ba>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar :dosens="$dosens" :dosen="$dosen"></x-nav-bar>
            <div class="border-b-4"></div>
            <div class="mx-8 mt-8 bg-white py-8 px-6 rounded-2xl">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col items-center ml-20 mt-8">
                        <div class="w-24 h-24 rounded-full overflow-hidden">
                            <img src="path_to_image.jpg" alt="User Image" class="object-cover w-full h-full">
                        </div>
                        <div class="mt-7 text-center">
                            <div class="text-xl font-semibold">2024/2025 Ganjil</div>
                            <div class="mt-4 bg-green-500 text-white px-4 py-2 rounded-full">AKTIF</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 w-full ml-40 gap-8">
                        <div>
                            <h2 class="text-lg font-semibold">NIM:</h2>
                            <p>24060122140127</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold">Nama lengkap:</h2>
                            <p>Muhammad Mirza Faiz Rabbani</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold">Fakultas:</h2>
                            <p>SAINS DAN MATEMATIKA</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold">Prodi:</h2>
                            <p>Informatika S1</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold">Angkatan:</h2>
                            <p>2022</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold">Nomor HP:</h2>
                            <p>0812-8210-8661</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold">Email SSO:</h2>
                            <p>mirza@students.undip.ac.id</p>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold">Email Pribadi:</h2>
                            <p>mirzauhuy@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div x-data="{ open: false }" class="mb-4 border rounded-lg bg-[#F9FBFF] mt-8 w-full">
                    <div class="flex justify-between items-center p-4 cursor-pointer" @click="open = !open">
                        <div>
                            <h1 class="text-lg">Semester 1</h1>
                            <h1 class="text-sm text-gray-500">Jumlah SKS 21</h1>
                        </div>
                        <svg :class="{ 'rotate-180': open }" class="ml-2 w-5 h-5 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>

                    <div x-show="open" class="p-4">
                        <table class="min-w-full table-auto bg-white border-collapse border border-gray-300">
                            <thead class="bg-[#5932EA] text-white">
                                <tr>
                                    <th class="border px-4 py-2">No</th>
                                    <th class="border px-4 py-2">Kode</th>
                                    <th class="border px-4 py-2">Mata Kuliah</th>
                                    <th class="border px-4 py-2">SKS</th>
                                    <th class="border px-4 py-2">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">PAIK102</td>
                                    <td class="border px-4 py-2">Dasar Pemrograman</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">2</td>
                                    <td class="border px-4 py-2">PAIK103</td>
                                    <td class="border px-4 py-2">Matematika 1</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">PAIK101</td>
                                    <td class="border px-4 py-2">Metode Stokastik 1</td>
                                    <td class="border px-4 py-2">2</td>
                                    <td class="border px-4 py-2">A</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">4</td>
                                    <td class="border px-4 py-2">UUW00007</td>
                                    <td class="border px-4 py-2">Bahasa Inggris</td>
                                    <td class="border px-4 py-2">2</td>
                                    <td class="border px-4 py-2">A</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">5</td>
                                    <td class="border px-4 py-2">PAIK104</td>
                                    <td class="border px-4 py-2">Logika Informatika</td>
                                    <td class="border px-4 py-2">3</td>
                                    <td class="border px-4 py-2">A</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">6</td>
                                    <td class="border px-4 py-2">PAIK105</td>
                                    <td class="border px-4 py-2">Struktur Diskrit</td>
                                    <td class="border px-4 py-2">4</td>
                                    <td class="border px-4 py-2">A</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">7</td>
                                    <td class="border px-4 py-2">UUW00005</td>
                                    <td class="border px-4 py-2">Olah raga</td>
                                    <td class="border px-4 py-2">1</td>
                                    <td class="border px-4 py-2">A</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">8</td>
                                    <td class="border px-4 py-2">UUW00003</td>
                                    <td class="border px-4 py-2">Pancasila dan Kewarganegaraan</td>
                                    <td class="border px-4 py-2">2</td>
                                    <td class="border px-4 py-2">B</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex justify-center mt-8 gap-40">
                            <div class="bg-green-500 text-white font-bold py-2 px-6 rounded-lg mx-4">
                                <h1 class="text-2xl">4.00</h1>
                                <h1>IP Semester</h1>
                            </div>

                            <div class="bg-green-500 text-white font-bold py-2 px-6 rounded-lg mx-4">
                                <h1 class="text-2xl">3.83</h1>
                                <h1>IP Kumulatif</h1>
                            </div>

                            <div>
                                <button
                                    class="bg-red-500 text-white font-bold py-6 px-6 rounded-lg mx-4 hover:bg-red-600">
                                    Unduh PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection