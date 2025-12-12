<?php

namespace App\Http\Controllers;

use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $title = 'Manajemen Kategori Klinis';
        $kategoriKlinis = KategoriKlinis::orderBy('nama_kategori_klinis')->get();
        
        return view('kategori-klinis.index', compact('title', 'kategoriKlinis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori_klinis' => ['required', 'string', 'max:50'],
        ]);

        $kategoriKlinis = KategoriKlinis::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Kategori Klinis berhasil ditambahkan.',
            'data'    => $kategoriKlinis,
        ]);
    }

    public function update(Request $request, $id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori_klinis' => ['required', 'string', 'max:50'],
        ]);

        $kategoriKlinis->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Kategori Klinis berhasil diperbarui.',
            'data'    => $kategoriKlinis,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:kategori_klinis,idkategori_klinis'],
        ]);

        $kategoriKlinis = KategoriKlinis::findOrFail($request->id);
        $kategoriKlinis->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Kategori Klinis berhasil dihapus.',
        ]);
    }
}
