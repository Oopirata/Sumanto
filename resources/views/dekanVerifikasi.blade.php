@extends('main')

@section('title', 'Verifikasi Ruangan')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex overflow-hidden">
        <x-side-bar-dekan :dekan="$dekan"></x-side-bar-dekan>
        <div id="main-content" class=" relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
            <x-nav-bar :user="$user"></x-nav-bar>
            
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

            <!-- Tabel Verifikasi -->
            <div class="mt-10 p-8 mx-8 bg-white rounded-xl shadow-md overflow-hidden overflow-y-auto" style="max-height: 550px;">
                <table id="tabelVeri" class="text-center w-full">
                <thead>
                        <tr>
                            <th>Kode Ruang</th>
                            <th>Nama Ruang</th>
                            <th>Kapasitas</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ruang as $ruangan)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $ruangan->id_ruang }}</td>
                                <td class="px-6 py-4">{{ $ruangan->nama }}</td>
                                <td class="px-6 py-4">{{ $ruangan->kapasitas }}</td>
                                <td class="px-6 py-4">{{ $ruangan->lokasi}}</td>
                                <td class="px-6 py-4">{{ $ruangan->status}}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('ruangan.update', $ruangan->id_ruang) }}" method="POST">
                                        @csrf
                                        @method('PUT') <!-- Pastikan ini -->
                                        <div class="flex items-center">
                                            <!-- Tombol Setuju -->
                                            <button 
                                                type="submit" 
                                                name="status" 
                                                value="Tersedia" 
                                                class="px-4 py-2 bg-green-500 text-white rounded-md mr-2">
                                                Setuju
                                            </button>

                                            <!-- Tombol Tidak Setuju -->
                                            <button 
                                                type="submit" 
                                                name="status" 
                                                value="Tidak Tersedia" 
                                                class="px-4 py-2 bg-red-500 text-white rounded-md">
                                                Tidak Setuju
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
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
                { className: "dt-head-center", targets: [0,1,2,3,4,5] },
                { className: "dt-body-center", targets: [0,1,2,3,4,5] }
            ]
        });
    });
</script>
@endsection
