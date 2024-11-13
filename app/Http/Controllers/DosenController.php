<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;



class DosenController extends Controller
{
    //
    public function dashboardPA()
    {
        $dosens = Auth::user();
        $dosen = \App\Models\Dosen::where('user_id', $dosens->id)->first();
        // dd($dosens, $dosen);
        return view('paDashboard', compact('dosens', 'dosen'));
    }

    public function pengajuanIrsPA()
    {
        $dosens = Auth::user();
        $dosen = \App\Models\Dosen::where('user_id', $dosens->id)->first();
        $mahasiswa = Mahasiswa::where('dosen_wali_id', $dosen->id);
        // ->whereHas('irs', function ($query) {
        //     $query->where('status', 'Pending');
        // })
        // ->get();
        // dd($dosens, $dosen);
        return view('paPengajuanIrs', compact('dosens', 'dosen', 'mahasiswa'));
    }
}
