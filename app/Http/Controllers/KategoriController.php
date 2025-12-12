<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $title = 'Manajemen Kategori';
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        
        return view('kategori.index', compact('title', 'kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:100'],
        ]);

        $kategori = Kategori::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Kategori berhasil ditambahkan.',
            'data'    => $kategori,
        ]);
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:100'],
        ]);

        $kategori->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Kategori berhasil diperbarui.',
            'data'    => $kategori,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:kategori,idkategori'],
        ]);

        $kategori = Kategori::findOrFail($request->id);
        $kategori->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Kategori berhasil dihapus.',
        ]);
    }
}
