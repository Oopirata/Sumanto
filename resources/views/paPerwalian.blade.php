@extends('main')

@section('title', 'Perwalian')

@section('page')
    <div class="bg-gray-100 min-h-screen flex flex-col">
        <div class="flex overflow-hidden">
            <x-side-bar-pa :dosen="$dosen" :dosens="$dosens"></x-side-bar-pa>
            <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
                <x-nav-bar :dosen="$dosen" :dosens="$dosens"></x-nav-bar>

                <div class="border-b-4"></div>
                <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-black font-bold items-center">Perwalian</h1>
                        </div>

                        <div>
                            <div class="flex">
                                <div>
                                    <x-strata></x-strata>
                                </div>
                                <div class="px-4"></div>
                                <div>
                                    <x-jurusan></x-jurusan>
                                </div>
                                <div class="px-4"></div>
                                <div>
                                    <x-semester></x-semester>
                                </div>
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
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($mahasiswa as $student)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $student->nama }}</td>
                                    <td class="px-6 py-4">{{ $student->nim }}</td>
                                    <td class="px-6 py-4">
                                        <!-- Tombol Detail -->
                                        <a href="/dosen/Perwalian/detail"
                                            class="px-4 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md">
                                            Detail
                                        </a>
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
                paging: true, // Enable pagination
                searching: true, // Enable search box
                info: false, // Disable table information display
                pageLength: 5, // Set default number of rows per page
                lengthChange: false, // Hide the option to change number of rows per page
                columnDefs: [{
                        className: "dt-head-center",
                        targets: [0, 1, 2, 3]
                    },
                    {
                        className: "dt-body-center",
                        targets: [0, 1, 2, 3]
                    }
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
