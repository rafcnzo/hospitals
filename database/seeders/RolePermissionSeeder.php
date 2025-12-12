<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | DEFINISI PERMISSIONS
        |--------------------------------------------------------------------------
        */

        $permissions = [
            'view dashboard',
            'manage users',
            'manage patients',
            'manage medicines',
            'manage procurement',
            'manage reports',
            'manage kategori',
            'manage kategori klinis',
            'manage kode tindakan terapi',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        /*
        |--------------------------------------------------------------------------
        | DEFINISI ROLES & ASSIGN PERMISSIONS
        |--------------------------------------------------------------------------
        */

        // 1. ADMIN — semua akses
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        // 2. DOKTER — dashboard, pasien, laporan
        $doctor = Role::firstOrCreate(['name' => 'dokter']);
        $doctor->syncPermissions([
            'view dashboard',
            'manage patients',
            'manage reports',
        ]);

        // 3. PERAWAT — dashboard, pasien, obat
        $perawat = Role::firstOrCreate(['name' => 'perawat']);
        $perawat->syncPermissions([
            'view dashboard',
            'manage patients',
            'manage medicines',
        ]);

        // 4. PEMILIK (Owner) — hanya dashboard & laporan
        $owner = Role::firstOrCreate(['name' => 'pemilik']);
        $owner->syncPermissions([
            'view dashboard',
            'manage reports',
        ]);

        echo "Roles & permissions berhasil dibuat!\n";
    }
}
