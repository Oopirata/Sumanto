@extends('main')

@section('title', 'Buat Jadwal')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col " x-data="modal()">
    <div class="flex overflow-hidden">
        <x-side-bar-kaprodi></x-side-bar-kaprodi>
        <div id="main-content" class="relative text-black font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar />
            <div class="border-b-4"></div>
            <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center">
                    <h1 class="text-black font-bold">Jadwal</h1>
                    <div class="flex justify-between">
                        <div>
                            <x-jurusan></x-jurusman>
                        </div>
                        <div class="px-4 bg-white"></div>
                        <div>
                            <x-semester></x-semester>
                        </div>
                        <div class="px-4 bg-white"></div>
                        <div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10 p-8 mx-8 bg-white rounded-xl shadow-md flex-grow overflow-hidden overflow-y-auto">
                <table id="tabelDekan" class="display">
                    <thead>
                        <tr>
                            <th class="px-6 py-3">Mata Kuliah</th>
                            <th class="px-6 py-3">Semester</th>
                            <th class="px-6 py-3">SKS</th>
                            <th class="px-6 py-3">Dosen</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matakuliah as $mk)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $mk->nama_mk }}</td>
                                <td class="px-6 py-4">{{ $mk->semester }}</td>
                                <td class="px-6 py-4">{{ $mk->sks }}</td>
                                <td class="px-6 py-4">
                                    <ul class="list-disc ml-5 text-left">
                                        
                                            <li>{{ $mk->nama}}</li>
                                        
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#tabelDekan').DataTable({
            layout: {
                topStart: null,
                bottomStart: null,
            },
            columnDefs: [
                { className: "dt-head-center", targets: [0,1,2,3] },
                { className: "dt-body-center", targets: [0,1,2,3] }
            ]
        });
    });
</script>
@endsection