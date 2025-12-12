<?php

namespace App\Http\Controllers;

use App\Models\JenisHewan;
use Illuminate\Http\Request;

class JenisHewanController extends Controller
{
    public function index()
    {
        $title = 'Master Jenis Hewan';
        $jenisHewan = JenisHewan::orderBy('nama_jenis_hewan')->get();
        
        return view('jenis-hewan.index', compact('title', 'jenisHewan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis_hewan' => ['required', 'string', 'max:100'],
        ]);

        $jenisHewan = JenisHewan::create($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Jenis hewan berhasil ditambahkan.',
            'data'    => $jenisHewan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);

        $validated = $request->validate([
            'nama_jenis_hewan' => ['required', 'string', 'max:100'],
        ]);

        $jenisHewan->update($validated);

        return response()->json([
            'status'  => 'success',
            'message' => 'Jenis hewan berhasil diperbarui.',
            'data'    => $jenisHewan,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:jenis_hewan,idjenis_hewan'],
        ]);

        $jenisHewan = JenisHewan::findOrFail($request->id);
        $jenisHewan->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Jenis hewan berhasil dihapus.',
        ]);
    }
}
