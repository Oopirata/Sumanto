@extends('main')

@section('title', 'Form Input Nilai')

@section('page')
    <div class="bg-gray-100 min-h-screen flex justify-center items-center">
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <div class="mx-8 rounded-2xl mt-4 bg-white shadow p-8 mb-6">
                <!-- Informasi Mahasiswa -->
                <div class="flex justify-between mb-6">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Nama: Raka Maulana Yusuf</p>
                        <p class="text-sm font-medium text-gray-700">NIM: 24060122140119</p>
                        <p class="text-sm font-medium text-gray-700">Mata Kuliah: Struktur Data A</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-700">Pengampu: Dr.Eng. Mukidi Sukidi, S.Si, M.Kom.</p>
                        <p class="text-sm font-medium text-gray-700">NIP: 2298976546789</p>
                    </div>
                </div>

                <!-- Form Nilai -->
                <div class="border rounded-lg overflow-hidden">
                    <div class="bg-purple-500 text-white text-center font-semibold">
                        <div class="grid grid-cols-5">
                            <p class="py-2">Nilai Partisipatif</p>
                            <p class="py-2">Nilai Proyek</p>
                            <p class="py-2">Nilai Tugas</p>
                            <p class="py-2">Nilai UTS</p>
                            <p class="py-2">Nilai UAS</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-5 border bg-white">
                        <input type="number" step="1" placeholder="0" class="border py-2 px-3 text-center">
                        <input type="number" step="1" placeholder="0" class="border py-2 px-3 text-center">
                        <input type="number" step="1" placeholder="0" class="border py-2 px-3 text-center">
                        <input type="number" step="1" placeholder="0" class="border py-2 px-3 text-center">
                        <input type="number" step="1" placeholder="0" class="border py-2 px-3 text-center">
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div class="mt-6 text-center">
                    <button
                        class="bg-blue-600 text-white font-bold py-2 px-8 rounded-full shadow-lg hover:bg-blue-700 transition">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
