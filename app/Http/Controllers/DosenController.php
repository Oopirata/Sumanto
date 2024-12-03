<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Irs;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    /**
     * Dashboard Pembimbing Akademik (PA)
     */
    public function dashboardPA()
    {
        $dosens = Auth::user(); // Data user yang sedang login
        $dosen = Dosen::where('user_id', $dosens->id)->first(); // Ambil data dosen berdasarkan user_id

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Dosen tidak ditemukan!');
        }

        // Ambil jadwal berdasarkan hari ini
        $hariIni = now()->locale('id')->translatedFormat('l'); // Nama hari dalam bahasa Indonesia

        // Jadwal hari ini untuk dosen yang login
        $jadwals = Jadwal::where('hari', $hariIni)
            ->whereIn('kode_mk', function ($query) use ($dosen) {
                $query->select('kode_mk')
                    ->from('dosen_matakuliah')
                    ->where('dosen_nip', $dosen->nip);
            })
            ->orderBy('jam_mulai', 'asc')
            ->get();

        // Kirim data ke view
        return view('paDashboard', compact('dosens', 'dosen', 'jadwals'));
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

        // Ambil mahasiswa yang diawasi dosen, dengan IRS mereka
        $mahasiswa = Mahasiswa::with('irs') // Gunakan eager loading untuk IRS
            ->where('dosen_wali_id', $dosen->id)
            ->get();

        // Kirim data ke view
        return view('paPengajuanIrs', compact('dosens', 'dosen', 'mahasiswa'));
    }

    /**
     * Update Status IRS
     */
    public function updateStatusIrs(Request $request, $mhs_id)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:Disetujui,Tidak Disetujui',
        ]);

        // Temukan IRS berdasarkan mahasiswa ID
        $irs = Irs::where('mhs_id', $mhs_id)->first();

        if ($irs) {
            $irs->update(['status' => $request->status]);

            return redirect()->route('DosenPengajuan.irs')->with('success', 'Status IRS berhasil diperbarui!');
        }

        return redirect()->route('DosenPengajuan.irs')->with('error', 'IRS tidak ditemukan!');
    }

    /**
     * Halaman Perwalian PA
     */
    public function perwalianPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first();

        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Dosen tidak ditemukan!');
        }

        // Ambil mahasiswa yang diawasi dosen, dengan IRS mereka
        $mahasiswa = Mahasiswa::with('irs') // Gunakan eager loading untuk IRS
            ->where('dosen_wali_id', $dosen->id)
            ->get();

        // Kirim data ke view
        return view('paPerwalian', compact('dosens', 'dosen', 'mahasiswa'));
    }

    public function detailIrsPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first();

        // $mahasiswa = Mahasiswa::with('irs')->findOrFail($id); // Ambil data mahasiswa beserta IRS-nya

        return view('paDetailIrs', compact('dosens', 'dosen')); // Kirim data ke view
    }

    public function detailPerwalianPA($id)
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first();

        // Fetch the specific student with their user and IRS data
        $mahasiswa = Mahasiswa::with(['user', 'irs' => function ($query) {
            $query->join('jadwal', 'irs.jadwal_id', '=', 'jadwal.id')
                ->join('buat_irs', function ($join) {
                    $join->on('jadwal.kode_mk', '=', 'buat_irs.kode_mk')
                        ->on('jadwal.kelas', '=', 'buat_irs.kelas');
                })
                ->select(
                    'irs.*',
                    'jadwal.kode_mk',
                    'jadwal.nama_mk',
                    'jadwal.semester',
                    'jadwal.kelas',
                    'jadwal.sks',
                    'jadwal.ruang',
                    'jadwal.sifat',
                    'buat_irs.nama_dosen'
                )
                ->orderBy('jadwal.semester');
        }])->findOrFail($id);

        // Initialize empty arrays for IRS data and semester SKS
        $irsData = collect();
        $semesterSks = [];

        // Only process IRS data if it exists
        if ($mahasiswa->irs->isNotEmpty()) {
            $irsData = $mahasiswa->irs->groupBy('semester');
            foreach ($irsData as $semester => $entries) {
                $semesterSks[$semester] = $entries->sum('sks');
            }
        }

        return view('paDetailPerwalian', compact('dosens', 'dosen', 'mahasiswa', 'irsData', 'semesterSks'));
    }
}
