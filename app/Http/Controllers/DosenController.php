<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Dosen;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function dashboardPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first(); // Ambil data dosen berdasarkan user_id
        return view('paDashboard', compact('dosens', 'dosen')); // Kirim data dosen ke view
    }

    public function pengajuanIrsPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first();
        $mahasiswa = Mahasiswa::where('dosen_wali_id', $dosen->id)->get(); // Ambil mahasiswa yang dibimbing dosen ini
        return view('paPengajuanIrs', compact('dosens', 'dosen', 'mahasiswa'));
    }

    public function perwalianPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first(); // Ambil data dosen berdasarkan user_id
        $mahasiswa = Mahasiswa::where('dosen_wali_id', $dosen->id)->get(); // Ambil mahasiswa yang dibimbing dosen ini
        return view('paPerwalian', compact('dosens', 'dosen', 'mahasiswa')); // Kirim data dosen ke view
    }
}
