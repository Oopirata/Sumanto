<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RuanganController extends Controller
{
    //
    public function index(){
        $dosens = Auth::user();
        $dosen = DB::table('bagian_akademik')->where('user_id', $dosens->id)->first();
        $ruang = Ruangan::all();
        // dd($dosen);
        return view('baRuangan', compact('ruang', 'dosen', 'dosens'));
    }
    public function update(Request $request, $id_ruang)
    {
        // dd($request->all());
        // dd($id_ruang);
        $request->validate([
            'status' => 'required|in:Tersedia,Tidak Tersedia', // Validasi status
        ]);
        // dd($ruangan);

        DB::table('ruangan')
            ->where('id_ruang', $id_ruang) // pastikan ini adalah id atau kondisi yang sesuai dengan data yang ingin diupdate
            ->update(['status' => $request->status]);
    
        return redirect()->back()->with('error', 'Ruangan tidak ditemukan');
    }
    
}
