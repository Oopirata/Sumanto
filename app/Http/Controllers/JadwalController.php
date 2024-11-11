<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    //
    public function index(){

        $data = Jadwal::all();

        

        return view('kaprodiBuatJadwal', compact('data'));


    }

    public function store(Request $request){
        $request->validate([
            'nama_mk' => 'required',
            'ruang' => 'required',
            'status' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kelas' => 'required',
            'semester' => 'required',
            'tahun_ajaran' => 'required',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('kaprodiBuatJadwal')->with('success', 'Jadwal berhasil dibuat');
    }
}
