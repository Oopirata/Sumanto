<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Irs;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DosenController extends Controller
{
    /**
     * Dashboard Pembimbing Akademik (PA)
     */
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
    public function dashboardPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first();

        // Konversi hari ke bahasa Indonesia
        $hari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        $hariIni = $hari[now()->format('l')] ?? now()->format('l');

        // Ambil jadwal hari ini berdasarkan relasi dosen_matakuliah
        $jadwals = Jadwal::join('dosen_matakuliah', 'jadwal.kode_mk', '=', 'dosen_matakuliah.kode_mk')
            ->where('dosen_matakuliah.dosen_nip', $dosen->nip)
            ->where('jadwal.hari', $hariIni)
            ->select('jadwal.*')
            ->orderBy('jadwal.jam_mulai')
            ->get();

        // Debug jika diperlukan
        // dd([
        //     'hari_ini' => $hariIni,
        //     'nip_dosen' => $dosen->nip,
        //     'jadwals' => $jadwals->toArray()
        // ]);

        return view('paDashboard', compact('dosen', 'dosens', 'jadwals'));
    }

    /**
     * Verifikasi Pengajuan IRS PA
     */

    public function pengajuanIrsPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first();

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Dosen tidak ditemukan!');
        }

        // Dapatkan mahasiswa dengan IRS terbaru
        $mahasiswa = Mahasiswa::where('dosen_wali_id', $dosen->id)
            ->get()
            ->map(function ($student) {
                // Ambil IRS terbaru untuk setiap mahasiswa
                $latestIrs = Irs::where('nim', $student->nim)
                    ->orderBy('semester', 'desc')
                    ->first();

                // Tambahkan IRS ke data mahasiswa
                $student->latest_irs = $latestIrs;
                return $student;
            });

        return view('paPengajuanIrs', compact('dosens', 'dosen', 'mahasiswa'));
    }

    /**
     * Update Status IRS
     */
    public function updateStatusIrs(Request $request, $nim)
    {
        try {
            DB::beginTransaction();
            $period = $this->checkIRSPeriod();

            $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
            $semesterAktif = $mahasiswa->semester;

            // Get all previous courses taken by the student from all semesters
            $previousCourses = Irs::where('nim', $nim)
                ->where('semester', '<', $semesterAktif)
                ->with('jadwal')
                ->get()
                ->pluck('jadwal.kode_mk')
                ->toArray();

            if ($request->has('action')) {
                $irsEntries = Irs::where('nim', $nim)
                    ->where('semester', $semesterAktif)
                    ->where('status', 'pending')
                    ->with('jadwal')
                    ->get();

                if ($request->action === 'reject') {
                    // Reject all pending IRS entries
                    foreach ($irsEntries as $irs) {
                        $irs->update(['status' => 'rejected']);
                    }
                } elseif ($request->action === 'approve') {
                    // Approve entries and set status based on course history
                    foreach ($irsEntries as $irs) {
                        $status = in_array($irs->jadwal->kode_mk, $previousCourses) ? 'perbaikan' : 'baru';
                        $irs->update(['status' => $status]);
                    }
                }
            } elseif ($request->has('status') && $request->status === 'pending') {
                // Reset status to pending for all entries in current semester
                Irs::where('nim', $nim)
                    ->where('semester', $semesterAktif)
                    ->update(['status' => 'pending']);

                if ($period === 'edit_period') {
                    DB::table('mahasiswa')->where('nim', $nim)->update(['akses' => 'yes']);
                }
            }

            DB::commit();
            return redirect()
                ->route('DosenPengajuan.irs')
                ->with('success', 'Status IRS berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route('DosenPengajuan.irs')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function detailIrsPA($nim)
    {
        try {
            $dosens = Auth::user();
            $dosen = Dosen::where('user_id', $dosens->id)->first();

            // Get mahasiswa data
            $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

            // Get previous courses from all semesters
            $previousCourses = Irs::where('nim', $nim)
                ->where('semester', '<', $mahasiswa->semester)
                ->with('jadwal')
                ->get()
                ->pluck('jadwal.kode_mk')
                ->toArray();

            // Get current semester IRS data
            $irsData = Irs::where('nim', $nim)
                ->where('semester', $mahasiswa->semester)
                ->with('jadwal')
                ->get();

            // Add isRetake information to each IRS entry
            $irsData->each(function ($irs) use ($previousCourses) {
                $irs->isRetake = in_array($irs->jadwal->kode_mk, $previousCourses);
            });

            return view('paDetailIrs', compact('dosens', 'dosen', 'mahasiswa', 'irsData'));
        } catch (\Exception $e) {
            return redirect()
                ->route('DosenPengajuan.irs')
                ->with('error', 'Terjadi kesalahan saat memuat data IRS');
        }
    }

    /**
     * Halaman Perwalian PA
     */
    public function perwalianPA()
    {
        // Ambil user yang sedang login
        $dosens = Auth::user();

        // Cari dosen berdasarkan user_id
        $dosen = Dosen::where('user_id', $dosens->id)->first();

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Dosen tidak ditemukan!');
        }

        // Ambil mahasiswa yang diawasi oleh dosen
        $mahasiswa = Mahasiswa::with('user') // Jika ada relasi dengan tabel user
            ->where('dosen_wali_id', $dosen->id)
            ->get();

        // Kirim data ke view
        return view('paPerwalian', compact('dosens', 'dosen', 'mahasiswa'));
    }

    public function detailPerwalian($nim)
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first();

        // Ambil data mahasiswa dengan relasinya
        $mahasiswa = Mahasiswa::with('user')
            ->where('nim', $nim)
            ->firstOrFail();

        // Ambil semua IRS mahasiswa dan group berdasarkan semester
        $irsData = Irs::where('nim', $nim)
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
            ->orderBy('irs.semester')
            ->orderBy('jadwal.kode_mk')
            ->get()
            ->groupBy('semester');

        // Hitung total SKS per semester
        $semesterSks = [];
        foreach ($irsData as $semester => $matakuliahs) {
            $semesterSks[$semester] = $matakuliahs->sum('sks');
        }

        // Hitung IP dan IPK
        $ipk = $mahasiswa->IPK ?? 0;
        $ips = $mahasiswa->IPS ?? 0;

        // Status Mahasiswa
        $status = 'AKTIF';
        $statusClass = 'bg-green-100 text-green-500';

        return view('paDetailPerwalian', compact(
            'dosen',
            'dosens',
            'mahasiswa',
            'irsData',
            'semesterSks',
            'ipk',
            'ips',
            'status',
            'statusClass'
        ));
    }

    public function pengajuanNilaiPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first();

        // $mahasiswa = Mahasiswa::with('irs')->findOrFail($id); // Ambil data mahasiswa beserta IRS-nya

        return view('paPengajuanNilai', compact('dosens', 'dosen')); // Kirim data ke view
    }

    public function detailNilaiPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first();

        // $mahasiswa = Mahasiswa::with('irs')->findOrFail($id); // Ambil data mahasiswa beserta IRS-nya

        return view('paDetailNilai', compact('dosens', 'dosen')); // Kirim data ke view
    }

    public function inputNilaiPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first();

        // $mahasiswa = Mahasiswa::with('irs')->findOrFail($id); // Ambil data mahasiswa beserta IRS-nya

        return view('paInputNilai', compact('dosens', 'dosen')); // Kirim data ke view
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
