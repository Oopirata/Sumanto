<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Support\Facades\DB;
use App\Models\Khs;
use Illuminate\Http\Request;
use App\Models\Irs;

class BuatIRSController extends Controller
{
    public function tampil_jadwal()
{
    $user = Auth::user();
    $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

    if ($mahasiswa) {
        $sksLimit = $this->calculateSksLimit($mahasiswa->IPS);
        $currentSemester = $mahasiswa->semester;

        // Determine if the current semester is odd or even
        $isOddSemester = $currentSemester % 2 !== 0;

        // Define max semester according to real university regulations
        $maxSemester = 14; // Batas maksimal masa studi S1 adalah 14 semester (7 tahun)

        // Get all semesters with the same parity up to max semester
        $relevantSemesters = range(
            $isOddSemester ? 1 : 2,
            $maxSemester,
            $isOddSemester ? 2 : 2
        );

        // Fetch courses for relevant semesters
        $jadwals = Jadwal::whereIn('semester', $relevantSemesters)->get();

        // Get just the IDs for checking in the view
        $existingIrs = Irs::where('nim', $mahasiswa->nim)
            ->whereIn('semester', $relevantSemesters)
            ->pluck('jadwal_id')
            ->toArray();

        // Get full IRS entries with jadwal details
        $existingIrsEntries = Irs::where('nim', $mahasiswa->nim)
            ->whereIn('semester', $relevantSemesters)
            ->with('jadwal')
            ->get()
            ->map(function ($irs) {
                return [
                    'id' => $irs->jadwal->id,
                    'day' => $irs->jadwal->hari,
                    'kode_mk' => $irs->jadwal->kode_mk,
                    'sks' => $irs->jadwal->sks,
                    'semester' => $irs->jadwal->semester,
                    'kapasitas' => $irs->jadwal->kapasitas,
                    'start' => $irs->jadwal->jam_mulai,
                    'end' => $irs->jadwal->jam_selesai,
                    'title' => $irs->jadwal->nama_mk,
                    'kelas' => $irs->jadwal->kelas,
                    'ruangan' => $irs->jadwal->ruang,
                    'jenis' => $irs->jadwal->status
                ];
            });

        $dosenWali = Dosen::find($mahasiswa->dosen_wali_id);
    } else {
        $jadwals = collect();
        $dosenWali = null;
        $sksLimit = 0;
        $existingIrs = [];
        $existingIrsEntries = collect();
    }

    return view('mhsBuatIrs', compact(
        'user',
        'jadwals',
        'mahasiswa',
        'dosenWali',
        'sksLimit',
        'existingIrs',
        'existingIrsEntries'
    ));
}


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $mhs = Auth::user();
            $mhsId = Mahasiswa::where('user_id', $mhs->id)->first();

            if (!$mhsId) {
                throw new \Exception('Mahasiswa tidak ditemukan');
            }

            if (!$request->has('selectedSchedules')) {
                throw new \Exception('Tidak ada mata kuliah yang dipilih');
            }

            $selectedSchedules = $request->input('selectedSchedules');
            $currentSemester = $mhsId->semester;

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

            foreach ($selectedSchedules as $schedule) {

                $jadwal = Jadwal::find($schedule['id']);

                if ($jadwal) {
                    $matakuliah = Matakuliah::where('kode_mk', $jadwal->kode_mk)->first();
                    $nilaiKhs = Khs::where('nim', $mhsId->nim)
                        ->where('kode_mk', $jadwal->kode_mk)
                        ->first();
                }

                $smtMahasiswa = $mhsId->semester;
                $smtMatakuliah = $matakuliah->semester;
                $nilaiSebelumnya = $nilaiKhs ? $nilaiKhs->nilai : 'S';

                // Hitung prioritas
                if($smtMahasiswa > $smtMatakuliah){
                    if($nilaiSebelumnya == 'D' || $nilaiSebelumnya == 'E'){
                        $prioritas = 3;
                    }else if($nilaiSebelumnya == 'A'|| $nilaiSebelumnya == 'C' || $nilaiSebelumnya == 'B'){
                        $prioritas = 2;
                    }else{
                        $prioritas = 4;
                    }
                }else if($smtMahasiswa == $smtMatakuliah){
                    $prioritas = 5;
                }else{
                    $prioritas = 1;
                }

                // Ambil semua pendaftar untuk jadwal ini dan urutkan berdasarkan prioritas
                $row_index = Irs::select(DB::raw('ROW_NUMBER() OVER (ORDER BY prioritas DESC, created_at ASC) AS row_index, nim'))
                    ->where('jadwal_id', $jadwal->id)
                    ->where('semester', $currentSemester)
                    ->get();

                // Tambahkan pendaftar baru ke daftar untuk perhitungan posisi
                $position = $row_index->count() + 1;

                // Jika kapasitas sudah penuh, cek apakah prioritas pendaftar baru lebih tinggi
                if ($row_index->count() >= $jadwal->kapasitas) {
                    // Ambil mahasiswa dengan prioritas terendah
                    $lowestPriority = Irs::where('jadwal_id', $jadwal->id)
                        ->where('semester', $currentSemester)
                        ->orderBy('prioritas', 'ASC')
                        ->orderBy('created_at', 'DESC')
                        ->first();

                    // Jika prioritas pendaftar baru lebih tinggi, hapus yang prioritasnya terendah
                    if ($prioritas > $lowestPriority->prioritas) {
                        $lowestPriority->delete();
                    } else {
                        // Jika prioritas lebih rendah atau sama, skip pendaftaran
                        continue;
                    }
                }

                $existingIrs = Irs::where('nim', $mhsId->nim)
                    ->where('jadwal_id', $schedule['id'])
                    ->where('semester', $currentSemester)
                    ->first();

                if (!$existingIrs) {
                    if ($jadwal) {
                        // Check if this course has been taken before
                        $previousIrs = Irs::where('nim', $mhsId->nim)
                            ->where('jadwal_id', '!=', $jadwal->id) // Different class/schedule
                            ->whereHas('jadwal', function ($query) use ($jadwal) {
                                $query->where('kode_mk', $jadwal->kode_mk); // Same course code
                            })
                            ->first();

                        // Always set initial status as pending
                        // The status will be updated to 'mengulang' by dosen/PA during verification
                        // if they confirm it's a repeated course
                        $status = 'pending';

                        // Store with current semester
                        Irs::create([
                            'nim' => $mhsId->nim,
                            'jadwal_id' => $jadwal->id,
                            'semester' => $currentSemester,
                            'prioritas' => $prioritas,
                            'status' => $status
                        ]);
                    }
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

    public function deleteIrs($jadwal_id)
    {
        try {
            DB::beginTransaction();

            $mhs = Auth::user();
            $mhsId = Mahasiswa::where('user_id', $mhs->id)->first();

            if (!$mhsId) {
                throw new \Exception('Mahasiswa tidak ditemukan');
            }

            // Delete the IRS entry
            $deleted = Irs::where('nim', $mhsId->nim)
                ->where('jadwal_id', $jadwal_id)
                ->where('semester', $mhsId->semester)  // Make sure we're deleting from current semester
                ->delete();

            if (!$deleted) {
                throw new \Exception('Mata kuliah tidak ditemukan dalam IRS');
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Mata kuliah berhasil dihapus dari IRS'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}