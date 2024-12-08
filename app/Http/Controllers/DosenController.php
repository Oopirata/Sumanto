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

class DosenController extends Controller
{
    /**
     * Dashboard Pembimbing Akademik (PA)
     */
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

            $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
            $semesterAktif = $mahasiswa->semester;

            if ($request->has('action')) {
                // Handle bulk actions (approve all or reject all)
                if ($request->action === 'reject') {
                    // Reject all pending IRS entries
                    Irs::where('nim', $nim)
                        ->where('semester', $semesterAktif)
                        ->where('status', 'pending')
                        ->update(['status' => 'rejected']);
                } elseif ($request->action === 'approve') {
                    // Update each IRS entry with its specified status
                    foreach ($request->status as $irsId => $status) {
                        Irs::where('id', $irsId)
                            ->where('nim', $nim)
                            ->where('semester', $semesterAktif)
                            ->update(['status' => $status]);
                    }
                }
            } elseif ($request->has('status')) {
                // Handle individual status updates from the list view
                if ($request->status === 'pending') {
                    // Reset status to pending
                    Irs::where('nim', $nim)
                        ->where('semester', $semesterAktif)
                        ->update(['status' => 'pending']);
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

            // Ambil data mahasiswa
            $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

            // Ambil data IRS dengan jadwal untuk semester aktif mahasiswa
            $irsData = Irs::where('nim', $nim)
                ->where('semester', $mahasiswa->semester)
                ->with('jadwal') // Load jadwal relationship
                ->get();

            // Debug jika diperlukan
            // dd($irsData->toArray());

            return view('paDetailIrs', compact('dosens', 'dosen', 'mahasiswa', 'irsData'));
        } catch (\Exception $e) {
            // // Log error untuk debugging
            // \Log::error($e->getMessage());

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
