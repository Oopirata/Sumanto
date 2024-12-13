@extends('main')

@section('title', 'Buat Jadwal')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col ml-64 ">
    <div class="flex overflow-hidden">
        <x-side-bar-kaprodi :userr="$userr"></x-side-bar-kaprodi>
        <div id="main-content" class="relative text-black  font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar :user="$user"></x-nav-bar>
            <div class="border-b-4"></div>
            <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-black font-bold items-center">Jadwal</h1>
                    </div>
                    
                    <div>
                        <div class="flex justify-between">
                            
                            <div class="px-4 bg-white"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div x-data="{ showModal: false, selectedSchedule: null }">
                <!-- Bagian jadwal -->
                <section class="relative mb-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm flex">
                    <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 overflow-x-auto">
                        <div class="grid grid-cols-8 border-t border-gray-200 sticky top-0 left-0 w-full">
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900"></div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Senin</div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Selasa</div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Rabu</div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Kamis</div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Jumat</div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Sabtu</div>
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Minggu</div>
                        </div>

                        @for ($time = 7; $time <= 21; $time++)
                        <div class="grid grid-cols-8 border-t border-gray-200">
                            <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">{{ $time }}:00</div>
                            @for ($day = 1; $day <= 7; $day++)
                                <div class="flex flex-col h-auto p-0.5 md:p-3.5 border-r border-gray-200 transition-all hover:bg-stone-100">
                                    @php
                                        // Definisikan nama hari dalam array untuk mempermudah pencocokan
                                        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                        $schedules = [
                                            // Tambahkan jadwal lainnya sesuai kebutuhan
                                        ];
                                        
                                        foreach ($data as $jadwal){
                                            $j =[ 'id' => $jadwal->id, 'day' => $jadwal->hari, 'start' => $jadwal->jam_mulai, 'end' => $jadwal->jam_selesai, 'title' => $jadwal->nama_mk, 'kelas' => $jadwal->kelas, 'ruangan' => $jadwal->ruang, 'jenis' => $jadwal->status];
                                            // Tambahkan jadwal ke array $schedules
                                            array_push($schedules, $j);
                                            }
                                    
                                    @endphp
                                    @foreach ($schedules as $schedule)
                                            @if ($schedule['day'] == $days[$day - 1] && 
                                                ($time == intval(substr($schedule['start'], 0, 2))))
                                                
                                                @php
                                                    // Calculate the duration of the schedule in hours
                                                    $startHour = intval(substr($schedule['start'], 0, 2));
                                                    $endHour = intval(substr($schedule['end'], 0, 2));
                                                    $duration = $endHour - $startHour;
                                                $colorClass = '';
                                                switch ($schedule['kelas']) {
                                                    case 'A':
                                                        $colorClass = 'bg-blue-50 border-blue-600 text-blue-600';
                                                        break;
                                                    case 'B':
                                                        $colorClass = 'bg-red-50 border-red-600 text-red-600';
                                                        break;
                                                    case 'C':
                                                        $colorClass = 'bg-green-50 border-green-600 text-green-600';
                                                        break;
                                                    case 'D':
                                                        $colorClass = 'bg-purple-50 border-purple-600 text-purple-600';
                                                        break;
                                                    default:
                                                        $colorClass = 'bg-gray-50 border-gray-600 text-gray-600';
                                                        break;
                                                }
                                            @endphp

                                            <button class="rounded p-1.5 border-l-2 {{ $colorClass }} w-full text-left" 
                                                    @click="showModal = true; selectedSchedule = {{ json_encode($schedule) }}">
                                                <p class="text-xs font-normal mb-px">{{ $schedule['title'] }}</p>
                                                <p class="text-xs font-semibold">{{ $schedule['start'] }} - {{ $schedule['end'] }}</p>
                                                <p class="text-xs font-normal">{{ $schedule['ruangan'] }}</p>
                                                <p class="text-xs font-normal">{{ $schedule['kelas'] }}</p>
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            @endfor
                        </div>
                        @endfor
                    </div>
                    
                    <!-- drawer init and toggle -->
                    <div class="text-center">
                        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-5 mr-9 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" 
                                type="button" 
                                data-drawer-target="drawer-right-example" 
                                data-drawer-show="drawer-right-example" 
                                data-drawer-placement="right" 
                                aria-controls="drawer-right-example">
                            <svg class="w-4 h-4 inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 01-2 0v-6H4a1 1 0 110-2h6V4a1 1 0 011-1z" clip-rule="evenodd"/>
                            </svg>
                            Jadwal
                        </button>
                    </div>  

                    <!-- drawer component -->
                    <div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
                        <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            Tambah Jadwal
                        </h5>
                        <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M1 13L13 1"/>
                            </svg>
                            <span class="sr-only">Close menu</span>
                        </button>
                        <ul class="space-y-4">
                            <li>
                               <form action="{{ route('storeKaprodi.jadwal') }}" method="POST" class="space-y-4 p-6 bg-gray-50 border border-gray-300 rounded-lg shadow-md">
                                    @csrf

                                    <!-- Nama Mata Kuliah -->
                                    <div>
                                        <label for="kode_mk" class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                                            <select id="kode_mk" name="kode_mk" required onchange="calculateEndTime()" 
                                                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                <option value="">Pilih Mata Kuliah</option>
                                                @foreach($mk as $jadwal)
                                                    <option value="{{ $jadwal->kode_mk }}" data-sks="{{ $jadwal->sks }}">
                                                        {{ $jadwal->nama_mk }}
                                                    </option>
                                                @endforeach
                                            </select>

                                    </div>

                                    <script>
                                        function calculateEndTime() {
                                            const kodeMkSelect = document.getElementById('kode_mk');
                                            const selectedOption = kodeMkSelect.options[kodeMkSelect.selectedIndex];
                                            const sks = parseInt(selectedOption.getAttribute('data-sks'), 10);

                                            const jamMulaiInput = document.getElementById('jam_mulai');
                                            const jamSelesaiInput = document.getElementById('jam_selesai');

                                            const jamMulai = jamMulaiInput.value;

                                            if (jamMulai && sks) {
                                                // Pisahkan jam dan menit dari input waktu
                                                const [hours, minutes] = jamMulai.split(':').map(Number);

                                                // Buat objek Date untuk waktu mulai
                                                const startTime = new Date();
                                                startTime.setHours(hours, minutes, 0);

                                                // Hitung durasi berdasarkan SKS (50 menit per SKS)
                                                const durationMinutes = sks * 50;
                                                startTime.setMinutes(startTime.getMinutes() + durationMinutes);

                                                // Format waktu selesai menjadi HH:mm
                                                const endTime = startTime.toTimeString().slice(0, 5);
                                                jamSelesaiInput.value = endTime;
                                            } else {
                                                jamSelesaiInput.value = '';
                                            }
                                        }

                                        // Update jam selesai saat jam mulai berubah
                                        document.getElementById('jam_mulai').addEventListener('input', calculateEndTime);

                                        window.onload = calculateEndTime;

                                    </script>



                                    <!-- Kelas -->
                                    <div>
                                        <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                                        <select id="kelas" name="kelas" required onchange="toggleKelasInput()" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Kelas</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            <option value="other">Lainnya</option>
                                        </select>

                                        <input type="text" id="kelas_lainnya" name="kelas_lainnya" placeholder="Masukkan kelas lain" class="mt-2 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" style="display: none;">
                                    </div>

                                    <!-- Ruang -->
                                    <div>
                                        <label for="ruangan" class="block text-sm font-medium text-gray-700">Ruang</label>
                                        <select id="ruangan" name="ruangan" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Ruangan</option>
                                            @foreach($ruangan as $ruang)
                                                <option value="{{ $ruang->id }}">{{ $ruang->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Hari -->
                                    <div>
                                        <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                                        <select id="hari" name="hari" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Hari</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                            <option value="Minggu">Minggu</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                                        <input type="time" id="jam_mulai" name="jam_mulai" required 
                                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="jam_selesai" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                                        <input type="time" id="jam_selesai" name="jam_selesai" readonly 
                                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <script>
                                        // Event listener untuk menangani input pada jam_mulai
                                        document.getElementById('jam_mulai').addEventListener('input', function() {
                                            const jamMulai = this.value;  // Ambil waktu jam mulai
                                            const sksSelect = document.getElementById('kode_mk');
                                            const selectedOption = sksSelect.options[sksSelect.selectedIndex];
                                            const sks = parseInt(selectedOption.getAttribute('data-sks'), 10);  // Ambil jumlah SKS dari mata kuliah

                                            // Cek apakah jam mulai dan SKS sudah ada
                                            if (jamMulai && sks) {
                                                // Pisahkan jam dan menit dari input waktu
                                                const [hours, minutes] = jamMulai.split(':').map(Number);

                                                // Buat objek Date untuk waktu mulai
                                                const startTime = new Date();
                                                startTime.setHours(hours, minutes, 0);

                                                // Hitung durasi berdasarkan SKS (50 menit per SKS)
                                                const durationMinutes = sks * 50;
                                                startTime.setMinutes(startTime.getMinutes() + durationMinutes);

                                                // Format waktu selesai menjadi HH:mm
                                                const endTime = startTime.toTimeString().slice(0, 5);

                                                // Update jam selesai dengan waktu yang dihitung
                                                document.getElementById('jam_selesai').value = endTime;
                                            }
                                        });
                                    </script>



                                    <script>
                                        function toggleKelasInput() {
                                            const kelasSelect = document.getElementById("kelas");
                                            const kelasLainnyaInput = document.getElementById("kelas_lainnya");

                                            if (kelasSelect.value === "other") {
                                                kelasLainnyaInput.style.display = "block";
                                                kelasLainnyaInput.required = true;
                                            } else {
                                                kelasLainnyaInput.style.display = "none";
                                                kelasLainnyaInput.required = false;
                                            }
                                        }
                                    </script>

                                    <!-- Submit Button -->
                                    <div>
                                        <button id="simpanBtn" type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Simpan
                                        </button>
                                    </div>
                                </form>

                            </li>
                        </ul>
                    </div>
                </section>

                <!-- Modal for displaying schedule details -->
                    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen px-4 text-center">
                            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                <div class="px-4 py-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="selectedSchedule.title"></h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Kelas: <span x-text="selectedSchedule.kelas"></span></p>
                                        <p class="text-sm text-gray-500">Waktu: <span x-text="selectedSchedule.start"></span> - <span x-text="selectedSchedule.end"></span></p>
                                        <p class="text-sm text-gray-500">Ruangan: <span x-text="selectedSchedule.ruangan"></span></p>
                                        <p class="text-sm text-gray-500">Jenis: <span x-text="selectedSchedule.jenis"></span></p>
                                    </div>
                                    <div class="mt-4 flex justify-end space-x-2">
                                        <button @click="showModal = false" class="bg-gray-300 hover:bg-gray-400 text-black py-2 px-4 rounded">
                                            Tutup
                                        </button>
                                        <form action="{{ route('deleteKaprodi.jadwal') }}" method="POST" class="delete-form">
                                            @csrf
                                            <input type="hidden" name="id" :value="selectedSchedule.id">
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                                                Hapus
                                            </button>
                                        </form>

                                        <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const deleteForms = document.querySelectorAll('.delete-form');
                                            
                                            deleteForms.forEach(form => {
                                                form.addEventListener('submit', function(e) {
                                                    e.preventDefault();
                                                    
                                                    Swal.fire({
                                                        title: 'Konfirmasi Penghapusan',
                                                        text: "Apakah Anda yakin ingin menghapus jadwal ini?",
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#d33',
                                                        cancelButtonColor: '#3085d6',
                                                        confirmButtonText: 'Ya, hapus!',
                                                        cancelButtonText: 'Batal'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            form.submit();
                                                        }
                                                    });
                                                });
                                            });
                                        });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Ajukan -->
                    <div class="fixed bottom-6 right-6">
                        <button id="ajukanBtn" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg shadow-lg">
                            Ajukan
                        </button>
                    </div>

                    <script>
                        // Ketika tombol Ajukan diklik
                        document.getElementById('ajukanBtn').addEventListener('click', function() {
                            // Panggil fungsi JavaScript untuk mengubah status jadwal
                            submitAllSchedules();
                        });
                    
                        function submitAllSchedules() {
                            $.ajax({
                                url: '/kaprodi/jadwal/ajukan',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Jadwal berhasil diajukan.',
                                        icon: 'success'
                                    }).then(() => {
                                        location.reload(); // Reload halaman setelah berhasil
                                    });
                                },
                                error: function(error) {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Terjadi kesalahan saat mengajukan jadwal.',
                                        icon: 'error'
                                    });
                                }
                            });
                        }
                    </script>
            </div>
        </div>
    </div>
</div>

<script>
    // Ketika tombol Ajukan diklik
    $('form[action="{{ route('storeKaprodi.jadwal') }}"]').submit(function(e) {
        e.preventDefault();
        const form = this;
        Swal.fire({
            title: 'Konfirmasi Pengajuan',
            text: "Apakah Anda yakin ingin mengajukan jadwal ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ajukan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                // Tambahkan kode untuk melanjutkan pengajuan (misalnya, submit form, redirect, dll)
            }
        });
    });

    @if(session('sweetAlert'))
            document.addEventListener('DOMContentLoaded', function() {
                const alert = @json(session('sweetAlert'));
                Swal.fire({
                    title: alert.title,
                    text: alert.text,
                    icon: alert.icon,
                    confirmButtonColor: '#028391',
                    confirmButtonText: 'OK'
                });
            });
        @endif
</script>

@endsection
