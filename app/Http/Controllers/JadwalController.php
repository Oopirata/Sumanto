<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kaprodi;
use App\Models\Matakuliah;
use App\Models\Ruangan;

class JadwalController extends Controller
{
    //
    public function index(){
        $userr = Auth::user();
        $user = Kaprodi::where('user_id', $userr->id)->first();

        $data = Jadwal::all();
        $mk = MataKuliah::all();
        $ruangan = Ruangan::all();

        
        return view('kaprodiBuatJadwal', compact('data', 'user', 'mk', 'ruangan'));


    }

    public function store(Request $request){
        // Validasi data
        $request->validate([
            'kode_mk' => 'required|exists:matakuliah,kode_mk',
            'ruangan' => 'required|exists:ruangan,id',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'hari' => 'required',
            'nama_mk' => 'required',
            'sks' => 'required|integer',
            'kelas' => 'required',
            'kapasitas' => 'required|integer',
            'sifat' => 'required',
        ]);
        dd($request->all());    
        // Simpan data jadwal
        Jadwal::create([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruang' => $request->ruangan,
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $request->nama_mk,
            'sks' => $request->sks,
            'kelas' => $request->kelas,
            'kapasitas' => $request->kapasitas,
            'status' => 'Tidak Disetujui', // Nilai default
            'prodi' => 'Informatika', // Nilai default
            'sifat' => $request->sifat,
        ]);
    
        return redirect()->route('kaprodiBuatJadwal')->with('success', 'Jadwal berhasil disimpan');
    }
    
    
}
