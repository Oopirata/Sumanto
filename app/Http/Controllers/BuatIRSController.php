<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\BuatIRS;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BuatIRSController extends Controller
{
    public function tampil_jadwal()
    {
        $user = Auth::user();

        // Get Mahasiswa (Student) details
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        // dd($mahasiswa);
        if ($mahasiswa) {
            $currentSemester = $mahasiswa->semester;
            $currentSemesterCourses = Matakuliah::where('semester', $currentSemester)
                ->pluck('semester')
                ->toArray();

            $jadwals = Jadwal::whereIn('semester', $currentSemesterCourses)->get();
            $dosenWali = Dosen::find($mahasiswa->dosen_wali_id);
        } else {
            $jadwals = collect();
            $dosenWali = null;
        }

        return view('mhsBuatIrs', compact('user', 'jadwals', 'mahasiswa', 'dosenWali'));
    }
}
