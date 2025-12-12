<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', ['title' => 'Dashboard Operasional']);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('admin')->group(function () {
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
    Route::get('/kategori', [\App\Http\Controllers\KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::post('/kategori', [\App\Http\Controllers\KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::put('/kategori/{id}', [\App\Http\Controllers\KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/kategori', [\App\Http\Controllers\KategoriController::class, 'destroy'])->name('admin.kategori.destroy');
    
    // Kategori Klinis
    Route::get('/kategori-klinis', [\App\Http\Controllers\KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');
    Route::post('/kategori-klinis', [\App\Http\Controllers\KategoriKlinisController::class, 'store'])->name('admin.kategori-klinis.store');
    Route::put('/kategori-klinis/{id}', [\App\Http\Controllers\KategoriKlinisController::class, 'update'])->name('admin.kategori-klinis.update');
    Route::delete('/kategori-klinis', [\App\Http\Controllers\KategoriKlinisController::class, 'destroy'])->name('admin.kategori-klinis.destroy');
    
    // Kode Tindakan Terapi
    Route::get('/kode-tindakan-terapi', [\App\Http\Controllers\KodeTindakanTerapiController::class, 'index'])->name('admin.kode-tindakan-terapi.index');
    Route::post('/kode-tindakan-terapi', [\App\Http\Controllers\KodeTindakanTerapiController::class, 'store'])->name('admin.kode-tindakan-terapi.store');
    Route::put('/kode-tindakan-terapi/{id}', [\App\Http\Controllers\KodeTindakanTerapiController::class, 'update'])->name('admin.kode-tindakan-terapi.update');
    Route::delete('/kode-tindakan-terapi', [\App\Http\Controllers\KodeTindakanTerapiController::class, 'destroy'])->name('admin.kode-tindakan-terapi.destroy');
});



require __DIR__.'/auth.php';
