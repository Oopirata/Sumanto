<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Irs;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class IRSController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $irsData = Irs::with(['jadwal'])
            ->join('jadwal', 'irs.jadwal_id', '=', 'jadwal.id')
            ->join('buat_irs', function ($join) {
                $join->on('jadwal.kode_mk', '=', 'buat_irs.kode_mk')
                    ->on('jadwal.kelas', '=', 'buat_irs.kelas');
            })
            ->where('irs.nim', $mahasiswa->nim)
            ->select(
                'irs.id',
                'irs.nim',
                'irs.jadwal_id',
                'irs.semester as irs_semester', // Use IRS semester, not jadwal semester
                'irs.status',
                'jadwal.sks',
                'jadwal.kode_mk',
                'jadwal.nama_mk',
                'jadwal.kelas',
                'jadwal.ruang',
                'buat_irs.nama_dosen'
            )
            ->orderBy('irs.semester') // Order by IRS semester
            ->get()
            ->groupBy('irs_semester'); // Group by IRS semester

        $semesterSks = [];
        foreach ($irsData as $semester => $entries) {
            $semesterSks[$semester] = $entries->sum('sks');
        }

        $dosenWali = Dosen::find($mahasiswa->dosen_wali_id);

        return view('mhsIrs', compact(
            'user',
            'mahasiswa',
            'irsData',
            'semesterSks',
            'dosenWali'
        ));
    }

    public function getSemesterData(Request $request, $semester)
    {
        try {
            $user = Auth::user();
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

            if (!$mahasiswa) {
                throw new \Exception('Data mahasiswa tidak ditemukan');
            }

            $data = Irs::with(['jadwal'])
                ->join('jadwal', 'irs.jadwal_id', '=', 'jadwal.id')
                ->where('nim', $mahasiswa->id)
                ->where('jadwal.semester', $semester)
                ->select(
                    'irs.*',
                    'jadwal.kode_mk',
                    'jadwal.nama_mk as matakuliah',
                    'jadwal.ruang',
                    'jadwal.sks',
                    'jadwal.kelas',
                    'jadwal.status',
                    'jadwal.nama_dosen as dosen'
                )
                ->get();

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function tampil_jadwal()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        // Get current semester's courses
        $currentSemesterCourses = Matakuliah::where('semester', $mahasiswa->semester)
            ->pluck('semester')
            ->toArray();

        // Get relevant schedules
        $jadwals = Jadwal::whereIn('semester', $currentSemesterCourses)->get();

        // Get dosen wali
        $dosenWali = Dosen::find($mahasiswa->dosen_wali_id);

        // Calculate SKS limit based on IP
        $sksLimit = $this->calculateSksLimit($mahasiswa->IPS);

        return view('mhsIrs', compact(
            'user',
            'jadwals',
            'mahasiswa',
            'dosenWali',
            'sksLimit'
        ));
    }

    private function calculateSksLimit($ips)
    {
        if ($ips >= 3.00) return 24;
        if ($ips >= 2.50) return 21;
        if ($ips >= 2.00) return 18;
        if ($ips >= 1.50) return 15;
        return 12;
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

        return $pdf->download('IRS_' . $nim . '_Semester_' . $semester . '.pdf');
    }
}
