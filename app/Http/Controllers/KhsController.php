<?php

namespace App\Http\Controllers;

use App\Models\Khs;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Fetch the data for the specified semester
        $khsData = Khs::join('matakuliah', 'khs.kode_mk', '=', 'matakuliah.kode_mk')
            ->where('khs.nim', $mahasiswa->nim)
            ->where('khs.semester', $semester)
            ->select('khs.*', 'matakuliah.nama_mk as nama_mk', 'matakuliah.sks')
            ->get();

        // Generate PDF (using a library like Dompdf or Snappy)
        // $pdf = \PDF::loadView('khs-pdf', ['khsData' => $khsData, 'semester' => $semester]);

        // Download the PDF
        // return $pdf->download("KHS_Semester_{$semester}.pdf");
    }

    public function downloadIrsPDF($nim, $semester)
    {
        $mahasiswa = Mahasiswa::with('user')
        ->where('nim', $nim)
        ->firstOrFail();

        // Ambil data IRS hanya untuk semester yang dipilih
        $irsData = Irs::where('nim', $nim)
        ->where('irs.semester', $semester)  // Tambahkan prefix 'irs.' untuk memperjelas
        ->join('jadwal', 'irs.jadwal_id', '=', 'jadwal.id')
        ->select(
        'irs.*',
        'jadwal.kode_mk',
        'jadwal.nama_mk',
        'jadwal.kelas',
        'jadwal.sks',
        'jadwal.ruang',
        'jadwal.sifat'
        )
        ->orderBy('jadwal.kode_mk')
        ->get();

        // Hitung total SKS
        $totalSks = $irsData->sum('sks');

        $pdf = PDF::loadView('unduhPdf', compact('mahasiswa', 'irsData', 'semester', 'totalSks'));

        return $pdf->download('IRS_'.$nim.'_Semester_'.$semester.'.pdf');
    }
}
