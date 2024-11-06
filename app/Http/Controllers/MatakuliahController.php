<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\Dosen;

class MatakuliahController extends Controller
{
    public function index()
    {
        $matakuliah = Matakuliah::select('matakuliah.nama_mk', 'matakuliah.sks', 'matakuliah.semester','matakuliah.kode_mk')
            //->join('dosen_matakuliah', 'matakuliah.kode_mk', '=', 'dosen_matakuliah.kode_mk')
            //->join('dosen', 'dosen_matakuliah.dosen_nip', '=', 'dosen.nip')
            ->groupBy('matakuliah.nama_mk', 'matakuliah.sks', 'matakuliah.semester', 'matakuliah.kode_mk')
            ->get();

        foreach ($matakuliah as $mk) {
            $dosen = Dosen::select('dosen.nama')
                ->join('dosen_matakuliah', 'dosen.nip', '=', 'dosen_matakuliah.dosen_nip')
                ->where('dosen_matakuliah.kode_mk', $mk->kode_mk)
                ->get();

            $mk->dosen = $dosen;
        }

        
        return view('kaprodiMatkulDosen', compact('matakuliah'));
    }
    
    
    //
}
