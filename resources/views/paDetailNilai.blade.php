@extends('main')

@section('title', 'Verifikasi Nilai')

@section('page')
    <div class="bg-gray-100 min-h-screen flex flex-col">
        <div class="flex overflow-hidden">
            <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">

                <div class="border-b-4"></div>
        

                <!-- Tabel Verifikasi -->
                <div class="mt-10 p-8 mx-8 bg-white rounded-xl shadow-md overflow-hidden">
                    <table id="tabelNilai" class="text-center w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">NO</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">NIM</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Matakuliah</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Nilai</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Kelola</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">1</td>
                                <td class="px-6 py-4">24060122140119</td>
                                <td class="px-6 py-4">Raka Maulana Yusuf</td>
                                <td class="px-6 py-4">Struktur Data A</td>
                                <td class="px-6 py-4">A</td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-full">Ubah</button>
                                    <button class="bg-red-600 text-white px-4 py-2 rounded-full">Hapus</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">2</td>
                                <td class="px-6 py-4">24060122140127</td>
                                <td class="px-6 py-4">Muhammad Mirza Faiz Rabbani</td>
                                <td class="px-6 py-4">Struktur Data A</td>
                                <td class="px-6 py-4">A</td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-full">Ubah</button>
                                    <button class="bg-red-600 text-white px-4 py-2 rounded-full">Hapus</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">3</td>
                                <td class="px-6 py-4">24060122120031</td>
                                <td class="px-6 py-4">Bintang Syafrian Rizal</td>
                                <td class="px-6 py-4">Struktur Data A</td>
                                <td class="px-6 py-4">A</td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-full">Ubah</button>
                                    <button class="bg-red-600 text-white px-4 py-2 rounded-full">Hapus</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">4</td>
                                <td class="px-6 py-4">24060122120015</td>
                                <td class="px-6 py-4">Hanif Herofa</td>
                                <td class="px-6 py-4">Struktur Data B</td>
                                <td class="px-6 py-4">B</td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-full">Ubah</button>
                                    <button class="bg-red-600 text-white px-4 py-2 rounded-full">Hapus</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">5</td>
                                <td class="px-6 py-4">24060122120039</td>
                                <td class="px-6 py-4">Awang Pratama Mulya</td>
                                <td class="px-6 py-4">Struktur Data B</td>
                                <td class="px-6 py-4">B</td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-full">Ubah</button>
                                    <button class="bg-red-600 text-white px-4 py-2 rounded-full">Hapus</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">6</td>
                                <td class="px-6 py-4">24060122122056</td>
                                <td class="px-6 py-4">Dul Samsi</td>
                                <td class="px-6 py-4">Struktur Data C</td>
                                <td class="px-6 py-4">C</td>
                                <td class="px-6 py-4 flex justify-center gap-2">
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-full">Ubah</button>
                                    <button class="bg-red-600 text-white px-4 py-2 rounded-full">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#tabelNilai').DataTable({
                paging: false,
                searching: false,
                info: false,
                columnDefs: [
                    { className: "dt-head-center", targets: "_all" },
                    { className: "dt-body-center", targets: "_all" }
                ]
            });
        });
    </script>
@endsection
