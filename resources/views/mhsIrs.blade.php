@extends('main')

@section('title', 'Irs')

@section('page')
    <div class="bg-gray-100 min-h-screen flex flex-col">
        <div class="flex overflow-hidden">
            <x-side-bar-mhs :mahasiswa="$mahasiswa"></x-side-bar-mhs>
            <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
                <x-nav-bar :mahasiswa="$mahasiswa" :user="$user"></x-nav-bar>
                <div class="mx-8 mt-8 bg-white py-8 px-6 rounded-2xl">
                    <h1 class="font-extrabold text-xl">Isian Rencana Semester (IRS)</h1>

                    @forelse ($irsData as $semester => $entries)
                        <div x-data="{ open: false }" class="mb-4 border rounded-lg bg-[#F9FBFF] mt-12">
                            <div class="flex justify-between items-center p-4 cursor-pointer" @click="open = !open">
                                <div>
                                    <h1 class="text-lg">Semester {{ $semester }}</h1>
                                    <h1 class="text-sm text-gray-500">Jumlah SKS {{ $semesterSks[$semester] }}</h1>
                                </div>
                                <svg :class="{ 'rotate-180': open }" class="ml-2 w-5 h-5 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>

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
                                        @foreach ($entries as $index => $entry)
                                            <tr>
                                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                                <td class="border px-4 py-2">{{ $entry->jadwal->kode_mk }}</td>
                                                <td class="border px-4 py-2">{{ $entry->jadwal->nama_mk }}</td>
                                                <td class="border px-4 py-2">{{ $entry->jadwal->kelas }}</td>
                                                <td class="border px-4 py-2">{{ $entry->jadwal->sks }}</td>
                                                <td class="border px-4 py-2">{{ $entry->jadwal->ruang }}</td>
                                                <td class="border px-4 py-2 text-center">
                                                    @if ($entry->status == 'pending')
                                                        <span
                                                            class="inline-flex px-3 py-1 bg-yellow-200 text-yellow-800 rounded-full text-xs whitespace-nowrap">
                                                            Menunggu Persetujuan
                                                        </span>
                                                    @elseif($entry->status == 'mengulang')
                                                        <span
                                                            class="inline-flex px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-xs whitespace-nowrap">
                                                            Mengulang
                                                        </span>
                                                    @elseif($entry->status == 'approved')
                                                        <span
                                                            class="inline-flex px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs whitespace-nowrap">
                                                            Disetujui
                                                        </span>
                                                    @elseif($entry->status == 'wajib')
                                                        <span
                                                            class="inline-flex px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs whitespace-nowrap">
                                                            Wajib
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs whitespace-nowrap">
                                                            Ditolak
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="border px-4 py-2">{{ $entry->nama_dosen }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <a href="{{ route('mhs.downloadIrsPDF', ['nim' => $mahasiswa->nim, 'semester' => $semester]) }}"
                                    class="ml-4 px-3 py-1 mt-10 bg-green-500 text-white rounded-md text-sm hover:bg-green-600">
                                    Download PDF
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="mt-8 text-center text-gray-500">
                            Belum ada IRS yang diajukan
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
