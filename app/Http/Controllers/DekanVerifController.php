<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kaprodi;
use App\Models\Matakuliah;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;

class DekanVerifController extends Controller
{
    //
    public function dekanDashboard()
    {

        $user = Auth::user();

        $dekan = \App\Models\Dekan::where('user_id', $user->id)->first();

        return view('dekanDashboard', compact('dekan', 'user'));
    }

    public function dekanRuangan()
    {

        $user = Auth::user();

        $dekan = \App\Models\Dekan::where('user_id', $user->id)->first();

        return view('dekanVerifikasi', compact('dekan', 'user'));
    }

    public function dekanJadwal()
    {

        $user = Auth::user();

        $dekan = \App\Models\Dekan::where('user_id', $user->id)->first();
  

        
        $data = Jadwal::all();
        // dd($data);
        $mk = MataKuliah::all();
        $ruangan = Ruangan::all();

        $allApproved = $mk->every(fn($item) => $item->status == 'disetujui');

        
        return view('dekanJadwal', compact('data', 'user', 'mk', 'ruangan', 'dekan', 'allApproved'));

    }

}
