@extends('main')

@section('title', 'Buat Jadwal')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col ml-64 " x-data="modal()">
    <div class="flex overflow-hidden">
        <x-side-bar-kaprodi :userr="$userr"></x-side-bar-kaprodi>
        <div id="main-content" class="relative text-black font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar :user="$user" :userr="$userr"></x-nav-bar>
            <div class="border-b-4"></div>
            <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                <div class="flex justify-between items-center">
                    <h1 class="text-black font-bold">Jadwal</h1>
                    <div class="flex justify-between">

                        <div class="text-center">
                            <button
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                type="button" data-drawer-target="drawer-right-mk"
                                data-drawer-show="drawer-right-mk" data-drawer-placement="right"
                                aria-controls="drawer-right-mk">
                                Tambah MK
                            </button>
                        </div>

                        <!-- drawer component -->
                        <div id="drawer-right-mk"
                            class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
                            tabindex="-1" aria-labelledby="drawer-right-label">
                            <h5 id="drawer-right-label"
                                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>Tambah Mata Kuliah
                            </h5>
                            <button type="button" data-drawer-hide="drawer-right-mk" aria-controls="drawer-right-mk"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close menu</span>
                            </button>
                            <form id="form-tambah-matakuliah" action="{{ route('store.jadwal') }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="store_mk">
                                <!-- Nama Mata Kuliah -->
                                <div class="mb-4">
                                    <label for="nama_mk" class="block text-sm font-medium text-gray-700">Nama Mata Kuliah</label>
                                    <input type="text" id="nama_mk" name="nama_mk" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Kode Mata Kuliah -->
                                <div class="mb-4">
                                    <label for="kode_mk" class="block text-sm font-medium text-gray-700">Kode Mata Kuliah</label>
                                    <input type="text" id="kode_mk" name="kode_mk" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Semester -->
                                <div class="mb-4">
                                    <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                                    <input type="text" id="semester" name="semester" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- SKS -->
                                <div class="mb-4">
                                    <label for="sks" class="block text-sm font-medium text-gray-700">SKS</label>
                                    <input type="number" id="sks" name="sks" min="1" max="6" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Status -->
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select id="status" name="status" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Status</option>
                                        <option value="Wajib">Wajib</option>
                                        <option value="Pilihan">Pilihan</option>
                                    </select>
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-4">
                                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                    <textarea id="deskripsi" name="deskripsi" rows="3"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                                </div>

                                <!-- Kapasitas -->
                                <div class="mb-4">
                                    <label for="kapasitas" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                                    <input type="number" id="kapasitas" name="kapasitas" min="1" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Submit Button -->
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">Tambah
                                    Mata Kuliah</button>
                            </form>
                        </div>

                        <div class="px-4 bg-white"></div>

                        <!-- Button untuk membuka drawer -->
                        <div class="text-center">
                            <button
                                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-900 focus:outline-none dark:focus:ring-blue-800"
                                type="button" data-drawer-target="drawer-delete-matkul"
                                data-drawer-show="drawer-delete-matkul" data-drawer-placement="right"
                                aria-controls="drawer-delete-matkul">
                                Hapus MK
                            </button>
                        </div>

                        <!-- Drawer untuk Hapus Mata Kuliah -->
                        <div id="drawer-delete-matkul"
                            class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
                            tabindex="-1" aria-labelledby="drawer-delete-matkul-label">
                            <h5 id="drawer-delete-matkul-label"
                                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                Hapus Mata Kuliah
                            </h5>
                            <button type="button" data-drawer-hide="drawer-delete-matkul"
                                aria-controls="drawer-delete-matkul"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close menu</span>
                            </button>

                            <!-- Form Hapus Mata Kuliah -->
                            <form action="{{ route('delete.jadwal') }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="delete_mk">
                                <div class="mb-4">
                                    <label for="mata_kuliah_hapus" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                                    <select id="hapus_matakuliah" name="mata_kuliah_id" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Mata Kuliah</option>
                                        @foreach ($matakuliah as $mk)
                                            <option value="{{ $mk->kode_mk }}">{{ $mk->nama_mk }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-blue-300">
                                    Hapus Mata Kuliah
                                </button>
                            </form>
                        </div>
                        
                        <div class="px-4 bg-white"></div>

                        <div class="text-center">
                            <button
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                type="button" data-drawer-target="drawer-right-example"
                                data-drawer-show="drawer-right-example" data-drawer-placement="right"
                                aria-controls="drawer-right-example">
                                Tambah Dosen
                            </button>
                        </div>

                        <!-- drawer component -->
                        <div id="drawer-right-example"
                            class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
                            tabindex="-1" aria-labelledby="drawer-right-label">
                            <h5 id="drawer-right-label"
                                class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>Tambah Dosen
                            </h5>
                            <button type="button" data-drawer-hide="drawer-right-example"
                                aria-controls="drawer-right-example"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close menu</span>
                            </button>
                            <form id="form-tambah-dosen" action="{{ route('store.jadwal') }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="store_dosen">
                                <div class="mb-4">
                                    <label for="mata_kuliah" class="block text-sm font-medium text-gray-700">Mata
                                        Kuliah</label>
                                    <select id="mata_kuliah" name="mata_kuliah_id" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Mata Kuliah</option>
                                        @foreach ($matakuliah as $mk)
                                            <option value="{{ $mk->kode_mk }}">{{ $mk->nama_mk }}</option>
                                            <!-- Kirim kode_mk, bukan id -->
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="dosen" class="block text-sm font-medium text-gray-700">Dosen</label>
                                    <select id="dosen" name="dosen_nip" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Pilih Dosen</option>
                                        @foreach ($dosen as $dosens)
                                            <option value="{{ $dosens->nip }}">{{ $dosens->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="button" onclick="confirmSubmit()" 
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">Tambah dosen
                                </button>
                            </form>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                        function confirmSubmit() {
                            Swal.fire({
                                title: "Apakah Anda yakin?",
                                text: "Data dosen akan ditambahkan!",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Ya, tambah!"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById("form-tambah-dosen").submit();
                                }
                            });
                        }
                        </script>

                        <div class="px-4 bg-white"></div>
                        <div>
                            <!-- drawer init and toggle -->
                            <div class="text-center">
                                <button
                                    class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-red-600 dark:hover:bg-red-900 focus:outline-none dark:focus:ring-blue-800"
                                    type="button" data-drawer-target="drawer-left-example"
                                    data-drawer-show="drawer-left-example" data-drawer-placement="right"
                                    aria-controls="drawer-left-example">
                                    Hapus Dosen
                                </button>
                            </div>

                            <!-- drawer component -->
                            <div id="drawer-left-example"
                                class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
                                tabindex="-1" aria-labelledby="drawer-left-label">
                                <h5 id="drawer-left-label"
                                    class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                                    <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                    </svg>
                                    Hapus Dosen
                                </h5>
                                <button type="button" data-drawer-hide="drawer-left-example"
                                    aria-controls="drawer-left-example"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close menu</span>
                                </button>
                                    <form action="{{ route('deleteDosen') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="dosen_kuliah_hapus" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                                        <select id="dosen_kuliah_hapus" name="dosen_kuliah_id" required
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Mata Kuliah</option>
                                            @foreach ($matakuliah as $mk)
                                                <option value="{{ $mk->kode_mk }}">{{ $mk->nama_mk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="dosen_hapus" class="block text-sm font-medium text-gray-700">Dosen</label>
                                        <select id="dosen_hapus" name="dosen_nip" required
                                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Pilih Dosen</option>
                                            @foreach ($matakuliah as $mk)
                                                @foreach ($mk->dosen as $dosen)
                                                    <option value="{{ $dosen->nip }}" class="dosen-option matkul-{{ $mk->kode_mk }}" style="display:none;">
                                                        {{ $dosen->nama }}
                                                    </option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus dosen ini?')"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-blue-300">
                                        Hapus Dosen
                                    </button>
                                </form>
                                <script>
                                    // JavaScript untuk menyaring dosen berdasarkan mata kuliah yang dipilih
                                    document.getElementById('dosen_kuliah_hapus').addEventListener('change', function () {
                                        const selectedMatkul = this.value;
                                        const dosenOptions = document.querySelectorAll('.dosen-option');
                                        
                                        // Menyembunyikan semua dosen terlebih dahulu
                                        dosenOptions.forEach(option => {
                                            option.style.display = 'none';  // Menyembunyikan semua opsi dosen
                                            option.disabled = true;  // Menonaktifkan semua opsi dosen
                                        });

                                        // Menampilkan dan mengaktifkan dosen yang sesuai dengan mata kuliah yang dipilih
                                        if (selectedMatkul) {
                                            const relevantOptions = document.querySelectorAll('.matkul-' + selectedMatkul);
                                            relevantOptions.forEach(option => {
                                                option.style.display = 'block';  // Menampilkan opsi dosen
                                                option.disabled = false;  // Mengaktifkan opsi dosen
                                            });
                                        }
                                    });
                                </script>

                            </div>
                        </div>
                        <!-- drawer init and toggle -->

                    </div>
                </div>

                

            </div>
            <div class="mt-10 p-8 mx-8 bg-white rounded-xl shadow-md flex-grow overflow-hidden overflow-y-auto">
                    <table id="tabelDekan" class="display">
                        <thead>
                            <tr>
                                <th class="px-6 py-3">Mata Kuliah</th>
                                <th class="px-6 py-3">Semester</th>
                                <th class="px-6 py-3">SKS</th>
                                <th class="px-6 py-3">Dosen</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matakuliah as $mk)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $mk->nama_mk }}</td>
                                    <td class="px-6 py-4">{{ $mk->semester }}</td>
                                    <td class="px-6 py-4">{{ $mk->sks }}</td>
                                    <td class="px-6 py-4">
                                        <ul class="list-disc ml-5 text-left">
                                            @foreach ($mk->dosen as $dosen)
                                                <li>{{ $dosen->nama}}</li>
                                            @endforeach


                                        </ul>
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
    $(document).ready(function () {
        $('#tabelDekan').DataTable({
            layout: {
                topStart: null,
                bottomStart: null,
            },
            columnDefs: [
                { className: "dt-head-center", targets: [0, 1, 2, 3] },
                { className: "dt-body-center", targets: [0, 1, 2, 3] }
            ]
        });
    });
</script>
@endsection