@extends('main')

@section('title', 'Buat Jadwal')

@section('page')

<div class="bg-gray-100 min-h-screen flex flex-col " x-data="modal()">
    <div class="flex overflow-hidden">
        <x-side-bar-kaprodi></x-side-bar-kaprodi>
        <div id="main-content" class="relative text-black font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar />
            
            <div class="mt-10 p-8 mx-8 bg-white rounded-xl shadow-md overflow-hidden overflow-y-auto" style="max-height: 550px;">
                @php
                    $schedules = [
                        ['title' => 'PBP', 'semester' => '5', 'lecturers' => ['Dr. Budi', 'Prof. Andi']],
                        ['title' => 'PPL', 'semester' => '5', 'lecturers' => ['Dr. Siti', 'Dr. Ahmad']],
                        // Tambahkan jadwal dan dosen lainnya sesuai kebutuhan
                    ];
                @endphp
                <table id="tabelDekan" class="display">
                    <thead>
                        <tr>
                            <th class="px-6 py-3">Mata Kuliah</th>
                            <th class="px-6 py-3">Semester</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $schedule['title'] }}</td>
                                <td class="px-6 py-4">{{ $schedule['semester'] ?? 'N/A' }}</td>
                                <td>
                                    <!-- drawer init and toggle -->
                                    <div class="text-center">
                                        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button" data-drawer-target="drawer-right-{{ $loop->index }}" data-drawer-show="drawer-right-{{ $loop->index }}" data-drawer-placement="right" aria-controls="drawer-right-{{ $loop->index }}">
                                            Pengajar
                                        </button>
                                    </div>
                                    <!-- drawer component -->
                                    <div id="drawer-right-{{ $loop->index }}" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label-{{ $loop->index }}">
                                        <h5 id="drawer-right-label-{{ $loop->index }}" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                                            <!-- Tambahkan elemen SVG yang membungkus path -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                            </svg>
                                            Pengajar
                                        </h5>   

                                        <button type="button" data-drawer-hide="drawer-right-{{ $loop->index }}" aria-controls="drawer-right-{{ $loop->index }}" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close menu</span>
                                        </button>
                                        <!-- Menampilkan Detail Mata Kuliah dan Semester -->
                                        <p class="mb-6 text-sm text-gray-500 dark:text-gray-400">
                                            Mata Kuliah: <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $schedule['title'] }}</span><br>
                                            Semester: <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $schedule['semester'] ?? 'N/A' }}</span>
                                        </p>
                                        <!-- Menampilkan Nama Dosen -->
                                        <p class="mb-4 font-medium text-gray-700 dark:text-gray-300">Dosen Pengajar:</p>
                                        <ul class="list-disc list-inside mb-6 text-sm text-gray-500 dark:text-gray-400">
                                            @foreach ($schedule['lecturers'] as $lecturer)
                                                <li>{{ $lecturer }}</li>
                                            @endforeach
                                        </ul>
                                        <div class="flex justify-center">
                                            <button class="px-4 py-2 items-center text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800">
                                                Tambahkan Dosen
                                            </button>
                                        </div>
                                    </div>
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
                { className: "dt-head-center", targets: [0, 1, 2] },
                { className: "dt-body-center", targets: [0, 1, 2] }
            ]
        });
    });
</script>

@endsection
