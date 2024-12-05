<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Dosen;

class UserSeeder extends Seeder
{
    private function generateCleanEmail($name, $role)
    {
        // Remove special characters, commas, dots, and academic titles
        $cleanName = preg_replace('/[.,]/', '', $name); // Remove dots and commas
        $cleanName = preg_replace('/\b(Dr|Drs|S\.Si|M\.T|S\.Kom|M\.Kom|M\.Sc)\b/i', '', $cleanName); // Remove academic titles
        $cleanName = trim(preg_replace('/\s+/', '', $cleanName)); // Remove spaces

        return strtolower($cleanName) . '@' . strtolower(str_replace(' ', '', $role)) . '.example.com';
    }

    private function calculateGrades($nim)
    {
        // Get all KHS entries for the student
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

        // Group KHS data by semester
        $semesterData = $khsData->groupBy('semester');

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
        $users = [
            // Pembimbing Akademik atau Dosen
            [
                'name' => 'Dr. Aris Puji Widodo, S.Si., M.T.',
                'roles' => ['Pembimbing Akademik'],
                'nip' => '197304011998021001',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Profesor Ngakak MH No. 1'
            ],
            [
                'name' => 'Drs. Eko Adi Sarwoko, M.Komp.',
                'roles' => ['Pembimbing Akademik'],
                'nip' => '196511071992031003',
                'no_hp' => '081234567891',
                'alamat' => 'Jl. Raja Mongolia No. 2'
            ],
            [
                'name' => 'Sandy Kurniawan, S.Kom., M.Kom.',
                'roles' => ['Pembimbing Akademik'],
                'nip' => '198607232019031007',
                'no_hp' => '081234567892',
                'alamat' => 'Jl. Profesor Sudarto SH No. 3'
            ],
            //Dekan
            [
                'name' => 'Don Gogo',
                'roles' => ['Dekan', 'Pembimbing Akademik'],
                'nip' => '198607232019099999',
                'no_hp' => '085555555555',
                'alamat' => 'Jl. Kocak Geming No. 88'
            ],
            // Khusus ahmad douglas
            [
                'name' => 'Ahmad Douglas',
                'roles' => ['Mahasiswa', 'Pembimbing Akademik'],
                'nip' => '199001012020055555',
                'nim' => '24060122199999',
                'semester' => 5,
                'angkatan' => '2024',
                'no_hp' => '081234567896',
                'alamat' => 'Jl. Madasel No. 4',
                'dosen_wali_nip' => '197304011998021001'  // Reference to Dr. Aris's NIP
            ],

            // Bagian Akademik
            [
                'name' => 'Sarah Sriwedari',
                'roles' => ['Bagian Akademik'],
                'nip' => '199001012020066666',
                'no_hp' => '081111111111',
                'alamat' => 'Jl. Banjarsari Selatan No. 5'
            ],
            // Ketua Program Studi
            [
                'name' => 'Cain Chana',
                'roles' => ['Ketua Program Studi'],
                'nip' => '199001012020077777',
                'no_hp' => '082222222222',
                'prodi' => 'Informatika',
                'alamat' => 'Jl. Kaliurang No. 6'
            ],
            // Mahasiswa
            [
                'name' => 'Bintang Syafrian Rizal',
                'roles' => ['Mahasiswa'],
                'nim' => '24060122120031',
                'semester' => 5,
                'prodi' => 'Kimia',
                'angkatan' => '2022',
                'no_hp' => '081234567893',
                'dosen_wali_nip' => '197304011998021001'  // Reference to Dr. Aris's NIP
            ],
            [
                'name' => 'Awang Pratama Putra Mulya',
                'roles' => ['Mahasiswa'],
                'nim' => '24060122120039',
                'semester' => 5,
                'prodi' => 'Fisika',
                'angkatan' => '2022',
                'no_hp' => '08182738291',
                'dosen_wali_nip' => '198607232019031007'  // Reference to Mr. Sandy's NIP
            ],
            [
                'name' => 'Muhammad Mirza Faiz Rabbani',
                'roles' => ['Mahasiswa'],
                'nim' => '24060122140127',
                'semester' => 5,
                'prodi' => 'Biologi',
                'angkatan' => '2022',
                'no_hp' => '081234567894',
                'dosen_wali_nip' => '196511071992031003'  // Reference to Drs. Eko's NIP
            ],
            [
                'name' => 'Hanif Herofa',
                'roles' => ['Mahasiswa'],
                'nim' => '24060122120015',
                'semester' => 5,
                'prodi' => 'Matematika',
                'angkatan' => '2022',
                'no_hp' => '081234567895',
                'dosen_wali_nip' => '198607232019031007'  // Reference to Mr. Sandy's NIP
            ],
            [
                'name' => 'Raka Maulana Yusuf',
                'roles' => ['Mahasiswa'],
                'nim' => '24060122140119',
                'semester' => 5,
                'prodi' => 'Statistika',
                'angkatan' => '2022',
                'no_hp' => '081234567665',
                'dosen_wali_nip' => '198607232019031007'  // Reference to Mr. Sandy's NIP
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => 'temp@example.com',
                'password' => Hash::make('password'),
            ]);

            // Attach roles to user
            $roleIds = Role::whereIn('name', $userData['roles'])->pluck('id');
            $user->roles()->attach($roleIds);

            // Update email based on highest priority role using the new generateCleanEmail method
            $highestRole = $user->getHighestPriorityRole();
            $user->email = $this->generateCleanEmail($user->name, $highestRole->name);
            $user->save();

            // add user berdasarkan roles ke tabel yang sesuai
            foreach ($userData['roles'] as $roleName) {
                switch ($roleName) {
                    case 'Mahasiswa':
                        $dosenWali = Dosen::where('nip', $userData['dosen_wali_nip'])->first();

                        $grades = $this->calculateGrades($userData['nim']);

                        DB::table('mahasiswa')->insert([
                            'user_id' => $user->id,
                            'nama' => $user->name,
                            'nim' => $userData['nim'],
                            'semester' => $userData['semester'],
                            'fakultas' => 'Fakultas Sains dan Matematika',
                            'prodi' => $userData['prodi'],
                            'angkatan' => $userData['angkatan'],
                            'no_hp' => $userData['no_hp'],
                            'IPK' => 0.00,  // Initial value
                            'IPS' => 0.00,  // Initial value
                            'dosen_wali_id' => $dosenWali->id
                        ]);
                        break;

                    case 'Pembimbing Akademik':
                        DB::table('dosen')->insert([
                            'user_id' => $user->id,
                            'nama' => $user->name,
                            'nip' => $userData['nip'],
                            'no_hp' => $userData['no_hp'],
                            'alamat' => $userData['alamat'],
                            'fakultas' => 'Fakultas Sains dan Matematika',
                            'prodi' => 'Informatika',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        break;

                    case 'Ketua Program Studi':
                        DB::table('kaprodi')->insert([
                            'user_id' => $user->id,
                            'nama' => $user->name,
                            'nip' => $userData['nip'],
                            'nama_prodi' => $userData['prodi']
                        ]);
                        break;

                    case 'Dekan':
                        DB::table('dekan')->insert([
                            'user_id' => $user->id,
                            'nama' => $user->name,
                            'nip' => $userData['nip']
                        ]);
                        break;

                    case 'Bagian Akademik':
                        DB::table('bagian_akademik')->insert([
                            'user_id' => $user->id,
                            'nama' => $user->name,
                            'nip' => $userData['nip']
                        ]);
                        break;
                }
            }
        }

        $this->updateAllStudentGrades();
    }

    private function updateAllStudentGrades()
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
