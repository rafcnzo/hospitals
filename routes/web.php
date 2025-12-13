<?php

use App\Http\Controllers\JadwalTemuController;
use App\Http\Controllers\JenisHewanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriKlinisController;
use App\Http\Controllers\KodeTindakanTerapiController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RasHewanController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('guestOrPemilik');

Route::middleware(['auth', 'role:admin'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users', [UserController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
        Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
        Route::put('/roles/{id}', [RoleController::class, 'update'])->name('admin.roles.update');
        Route::delete('/roles', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
        Route::get('/roles/{id}', [RoleController::class, 'edit'])->name('admin.roles.edit');

        Route::post('/permissions', [PermissionController::class, 'store'])->name('admin.permissions.store');
        Route::get('/permissions/{id}', [PermissionController::class, 'show']);
        Route::put('/permissions/{id}', [PermissionController::class, 'update']);
        Route::delete('/permissions', [PermissionController::class, 'destroy'])->name('admin.permissions.destroy');

        // Kategori
        Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
        Route::delete('/kategori', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');

        // Kategori Klinis
        Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');
        Route::post('/kategori-klinis', [KategoriKlinisController::class, 'store'])->name('admin.kategori-klinis.store');
        Route::put('/kategori-klinis/{id}', [KategoriKlinisController::class, 'update'])->name('admin.kategori-klinis.update');
        Route::delete('/kategori-klinis', [KategoriKlinisController::class, 'destroy'])->name('admin.kategori-klinis.destroy');

        // Kode Tindakan Terapi
        Route::get('/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'index'])->name('admin.kode-tindakan-terapi.index');
        Route::post('/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'store'])->name('admin.kode-tindakan-terapi.store');
        Route::put('/kode-tindakan-terapi/{id}', [KodeTindakanTerapiController::class, 'update'])->name('admin.kode-tindakan-terapi.update');
        Route::delete('/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'destroy'])->name('admin.kode-tindakan-terapi.destroy');

        // Jenis Hewan
        Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');
        Route::post('/jenis-hewan', [JenisHewanController::class, 'store'])->name('admin.jenis-hewan.store');
        Route::put('/jenis-hewan/{id}', [JenisHewanController::class, 'update'])->name('admin.jenis-hewan.update');
        Route::delete('/jenis-hewan', [JenisHewanController::class, 'destroy'])->name('admin.jenis-hewan.destroy');

        // Ras Hewan
        Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('admin.ras-hewan.index');
        Route::post('/ras-hewan', [RasHewanController::class, 'store'])->name('admin.ras-hewan.store');
        Route::put('/ras-hewan/{id}', [RasHewanController::class, 'update'])->name('admin.ras-hewan.update');
        Route::delete('/ras-hewan', [RasHewanController::class, 'destroy'])->name('admin.ras-hewan.destroy');
    });

    // Group untuk admin & resepsionis: full akses
    Route::middleware(['role:admin|resepsionis'])->group(function () {
        Route::post('/pemilik', [PemilikController::class, 'store'])->name('admin.pemilik.store');
        Route::put('/pemilik/{id}', [PemilikController::class, 'update'])->name('admin.pemilik.update');
        Route::delete('/pemilik', [PemilikController::class, 'destroy'])->name('admin.pemilik.destroy');

        Route::post('/pet', [PetController::class, 'store'])->name('admin.pet.store');
        Route::put('/pet/{id}', [PetController::class, 'update'])->name('admin.pet.update');
        Route::delete('/pet', [PetController::class, 'destroy'])->name('admin.pet.destroy');
    });

    // Group untuk dokter & perawat: hanya GET
    Route::middleware(['role:dokter|perawat|resepsionis|admin'])->group(function () {
        Route::get('/pemilik', [PemilikController::class, 'index'])->name('admin.pemilik.index');
        Route::get('/pet', [PetController::class, 'index'])->name('admin.pet.index');
    });

});

Route::middleware(['auth', 'role:dokter|admin'])->prefix('dokter')->group(function () {
    // Rekam Medis
    Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('dokter.rekam-medis.index');
    Route::post('/rekam-medis', [RekamMedisController::class, 'store'])->name('dokter.rekam-medis.store');
    Route::get('/rekam-medis/{id}', [RekamMedisController::class, 'show'])->name('dokter.rekam-medis.show');
    Route::put('/rekam-medis/{id}', [RekamMedisController::class, 'update'])->name('dokter.rekam-medis.update');
    Route::delete('/rekam-medis', [RekamMedisController::class, 'destroy'])->name('dokter.rekam-medis.destroy');
});

// Grup Route Resepsionis (Prefix: /resepsionis)
Route::middleware(['auth'])->prefix('resepsionis')->group(function () {

    // 1. Route yang bisa diakses Resepsionis DAN Dokter (GET only)
    Route::middleware(['role:resepsionis|dokter|admin'])->group(function () {
        Route::get('/jadwal-temu', [JadwalTemuController::class, 'index'])->name('resepsionis.jadwal-temu.index');
        Route::get('/jadwal-temu/{id}/show', [JadwalTemuController::class, 'show'])->name('resepsionis.jadwal-temu.show');
    });

    // 2. Route yang HANYA bisa diakses Resepsionis (Full Akses: POST, PUT, DELETE)
    Route::middleware(['role:resepsionis|admin'])->group(function () {
        Route::post('/jadwal-temu', [JadwalTemuController::class, 'store'])->name('resepsionis.jadwal-temu.store');
        Route::put('/jadwal-temu/{id}', [JadwalTemuController::class, 'update'])->name('resepsionis.jadwal-temu.update');
        Route::delete('/jadwal-temu', [JadwalTemuController::class, 'destroy'])->name('resepsionis.jadwal-temu.destroy');
    });

});

Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->group(function () {
    Route::get('profile', [OwnerController::class, 'indexProfile'])->name('pemilik.profile.index');
    Route::post('profile/update', [OwnerController::class, 'updateProfile'])->name('pemilik.profile.update');

    Route::get('/schedule', [OwnerController::class, 'indexJadwalTemu'])->name('pemilik.jadwal-temu.index');
    Route::get('/rekam-medis/{id}', [OwnerController::class, 'indexRekamMedis'])->name('pemilik.rekam-medis.index');
});

require __DIR__ . '/auth.php';
