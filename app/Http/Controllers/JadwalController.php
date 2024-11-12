<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kaprodi;
use App\Models\Matakuliah;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    //
    public function index(){
        $userr = Auth::user();
        $user = Kaprodi::where('user_id', $userr->id)->first();

        $data = Jadwal::all();
        // dd($data);
        $mk = MataKuliah::all();
        $ruangan = Ruangan::all();

        
        return view('kaprodiBuatJadwal', compact('data', 'user', 'mk', 'ruangan'));


    }

    public function store(Request $request){
        // Validasi data
        // dd($request->all());
        $request->validate([
            'kode_mk' => 'required|exists:matakuliah,kode_mk',
            'ruangan' => 'required|exists:ruangan,id',
            'sifat' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kelas' => 'required',
            // 'nama_mk' => 'required',
            // 'sks' => 'required|integer',
            // 'kapasitas' => 'required|integer',

        ]);

        $matakuliah = Matakuliah::where('kode_mk', $request->kode_mk)->first();
        $ruangan = Ruangan::where('id', $request->ruangan)->first();
        // dd($matakuliah, $ruangan);
           
        // Simpan data jadwal
        DB::table('jadwal')->insert([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruang' => $request->ruangan,
            'kode_mk' => $request->kode_mk,
            'nama_mk' => $matakuliah->nama_mk,
            'sks' => $matakuliah->sks,
            'semester' => $matakuliah->semester,
            'kelas' => $request->kelas,
            'kapasitas' => $ruangan->kapasitas,
            'status' => 'Tidak Disetujui', // Nilai default
            'prodi' => 'Informatika', // Nilai default
            'sifat' => $request->sifat,
        ]);
    
        return redirect()->back()->with('success', 'Jadwal berhasil disimpan');
    }
    public function destroy(Request $request)
    {
        // Validasi bahwa jadwal_id harus ada dalam request
        $request->validate([
            'id' => 'required|exists:jadwal,id',
        ]);
        // dd($request->all());

        // Cari jadwal berdasarkan jadwal_id yang dikirim dari form
        DB::table('jadwal')->where('id', $request->id)->delete();
        
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus');
    }


    
}
