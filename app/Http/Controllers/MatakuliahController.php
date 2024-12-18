<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\Dosen;
use App\Models\Kaprodi;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class MatakuliahController extends Controller
{
    public function handleStore(Request $request)
    {
        $action = $request->input('action'); // Ambil nilai dari hidden input 'action'

        if ($action === 'store_dosen') {
            return $this->store($request); // Panggil fungsi store
        } elseif ($action === 'store_mk') {
            return $this->storeMk($request); // Panggil fungsi storeMk
        }

        return redirect()->back()->with('error', 'Aksi tidak valid.');
    }

    public function handleDelete(Request $request)
    {
        $action = $request->input('action'); // Ambil nilai dari hidden input 'action'

        if ($action === 'delete_dosen') {
            return $this->deleteJadwal($request); // Panggil fungsi deleteJadwal
        } elseif ($action === 'delete_mk') {
            return $this->deleteMatakuliah($request); // Panggil fungsi deleteMatakuliah
        }

        return redirect()->back()->with('error', 'Aksi tidak valid.');
    }

    public function showKaprodiDashboard()
    {
        $user = Auth::user();
        $userr= Kaprodi::where('user_id', $user->id)->first();
        // dd($userr);
        return view('kaprodiDashboard', compact('user', 'userr'));
    }
    public function index()
    {
        $user = Auth::user();
        $userr = Kaprodi::where('user_id', $user->id)->first();
        // Mendapatkan semua mata kuliah
        $matakuliah = Matakuliah::select('matakuliah.nama_mk', 'matakuliah.sks', 'matakuliah.semester','matakuliah.kode_mk')
            ->groupBy('matakuliah.nama_mk', 'matakuliah.sks', 'matakuliah.semester', 'matakuliah.kode_mk')
            ->get();

        // Menambahkan dosen yang terkait dengan masing-masing mata kuliah
        foreach ($matakuliah as $mk) {
            $dosen = Dosen::select('dosen.nama','dosen.nip')
                ->join('dosen_matakuliah', 'dosen.nip', '=', 'dosen_matakuliah.dosen_nip')
                ->where('dosen_matakuliah.kode_mk', $mk->kode_mk)
                ->get();

            $mk->dosen = $dosen;
        }

        // Mendapatkan seluruh dosen tanpa tergantung mata kuliah
        $dosen = Dosen::all();
        // dd($dosen);
        // Mengirim data ke view
        return view('kaprodiMatkulDosen', compact('matakuliah', 'dosen', 'user', 'userr'));
    }
    public function deleteDosen(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'dosen_nip' => 'required|exists:dosen,nip',
            'dosen_kuliah_id' => 'required|exists:matakuliah,kode_mk',
        ]);
    
        // Menggunakan query untuk menghapus data
        $deleted = DB::table('dosen_matakuliah')
            ->where('dosen_nip', $validated['dosen_nip'])
            ->where('kode_mk', $validated['dosen_kuliah_id'])
            ->delete();
    
        // Cek apakah data berhasil dihapus
        if ($deleted) {
            return redirect()->route('matakuliah.index')->with('success', 'Dosen berhasil dihapus dari Mata Kuliah');
        } else {
            return redirect()->route('matakuliah.index')->with('error', 'Gagal menghapus Dosen dari Mata Kuliah');
        }
    }
    



    public function store(Request $request)
    {
        // Validasi data request
        $request->validate([
            'mata_kuliah_id' => 'required|string|exists:matakuliah,kode_mk', // validasi untuk mata kuliah
            'dosen_nip' => 'required|string|exists:dosen,nip', // validasi untuk dosen
        ]);

        // Menambahkan data dosen ke mata kuliah (hubungan dosen dengan mata kuliah)
        $mataKuliah = Matakuliah::where('kode_mk', $request->mata_kuliah_id)->first();
        $dosen = Dosen::where('nip', $request->dosen_nip)->first();

        // Memeriksa apakah mata kuliah ditemukan
        if ($mataKuliah) {
            // Mengecek apakah sudah ada entri dengan dosen_nip dan kode_mk yang sama di tabel pivot
            $exists = DB::table('dosen_matakuliah')
                ->where('dosen_nip', $dosen->nip)
                ->where('kode_mk', $mataKuliah->kode_mk)
                ->exists();

            if ($exists) {
                // Jika sudah ada, berikan respons atau pesan
                return redirect()->back()->with('error', 'Dosen ini sudah terhubung dengan mata kuliah ini.');
            }

            // Jika belum ada, tambahkan data ke tabel pivot
            DB::table('dosen_matakuliah')->insert([
                'dosen_nip' => $dosen->nip,
                'kode_mk' => $mataKuliah->kode_mk,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        

        // Redirect dengan pesan sukses
        return redirect()->route('matakuliah.index')->with('success', 'Dosen berhasil ditambahkan ke Mata Kuliah.');
    }

    public function storeMk(Request $request)
    {
        // Validasi data request
        $request->validate([
            'kode_mk' => 'required|string|unique:matakuliah,kode_mk', // validasi untuk kode mata kuliah
            'nama_mk' => 'required|string', // validasi untuk nama mata kuliah
            'semester' => 'required|integer|between:1,8', // validasi untuk semester
            'sks' => 'required|integer|between:1,6', // validasi untuk sks
            'deskripsi' => 'nullable|string', // validasi untuk deskripsi
            'status' => 'required|string', // validasi untuk status
        ]);

        $matakuliah = Matakuliah::all();
        if ($matakuliah) {
            $exist = Matakuliah::where('kode_mk', $request->kode_mk)->first();

            if ($exist) {
                return response()->json([
                    'status' => 'error',
                    'message' => "Matakuliah ini sudah ada.",
                ]);
            }

            DB::table('matakuliah')->insert([
                'kode_mk' => $request->kode_mk,
                'nama_mk' => $request->nama_mk,
                'sks' => $request->sks,
                'semester' => $request->semester,
                'status' => $request->status,
                'deskripsi' => $request->deskripsi,
                'created_at' => now(), // Tambahkan jika tabel memiliki timestamps
                'updated_at' => now()  // Tambahkan jika tabel memiliki timestamps
            ]);
            
        }

        return redirect()->back()->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    public function deleteMatakuliah(Request $request)
    {
        // Validasi request
        $request->validate([
            'mata_kuliah_id' => 'required|string|exists:matakuliah,kode_mk',
        ]);

        Matakuliah::where('kode_mk', $request->mata_kuliah_id)->delete();

        return redirect()->back()->with('success', 'Mata Kuliah berhasil dihapus.');
    }
}