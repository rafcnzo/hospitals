<?php

namespace App\Http\Controllers;

use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;

class RasHewanController extends Controller
{
    public function index()
    {
        $title = 'Master Ras Hewan';
        $rasHewan = RasHewan::with('jenisHewan')->orderBy('nama_ras')->get();
        $jenisHewan = JenisHewan::orderBy('nama_jenis_hewan')->get();
        
        return view('ras-hewan.index', compact('title', 'rasHewan', 'jenisHewan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ras' => ['required', 'string', 'max:100'],
            'idjenis_hewan' => ['required', 'integer', 'exists:jenis_hewan,idjenis_hewan'],
        ]);

        $rasHewan = RasHewan::create($validated);
        $rasHewan->load('jenisHewan');

        return response()->json([
            'status'  => 'success',
            'message' => 'Ras hewan berhasil ditambahkan.',
            'data'    => $rasHewan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $rasHewan = RasHewan::findOrFail($id);

        $validated = $request->validate([
            'nama_ras' => ['required', 'string', 'max:100'],
            'idjenis_hewan' => ['required', 'integer', 'exists:jenis_hewan,idjenis_hewan'],
        ]);

        $rasHewan->update($validated);
        $rasHewan->load('jenisHewan');

        return response()->json([
            'status'  => 'success',
            'message' => 'Ras hewan berhasil diperbarui.',
            'data'    => $rasHewan,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:ras_hewan,idras_hewan'],
        ]);

        $rasHewan = RasHewan::findOrFail($request->id);
        $rasHewan->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Ras hewan berhasil dihapus.',
        ]);
    }
}
