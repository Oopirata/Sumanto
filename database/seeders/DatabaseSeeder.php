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
            DosenSeeder::class,
            IrsSeeder::class,
            JadwalSeeder::class,
            KhsSeeder::class,
            MataKuliahSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            RuanganSeeder::class,
            RoleUserSeeder::class,
        ]);
    }
}
