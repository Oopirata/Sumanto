@extends('main')

@section('title', 'Verifikasi Jadwal')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex overflow-hidden">
        <x-side-bar-kaprodi :userr="$userr"></x-side-bar-kaprodi>
            <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
                <x-nav-bar :user="$user" :userr="$userr"></x-nav-bar>

                <div class="border-b-4"></div>
                <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-black font-bold items-center">Verifikasi IRS</h1>
                        </div>

                        <div>
                            <div class="flex">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Verifikasi -->
                <div class="mt-10 p-8 mx-8 bg-white rounded-xl shadow-md overflow-hidden" style="max-height: 550px;">
                    <table id="tabelVeri" class="text-center w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">NIM</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Semester</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($mahasiswa as $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $student->nama }}</td>
                                        <td>{{ $student->nim }}</td>
                                        <td>{{ $student->semester }}</td>
                                        <td>
                                            @php
                                                $status = $allApproved[$student->nim] ?? false;
                                            @endphp
                                            <span class="px-2 py-1 rounded {{ $status ? 'bg-green-100 text-green-500' : 'bg-red-100 text-red-500' }}">
                                                {{ $status ? 'Disetujui' : 'Tidak Disetujui' }}
                                            </span>
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
        
        $(document).ready(function() {
        $('#tabelVeri').DataTable({
            paging: true,        // Enable pagination
            searching: true,     // Enable search box
            info: false,         // Disable table information display
            pageLength: 5,       // Set default number of rows per page
            lengthChange: false, // Hide the option to change number of rows per page
            columnDefs: [
                { className: "dt-head-center", targets: [0, 1, 2, 3, 4 ] },
                { className: "dt-body-center", targets: [0, 1, 2, 3, 4 ] }
            ],
            language: {
                paginate: {
                    previous: "<",
                    next: ">"
                },
                search: "Search:"
            }
        });
    });
    </script>
@endsection
