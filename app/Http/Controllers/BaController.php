<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaController extends Controller       
{
    public function IrsBA()
    {
        $dosens = Auth::user();
        $dosen = DB::table('bagian_akademik')->where('user_id', $dosens->id)->first();
        $dataMahasiswa = Mahasiswa::all();
        return view('baIrs', compact('dataMahasiswa', 'dosen', 'dosens'));
    }

    public function DetailIrsBA()
    {
        $dosens = Auth::user();
        $dosen = DB::table('bagian_akademik')->where('user_id', $dosens->id)->first();
        return view('baDetailIrs', compact('dosens', 'dosen'));
    }

    public function DetailNilaiBA()
    {
        $dosens = Auth::user();
        $dosen = DB::table('bagian_akademik')->where('user_id', $dosens->id)->first();
        return view('baDetailNilai', compact('dosens', 'dosen'));
    }

    public function DashboardBA()
    {
        $dosens = Auth::user();
        $dosen = DB::table('bagian_akademik')->where('user_id', $dosens->id)->first();
        // dd($dosen, $dosens);
        return view('baDashboard', compact('dosens', 'dosen'));
    }

    public function PresensiBA()
    {
        $dosens = Auth::user();
        $dosen = DB::table('bagian_akademik')->where('user_id', $dosens->id)->first();
        $dataMahasiswa = Mahasiswa::all();
        return view('baPresensi', compact('dataMahasiswa', 'dosen', 'dosens'));
    }

    public function SksMhsBA()
    {
        $dosens = Auth::user();
        $dosen = DB::table('bagian_akademik')->where('user_id', $dosens->id)->first();
        $dataMahasiswa = Mahasiswa::all();
        return view('baSKSmhs', compact('dataMahasiswa', 'dosen', 'dosens'));
    }

    public function NilaiMhsBA()
    {
        $dosens = Auth::user();
        $dosen = DB::table('bagian_akademik')->where('user_id', $dosens->id)->first();
        $dataMahasiswa = Mahasiswa::all();
        return view('baNilaimhs', compact('dataMahasiswa', 'dosen', 'dosens'));
    }
}
