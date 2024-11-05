<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\Dosen;

class MatakuliahController extends Controller
{
    public function index()
    {
        $matakuliah = Matakuliah::select('matakuliah.nama_mk', 'matakuliah.sks', 'matakuliah.semester', 'dosen.nama')
            ->join('dosen_matakuliah', 'matakuliah.kode_mk', '=', 'dosen_matakuliah.kode_mk')
            ->join('dosen', 'dosen_matakuliah.dosen_nip', '=', 'dosen.nip')
            ->get();
    
        return view('kaprodiMatkulDosen', compact('matakuliah'));
    }
    
    
    //
}
