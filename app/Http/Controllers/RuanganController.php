<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;

class RuanganController extends Controller
{
    //
    public function index(){
        $ruang = Ruangan::all();
        // dd($ruang);
        return view('baRuangan', compact('ruang'));
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
