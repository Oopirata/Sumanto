@extends('main')

@section('title', 'Verifikasi Ruangan')

@section('page')
<div class="bg-gray-100 min-h-screen flex flex-col ">
    <div class="flex overflow-hidden">
            <x-side-bar-ba :dosen="$dosen"></x-side-bar-ba> <!-- Tambahkan ini -->
            <div id="main-content" class="relative text-black ml-64 font-poppins w-full h-full overflow-y-auto">
                <x-nav-bar :dosen="$dosen" :dosens="$dosens"></x-nav-bar>
                
                <form action="{{ route('ruangan.update')}}" method="POST">
                @csrf
                    <div class="border-b-4"></div>
                    <div class="p-8 mt-6 mx-8 bg-white border border-gray-200 rounded-3xl shadow-sm">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="text-black font-bold items-center">List Ruangan</h1>
                            </div>
                            
                            <div>
                                <div class="flex justify-between">
                                    <div>
                                        <x-jurusan name="jurusan"></x-jurusan>
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
                                    <th>Status</th>
                                    <th>Edit</th>
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
                                                <select name="status" class="px-4 py-2 border rounded-md">
                                                    <option value="Tersedia" {{ $ruangan->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                                    <option value="Tidak Tersedia" {{ $ruangan->status == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                                                </select>
                                                <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md">Simpan</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
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
