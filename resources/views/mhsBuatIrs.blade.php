@extends('main')

@section('title', 'Buat IRS')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex overflow-hidden">
        <x-side-bar-mhs></x-side-bar-mhs>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>

            <!-- Main container for IRS creation -->
            <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center">
                    <h1 class="text-black font-bold">Buat IRS</h1>
                    <div class="text-sm text-green-500 font-semibold">Saatnya Isi IRS!</div>
                </div>

                <!-- Sidebar and Schedule Layout -->
                <div class="flex mt-4">

                    <!-- Left Sidebar for Course List and Search -->
                    <div class="w-1/4 bg-white p-4 border-r border-gray-200">
                        <h2 class="text-gray-800 font-semibold mb-4">Semester 5</h2>

                        <!-- Search Bar for Filtering Courses -->
                        <div class="relative mb-4">
                            <input type="text" id="courseSearch" placeholder="Cari Matakuliah..."
                                class="w-full p-2 border rounded-md" onkeyup="searchCourses()">
                        </div>

                        <!-- Course List -->
                        <ul id="courseList" class="space-y-2">
                            @php
                            $courses = $jadwals->unique('kode_mk')->map(function ($jadwal) {
                                return [
                                    'code' => $jadwal->kode_mk,
                                    'name' => $jadwal->nama_mk,
                                ];
                            })->values()->toArray();

                            $irss = $irs->unique('kode_mk')->map(function ($irs) {
                                return [
                                    'code' => $irs->kode_mk,
                                    'sks' => $irs->sks,
                                ];
                            })->values()->toArray();
                        @endphp

                        @foreach ($courses as $course)
                            @php
                                // Cari data SKS di $irss yang sesuai dengan course['code']
                                $irsItem = collect($irss)->firstWhere('code', $course['code']);
                            @endphp
                            <li id="course-{{ $course['code'] }}" class="course-item flex items-center p-2 border rounded-md bg-gray-50">
                                <button onclick="toggleCourse('{{ $course['code'] }}')" class="mr-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2C7.03 2 2.61 5.82 1 10.5a11.9 11.9 0 0010 7.5 11.9 11.9 0 0010-7.5c-1.61-4.68-6.03-8.5-10-8.5z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                                <div>
                                    <p class="font-semibold">{{ $course['name'] }}</p>
                                    <p class="text-xs text-gray-600">
                                        {{ $course['code'] }} (SMT 5) ({{ $irsItem ? $irsItem['sks'] : 'N/A' }} SKS)
                                    </p>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>

                    <!-- Weekly Schedule Grid -->
                    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 overflow-x-auto">
                        <!-- Header row for days of the week and time slot -->
                        <div class="grid grid-cols-7 bg-white border-t border-gray-200 sticky top-0 left-0 w-full">
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Jam</div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Senin</div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Selasa</div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Rabu</div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Kamis</div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Jumat</div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Sabtu</div>
                        </div>

                        <!-- Time slots and courses -->
                        @for ($time = 7; $time <= 15; $time += 1) <!-- Adjust times as needed -->
                            <div class="grid grid-cols-7 border-t border-gray-200">
                                <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">
                                    {{ $time }}:00 - {{ $time + 1 }}:00</div>

                                    @foreach (['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'] as $day)
                                    <div class="flex items-center justify-center border-r border-gray-200 p-2">
                                        @php
                                            // Filter jadwal berdasarkan hari dan jam
                                            $course = $jadwals->where('hari', ucfirst($day))->where('jam_mulai', $time . ':00')->first();
                                            
                                            // Cari sks berdasarkan nama mata kuliah tanpa memperhatikan hari dan jam
                                            $irsItem = $irs->firstWhere('nama_mk', optional($course)->nama_mk);
                                        @endphp
                                
                                        @if ($course)
                                            <div class="rounded-lg bg-blue-100 text-blue-900 text-sm font-semibold p-2 course-slot"
                                                data-code="{{ $course->kode_mk }}" data-day="{{ $day }}" data-time="{{ $time }}"
                                                onclick="showCourseModal('{{ $course->nama_mk }}', '{{ $course->kode_mk }}', '{{ $day }}', '{{ $time }}')">
                                                {{ $course->nama_mk }}
                                                <br>{{ $irsItem ? $irsItem->sks : 'N/A' }} SKS
                                            </div>
                                        @else
                                            <div class="text-sm text-gray-500">Kosong</div>
                                        @endif
                                    </div>
                                @endforeach                                
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Course Description -->
<div id="courseModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 id="modalCourseName" class="text-lg font-semibold"></h2>
            <p id="modalCourseDescription" class="mt-2"></p>
            <div class="mt-4">
                <button onclick="document.getElementById('courseModal').classList.add('hidden');"
                    class="bg-gray-200 px-4 py-2 rounded mr-2">Batal</button>
                <button id="selectCourseButton" class="bg-blue-500 text-white px-4 py-2 rounded">Pilih</button>
            </div>
        </div>
    </div>
</div>

<script>
    const selectedCourses = {};

    // Toggle visibility of course items and search
    function toggleCourse(code) {
        const courseItem = document.getElementById('course-' + code);
        courseItem.classList.toggle('hidden');
        searchCourses(); // Re-check visibility on search
    }

    // Function to show course modal with additional parameters
    function showCourseModal(name, description, code, day, time) {
        document.getElementById('modalCourseName').innerText = name;
        document.getElementById('modalCourseDescription').innerText = description;
        document.getElementById('selectCourseButton').onclick = function () {
            selectCourse(code, day, time);
            document.getElementById('courseModal').classList.add('hidden');
        };
        document.getElementById('courseModal').classList.remove('hidden');
    }

    // Select course and manage schedule for specific day and time
    function selectCourse(code, day, time) {
        // Mark the course as selected
        selectedCourses[code] = selectedCourses[code] || [];

        // Add the selected time and day to the array
        if (!selectedCourses[code].some(slot => slot.day === day && slot.time === time)) {
            selectedCourses[code].push({ day: day, time: time });

            // Hide the course in the schedule only for that specific day and time
            const courseElement = document.querySelector(`.course-slot[data-code='${code}'][data-day='${day}'][data-time='${time}']`);
            if (courseElement) {
                courseElement.style.display = 'none'; // Hide the selected slot
            }

            alert("Course " + code + " selected for " + day + " at " + time + ":00!");
        } else {
            alert("Course " + code + " is already selected for " + day + " at " + time + ":00.");
        }
    }


</script>

@endsection