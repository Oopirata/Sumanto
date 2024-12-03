@extends('main')

@section('title', 'Verifikasi Ruangan')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex overflow-hidden">
        <x-side-bar-ba :dosen="$dosen"></x-side-bar-ba>
        <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar :dosen="$dosen" :dosens="$dosens"></x-nav-bar>
            
            <div class="border-b-4"></div>
            <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-black font-bold items-center">List Ruangan</h1>
                    </div>
                    {{-- {{ dd($ruang) }} --}}
                    <div>
                        <div class="flex items-center space-x-4">
                            <!-- Dropdown Jurusan -->
                            <div class="text-center">
                                <select id="prodi" name="prodi" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Tidak Ada</option>
                                    <option value="Informatika">Informatika</option>
                                    <option value="Kimia">Kimia</option>
                                    <option value="Fisika">Fisika</option>
                                </select>
                            </div>


                            <div class="text-center">
                                <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-9 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" 
                                        type="button" 
                                        data-drawer-target="drawer-right-example" 
                                        data-drawer-show="drawer-right-example" 
                                        data-drawer-placement="right" 
                                        aria-controls="drawer-right-example">
                                    <svg class="w-4 h-4 inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 01-2 0v-6H4a1 1 0 110-2h6V4a1 1 0 011-1z" clip-rule="evenodd"/>
                                    </svg>
                                    Tambah Ruangan
                                </button>
                            </div>

                            <!-- drawer component -->
                            <div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
                                <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                                    <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                    </svg>
                                    Tambah Ruangan
                                </h5>
                                <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l12 12M1 13L13 1"/>
                                    </svg>
                                    <span class="sr-only">Close menu</span>
                                </button>
                                <ul class="space-y-4">
                                    <li>
                                        <form action="{{ route('store.ruangan') }}" method="POST" class="space-y-4 p-6 bg-gray-50 border border-gray-300 rounded-lg shadow-md">
                                            @csrf
                                        
                                            <!-- Lokasi -->
                                            <div>
                                                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                                                <select id="lokasi" name="lokasi" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" onchange="updateRoomFields()">
                                                    <option value="">Pilih Gedung</option>
                                                    <option value="Gedung A">Gedung A</option>
                                                    <option value="Gedung B">Gedung B</option>
                                                    <option value="Gedung C">Gedung C</option>
                                                    <option value="Gedung D">Gedung D</option>
                                                    <option value="Gedung E">Gedung E</option>
                                                    <option value="Gedung F">Gedung F</option>
                                                    <option value="Gedung G">Gedung G</option>
                                                    <option value="Gedung H">Gedung H</option>
                                                    <option value="Gedung I">Gedung I</option>
                                                    <option value="Gedung J">Gedung J</option>
                                                    <option value="Gedung K">Gedung K</option>
                                                </select>
                                            </div>
                                        
                                            <!-- Kode Ruang -->
                                            <div>
                                                <label for="id_ruang" class="block text-sm font-medium text-gray-700">Kode Ruang</label>
                                                <input type="text" id="id_ruang" name="id_ruang" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                        
                                            <!-- Kapasitas -->
                                            <div>
                                                <label for="kapasitas" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                                                <input type="number" id="kapasitas" name="kapasitas" required min="1" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                        
                                            <!-- Submit Button -->
                                            <div>
                                                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Simpan</button>
                                            </div>
                                        </form>
                                        
                                        <script>
                                        function updateRoomFields() {
                                            const locationType = document.getElementById('lokasi').value;
                                            const codePrefix = locationType.slice(-1);
                                        
                                            document.getElementById('id_ruang').value = codePrefix;
                                        }
                                        </script>
                                    </li>
                                </ul>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Verifikasi -->
            <div class="mt-6 px-8 py-15 mx-8 bg-white rounded-xl shadow-md overflow-hidden overflow-y-auto" style="max-height: 550px;">
                <table id="tabelVeri" class="text-center w-full" style="table-layout: auto;">
                    <thead>
                        <tr>
                            <th>Kode Ruang</th>
                            <th>Nama Ruang</th>
                            <th>Kapasitas</th>
                            <th>Lokasi</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Isi tabel akan diperbarui menggunakan JavaScript -->
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>

<script>
    $('#prodi').on('change', function() {
        var selectedProdi = $(this).val();
        console.log('Dropdown changed to:', selectedProdi);  // Cek event listener
        loadRuanganData(selectedProdi);
    });

    function loadRuanganData(prodi = '') {
        console.log('Loading data for prodi:', prodi);  // Cek AJAX call dimulai
        $.ajax({
            url: '{{ route("ba.ruangan") }}',
            type: 'GET',
            data: {
                prodi: prodi
            },
            success: function(response) {
                console.log('Data received:', response);  // Cek data yang diterima
                var filteredRuangan = prodi ? 
                    response.ruang.filter(function(room) {
                        return !room.prodi || room.prodi === prodi;
                    }) : 
                    response.ruang;
                console.log('Filtered data:', filteredRuangan);  // Cek hasil filter
                updateRuanganTable(filteredRuangan);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);  // Cek jika ada error
            }
        });
    }

    function updateRuanganTable(ruangan) {
        var tableBody = $('#tabelVeri tbody');
        tableBody.empty();
        var currentProdi = $('#prodi').val();

        if (ruangan.length === 0) {
            // Display a message when no rooms are found
            tableBody.append(`
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada ruangan yang tersedia untuk prodi ${currentProdi || 'yang dipilih'}
                    </td>
                </tr>
            `);
            return;
        }

        ruangan.forEach(function(r) {
            var row = `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">${r.id_ruang}</td>
                    <td class="px-6 py-4">${r.nama}</td>
                    <td class="px-6 py-4">
                        <form action="${'{{ route("ruangan.updateKapasitas", ":id") }}'.replace(':id', r.id_ruang)}" method="POST" class="inline">
                            @csrf
                            <input type="number" name="kapasitas" 
                                class="border rounded px-2 py-1 w-20" 
                                value="${r.kapasitas}"
                                min="1"
                                onchange="this.form.submit()">
                        </form>
                    </td>
                    <td class="px-6 py-4">${r.lokasi}</td>
                    <td class="px-6 py-4">
                        <form action="${'{{ route("ruangan.update", ":id") }}'.replace(':id', r.id_ruang)}" method="POST" class="inline updateForm">
                            @csrf
                            @method('DELETE')
                            <select name="keterangan" class="border rounded px-2 py-1" onchange="submitForm(this)">
                                <option value="Tidak Tersedia" ${r.keterangan === 'Tidak Tersedia' ? 'selected' : ''}>Tidak Tersedia</option>
                                <option value="Tersedia" ${r.keterangan === 'Tersedia' ? 'selected' : ''}>Tersedia</option>
                            </select>
                            <input type="hidden" name="prodi" value="${currentProdi}">
                        </form>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded ${r.status == 'Disetujui' ? 'bg-green-100 text-green-500' : (r.status == 'Diproses' ? 'bg-yellow-100 text-yellow-500' : 'bg-red-100 text-red-500')}">
                            ${r.status}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <form action="${'{{ route("ruangan.destroy", ":id") }}'.replace(':id', r.id_ruang)}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            `;
            tableBody.append(row);
        });
    }

    function submitForm(selectElement) {
        var form = $(selectElement).closest('form');
        var selectedProdi = $('#prodi').val();
        form.find('input[name="prodi"]').val(selectedProdi);
        form.submit();
    }
</script>
@endsection