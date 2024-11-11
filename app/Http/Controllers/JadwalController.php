<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kaprodi;

class JadwalController extends Controller
{
    //
    public function index(){
        $userr = Auth::user();
        $user = Kaprodi::where('user_id', $userr->id)->first();

        $data = Jadwal::all();

        

        return view('kaprodiBuatJadwal', compact('data', 'user'));


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
