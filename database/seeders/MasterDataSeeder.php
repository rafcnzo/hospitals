<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use App\Models\Pemilik;
use App\Models\Pet;
use Illuminate\Support\Facades\Hash;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat beberapa jenis hewan
        $jenisAnjing = JenisHewan::create([
            'nama_jenis_hewan' => 'Anjing'
        ]);
        
        $jenisKucing = JenisHewan::create([
            'nama_jenis_hewan' => 'Kucing'
        ]);
        
        $jenisKelinci = JenisHewan::create([
            'nama_jenis_hewan' => 'Kelinci'
        ]);

        // Membuat beberapa ras hewan
        // Ras Anjing
        RasHewan::create([
            'nama_ras' => 'Golden Retriever',
            'idjenis_hewan' => $jenisAnjing->idjenis_hewan
        ]);
        
        RasHewan::create([
            'nama_ras' => 'Bulldog',
            'idjenis_hewan' => $jenisAnjing->idjenis_hewan
        ]);
        
        RasHewan::create([
            'nama_ras' => 'German Shepherd',
            'idjenis_hewan' => $jenisAnjing->idjenis_hewan
        ]);

        // Ras Kucing
        $persianCat = RasHewan::create([
            'nama_ras' => 'Persian',
            'idjenis_hewan' => $jenisKucing->idjenis_hewan
        ]);
        
        $angoraCat = RasHewan::create([
            'nama_ras' => 'Anggora',
            'idjenis_hewan' => $jenisKucing->idjenis_hewan
        ]);
        
        RasHewan::create([
            'nama_ras' => 'Maine Coon',
            'idjenis_hewan' => $jenisKucing->idjenis_hewan
        ]);

        // Ras Kelinci
        $hollandLop = RasHewan::create([
            'nama_ras' => 'Holland Lop',
            'idjenis_hewan' => $jenisKelinci->idjenis_hewan
        ]);
        
        RasHewan::create([
            'nama_ras' => 'Flemish Giant',
            'idjenis_hewan' => $jenisKelinci->idjenis_hewan
        ]);

        // Membuat beberapa user pemilik
        $user1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => Hash::make('password123')
        ]);

        $user2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'password' => Hash::make('password123')
        ]);

        $user3 = User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad@example.com',
            'password' => Hash::make('password123')
        ]);

        // Membuat pemilik
        $pemilik1 = Pemilik::create([
            'no_wa' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'iduser' => $user1->id
        ]);

        $pemilik2 = Pemilik::create([
            'no_wa' => '081298765432',
            'alamat' => 'Jl. Sudirman No. 45, Bandung',
            'iduser' => $user2->id
        ]);

        $pemilik3 = Pemilik::create([
            'no_wa' => '081345678901',
            'alamat' => 'Jl. Ahmad Yani No. 78, Surabaya',
            'iduser' => $user3->id
        ]);

        // Membuat beberapa pet
        Pet::create([
            'nama' => 'Milo',
            'tanggal_lahir' => '2022-03-15',
            'warna_tanda' => 'Putih belang coklat',
            'jenis_kelamin' => 'L',
            'idpemilik' => $pemilik1->idpemilik,
            'idras_hewan' => $persianCat->idras_hewan
        ]);

        Pet::create([
            'nama' => 'Luna',
            'tanggal_lahir' => '2023-01-20',
            'warna_tanda' => 'Abu-abu kehitaman',
            'jenis_kelamin' => 'P',
            'idpemilik' => $pemilik2->idpemilik,
            'idras_hewan' => $angoraCat->idras_hewan
        ]);

        Pet::create([
            'nama' => 'Snowy',
            'tanggal_lahir' => '2023-06-10',
            'warna_tanda' => 'Putih seluruh tubuh',
            'jenis_kelamin' => 'P',
            'idpemilik' => $pemilik3->idpemilik,
            'idras_hewan' => $hollandLop->idras_hewan
        ]);
    }
}
