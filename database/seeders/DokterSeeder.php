<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role dokter sudah ada
        $dokterRole = Role::where('nama_role', 'dokter')->first();
        
        if (!$dokterRole) {
            echo "Role dokter belum ada. Jalankan RoleSeeder terlebih dahulu.\n";
            return;
        }

        $dokters = [
            [
                'name' => 'Dr. Agus Veteriner',
                'email' => 'dokter1@hospital.com',
                'password' => Hash::make('dokter123'),
            ],
            [
                'name' => 'Dr. Siti Hewan',
                'email' => 'dokter2@hospital.com',
                'password' => Hash::make('dokter123'),
            ],
            [
                'name' => 'Dr. Budi Pratama',
                'email' => 'dokter3@hospital.com',
                'password' => Hash::make('dokter123'),
            ],
        ];

        foreach ($dokters as $dokterData) {
            $dokter = User::firstOrCreate(
                ['email' => $dokterData['email']],
                $dokterData
            );
            
            if (!$dokter->hasRole('dokter')) {
                $dokter->assignRole('dokter');
            }
        }

        echo "Dokter users created successfully!\n";
        echo "Password untuk semua dokter: dokter123\n";
    }
}
