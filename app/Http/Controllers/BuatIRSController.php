<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Irs;
use Illuminate\Http\Request;

class BuatIRSController extends Controller
{
    public function tampil_jadwal() {
        $jadwals = Jadwal::all();
        $irs = Irs::all();
        // dd($jadwals);
        return view('mhsBuatIrs', compact('jadwals', 'irs'));
    }
}
