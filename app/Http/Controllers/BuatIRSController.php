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
use Carbon\Carbon;

class BuatIRSController extends Controller
{
    private function checkIRSPeriod()
    {
        $irsOpenDate = Carbon::parse(env('OPEN_IRS'));
        $now = Carbon::now();
        
        $twoWeeksAfter = $irsOpenDate->copy()->addWeeks(2);
        $fourWeeksAfter = $irsOpenDate->copy()->addWeeks(4);
        
        if ($now->lessThanOrEqualTo($twoWeeksAfter)) {
            return 'edit_period'; // Periode 2 minggu pertama
        } elseif ($now->lessThanOrEqualTo($fourWeeksAfter)) {
            return 'cancel_period'; // Periode pembatalan (minggu 3-4)
        } else {
            return 'closed'; // Setelah 4 minggu
        }
    }

    public function tampil_jadwal()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $period = $this->checkIRSPeriod();
        
        // Update akses based on period
        if ($period === 'cancel_period' && $mahasiswa->akses !== 'cuma_batal') {
            $mahasiswa->update(['akses' => 'cuma_batal']);
        } elseif ($period === 'closed') {
            $mahasiswa->update(['akses' => 'no']);
            return view('irsClosedParah', ['mahasiswa' => $mahasiswa, 'user' => $user]);
        }

        if ($mahasiswa) {
            $sksLimit = $this->calculateSksLimit($mahasiswa->IPS);
            $currentSemester = $mahasiswa->semester;

            // Ensure semester is within valid range (1-8)
            $currentSemester = max(1, min(8, $currentSemester));

            // Determine if the current semester is odd or even
            $isOddSemester = $currentSemester % 2 !== 0;

            // Get all relevant semesters (same parity as current semester)
            $relevantSemesters = [];
            for ($i = 1; $i <= 8; $i++) {
                if (($i % 2 !== 0) === $isOddSemester) {
                    $relevantSemesters[] = $i;
                }
            }

            // Query untuk jadwal
            $jadwals = DB::table('jadwal')
                ->whereIn('semester', $relevantSemesters)
                ->where('prodi', $mahasiswa->prodi)
                ->where('status', 'disetujui')
                ->orderBy('semester')
                ->get();

            // Get just the IDs for checking in the view
            $existingIrs = Irs::where('nim', $mahasiswa->nim)
                ->where('semester', $mahasiswa->semester)
                ->pluck('jadwal_id')
                ->toArray();

            // Get full IRS entries with jadwal details
            $existingIrsEntries = Irs::where('nim', $mahasiswa->nim)
                ->where('semester', $mahasiswa->semester)
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
            'existingIrsEntries',
            'period'
        ));
    }

    public function store(Request $request)
    {
        $value = $request->input('value');
        
        try {
            $mhs = Auth::user();
            $mhsId = Mahasiswa::where('user_id', $mhs->id)->first();
    
            if (!$mhsId) {
                throw new \Exception('Mahasiswa tidak ditemukan');
            }
    
            $period = $this->checkIRSPeriod();
            
            if ($period === 'closed') {
                throw new \Exception('Periode IRS telah berakhir');
            }
            
            if ($period === 'cancel_period' && $mhsId->akses !== 'cuma_batal') {
                throw new \Exception('Anda hanya dapat membatalkan IRS pada periode ini');
            }
    
            $statusIrs = Irs::where('nim', $mhsId->nim)
                ->where('semester', $mhsId->semester)
                ->whereIn('status', ['baru', 'perbaikan'])
                ->latest()
                ->first();
    
            // Handle pembatalan IRS
            if ($value === 'batal') {
                if ($statusIrs) {
                    // Update status IRS
                    DB::table('irs')
                        ->where('nim', $mhsId->nim)
                        ->where('semester', $mhsId->semester)
                        ->update(['status' => 'Pembatalan']);
                    
                    return redirect()->route('buat.irs')->with('success', 'IRS berhasil dibatalkan');
                }
                
                // Jika tidak ada statusIrs, tetap update akses
                DB::table('mahasiswa')
                    ->where('nim', $mhsId->nim)
                    ->update(['akses' => 'yes']);
                
                return redirect()->route('buat.irs')->with('success', 'IRS berhasil dibatalkan');
            } 
            elseif ($value === 'batalbanget') {
                DB::table('irs')
                    ->where('nim', $mhsId->nim)
                    ->where('semester', $mhsId->semester)
                    ->where('status', 'pending')
                    ->update(['status' => 'Pembatalan']);
                
                return redirect()->route('buat.irs')->with('success', 'IRS berhasil dibatalkan');
            }
    
            // Validasi jadwal yang dipilih
            if (!$request->has('selectedSchedules')) {
                throw new \Exception('Tidak ada mata kuliah yang dipilih');
            }
    
            $selectedSchedules = $request->input('selectedSchedules');
            $currentSemester = $mhsId->semester;
    
            // Validate that all selected courses are from valid semesters
            foreach ($selectedSchedules as $schedule) {
                $jadwal = Jadwal::find($schedule['id']);
                if (!$jadwal) {
                    throw new \Exception('Jadwal tidak ditemukan');
                }
    
                // Get the semester parity (odd/even)
                $isOddCurrentSemester = $currentSemester % 2 !== 0;
                $isOddJadwalSemester = $jadwal->semester % 2 !== 0;
    
                // Check if the jadwal semester matches the current semester's parity
                if ($isOddCurrentSemester !== $isOddJadwalSemester) {
                    throw new \Exception("Mata kuliah hanya dapat diambil pada semester " .
                        ($isOddCurrentSemester ? "ganjil" : "genap"));
                }
            }
    
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
    
            DB::table('mahasiswa')->where('nim', $mhsId->nim)->update(['akses' => 'no']);
    
            foreach ($selectedSchedules as $schedule) {
                $jadwal = Jadwal::find($schedule['id']);
    
                if (!$jadwal) {
                    continue;
                }
    
                $matakuliah = Matakuliah::where('kode_mk', $jadwal->kode_mk)->first();
                $nilaiKhs = Khs::where('nim', $mhsId->nim)
                    ->where('kode_mk', $jadwal->kode_mk)
                    ->first();
    
                $smtMahasiswa = $mhsId->semester;
                $smtMatakuliah = $matakuliah ? $matakuliah->semester : $jadwal->semester;
                $nilaiSebelumnya = $nilaiKhs ? $nilaiKhs->nilai : 'S';
    
                // Hitung prioritas
                if ($smtMahasiswa > $smtMatakuliah) {
                    if ($nilaiSebelumnya == 'D' || $nilaiSebelumnya == 'E') {
                        $prioritas = 3;
                    } else if ($nilaiSebelumnya == 'A' || $nilaiSebelumnya == 'C' || $nilaiSebelumnya == 'B') {
                        $prioritas = 2;
                    } else {
                        $prioritas = 4;
                    }
                } else if ($smtMahasiswa == $smtMatakuliah) {
                    $prioritas = 5;
                } else {
                    $prioritas = 1;
                }
    
                // Check existing IRS entry
                $existingIrs = Irs::where('nim', $mhsId->nim)
                    ->where('jadwal_id', $schedule['id'])
                    ->where('semester', $currentSemester)
                    ->first();
    
                if (!$existingIrs) {
                    // Check kapasitas and priority
                    $existingRegistrations = Irs::where('jadwal_id', $jadwal->id)
                        ->orderBy('prioritas', 'DESC')
                        ->orderBy('created_at', 'ASC')
                        ->get();
    
                    if ($existingRegistrations->count() >= $jadwal->kapasitas) {
                        $lowestPriorityEntry = $existingRegistrations
                            ->sortBy('prioritas')
                            ->first();
    
                        if ($prioritas <= $lowestPriorityEntry->prioritas) {
                            continue;
                        }
    
                        Irs::where('id', $lowestPriorityEntry->id)->delete();
                    }
    
                    // Create new IRS entry
                    Irs::create([
                        'nim' => $mhsId->nim,
                        'jadwal_id' => $jadwal->id,
                        'semester' => $currentSemester,
                        'prioritas' => $prioritas,
                        'status' => 'pending'
                    ]);
                }
            }
    
            return redirect()->route('mhs.irs')->with('success', 'IRS berhasil disimpan');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
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

            $period = $this->checkIRSPeriod();
            
            if ($period === 'closed') {
                throw new \Exception('Periode pembatalan IRS telah berakhir');
            }

            // Delete the IRS entry
            $deleted = Irs::where('nim', $mhsId->nim)
                ->where('jadwal_id', $jadwal_id)
                ->where('semester', $mhsId->semester)
                ->delete();

            if (!$deleted) {
                throw new \Exception('Mata kuliah tidak ditemukan dalam IRS');
            }

            // Jika dalam periode edit, kembalikan akses
            if ($period === 'edit_period') {
                $mhsId->update(['akses' => 'yes']);
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

    private function calculateSksLimit($ips)
    {
        if ($ips >= 3.00) return 24;
        if ($ips >= 2.50) return 21;
        if ($ips >= 2.00) return 18;
        if ($ips >= 1.50) return 15;
        return 12;
    }
}