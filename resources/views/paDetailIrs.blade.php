@extends('main')

@section('title', 'Detail IRS')

@section('page')
    <div class="bg-gray-100 min-h-screen flex flex-col font-poppins">
        <div class="flex overflow-hidden">
            <x-side-bar-pa :dosen="$dosen" :dosens="$dosens"></x-side-bar-pa>
            <div id="main-content" class="relative text-black ml-64 w-full h-full overflow-y-auto">
                <x-nav-bar :dosen="$dosen" :dosens="$dosens"></x-nav-bar>

                <!-- Main content -->
                <div class="mx-8 rounded-2xl mt-4">
                    <div class="bg-white rounded-lg shadow p-8 mb-6">
                        <!-- Home Button -->
                        <div class="mx-8 mt-4">
                            <a href="{{ route('DosenPengajuan.irs') }}"
                                class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg">Kembali</a>
                        </div>
                        <div class="text-center">
                            <h2 class="text-2xl font-semibold">IRS</h2>
                        </div>

                        <!-- Student Name -->
                        <div class="flex justify-center items-center space-x-6 mt-2">
                            <h3 class="text-xl">{{ $mahasiswa->nama }} - {{ $mahasiswa->nim }}</h3>
                        </div>

                        <!-- Form for updating IRS statuses -->
                        <form action="{{ route('updateStatusIrs', $mahasiswa->nim) }}" method="POST">
                            @csrf
                            @method('POST')

                            <!-- Table Section -->
                            <div class="overflow-x-auto mt-6">
                                <table class="w-full text-sm text-left text-gray-500 border-collapse border border-gray-200">
                                    <thead class="text-white bg-[#5932EA] font-semibold">
                                        <tr>
                                            <th class="px-4 py-3 text-center border border-white">No</th>
                                            <th class="px-4 py-3 border border-white">Kode MK</th>
                                            <th class="px-4 py-3 border border-white">Mata Kuliah</th>
                                            <th class="px-4 py-3 text-center border border-white">Kelas</th>
                                            <th class="px-4 py-3 text-center border border-white">SKS</th>
                                            <th class="px-4 py-3 border border-white">Ruang</th>
                                            <th class="px-4 py-3 text-center border border-white">Hari</th>
                                            <th class="px-4 py-3 text-center border border-white">Jam</th>
                                            <th class="px-4 py-3 border border-white">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($irsData as $index => $irs)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-4 py-3 text-center border border-gray-200">{{ $index + 1 }}</td>
                                                <td class="px-4 py-3 border border-gray-200">{{ $irs->jadwal->kode_mk }}</td>
                                                <td class="px-4 py-3 border border-gray-200">{{ $irs->jadwal->nama_mk }}</td>
                                                <td class="px-4 py-3 text-center border border-gray-200">{{ $irs->jadwal->kelas }}</td>
                                                <td class="px-4 py-3 text-center border border-gray-200">{{ $irs->jadwal->sks }}</td>
                                                <td class="px-4 py-3 border border-gray-200">{{ $irs->jadwal->ruang }}</td>
                                                <td class="px-4 py-3 text-center border border-gray-200">{{ $irs->jadwal->hari }}</td>
                                                <td class="px-4 py-3 text-center border border-gray-200">
                                                    {{ $irs->jadwal->jam_mulai }} - {{ $irs->jadwal->jam_selesai }}
                                                </td>
                                                <td class="px-4 py-3 border border-gray-200">
                                                    <span class="px-2 py-1 rounded 
                                                        {{ match ($irs->status) {
                                                            'baru' => 'bg-green-100 text-green-500',
                                                            'perbaikan' => 'bg-yellow-100 text-yellow-500',
                                                            'rejected' => 'bg-red-100 text-red-500',
                                                            'pending' => 'bg-blue-100 text-blue-500',
                                                            default => 'bg-gray-100 text-gray-500',
                                                        } }}">
                                                        {{ ucfirst($irs->status) }}
                                                        @if($irs->status === 'pending')
                                                            {{ $irs->isRetake ? '(Mengulang)' : '(Baru)' }}
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="px-4 py-3 text-center border border-gray-200">
                                                    Tidak ada data IRS
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Total SKS and Action Buttons -->
                            <div class="mt-6 flex justify-between items-center">
                                <div class="space-x-2">
                                    @if ($irsData->contains('status', 'pending'))
                                        <button type="submit" name="action" value="approve"
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                                            Setujui Semua
                                        </button>
                                        <button type="submit" name="action" value="reject"
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                            Tolak Semua
                                        </button>
                                    @endif
                                </div>
                                <p class="text-lg font-semibold">
                                    Total SKS: {{ $irsData->sum(function ($irs) {return $irs->jadwal->sks;}) }}
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection