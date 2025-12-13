<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\Pet;
use App\Models\KodeTindakanTerapi;
use App\Models\User;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        $title = 'Manajemen Rekam Medis';
        $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'pet.rasHewan.jenisHewan', 'dokter', 'details.kodeTindakanTerapi'])
            ->orderBy('created_at', 'desc')
            ->get();
        $pets = Pet::with(['pemilik.user', 'rasHewan'])->orderBy('nama')->get();
        $kodeTindakanTerapis = KodeTindakanTerapi::orderBy('kode')->get();
        $dokters = User::whereHas('roles', function($query) {
            $query->where('name', 'dokter');
        })->orderBy('name')->get();
        
        return view('rekam-medis.index', compact('title', 'rekamMedis', 'pets', 'kodeTindakanTerapis', 'dokters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'anamnesa' => ['required', 'string', 'max:1000'],
            'temuan_klinis' => ['required', 'string', 'max:1000'],
            'diagnosa' => ['required', 'string', 'max:1000'],
            'idpet' => ['required', 'integer', 'exists:pet,idpet'],
            'dokter_pemeriksa' => ['required', 'integer', 'exists:users,id'],
            'details' => ['required', 'array', 'min:1'],
            'details.*.idkode_tindakan_terapi' => ['required', 'integer', 'exists:kode_tindakan_terapi,idkode_tindakan_terapi'],
            'details.*.detail' => ['required', 'string', 'max:1000'],
        ]);

        $rekamMedis = RekamMedis::create([
            'anamnesa' => $validated['anamnesa'],
            'temuan_klinis' => $validated['temuan_klinis'],
            'diagnosa' => $validated['diagnosa'],
            'idpet' => $validated['idpet'],
            'dokter_pemeriksa' => $validated['dokter_pemeriksa'],
        ]);

        foreach ($validated['details'] as $detail) {
            DetailRekamMedis::create([
                'idrekam_medis' => $rekamMedis->idrekam_medis,
                'idkode_tindakan_terapi' => $detail['idkode_tindakan_terapi'],
                'detail' => $detail['detail'],
            ]);
        }

        $rekamMedis->load(['pet', 'dokter', 'details.kodeTindakanTerapi']);

        return response()->json([
            'status'  => 'success',
            'message' => 'Rekam medis berhasil ditambahkan.',
            'data'    => $rekamMedis,
        ]);
    }

    public function show($id)
    {
        $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'pet.rasHewan.jenisHewan', 'dokter', 'details.kodeTindakanTerapi'])
            ->findOrFail($id);

        return response()->json([
            'status'  => 'success',
            'data'    => $rekamMedis,
        ]);
    }

    public function update(Request $request, $id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);

        $validated = $request->validate([
            'anamnesa' => ['required', 'string', 'max:1000'],
            'temuan_klinis' => ['required', 'string', 'max:1000'],
            'diagnosa' => ['required', 'string', 'max:1000'],
            'idpet' => ['required', 'integer', 'exists:pet,idpet'],
            'dokter_pemeriksa' => ['required', 'integer', 'exists:users,id'],
            'details' => ['required', 'array', 'min:1'],
            'details.*.idkode_tindakan_terapi' => ['required', 'integer', 'exists:kode_tindakan_terapi,idkode_tindakan_terapi'],
            'details.*.detail' => ['required', 'string', 'max:1000'],
        ]);

        $rekamMedis->update([
            'anamnesa' => $validated['anamnesa'],
            'temuan_klinis' => $validated['temuan_klinis'],
            'diagnosa' => $validated['diagnosa'],
            'idpet' => $validated['idpet'],
            'dokter_pemeriksa' => $validated['dokter_pemeriksa'],
        ]);

        // Hapus detail lama dan buat yang baru
        $rekamMedis->details()->delete();
        
        foreach ($validated['details'] as $detail) {
            DetailRekamMedis::create([
                'idrekam_medis' => $rekamMedis->idrekam_medis,
                'idkode_tindakan_terapi' => $detail['idkode_tindakan_terapi'],
                'detail' => $detail['detail'],
            ]);
        }

        $rekamMedis->load(['pet', 'dokter', 'details.kodeTindakanTerapi']);

        return response()->json([
            'status'  => 'success',
            'message' => 'Rekam medis berhasil diperbarui.',
            'data'    => $rekamMedis,
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:rekam_medis,idrekam_medis'],
        ]);

        $rekamMedis = RekamMedis::findOrFail($request->id);
        $rekamMedis->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Rekam medis berhasil dihapus.',
        ]);
    }
}
