<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Khs;

class MhsDashboard extends Controller
{
    public function dashboardMhs()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if ($mahasiswa) {
            // Ambil Dosen berdasarkan dosen_wali_id dari mahasiswa
            $dosenWali = Dosen::find($mahasiswa->dosen_wali_id);

            // Calculate total SKS from completed courses in KHS
            $totalSks = Khs::join('matakuliah', 'khs.kode_mk', '=', 'matakuliah.kode_mk')
                ->where('khs.nim', $mahasiswa->nim)
                ->where('khs.nilai', '!=', 'E') // Exclude failed courses
                ->sum('matakuliah.sks');
        } else {
            $dosenWali = null;
            $totalSks = 0;
        }

        return view('mhsDashboard', compact('user', 'mahasiswa', 'dosenWali', 'totalSks'));
    }

    public function KhsMhs()
    {
        $user = Auth::user();

        $mahasiswa = \App\Models\Mahasiswa::where('user_id', $user->id)->first();

        if ($mahasiswa) {
            // Ambil Dosen berdasarkan dosen_wali_id dari mahasiswa
            $dosenWali = \App\Models\Dosen::find($mahasiswa->dosen_wali_id);
        } else {
            $dosenWali = null; // Atau tangani kasus di mana mahasiswa tidak ditemukan
        }

        // dd(compact('user','mahasiswa', 'dosenWali'));
        return view('mhsKhs', compact('user', 'mahasiswa', 'dosenWali'));
    }

    public function TranskripMhs()
    {
        $user = Auth::user();

        $mahasiswa = \App\Models\Mahasiswa::where('user_id', $user->id)->first();

        if ($mahasiswa) {
            // Ambil Dosen berdasarkan dosen_wali_id dari mahasiswa
            $dosenWali = \App\Models\Dosen::find($mahasiswa->dosen_wali_id);
        } else {
            $dosenWali = null; // Atau tangani kasus di mana mahasiswa tidak ditemukan
        }

        // dd(compact('user','mahasiswa', 'dosenWali'));
        return view('mhsTranskip', compact('user', 'mahasiswa', 'dosenWali'));
    }

    public function BayarMhs()
    {
        $user = Auth::user();

        $mahasiswa = \App\Models\Mahasiswa::where('user_id', $user->id)->first();

        if ($mahasiswa) {
            // Ambil Dosen berdasarkan dosen_wali_id dari mahasiswa
            $dosenWali = \App\Models\Dosen::find($mahasiswa->dosen_wali_id);
        } else {
            $dosenWali = null; // Atau tangani kasus di mana mahasiswa tidak ditemukan
        }

        // dd(compact('user','mahasiswa', 'dosenWali'));
        return view('mhsBiayaKuliah', compact('user', 'mahasiswa', 'dosenWali'));
    }

    public function StatusMhs()
    {
        $user = Auth::user();

        $mahasiswa = \App\Models\Mahasiswa::where('user_id', $user->id)->first();

        if ($mahasiswa) {
            // Ambil Dosen berdasarkan dosen_wali_id dari mahasiswa
            $dosenWali = \App\Models\Dosen::find($mahasiswa->dosen_wali_id);
        } else {
            $dosenWali = null; // Atau tangani kasus di mana mahasiswa tidak ditemukan
        }

        // dd(compact('user','mahasiswa', 'dosenWali'));
        return view('mhsStatuskuliah', compact('user', 'mahasiswa', 'dosenWali'));
    }
}
