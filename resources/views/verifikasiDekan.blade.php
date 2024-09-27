@extends('main')

@section('title', 'Verifikasi Jadwal')

@section('page')

<div class="bg-gray-100 min-h-screen flex flex-col">
    <div class="flex overflow-hidden">
        {{-- sidebar --}}
        <x-side-bar></x-side-bar>
        {{-- end sidebar --}}

        <div id="main-content" class="mt-20 my-8 relative text-black font-poppins w-full h-full overflow-y-auto">
            <div class="p-10 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm sm:p-6 dark:bg-white">
                <div class="flex text-center justify-between items-center">
                    <h1 class="font-semibold">LIST DAFTAR RUANG</h1>
                    
                    <!-- Dropdown -->
                    <div x-data="{ open: false, selectedJurusan: 'Jurusan' }" class="relative">
                        <button @click="open = !open" class="flex items-center px-6 py-2 w-full text-white bg-blue-600 rounded-lg transition-all focus:outline-none mb-2">
                            <span class="material-icons">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
                                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z"/>
                                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z"/>
                                </svg>
                            </span>
                            <span class="ml-2 text-sm" x-text="selectedJurusan"></span>
                            <svg class="ml-auto h-5 w-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Items -->
                        <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                <a href="#" @click="selectedJurusan = 'Informatika'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Informatika</a>
                                <a href="#" @click="selectedJurusan = 'Fisika'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Fisika</a>
                                <a href="#" @click="selectedJurusan = 'Kimia'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Kimia</a>
                                <a href="#" @click="selectedJurusan = 'Matematika'; open = false" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Matematika</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Verifikasi -->
            <div class="mt-10 p-8 mx-8 bg-white rounded-3xl shadow-md overflow-hidden overflow-y-auto" style="max-height: 500px;">
        
                    <table id="tabelVeri" class="text-center w-full">
                        <thead>
                            <tr>
                                <th>Kode Ruang</th>
                                <th>Nama Ruang</th>
                                <th>Kapasitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E102</td>
                                <td>Ruang Kelas E102</td>
                                <td>56</td>
                            </tr>
                            <tr>
                                <td>E103</td>
                                <td>Ruang Kelas E103</td>
                                <td>56</td>
                            </tr>
                            <tr>
                                <td>E103</td>
                                <td>Ruang Kelas E103</td>
                                <td>56</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E101</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                            <tr>
                                <td>E104</td>
                                <td>Ruang Kelas E101</td>
                                <td>60</td>
                            </tr>
                        </tbody>
                    </table>
                
            </div>


            <!-- Buttons -->
            <div class="px-6 py-4 flex justify-end space-x-3" x-data="{ status: null }">
                <!-- Tombol Tidak Setuju -->
                <button 
                    class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded" 
                    @click="status = 'Tidak Setuju'">
                    <span x-show="status !== 'Tidak Setuju'">Tidak Setuju</span>
                    <span x-show="status === 'Tidak Setuju'">Tidak Disetujui</span>
                </button>

                <!-- Tombol Setuju -->
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

<script>
    $(document).ready( function () {
        $('#tabelVeri').DataTable({
            layout: {
                topStart: null,
                topEnd: null,
                bottomStart: null,
                
            },
            columnDefs: [
                { className: "dt-head-center", targets: [0,1,2] },
                { className: "dt-body-center", targets: [0,1,2] }
            ]
        });
    });
</script>

@endsection
