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
        // Validasi input status
        $request->validate([
            'status' => 'required|in:Disetujui,Tidak Disetujui,pending',
        ]);

        // Ambil semester aktif dari mahasiswa
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        $semesterAktif = $mahasiswa->semester;

        // Update IRS berdasarkan NIM dan semester aktif
        $affectedRows = Irs::where('nim', $nim)
            ->where('semester', $semesterAktif) // Hanya update IRS semester aktif
            ->whereIn('status', ['pending', 'Disetujui', 'Tidak Disetujui'])
            ->update(['status' => $request->status]);

        if ($affectedRows > 0) {
            return redirect()
                ->route('DosenPengajuan.irs')
                ->with('success', 'Status IRS berhasil diperbarui!');
        }

        return redirect()
            ->route('DosenPengajuan.irs')
            ->with('error', 'IRS tidak ditemukan untuk mahasiswa tersebut!');
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

    public function detailPerwalianPA()
    {
        // Get authenticated user
        $dosens = Auth::user();

        // Fetch corresponding dosen record
        $dosen = Dosen::where('user_id', $dosens->id)->first();

        // Fetch Mahasiswa's data (assuming each dosen is linked to a mahasiswa via user_id)
        $mahasiswa = Mahasiswa::where('user_id', $dosens->id)->first();

        // Fetch IRS data for the mahasiswa
        $irsData = Irs::where('mahasiswa_id', $mahasiswa->id)->get(); // Assuming IRS model is linked with mahasiswa_id

        // Organize IRS data by semester
        $semesterSks = []; // To store the total SKS per semester
        $groupedIrsData = $irsData->groupBy('semester'); // Assuming IRS has a 'semester' field

        foreach ($groupedIrsData as $semester => $irs) {
            $semesterSks[$semester] = $irs->sum('sks'); // Sum SKS for each semester
        }

        // Return the view with the data
        return view('paDetailPerwalian', compact('dosens', 'dosen', 'mahasiswa', 'irsData', 'semesterSks'));
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
}
