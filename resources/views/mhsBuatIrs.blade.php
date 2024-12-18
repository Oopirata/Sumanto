@extends('main')

@section('title', 'Buat Irs')

@section('page')
    <div class="bg-gray-100 min-h-screen flex flex-col ">
        <div class="flex overflow-hidden">
            <x-side-bar-mhs :mahasiswa="$mahasiswa"></x-side-bar-mhs>
            <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
                <x-nav-bar :mahasiswa="$mahasiswa" :user="$user"></x-nav-bar>
                <div class="border-b-4"></div>
                <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-2xl shadow-sm">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-10">
                            <h1 class="text-black font-bold text-2xl">Buat IRS</h1>
                            <div id="real-time-clock" class="text-2xl font-semibold text-black"></div>
                            @if ($mahasiswa->akses !== 'yes')
                                <div class="text-red-600 text-2xl font-semibold">Anda sudah mengajukan IRS</div>
                            @elseif ($period === 'closed')
                                <div class="text-red-600 text-2xl font-semibold">Waktu Pengisian IRS Telah Ditutup</div>
                            @else 
                                <div class="text-green-600 text-2xl font-semibold">Saatnya Isi IRS!!!</div>
                            @endif
                        </div>
                        <div class="flex items-center space-x-10">
                            <h1 class="bg-[#000CB0] px-8 py-2 text-white rounded-3xl">Semester {{ $mahasiswa->semester }}
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-4 mx-8 bg-white rounded-lg">
                    <p class="text-blue-800 ml-4">
                        IPS Anda Semester Lalu : <span class="font-semibold">{{ number_format($mahasiswa->IPS, 2) }}</span>
                    </p>
                    <p class="text-blue-800 ml-4">
                        Batas SKS Yang Dapat Diambil : <span class="font-semibold">{{ $sksLimit }}</span> SKS
                    </p>
                </div>

                <div x-data="{
                    showModal: false,
                    selectedSchedule: null,
                    selectedSchedules: {{ $existingIrsEntries->isEmpty() ? '[]' : $existingIrsEntries->toJson() }},
                    sksLimit: {{ $sksLimit }},
                    currentTotalSks: {{ $existingIrsEntries->sum('sks') ?? 0 }},
                    notification: {
                        show: false,
                        type: '',
                        message: ''
                    },
                
                    checkSksLimit() {
                        this.currentTotalSks = this.selectedSchedules.reduce((total, schedule) => total + parseInt(schedule.sks), 0);
                        return this.currentTotalSks;
                    },
                
                    canAddCourse(newSks) {
                        return (this.currentTotalSks + parseInt(newSks)) <= this.sksLimit;
                    },
                
                    showNotification(type, message) {
                        this.notification.show = true;
                        this.notification.type = type;
                        this.notification.message = message;
                        setTimeout(() => {
                            this.notification.show = false;
                        }, 2000);
                    },
                
                    handleDelete(index) {
                        if (confirm('Are you sure?')) {
                            this.selectedSchedules.splice(index, 1);
                            this.showNotification('success', 'Your file has been deleted!');
                        } else {
                            this.showNotification('error', 'Your file is safe :)');
                        }
                    }
                
                }">
                    <!-- Notifications -->
                    <div x-show="notification.show" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-90"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-90"
                        :class="notification.type === 'success' ? 'bg-green-100 border-green-400 text-green-700' :
                            'bg-red-100 border-red-400 text-red-700'"
                        class="fixed top-4 right-4 px-4 py-3 rounded border z-50 flex items-center" role="alert">
                        <div class="flex">
                            <div class="py-1">
                                <template x-if="notification.type === 'success'">
                                    <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                                    </svg>
                                </template>
                                <template x-if="notification.type === 'error'">
                                    <svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" />
                                    </svg>
                                </template>
                            </div>
                            <div>
                                <p class="font-bold"
                                    x-text="notification.type === 'success' ? 'Success!' : 'Operation Cancelled'"></p>
                                <p class="text-sm" x-text="notification.message"></p>
                            </div>
                        </div>
                    </div>
                    <!-- Bagian jadwal -->
                    <section class="relative mb-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm flex">
                        <div class="w-full max-w-7xl mx-auto px-6 lg:px-8 overflow-x-auto">
                            <div class="grid grid-cols-8 border-t border-gray-200 sticky top-0 left-0 w-full">
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900"></div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Senin
                                </div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Selasa
                                </div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Rabu
                                </div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Kamis
                                </div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Jumat
                                </div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Sabtu
                                </div>
                                <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">Minggu
                                </div>
                            </div>
                            @for ($time = 7; $time <= 21; $time++)
                                <div class="grid grid-cols-8 border-t border-gray-200">
                                    <div class="p-3.5 flex items-center justify-center text-sm font-medium text-gray-900">
                                        {{ $time }}:00
                                    </div>
                                    @for ($day = 1; $day <= 7; $day++)
                                        <div
                                            class="flex flex-col h-auto p-0.5 md:p-3.5 border-r border-gray-200 transition-all hover:bg-stone-100">
                                            @php
                                                $days = [
                                                    'Senin',
                                                    'Selasa',
                                                    'Rabu',
                                                    'Kamis',
                                                    'Jumat',
                                                    'Sabtu',
                                                    'Minggu',
                                                ];
                                                $schedules = [];
                                                foreach ($jadwals as $jadwal) {
                                                    $j = [
                                                        'id' => $jadwal->id,
                                                        'day' => $jadwal->hari,
                                                        'kode_mk' => $jadwal->kode_mk,
                                                        'sks' => $jadwal->sks,
                                                        'kapasitas' => $jadwal->kapasitas,
                                                        'start' => $jadwal->jam_mulai,
                                                        'end' => $jadwal->jam_selesai,
                                                        'title' => $jadwal->nama_mk,
                                                        'kelas' => $jadwal->kelas,
                                                        'ruangan' => $jadwal->ruang,
                                                        'jenis' => $jadwal->status,
                                                    ];
                                                    array_push($schedules, $j);
                                                }
                                            @endphp
                                            @foreach ($schedules as $schedule)
                                                @if ($schedule['day'] == $days[$day - 1] && $time == intval(substr($schedule['start'], 0, 2)))
                                                    @php
                                                        $startHour = intval(substr($schedule['start'], 0, 2));
                                                        $endHour = intval(substr($schedule['end'], 0, 2));
                                                        $duration = $endHour - $startHour;
                                                        $colorClass = match ($schedule['kelas']) {
                                                            'A' => 'bg-blue-50 border-blue-600 text-blue-600',
                                                            'B' => 'bg-red-50 border-red-600 text-red-600',
                                                            'C' => 'bg-green-50 border-green-600 text-green-600',
                                                            'D' => 'bg-purple-50 border-purple-600 text-purple-600',
                                                            default => 'bg-gray-50 border-gray-600 text-gray-600',
                                                        };
                                                    @endphp
                                                    <div class="flex items-center space-x-2"
                                                        style="grid-row: span {{ $duration }};"
                                                        :class="[
                                                            selectedSchedules.some(s => s
                                                                .kode_mk === '{{ $schedule['kode_mk'] }}') &&
                                                            !selectedSchedules.some(s => s.id ===
                                                                {{ $schedule['id'] }}) ? 'opacity-50' : '',
                                                            {{ $period !== 'edit_period' || $mahasiswa->akses !== 'yes' || in_array($schedule['id'], $existingIrs) ? 'true' : 'false' }} ?
                                                            'opacity-50' : ''
                                                        ]">
                                                        <div class="flex items-center">
                                                            <input type="checkbox" 
                                                                class="w-4 h-4"
                                                                :checked="selectedSchedules.some(s => s.id === {{ $schedule['id'] }})"
                                                                :disabled="{{ $period !== 'edit_period' || $mahasiswa->akses !== 'yes' || in_array($schedule['id'], $existingIrs) ? 'true' : 'false' }}"
                                                                @change="
                                                                    if ($event.target.checked) {
                                                                        {{-- // Cek jika SKS sudah mencapai atau akan melebihi batas --}}
                                                                        if (!canAddCourse({{ $schedule['sks'] }})) {
                                                                            $event.target.checked = false;
                                                                            const totalSksAfterAdd = currentTotalSks + {{ $schedule['sks'] }};
                                                                            Swal.fire({
                                                                                title: 'Batas SKS Terlampaui',
                                                                                html: 'Tidak dapat menambah mata kuliah ini karena akan melebihi batas SKS Anda', 
                                                                                icon: 'error',
                                                                                confirmButtonColor: '#3085d6',
                                                                                confirmButtonText: 'OK'
                                                                            });
                                                                            return;
                                                                        }

                                                                        {{-- // Cek jika sudah memilih mata kuliah yang sama --}}
                                                                        if (selectedSchedules.some(s => s.kode_mk === '{{ $schedule['kode_mk'] }}')) {
                                                                            $event.target.checked = false;
                                                                            Swal.fire({
                                                                                title: 'Mata Kuliah Sudah Dipilih',
                                                                                text: 'Anda sudah memilih kelas untuk mata kuliah ini.',
                                                                                icon: 'warning',
                                                                                confirmButtonColor: '#3085d6',
                                                                                confirmButtonText: 'OK'
                                                                            });
                                                                            return;
                                                                        }

                                                                        {{-- // Cek jadwal yang bertabrakan --}}
                                                                        const hasConflict = selectedSchedules.some(s => 
                                                                            s.day === '{{ $schedule['day'] }}' && (
                                                                                ({{ intval(substr($schedule['start'], 0, 2)) }} >= parseInt(s.start) && 
                                                                                {{ intval(substr($schedule['start'], 0, 2)) }} < parseInt(s.end))
||
                                                                                ({{ intval(substr($schedule['end'], 0, 2)) }} > parseInt(s.start) && 
                                                                                {{ intval(substr($schedule['end'], 0, 2)) }} <= parseInt(s.end)) ||
                                                                                (parseInt(s.start) >= {{ intval(substr($schedule['start'], 0, 2)) }} && 
                                                                                parseInt(s.start) < {{ intval(substr($schedule['end'], 0, 2)) }})
                                                                            )
                                                                        );

                                                                        if (hasConflict) {
                                                                            $event.target.checked = false;
                                                                            Swal.fire({
                                                                                title: 'Jadwal Bertabrakan',
                                                                                text: 'Jadwal bertabrakan dengan mata kuliah yang sudah dipilih.',
                                                                                icon: 'error',
                                                                                confirmButtonColor: '#3085d6',
                                                                                confirmButtonText: 'OK'
                                                                            });
                                                                            return;
                                                                        }

                                                                        // Tambahkan jadwal jika semua pengecekan berhasil
                                                                        selectedSchedules.push({
                                                                            id: {{ $schedule['id'] }},
                                                                            day: '{{ $schedule['day'] }}',
                                                                            kode_mk: '{{ $schedule['kode_mk'] }}',
                                                                            sks: {{ $schedule['sks'] }},
                                                                            kapasitas: {{ $schedule['kapasitas'] }},
                                                                            start: '{{ $schedule['start'] }}',
                                                                            end: '{{ $schedule['end'] }}',
                                                                            title: '{{ $schedule['title'] }}',
                                                                            kelas: '{{ $schedule['kelas'] }}',
                                                                            ruangan: '{{ $schedule['ruangan'] }}',
                                                                            jenis: '{{ $schedule['jenis'] }}'
                                                                        });
                                                                        Swal.fire({
                                                                            title: 'Berhasil',
                                                                            text: 'Mata kuliah berhasil ditambahkan',
                                                                            icon: 'success',
                                                                            showConfirmButton: false,
                                                                            timer: 1500
                                                                        });
                                                                        currentTotalSks = checkSksLimit();
                                                                    } else {
                                                                        selectedSchedules = selectedSchedules.filter(s => s.id !== {{ $schedule['id'] }});
                                                                        currentTotalSks = checkSksLimit();
                                                                        Swal.fire({
                                                                            title: 'Dihapus',
                                                                            text: 'Mata kuliah telah dihapus dari pilihan',
                                                                            icon: 'success',
                                                                            showConfirmButton: false,
                                                                            timer: 1500
                                                                        });
                                                                    }
                                                                ">
                                                        </div>
                                                        <div
                                                            class="rounded p-1.5 border-l-2 {{ $colorClass }} w-full text-left mt-6">
                                                            <p class="text-xs font-normal mb-px">{{ $schedule['title'] }}
                                                            </p>
                                                            <p class="text-xs font-normal mb-px">Kelas :
                                                                {{ $schedule['kelas'] }}</p>
                                                            <p class="text-xs font-normal mb-px">SKS :
                                                                {{ $schedule['sks'] }}</p>
                                                            <p class="text-xs font-normal mb-px">Kapasitas :
                                                                {{ $schedule['kapasitas'] }}</p>
                                                            <p class="text-xs font-semibold">{{ $schedule['start'] }} -
                                                                {{ $schedule['end'] }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                        </div>

                        <!-- drawer init and toggle -->
                        <div class="fixed bottom-5 right-5 text-center">
                            <button
                                class="text-white bg-blue-800 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                type="button" data-drawer-target="drawer-right-example"
                                data-drawer-show="drawer-right-example" data-drawer-placement="right"
                                aria-controls="drawer-right-example">
                                IRS
                            </button>
                        </div>

                        <!-- drawer component -->
                        <div id="drawer-right-example"
                            class="rounded-l-3xl fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800"
                            tabindex="-1" aria-labelledby="drawer-right-label">
                            <h1 id="drawer-right-label"
                                class="inline-flex items-center mb-4 ml-2 text-base font-bold text-black">Matakuliah Yang
                                Dipilih</h1>
                            <button type="button" data-drawer-hide="drawer-right-example"
                                aria-controls="drawer-right-example"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 1l12 12M1 13L13 1" />
                                </svg>
                                <span class="sr-only">Close menu</span>
                            </button>

                            <!-- Tabel Mata Kuliah yang Dipilih -->
                            <form action="{{ route('store.irs') }}" method="POST">
                                @csrf
                                <div class="mt-4 overflow-x-auto p-2 rounded-lg font-poppins">
                                    <table class="min-w-full table-auto border-collapse text-sm">
                                        <thead class="bg-[#5932EA] text-white">
                                            <tr>
                                                <th class="border px-4 py-2 text-left">Nama MK</th>
                                                <th class="border px-4 py-2 text-left">Kode MK</th>
                                                <th class="border px-4 py-2 text-left">SKS</th>
                                                <th class="border px-4 py-2 text-left">Kelas</th>
                                                <th class="border px-4 py-2 text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template x-for="(schedule, index) in selectedSchedules"
                                                :key="schedule.id">
                                                <tr class="hover:bg-gray-100 transition-colors">
                                                    <td class="border px-4 py-2" x-text="schedule.title"></td>
                                                    <td class="border px-4 py-2" x-text="schedule.kode_mk"></td>
                                                    <td class="border px-4 py-2" x-text="schedule.sks"></td>
                                                    <td class="border px-4 py-2" x-text="schedule.kelas"></td>
                                                    <td class="border px-4 py-2 text-center">
                                                        <button
                                                            @click.prevent="
                                                        Swal.fire({
                                                            title: 'Konfirmasi Hapus',
                                                            text: 'Apakah anda yakin ingin menghapus mata kuliah ini?',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Ya, Hapus',
                                                            cancelButtonText: 'Batal'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                // Send delete request
                                                                fetch(`/mhs/BuatIrs/delete/${schedule.id}`, {
                                                                    method: 'DELETE',
                                                                    headers: {
                                                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                                                        'Accept': 'application/json'
                                                                    }
                                                                })
                                                                .then(response => response.json())
                                                                .then(data => {
                                                                    if (data.success) {
                                                                        selectedSchedules.splice(index, 1);
                                                                        Swal.fire(
                                                                            'Terhapus!',
                                                                            'Mata kuliah berhasil dihapus dari pilihan.',
                                                                            'success'
                                                                        );
                                                                    } else {
                                                                        throw new Error(data.message);
                                                                    }
                                                                })
                                                                .catch(error => {
                                                                    Swal.fire(
                                                                        'Error!',
                                                                        error.message || 'Terjadi kesalahan saat menghapus mata kuliah.',
                                                                        'error'
                                                                    );
                                                                });
                                                            }
                                                        })"
                                                            class="text-red-600 hover:text-red-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                                viewBox="0 0 20 20" fill="currentColor">
                                                                <path
                                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2h1v10a2 2 0 002 2h6a2 2 0 002-2V6h1a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zm1 4a1 1 0 011 1v7a1 1 0 11-2 0V7a1 1 0 011-1zM7 7a1 1 0 10-2 0v7a1 1 0 102 0V7zm8 0a1 1 0 10-2 0v7a1 1 0 102 0V7z" />
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Hidden inputs to bind the selected schedules -->
                                <div>
                                    <template x-for="(schedule, index) in selectedSchedules" :key="schedule.id">
                                        <input type="hidden" :name="'selectedSchedules[' + index + '][id]'"
                                            :value="schedule.id">
                                        <input type="hidden" :name="'day[' + index + ']'" :value="schedule.day">
                                        <input type="hidden" :name="'kode_mk[' + index + ']'" :value="schedule.kode_mk">
                                        <input type="hidden" :name="'sks[' + index + ']'" :value="schedule.sks">
                                        <input type="hidden" :name="'kapasitas[' + index + ']'"
                                            :value="schedule.kapasitas">
                                        <input type="hidden" :name="'start[' + index + ']'" :value="schedule.start">
                                        <input type="hidden" :name="'end[' + index + ']'" :value="schedule.end">
                                        <input type="hidden" :name="'title[' + index + ']'" :value="schedule.title">
                                        <input type="hidden" :name="'kelas[' + index + ']'" :value="schedule.kelas">
                                        <input type="hidden" :name="'ruangan[' + index + ']'" :value="schedule.ruangan">
                                        <input type="hidden" :name="'jenis[' + index + ']'" :value="schedule.jenis">
                                    </template>
                                </div>

                                <div class="flex items-center justify-between px-2 mt-4">
                                    <div class="text-lg font-semibold">
                                        Total SKS: <span
                                            x-text="selectedSchedules.reduce((total, schedule) => total + schedule.sks, 0)"
                                            class="text-blue-600"></span>
                                    </div>
                                    <div>
                                        @if($period === 'edit_period')
                                            @if($mahasiswa->akses === 'yes')
                                                <button
                                                    class="bg-blue-700 text-white px-3 py-1.5 rounded-md disabled:opacity-50 disabled:cursor-not-allowed"
                                                    x-bind:disabled="selectedSchedules.length === 0"
                                                    x-show="selectedSchedules.length > 0">
                                                    Simpan
                                                </button>
                                            @else
                                                <form method="POST" action="{{ route('store.irs') }}">
                                                    @csrf
                                                    <input type="hidden" name="value" value="batal">
                                                    <button type="submit" class="bg-red-700 text-white px-3 py-1.5 rounded-md">
                                                        Batalkan
                                                    </button>
                                                </form>
                                            @endif
                                        @elseif($period === 'cancel_period')
                                        <form method="POST" action="{{ route('store.irs') }}">
                                            @csrf
                                            <input type="hidden" name="value" value="batalbanget">
                                            <button type="submit" class="bg-red-700 text-white px-3 py-1.5 rounded-md">
                                                Batalkan
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <script>
            function updateClock() {
                const clockElement = document.getElementById('real-time-clock');
                if (clockElement) {
                    const now = new Date();
                    const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
                    const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
                        "Oktober", "November", "Desember"
                    ];

                    const dayName = days[now.getDay()];
                    const monthName = months[now.getMonth()];
                    const day = String(now.getDate()).padStart(2, '0');
                    const year = now.getFullYear();

                    const hours = String(now.getHours()).padStart(2, '0');
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    const seconds = String(now.getSeconds()).padStart(2, '0');

                    clockElement.innerText = `${dayName}, ${day} ${monthName} ${year} | ${hours} : ${minutes} : ${seconds}`;
                }
            }
            updateClock();

            setInterval(updateClock, 1000);
        </script>

    </div>
@endsection
