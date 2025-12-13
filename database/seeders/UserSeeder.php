<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role; // Pastikan import Model Role Anda

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);

        $user = User::updateOrCreate(
            ['id' => 2], // KUNCI PENCARIAN: Cari ID 2
            [
                'name' => 'Muhammad Rafi Afriza',
                'email' => 'emrafiafriza@gmail.com', // Email dipindah ke sini (data yang diupdate)
                'password' => '$2y$12$aNsLR27R1lmMwIReqT.Ab.Kc/wj/Nxt/avZZVccTDcDeyqIKQQKwK',
                'email_verified_at' => null,
            ]
        );

        $user->syncRoles([$roleAdmin]); // Gunakan syncRoles biar lebih rapi
        
        $this->command->info("User {$user->name} (ID: 2) berhasil disync dengan role admin!");
    }
}