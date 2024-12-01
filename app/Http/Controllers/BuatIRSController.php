<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Irs;

class BuatIRSController extends Controller
{
    public function tampil_jadwal()
    {
        $user = Auth::user();

        // Get Mahasiswa (Student) details
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        // dd($mahasiswa);
        if ($mahasiswa) {
            $sksLimit = $this->calculateSksLimit($mahasiswa->IPS);

            $currentSemester = $mahasiswa->semester;
            $currentSemesterCourses = Matakuliah::where('semester', $currentSemester)
                ->pluck('semester')
                ->toArray();

            $jadwals = Jadwal::whereIn('semester', $currentSemesterCourses)->get();
            $dosenWali = Dosen::find($mahasiswa->dosen_wali_id);
        } else {
            $jadwals = collect();
            $dosenWali = null;
            $sksLimit = 0;
        }
        // dd($jadwals);
        return view('mhsBuatIrs', compact('user', 'jadwals', 'mahasiswa', 'dosenWali', 'sksLimit'));
    }

    public function store(Request $request)
    {
        $selectedSchedules = $request->input('selectedSchedules'); // Ambil data selectedSchedules dari request

        $mhs = Auth::user();
        $mhsId = Mahasiswa::where('user_id', $mhs->id)->first();
        // dd($mhsId);

        foreach ($selectedSchedules as $schedule) {
            // Pastikan jadwal ada
            $jadwal = Jadwal::find($schedule['id']); // Temukan jadwal berdasarkan id

            if ($jadwal) {
                // Buat entri baru di tabel irs
                Irs::create([
                    'mhs_id' => $mhsId->id,        // ID mahasiswa
                    'jadwal_id' => $jadwal->id, // ID jadwal
                    'semester' => $mhsId->semester,  // Masukkan semester yang sesuai
                    'status' => 'pending',      // Masukkan status yang sesuai
                ]);
            }
        }



        return redirect()->back();
    }

    private function calculateSksLimit($ips)
    {
        if ($ips >= 3.00) return 24;
        if ($ips >= 2.50) return 21;
        if ($ips >= 2.00) return 18;
        if ($ips >= 1.50) return 15;
        return 12;
    }
}
