<?php

namespace App\Http\Controllers;

use App\Models\Irs;
use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    public function buatIRSJadwal()
    {
        // Mengambil jadwal dari database
        $jadwals = Jadwal::all(); // Atau sesuaikan dengan kriteria yang diinginkan
        $irs = Irs::all();

        return view('mhsBuatIrs', compact('jadwals', 'irs'));
    }
}
