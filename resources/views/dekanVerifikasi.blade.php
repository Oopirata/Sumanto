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
                            <div class="text-center">         
                                <select id="jurusan" name="jurusan" class="bg-blue-700 text-white rounded-lg text-sm px-4 py-2.5 mr-9 dark:bg-gray-700 dark:text-gray-200 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                                    <option value="">Pilih Jurusan</option>
                                    @foreach ($prodi as $p)
                                        <option value="{{ $p->nama_prodi }}" {{ $p->nama_prodi == $selectedProdi ? 'selected' : '' }}>
                                            {{ $p->nama_prodi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="px-4 bg-white"></div>
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
                            <th>Keterangan</th>
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
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded {{ $ruangan->keterangan == 'Tersedia' ? 'bg-green-100 text-green-500' : 'bg-red-100 text-red-500' }}">
                                        {{ $ruangan->keterangan }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded {{ $ruangan->status == 'Disetujui' ? 'bg-green-100 text-green-500' : ($ruangan->status == 'Diproses' ? 'bg-yellow-100 text-yellow-500' : 'bg-red-100 text-red-500') }}">
                                        {{ $ruangan->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('DekanRuangan.update', $ruangan->id_ruang) }}" method="POST">
                                        @csrf
                                        <div class="flex items-center">
                                            <!-- Tombol "Setuju" -->
                                            <button 
                                                type="submit" 
                                                name="status" 
                                                value="Disetujui" 
                                                class="px-4 py-2 rounded-md mr-2 
                                                    {{ $ruangan->status === 'Disetujui' || $ruangan->status === 'Tidak Disetujui' ? 'bg-gray-300 text-gray-500 cursor-not-allowed opacity-60' : 'bg-green-500 text-white hover:bg-green-600' }}" 
                                                @if($ruangan->status === 'Disetujui' || $ruangan->status === 'Tidak Disetujui') disabled @endif>
                                                Setuju
                                            </button>
                                            
                                            <!-- Tombol "Tidak Setuju" -->
                                            <button 
                                                type="submit" 
                                                name="status" 
                                                value="Tidak Disetujui" 
                                                class="px-4 py-2 rounded-md 
                                                    {{ $ruangan->status === 'Disetujui' || $ruangan->status === 'Tidak Disetujui' ? 'bg-gray-300 text-gray-500 cursor-not-allowed opacity-60' : 'bg-red-500 text-white hover:bg-red-600' }}" 
                                                @if($ruangan->status === 'Disetujui' || $ruangan->status === 'Tidak Disetujui') disabled @endif>
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
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#tabelVeri').DataTable({
        layout: {
            topStart: null,
            topEnd: null,
            bottomStart: null,
        },
        columnDefs: [
            { className: "dt-head-center", targets: [0,1,2,3,4,5,6] },
            { className: "dt-body-center", targets: [0,1,2,3,4,5,6] }
        ]
    });

    // Handle department dropdown change
    $('#jurusan').on('change', function() {
        var selectedJurusan = $(this).val();
        
        // Make AJAX request to get filtered data
        $.ajax({
            url: window.location.href,
            type: 'GET',
            data: {
                jurusan: selectedJurusan
            },
            success: function(response) {
                // Clear existing table data
                table.clear();
                
                // Add new data
                response.ruang.forEach(function(ruangan) {
                    table.row.add([
                        ruangan.id_ruang,
                        ruangan.nama,
                        ruangan.kapasitas,
                        ruangan.lokasi,
                        `<span class="px-2 py-1 rounded ${ruangan.keterangan == 'Tersedia' ? 'bg-green-100 text-green-500' : 'bg-red-100 text-red-500'}">${ruangan.keterangan}</span>`,
                        `<span class="px-2 py-1 rounded ${ruangan.status == 'Disetujui' ? 'bg-green-100 text-green-500' : (ruangan.status == 'Diproses' ? 'bg-yellow-100 text-yellow-500' : 'bg-red-100 text-red-500')}">${ruangan.status}</span>`,
                        `<form action="/verif/ruangan/${ruangan.id_ruang}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="flex items-center">
                                <button type="submit" name="status" value="Disetujui" class="px-4 py-2 bg-green-500 text-white rounded-md mr-2">Setuju</button>
                                <button type="submit" name="status" value="Tidak Disetujui" class="px-4 py-2 bg-red-500 text-white rounded-md">Tidak Setuju</button>
                            </div>
                        </form>`
                    ]);
                });
                
                // Redraw the table
                table.draw();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
});
</script>
@endsection
