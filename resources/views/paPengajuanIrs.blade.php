@extends('main')

@section('title', 'Verifikasi Jadwal')

@section('page')
    <div class="bg-gray-100 min-h-screen flex flex-col">
        <div class="flex overflow-hidden">
            <x-side-bar-pa :dosens="$dosens" :dosen="$dosen"></x-side-bar-pa>
            <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
                <x-nav-bar :dosens="$dosens" :dosen="$dosen"></x-nav-bar>

                <div class="border-b-4"></div>
                <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                    <div class="flex justify-between items-center">
                        <div>
                            <h1 class="text-black font-bold items-center">Verifikasi IRS</h1>
                        </div>

                        <div>
                            <div class="flex">
                                <div>
                                    <x-strata></x-strata>
                                </div>
                                <div class="px-4"></div>
                                <div>
                                    <x-jurusan></x-jurusan>
                                </div>
                                <div class="px-4"></div>
                                <div>
                                    <x-semester></x-semester>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel Verifikasi -->
                <div class="mt-10 p-8 mx-8 bg-white rounded-xl shadow-md overflow-hidden" style="max-height: 550px;">
                    <table id="tabelVeri" class="text-center w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">NIM</th>
                                <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($mahasiswa as $student)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">{{ $student['nama'] }}</td>
                                    <td class="px-6 py-4">{{ $student['nim'] }}</td>
                                    <td class="px-6 py-4">
                                        <button href="dosen/dashboard" class="btn-detail bg-[#000CB0] text-white px-3 py-1 rounded-full mr-2">Detail</button>
                                        <button class="btn-setuju bg-[#4BD37B] text-white px-3 py-1 rounded-full mr-2" onclick="setujui(this)">Setuju</button>
                                        <button class="btn-tolak bg-red-600 text-white px-3 py-1 rounded-full" onclick="tolak(this)">Tolak</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setujui(button) {
            const detailButton = button.parentNode.querySelector('.btn-detail');
            const tolakButton = button.parentNode.querySelector('.btn-tolak');
            detailButton.style.display = 'none';
            tolakButton.style.display = 'none';

            button.innerText = "Disetujui";
            button.classList.remove("bg-[#4BD37B]");
            button.classList.add("bg-green-600", "text-white");
            button.disabled = true;

            const batalkanButton = document.createElement("button");
            batalkanButton.classList.add("bg-red-600", "text-white", "px-3", "py-1", "rounded-full", "ml-2");
            batalkanButton.innerText = "Pembatalan";
            batalkanButton.onclick = function() {
                batalkan(button, batalkanButton, detailButton, tolakButton);
            };

            button.parentNode.appendChild(batalkanButton);
        }

        function tolak(button) {
            const detailButton = button.parentNode.querySelector('.btn-detail');
            const setujuButton = button.parentNode.querySelector('.btn-setuju');
            detailButton.style.display = 'none';
            setujuButton.style.display = 'none';

            button.innerText = "Ditolak";
            button.classList.remove("bg-red-600");
            button.classList.add("bg-red-800", "text-white");
            button.disabled = true;

            const batalkanButton = document.createElement("button");
            batalkanButton.classList.add("bg-red-600", "text-white", "px-3", "py-1", "rounded-full", "ml-2");
            batalkanButton.innerText = "Pembatalan";
            batalkanButton.onclick = function() {
                batalkan(button, batalkanButton, detailButton, setujuButton);
            };

            button.parentNode.appendChild(batalkanButton);
        }

        function batalkan(actionButton, batalkanButton, detailButton, otherButton) {
            if (actionButton.classList.contains('bg-green-600')) {
                // If it was the Setuju button
                actionButton.innerText = "Setuju";
                actionButton.classList.remove("bg-green-600");
                actionButton.classList.add("bg-[#4BD37B]", "text-white");
            } else {
                // If it was the Tolak button
                actionButton.innerText = "Tolak";
                actionButton.classList.remove("bg-red-800");
                actionButton.classList.add("bg-red-600", "text-white");
            }
            actionButton.disabled = false;

            detailButton.style.display = 'inline-block';
            otherButton.style.display = 'inline-block';

            batalkanButton.remove();
        }

        $(document).ready(function() {
        $('#tabelVeri').DataTable({
            paging: true,        // Enable pagination
            searching: true,     // Enable search box
            info: false,         // Disable table information display
            pageLength: 5,       // Set default number of rows per page
            lengthChange: false, // Hide the option to change number of rows per page
            columnDefs: [
                { className: "dt-head-center", targets: [0, 1, 2, 3] },
                { className: "dt-body-center", targets: [0, 1, 2, 3] }
            ],
            language: {
                paginate: {
                    previous: "<",
                    next: ">"
                },
                search: "Search:"
            }
        });
    });
    </script>
@endsection
