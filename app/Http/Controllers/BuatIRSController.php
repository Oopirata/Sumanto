<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Irs;

class BuatIRSController extends Controller
{
    public function tampil_jadwal()
{
    $user = Auth::user();

    // Get Mahasiswa details
    $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

    if ($mahasiswa) {
        $sksLimit = $this->calculateSksLimit($mahasiswa->IPS);

        $currentSemester = $mahasiswa->semester;

        // Determine if the current semester is odd or even
        $isOddSemester = $currentSemester % 2 !== 0;

        // Get all relevant semesters (same parity as current semester)
        $relevantSemesters = [];
        for ($i = $currentSemester; $i > 0; $i--) {
            if (($i % 2 !== 0) === $isOddSemester) {
                $relevantSemesters[] = $i;
            }
        }

        // Fetch courses for relevant semesters
        $jadwals = Jadwal::whereIn('semester', $relevantSemesters)->get();

        // Fetch existing IRS entries for the current semester
        $existingIrs = Irs::where('nim', $mahasiswa->nim)
            ->where('semester', $mahasiswa->semester)
            ->pluck('jadwal_id')
            ->toArray();

        $dosenWali = Dosen::find($mahasiswa->dosen_wali_id);
    } else {
        $jadwals = collect();
        $dosenWali = null;
        $sksLimit = 0;
        $existingIrs = [];
    }

    return view('mhsBuatIrs', compact('user', 'jadwals', 'mahasiswa', 'dosenWali', 'sksLimit', 'existingIrs'));
}


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $mhs = Auth::user();
            $mhsId = Mahasiswa::where('user_id', $mhs->id)->first();
            // dd($mhsId);

            if (!$mhsId) {
                throw new \Exception('Mahasiswa tidak ditemukan');
            }

            // Validate request
            if (!$request->has('selectedSchedules')) {
                throw new \Exception('Tidak ada mata kuliah yang dipilih');
            }

            $selectedSchedules = $request->input('selectedSchedules');

            // Calculate total SKS
            $totalSks = 0;
            foreach ($selectedSchedules as $schedule) {
                $jadwal = Jadwal::find($schedule['id']);
                if ($jadwal) {
                    $totalSks += $jadwal->sks;
                }
            }

            // Check SKS limit
            $sksLimit = $this->calculateSksLimit($mhsId->IPS);
            if ($totalSks > $sksLimit) {
                throw new \Exception("Total SKS ($totalSks) melebihi batas yang diizinkan ($sksLimit)");
            }

            // Delete existing pending IRS entries for this semester
            Irs::where('nim', $mhsId->nim)
                ->where('semester', $mhsId->semester)
                ->where('status', 'pending')
                ->delete();

            // Create new IRS entries
            foreach ($selectedSchedules as $schedule) {
                $jadwal = Jadwal::find($schedule['id']);

                if ($jadwal) {
                    Irs::create([
                        'nim' => $mhsId->nim,
                        'jadwal_id' => $jadwal->id,
                        'semester' => $mhsId->semester,
                        'status' => 'pending'
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('mhs.irs')->with('success', 'IRS berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
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
