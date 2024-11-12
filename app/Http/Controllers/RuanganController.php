<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    //
    public function index(){
        $ruang = Ruangan::all();
        return view('baRuangan', compact('ruang'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Tersedia,Tidak Tersedia', // Validasi status
        ]);
    
        $ruangan = Ruangan::find($id);
        if ($ruangan) {
            $ruangan->status = $request->status;
            $ruangan->save();
            
            return redirect()->back()->with('success', 'Status ruangan berhasil diupdate');
        }
    
        return redirect()->back()->with('error', 'Ruangan tidak ditemukan');
    }
    
}
