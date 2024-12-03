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
        // Validasi input `status` agar hanya menerima nilai "Disetujui" atau "Tidak Disetujui"
    $request->validate([
        'status' => 'required|in:Disetujui,Tidak Disetujui', // Status wajib diisi dan hanya bisa "Disetujui" atau "Tidak Disetujui"
    ]);

    // Update semua data IRS dengan `mhs_id` yang sesuai
    $affectedRows = Irs::where('mhs_id', $mhs_id)->update(['status' => $request->status]);

    // Periksa apakah ada data yang berhasil diperbarui
    if ($affectedRows > 0) {
        // Jika ada data yang diperbarui, kembalikan pesan sukses
        return redirect()
            ->route('DosenPengajuan.irs')
            ->with('success', 'Status IRS berhasil diperbarui untuk semua data!');
    }

    // Jika tidak ada data IRS yang ditemukan untuk `mhs_id` tersebut, kembalikan pesan error
    return redirect()
        ->route('DosenPengajuan.irs')
        ->with('error', 'IRS tidak ditemukan untuk mahasiswa tersebut!');
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

    public function detailPerwalianPA()
    {
        $dosens = Auth::user();
        $dosen = Dosen::where('user_id', $dosens->id)->first();

        // $mahasiswa = Mahasiswa::with('irs')->findOrFail($id); // Ambil data mahasiswa beserta IRS-nya

        return view('paDetailPerwalian', compact('dosens', 'dosen')); // Kirim data ke view
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
