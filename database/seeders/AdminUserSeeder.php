<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role sudah ada
        $this->call(RoleSeeder::class);
        
        // Buat user admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@hospital.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
            ]
        );
        
        // Assign role admin ke user
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }
        
        echo "Admin user created successfully!\n";
        echo "Email: admin@hospital.com\n";
        echo "Password: admin123\n";
    }
}
