@extends('main')

@section('title', 'Verifikasi Jadwal')

@section('page')
    <div class="bg-gray-100 min-h-screen flex flex-col">
        <div class="flex overflow-hidden">
            
            <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
                
                <!-- Tabel Verifikasi -->
                <div class="mt-10 p-8 mx-8 bg-white rounded-xl shadow-md overflow-hidden">
                    <table id="tabelJadwal" class="text-center w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Kode</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Mata Kuliah</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Pengampu</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Kelola</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">1</td>
                                <td class="px-6 py-4">PAIK6101</td>
                                <td class="px-6 py-4">Struktur Data</td>
                                <td class="px-6 py-4">
                                    Dr.Eng. Mukidi Sukidi, S.Si., M.Kom.<br>
                                    Dr.Eng. Mulyadi Utowo, S.Si., M.Kom.
                                </td>
                                <td class="px-6 py-4">
                                    <button class="btn-detail bg-[#000CB0] text-white px-4 py-2 rounded-full">Detail</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">2</td>
                                <td class="px-6 py-4">PAIK6102</td>
                                <td class="px-6 py-4">Dasar Pemrograman</td>
                                <td class="px-6 py-4">
                                    Dr.Eng. Mukidi Sukidi, S.Si., M.Kom.<br>
                                    Ahmad Subekti, S.Si., M.Kom.
                                </td>
                                <td class="px-6 py-4">
                                    <button class="btn-detail bg-[#000CB0] text-white px-4 py-2 rounded-full">Detail</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">3</td>
                                <td class="px-6 py-4">PAIK6504</td>
                                <td class="px-6 py-4">Proyek Perangkat Lunak</td>
                                <td class="px-6 py-4">
                                    Ahmad Subekti, S.Si., M.Kom.<br>
                                    Dr.Eng. Mukidi Sukidi, S.Si., M.Kom.
                                </td>
                                <td class="px-6 py-4">
                                    <button class="btn-detail bg-[#000CB0] text-white px-4 py-2 rounded-full">Detail</button>
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
            $('#tabelJadwal').DataTable({
                paging: true,
                searching: false,
                info: false,
                pageLength: 5,
                lengthChange: false,
                columnDefs: [
                    { className: "dt-head-center", targets: "_all" },
                    { className: "dt-body-center", targets: "_all" }
                ],
                language: {
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                }
            });
        });
    </script>
@endsection
