@extends('main')

@section('title', 'Buat Jadwal')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex overflow-hidden">
        <x-side-bar-dekan></x-side-bar-dekan>
        <div id="main-content" class=" relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar></x-nav-bar>
            <div class="border-b-4"></div>
            <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-black font-bold items-center">Jadwal</h1>
                    </div>
                    
                    <div>
                        <div class="flex justify-between">
                            <div>
                                <x-jurusan></x-jurusan>
                            </div>
                            <div class="px-4 bg-white"></div>
                            <div>
                                <x-semester></x-semester>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <>
                <div x-data="{ showModal: false, selectedSchedule: null }">
                    <!-- Bagian jadwal -->
                    <section class="relative mb-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
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
                                                $schedules = [
                                                    ['day' => 1, 'start' => 7, 'end' => 9, 'title' => 'PBP (A)', 'time' => '06:00 - 07:55', 'kelas' => 'A'],
                                                    ['day' => 1, 'start' => 7, 'end' => 9, 'title' => 'PBP (B)', 'time' => '06:00 - 07:55', 'kelas' => 'B'],
                                                    ['day' => 1, 'start' => 7, 'end' => 9, 'title' => 'PBP (C)', 'time' => '06:00 - 07:55', 'kelas' => 'C'],
                                                    ['day' => 2, 'start' => 8, 'end' => 10, 'title' => 'Pemrograman Web', 'time' => '08:00 - 09:55', 'kelas' => 'A'],
                                                    // Tambahkan jadwal lainnya sesuai kebutuhan
                                                ];
                                            @endphp
                                            @foreach ($schedules as $schedule)
                                                @if ($schedule['day'] == $day && $time >= $schedule['start'] && $time < $schedule['end'])
                                                    @php
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
                                                        <p class="text-xs font-semibold">{{ $schedule['time'] }}</p>
                                                    </button>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                        </div>
                    </section>

                    <!-- Modal Pop-up -->
                    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto">
                        <div class="flex items-center justify-center min-h-screen px-4 text-center">
                            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                                <div class="px-4 py-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="selectedSchedule.title"></h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Kelas: <span x-text="selectedSchedule.kelas"></span></p>
                                        <p class="text-sm text-gray-500">Waktu: <span x-text="selectedSchedule.time"></span></p>
                                    </div>
                                    <div class="mt-4">
                                        <button @click="showModal = false" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="px-6 py-4 flex justify-end space-x-3" x-data="{ status: null }">
                <button 
                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded" 
                    @click="status = 'Tidak Setuju'">
                    <span x-show="status !== 'Tidak Setuju'">Tidak Setuju</span>
                    <span x-show="status === 'Tidak Setuju'">Tidak Disetujui</span>
                </button>

                <button 
                    :class="status === 'Setuju' ? 'bg-green-700' : 'bg-green-500 hover:bg-green-600'" 
                    class="text-white py-2 px-4 rounded transition-all" 
                    @click="status = 'Setuju'">
                    <span x-show="status !== 'Setuju'">Setuju</span>
                    <span x-show="status === 'Setuju'">Disetujui</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
