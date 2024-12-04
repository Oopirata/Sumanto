<?php

namespace App\Http\Controllers;

use App\Models\Irs;
use App\Models\Khs;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class KhsController extends Controller
{
    public function all(Request $request)
    {
        // autentikasi user
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        // dd($user);
        // Get rekap semester
        $semesterData = Khs::join('matakuliah', 'khs.kode_mk', '=', 'matakuliah.kode_mk')
            ->where('khs.nim', $mahasiswa->nim)
            ->select(
                'khs.semester',
                DB::raw('SUM(matakuliah.sks) as total_sks'),
                DB::raw('AVG(CASE 
                        WHEN khs.nilai = "A" THEN 4.0
                        WHEN khs.nilai = "A-" THEN 3.7
                        WHEN khs.nilai = "B+" THEN 3.3
                        WHEN khs.nilai = "B" THEN 3.0
                        WHEN khs.nilai = "B-" THEN 2.7
                        WHEN khs.nilai = "C+" THEN 2.3
                        WHEN khs.nilai = "C" THEN 2.0
                        WHEN khs.nilai = "D" THEN 1.0
                        ELSE 0 END) as ips')
            )
            ->groupBy('khs.semester')
            ->orderBy('khs.semester')
            ->get();

        // Hitung IPK
        $ipk = $semesterData->avg('ips');

        // Get detailed course data for each semester
        $khsData = Khs::join('matakuliah', 'khs.kode_mk', '=', 'matakuliah.kode_mk')
            ->where('khs.nim', $mahasiswa->nim)
            ->select('khs.*', 'matakuliah.nama_mk as nama_mk', 'matakuliah.sks')
            ->orderBy('khs.semester')
            ->orderBy('matakuliah.nama_mk')
            ->get()
            ->groupBy('semester');

        $userData = User::find($user->id);

        return view('mhsKhs', compact('mahasiswa', 'userData', 'semesterData', 'khsData', 'ipk'));
    }
    public function download($semester)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        // Fetch the KHS data for the specified semester
        $khsData = Khs::join('matakuliah', 'khs.kode_mk', '=', 'matakuliah.kode_mk')
            ->where('khs.nim', $mahasiswa->nim)
            ->where('khs.semester', $semester)
            ->select('khs.*', 'matakuliah.nama_mk', 'matakuliah.sks')
            ->orderBy('matakuliah.kode_mk')
            ->get();

        // Calculate total SKS
        $totalSks = $khsData->sum('sks');

        // Calculate IPS
        $ips = $khsData->average(function ($item) {
            return match ($item->nilai) {
                'A' => 4.0,
                'A-' => 3.7,
                'B+' => 3.3,
                'B' => 3.0,
                'B-' => 2.7,
                'C+' => 2.3,
                'C' => 2.0,
                'D' => 1.0,
                default => 0,
            };
        });

        $pdf = PDF::loadView('khsDownloadPdf', compact('mahasiswa', 'khsData', 'semester', 'totalSks', 'ips'));

        return $pdf->download('KHS_' . $mahasiswa->nim . '_Semester_' . $semester . '.pdf');
    }
}
