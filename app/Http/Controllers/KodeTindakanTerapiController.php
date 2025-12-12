<?php

namespace App\Http\Controllers;

use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $title = 'Manajemen Kode Tindakan Terapi';
        $kodeTindakanTerapis = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])
            ->orderBy('kode')
            ->get();
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $kategoriKlinis = KategoriKlinis::orderBy('nama_kategori_klinis')->get();
        
        return view('kode-tindakan-terapi.index', compact('title', 'kodeTindakanTerapis', 'kategoris', 'kategoriKlinis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:5'],
            'deskripsi_tindakan_terapi' => ['required', 'string', 'max:1000'],
            'idkategori' => ['required', 'integer', 'exists:kategori,idkategori'],
            'idkategori_klinis' => ['required', 'integer', 'exists:kategori_klinis,idkategori_klinis'],
        ]);

        $kodeTindakanTerapi = KodeTindakanTerapi::create($validated);
        $kodeTindakanTerapi->load(['kategori', 'kategoriKlinis']);

        return response()->json([
            'status'  => 'success',
            'message' => 'Kode Tindakan Terapi berhasil ditambahkan.',
            'data'    => $kodeTindakanTerapi,
        ]);
    }

    public function update(Request $request, $id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);

        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:5'],
            'deskripsi_tindakan_terapi' => ['required', 'string', 'max:1000'],
            'idkategori' => ['required', 'integer', 'exists:kategori,idkategori'],
            'idkategori_klinis' => ['required', 'integer', 'exists:kategori_klinis,idkategori_klinis'],
        ]);

        $kodeTindakanTerapi->update($validated);
        $kodeTindakanTerapi->load(['kategori', 'kategoriKlinis']);

        return response()->json([
            'status'  => 'success',
            'message' => 'Kode Tindakan Terapi berhasil diperbarui.',
            'data'    => $kodeTindakanTerapi,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:kode_tindakan_terapi,idkode_tindakan_terapi'],
        ]);

        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($request->id);
        $kodeTindakanTerapi->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Kode Tindakan Terapi berhasil dihapus.',
        ]);
    }
}
