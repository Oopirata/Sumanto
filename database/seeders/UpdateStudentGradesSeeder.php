<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateStudentGradesSeeder extends Seeder
{
    private function calculateGrades($nim)
    {
        $khsData = DB::table('khs')
            ->join('matakuliah', 'khs.kode_mk', '=', 'matakuliah.kode_mk')
            ->where('khs.nim', $nim)
            ->select(
                'khs.semester',
                'khs.nilai',
                'matakuliah.sks'
            )
            ->get();

        if ($khsData->isEmpty()) {
            return [
                'ipk' => 0.00,
                'ips' => 0.00
            ];
        }

        $totalGradePoints = 0;
        $totalSKS = 0;
        $latestSemester = $khsData->max('semester');
        $latestSemesterPoints = 0;
        $latestSemesterSKS = 0;

        foreach ($khsData as $entry) {
            $gradePoint = match ($entry->nilai) {
                'A' => 4.0,
                'A-' => 3.7,
                'B+' => 3.3,
                'B' => 3.0,
                'B-' => 2.7,
                'C+' => 2.3,
                'C' => 2.0,
                'D' => 1.0,
                default => 0
            };

            $weightedGrade = $gradePoint * $entry->sks;
            $totalGradePoints += $weightedGrade;
            $totalSKS += $entry->sks;

            if ($entry->semester == $latestSemester) {
                $latestSemesterPoints += $weightedGrade;
                $latestSemesterSKS += $entry->sks;
            }
        }

        $ipk = $totalSKS > 0 ? round($totalGradePoints / $totalSKS, 2) : 0.00;
        $ips = $latestSemesterSKS > 0 ? round($latestSemesterPoints / $latestSemesterSKS, 2) : 0.00;

        return [
            'ipk' => $ipk,
            'ips' => $ips
        ];
    }

    public function run()
    {
        $mahasiswas = DB::table('mahasiswa')->get();

        foreach ($mahasiswas as $mahasiswa) {
            $grades = $this->calculateGrades($mahasiswa->nim);

            DB::table('mahasiswa')
                ->where('nim', $mahasiswa->nim)
                ->update([
                    'IPK' => $grades['ipk'],
                    'IPS' => $grades['ips']
                ]);
        }
    }
}
