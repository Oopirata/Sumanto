@extends('main')

@section('title', 'Buat IRS')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex overflow-hidden">
        <x-side-bar-mhs></x-side-bar-mhs>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>

            <!-- Main container for IRS creation -->
            <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center">
                    <h1 class="text-black font-bold">Buat IRS</h1>
                    <div class="text-sm text-red-500 font-semibold">Belum Saatnya Isi IRS!</div>
                </div>

                <!-- Sidebar and Schedule Layout -->
                <div class="flex mt-4">

                    <!-- Left Sidebar for Course List and Search -->
                    <div class="w-1/4 bg-white p-4 border-r border-gray-200">
                        <div class="bg-purple-500 px-2 py-1 rounded-3xl">
                            <h2 class="text-white font-semibold text-center">Semester 5</h2>
                        </div>
                        <!-- Search Bar for Filtering Courses -->
                        <div class="relative mb-4 mt-5">
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
                                    $irsItem = collect($irss)->firstWhere('code', $course['code']);
                                @endphp
                                <li id="course-{{ $course['code'] }}" class="course-item flex items-center p-2 border rounded-md bg-gray-50" data-sks="{{ $irsItem ? $irsItem['sks'] : 0 }}">
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
                        <div class="grid grid-cols-7 bg-white sticky top-0 left-0 w-full gap-y-0 gap-x-0 border-b border-gray-200">
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Jam</div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Senin</div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Selasa</div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Rabu</div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Kamis</div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Jumat</div>
                            <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">Sabtu</div>
                        </div>

                        <!-- Time slots and courses -->
                        @for ($time = 7; $time <= 15; $time += 1)
                            <div class="grid grid-cols-7 gap-y-0 gap-x-0 border-b border-gray-200">
                                <div class="p-4 flex items-center justify-center text-sm font-medium text-gray-900">
                                    {{ $time }}:00 - {{ $time + 1 }}:00
                                </div>

                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                                    <div class="flex items-center justify-center p-2 border-r border-gray-200">
                                        @php
                                            // Cari course pada hari dan jam yang sesuai
                                            $courses = $jadwals->where('hari', $day)->where('jam_mulai', $time . ':00');
                                        @endphp

                                        @if ($courses->isNotEmpty())
                                            <!-- Tampilkan semua course yang sesuai -->
                                            @foreach ($courses as $course)
                                                <div class="rounded-lg bg-blue-100 text-blue-900 text-sm font-semibold p-2 course-slot"
                                                    data-code="{{ $course->kode_mk }}" data-day="{{ $day }}" data-time="{{ $time }}"
                                                    onclick="showCourseModal('{{ $course->nama_mk }}', '{{ $course->kode_mk }}', '{{ $day }}', '{{ $time }}')">
                                                    {{ $course->nama_mk }}<br>{{ $course->sks }} SKS
                                                </div>
                                            @endforeach
                                        @else
                                            <!-- Tampilkan "Kosong" hanya jika tidak ada course yang ditemukan -->
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

<!-- SKS Indicator -->
<div id="sksIndicator" class="fixed bottom-4 right-4 bg-purple-500 text-white px-4 py-2 rounded-lg shadow-lg text-center">
    <button id="toggleSelectedCourses" class="focus:outline-none">
        0 SKS Dipilih
    </button>
</div>

<!-- Slide-In Container for Selected Courses -->
<div id="selectedCoursesSlide" class="fixed inset-y-0 right-0 bg-white shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50 px-20">
    <div class="p-4">
        <h2 class="text-lg font-semibold text-center">Mata Kuliah Dipilih</h2>
        <ul id="selectedCoursesList" class="mt-2 space-y-2">
            <!-- Daftar mata kuliah akan diisi melalui JavaScript -->
        </ul>
        <button id="closeSelectedCourses" class="mt-4 bg-gray-200 px-4 py-2 rounded">Tutup</button>
    </div>
</div>

<script>
    // Variabel untuk menyimpan jumlah SKS yang dipilih
    let totalSKS = 0;
    const selectedCourses = new Set();

    document.getElementById('toggleSelectedCourses').onclick = function() {
        const slide = document.getElementById('selectedCoursesSlide');
        if (slide.style.transform === 'translateX(0%)') {
            slide.style.transform = 'translateX(100%)';
        } else {
            slide.style.transform = 'translateX(0%)';
        }
    };

    function toggleCourse(code) {
        const courseElement = document.getElementById(`course-${code}`);
        const sks = parseInt(courseElement.getAttribute("data-sks")); // Ambil SKS dari data-sks

        if (selectedCourses.has(code)) {
            // Jika sudah dipilih, maka hapus dari set dan kurangi SKS
            selectedCourses.delete(code);
            totalSKS -= sks; // Kurangi SKS
            courseElement.classList.remove("bg-blue-200");
        } else {
            // Jika belum dipilih, maka tambahkan ke set dan tambahkan SKS
            selectedCourses.add(code);
            totalSKS += sks; // Tambah SKS
            courseElement.classList.add("bg-blue-200");
        }

        // Update indikator SKS
        updateSKSIndicator();
    }

    function updateSKSIndicator() {
        const sksIndicator = document.getElementById("sksIndicator");
        sksIndicator.querySelector("button").textContent = `${totalSKS} SKS Dipilih`;
    }

    function showCourseModal(name, code, day, time) {
        const modal = document.getElementById('courseModal');
        document.getElementById('modalCourseName').textContent = name;
        document.getElementById('modalCourseDescription').textContent = `Kode: ${code}\nHari: ${day}\nJam: ${time}:00 - ${time + 1}:00`;
        modal.classList.remove('hidden');

        document.getElementById('selectCourseButton').onclick = function() {
            toggleCourse(code);
            modal.classList.add('hidden');
        };
    }

    // Fungsi untuk mencari mata kuliah
    function searchCourses() {
        const input = document.getElementById("courseSearch").value.toLowerCase();
        const courses = document.querySelectorAll(".course-item");

        courses.forEach(course => {
            const courseName = course.textContent.toLowerCase();
            if (courseName.includes(input)) {
                course.style.display = "";
            } else {
                course.style.display = "none";
            }
        });
    }

    // Menutup slide-in untuk mata kuliah yang dipilih
    document.getElementById('closeSelectedCourses').onclick = function() {
        document.getElementById('selectedCoursesSlide').style.transform = 'translateX(100%)';
    };
</script>

@endsection
