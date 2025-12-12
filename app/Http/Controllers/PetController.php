<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $title = 'Master Pet';
        $pets = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])
                    ->orderBy('created_at', 'desc')
                    ->get();
        $pemilik = Pemilik::with('user')->orderBy('created_at', 'desc')->get();
        $rasHewan = RasHewan::with('jenisHewan')->orderBy('nama_ras')->get();
        
        return view('pet.index', compact('title', 'pets', 'pemilik', 'rasHewan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date'],
            'warna_tanda' => ['required', 'string', 'max:45'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'idpemilik' => ['required', 'integer', 'exists:pemilik,idpemilik'],
            'idras_hewan' => ['required', 'integer', 'exists:ras_hewan,idras_hewan'],
        ]);

        $pet = Pet::create($validated);
        $pet->load(['pemilik.user', 'rasHewan.jenisHewan']);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pet berhasil ditambahkan.',
            'data'    => $pet,
        ]);
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'tanggal_lahir' => ['required', 'date'],
            'warna_tanda' => ['required', 'string', 'max:45'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'idpemilik' => ['required', 'integer', 'exists:pemilik,idpemilik'],
            'idras_hewan' => ['required', 'integer', 'exists:ras_hewan,idras_hewan'],
        ]);

        $pet->update($validated);
        $pet->load(['pemilik.user', 'rasHewan.jenisHewan']);

        return response()->json([
            'status'  => 'success',
            'message' => 'Pet berhasil diperbarui.',
            'data'    => $pet,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:pet,idpet'],
        ]);

        $pet = Pet::findOrFail($request->id);
        $pet->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Pet berhasil dihapus.',
        ]);
    }
}
