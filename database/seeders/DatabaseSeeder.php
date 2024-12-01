<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            BuatIrsSeeder::class,
            JadwalSeeder::class,
            MataKuliahSeeder::class,
            RoleSeeder::class,
            RuanganSeeder::class,
            UserSeeder::class,
            DosenMatakuliahSeeder::class,
            IrsSeeder::class,
            KhsSeeder::class,
        ]);
    }
}
