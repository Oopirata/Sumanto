@extends('main')

@section('title', 'Presensi Mahasiswa')

@section('page')
<div class="bg-gray-100 h-screen flex flex-col">
    <div class="flex overflow-hidden">
        <x-side-bar-ba :dosen="$dosen" :dosens="$dosens"></x-side-bar-ba>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar :dosens="$dosens" :dosen="$dosen"></x-nav-bar>
            <div class="border-b-4"></div>
            <div class="bg-white px-4 py-8 rounded-xl mx-8 mt-8 flex items-center justify-between">
                <div class="font-semibold text-xl">Presensi Mahasiswa</div>
                <!-- Dropdown Section (Right aligned) -->
                <div class="flex space-x-4 items-center">
                    <x-strata></x-strata>
                    <x-jurusan></x-jurusan>
                    <x-tahun></x-tahun>
                </div>
            </div>
            <div class="mt-8 p-8 mx-8 bg-white rounded-xl shadow-md overflow-hidden" style="max-height: 550px;">
                <table id="tabelVeri" class="text-center w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">NIM</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">1</td>
                            <td class="px-6 py-4">Muhammad Mirza Faiz Rabbani</td>
                            <td class="px-6 py-4">24060122140127</td>
                            <td class="px-6 py-4">
                                <button class="btn-detail bg-[#000CB0] text-white px-5 py-1 rounded-full mr-2">Izin</button>
                                <button class="btn-setuju bg-[#4BD37B] text-white px-5 py-1 rounded-full mr-2">Hadir</button>
                                <button class="btn-tolak bg-red-600 text-white px-5 py-1 rounded-full">Tolak</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
