<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RuanganController extends Controller
{
    public function index(){
        $dosens = Auth::user();
        $dosen = DB::table('bagian_akademik')->where('user_id', $dosens->id)->first();
        $ruang = Ruangan::all();
        return view('baRuangan', compact('ruang', 'dosen', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ruang' => 'required|unique:ruangan,id_ruang',
            'nama' => 'required',
            'kapasitas' => 'required|numeric|min:1',
            'lokasi' => 'required',
            'keterangan' => 'required|in:Tersedia,Terpakai',
        ]);

        DB::table('ruangan')->insert([
            'id_ruang' => $request->id_ruang,
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
            'status' => 'Diproses',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function destroy($id_ruang)
    {
        DB::table('ruangan')->where('id_ruang', $id_ruang)->delete();
        return redirect()->back()->with('success', 'Ruangan berhasil dihapus');
    }

    public function updateKapasitas(Request $request, $id_ruang)
    {
        $request->validate([
            'kapasitas' => 'required|numeric|min:1'
        ]);

        DB::table('ruangan')
            ->where('id_ruang', $id_ruang)
            ->update(['kapasitas' => $request->kapasitas]);

        return redirect()->back()->with('success', 'Kapasitas ruangan berhasil diperbarui');
    }

    public function update(Request $request, $id_ruang)
    {
        $request->validate([
            'status' => 'required|in:Disetujui,Tidak Disetujui',
        ]);

        DB::table('ruangan')
            ->where('id_ruang', $id_ruang)
            ->update(['status' => $request->status]);
    
        return redirect()->back()->with('success', 'Status ruangan berhasil diperbarui');
    }
}