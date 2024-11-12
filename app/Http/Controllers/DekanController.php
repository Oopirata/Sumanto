<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;

class dekanController extends Controller
{
    public function verifJadwal()
    {
        $data = Jadwal::all();
        $dekan = Auth::user(); // Jika Anda perlu mengambil data dekan berdasarkan pengguna yang login
        return view('dekanJadwal', compact('data', 'dekan'));
    }
}
