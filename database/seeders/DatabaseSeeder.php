<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ADMIN
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@perpus.com',
            'nisn' => '0000000001',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
    
        // MURID
        User::factory()->create([
            'name' => 'Murid Satu',
            'email' => 'murid@perpus.com',
            'nisn' => '0000000002',
            'password' => bcrypt('murid123'),
            'role' => 'murid',
        ]);
    }
}
