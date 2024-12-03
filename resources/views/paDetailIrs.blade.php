@extends('main')

@section('title', 'Dashboard')

@section('page')
    <div class="bg-gray-100 min-h-screen flex flex-col font-poppins">
        <div class="flex overflow-hidden">
            <x-side-bar-pa :dosen="$dosen" :dosens="$dosens"></x-side-bar-pa>
            <div id="main-content" class="relative text-black ml-64 w-full h-full overflow-y-auto">
                <x-nav-bar :dosen="$dosen" :dosens="$dosens"></x-nav-bar>

                <!-- Main content -->
                <div class="mx-8 rounded-2xl mt-4">
                    <!-- User Information Section -->
                    <div class="bg-white rounded-lg shadow p-8 mb-6">
                        <!-- Home Button -->
                        <div class="mx-8 mt-4">
                            <a href="/dosen/PengajuanIrs" class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg">Home</a>
                        </div>
                        <div class="text-center">
                            <h2 class="text-2xl font-semibold">IRS</h2>
                        </div>

                        <!-- Status and Student Name Row -->
                        <div class="flex justify-center items-center space-x-6 mt-2">
                            <h3 class="text-xl">Ahmad Douglas - 24060122199999</h3>
                        </div>

                        <!-- Table Section -->
                        <table class="w-full text-sm text-left text-gray-500 mt-6 border-collapse" style="border: 2px solid white;">
                            <thead class="text-[#F9FBFF] bg-[#5932EA] text-md font-semibold" style="border-top: 4px solid white;">
                                <tr>
                                    <th class="px-4 py-3 text-center border border-white">No</th>
                                    <th class="px-4 py-3 border border-white">Kode</th>
                                    <th class="px-4 py-3 border border-white">Mata Kuliah</th>
                                    <th class="px-4 py-3 text-center border border-white">Kelas</th>
                                    <th class="px-4 py-3 text-center border border-white">SKS</th>
                                    <th class="px-4 py-3 border border-white">Ruang</th>
                                    <th class="px-4 py-3 border border-white">Status</th>
                                    <th class="px-4 py-3 border border-white">Nama Dosen</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-800">
                                <!-- Example Row - Repeat these rows for each course -->
                                <tr class="bg-gray-100 border-b">
                                    <td class="px-4 py-4 text-center border border-gray-200">1</td>
                                    <td class="px-4 py-4 border border-gray-200">PAIK102</td>
                                    <td class="px-4 py-4 border border-gray-200">Dasar Pemrograman</td>
                                    <td class="px-4 py-4 text-center border border-gray-200">D</td>
                                    <td class="px-4 py-4 text-center border border-gray-200">3</td>
                                    <td class="px-4 py-4 border border-gray-200">A204</td>
                                    <td class="px-4 py-4 border border-gray-200">BARU</td>
                                    <td class="px-4 py-4 border border-gray-200">Dr.Eng. Adi Wibowo, S.Si., M.Kom.<br>Khadijah, S.Kom., M.Cs.</td>
                                </tr>
                                <!-- Additional rows for each course should follow the same structure -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
