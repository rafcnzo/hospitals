<?php
namespace App\Http\Controllers;

use App\Models\JadwalTemu;
use App\Models\Pet; // Import Model Pet
use Illuminate\Http\Request;

class JadwalTemuController extends Controller
{
    public function index()
    {
        $title = 'Jadwal Temu';

        $jadwalTemu = JadwalTemu::with([
            'pet.pemilik.user',
            'pet.rasHewan.jenisHewan',
        ])
            ->orderBy('waktu_temu', 'desc')
            ->get();

        $pets = Pet::with('pemilik.user')
            ->orderBy('nama', 'asc')
            ->get();

        return view('jadwal-temu.index', compact('title', 'jadwalTemu', 'pets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idpet'      => ['required', 'integer', 'exists:pet,idpet'],
            'waktu_temu' => ['required', 'date'], // Menangani datetime-local input
            'keterangan' => ['required', 'string', 'max:255'],
        ]);

        $jadwal = JadwalTemu::create([
            'idpet'      => $validated['idpet'],
            'waktu_temu' => $validated['waktu_temu'],
            'keterangan' => $validated['keterangan'],
            'status'     => 'terjadwal', // Default
        ]);

        $jadwal->load('pet.pemilik.user', 'pet.rasHewan.jenisHewan');

        return response()->json([
            'status'  => 'success',
            'message' => 'Jadwal temu berhasil dijadwalkan.',
            'data'    => $jadwal,
        ]);
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalTemu::findOrFail($id);

        $validated = $request->validate([
            'idpet'      => ['required', 'integer', 'exists:pet,idpet'],
            'waktu_temu' => ['required', 'date'],
            'keterangan' => ['required', 'string', 'max:255'],
            'status'     => ['required', 'in:terjadwal,selesai,batal'], // Tambah validasi status
        ]);

        $jadwal->update($validated);

        $jadwal->load('pet.pemilik.user', 'pet.rasHewan.jenisHewan');

        return response()->json([
            'status'  => 'success',
            'message' => 'Jadwal temu berhasil diperbarui.',
            'data'    => $jadwal,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:jadwal_temu,idjadwal_temu'],
        ]);

        $jadwal = JadwalTemu::findOrFail($request->id);
        $jadwal->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Jadwal temu berhasil dihapus.',
        ]);
    }

    public function show($id)
    {
        $jadwal                  = JadwalTemu::findOrFail($id);
        $jadwal->formatted_waktu = $jadwal->waktu_temu->format('Y-m-d\TH:i');

        return response()->json([
            'status' => 'success',
            'data'   => $jadwal,
        ]);
    }
}
