<?php
namespace App\Http\Controllers;

use App\Models\JadwalTemu;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\RekamMedis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{

    public function indexProfile()
    {
        $user = Auth::user();

        $pemilik = Pemilik::firstOrCreate(
            ['iduser' => $user->id],
            ['no_wa' => '-', 'alamat' => '-']
        );

        $pets = Pet::with('rasHewan')
            ->where('idpemilik', $pemilik->idpemilik)
            ->orderBy('nama', 'asc')
            ->get();

        return view('pemilik.profile', compact('user', 'pemilik', 'pets'));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'no_wa'  => ['required', 'string', 'max:45'],
            'alamat' => ['required', 'string', 'max:100'],
        ]);

        $user    = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->id)->first();

        if (! $pemilik) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data pemilik tidak ditemukan.',
            ], 404);
        }

        try {
            // update user name
            $user->name = $validated['name'];
            $user->save();

            // update pemilik
            $pemilik->no_wa  = $validated['no_wa'];
            $pemilik->alamat = $validated['alamat'];
            $pemilik->save();

            // pastikan relasi user terload
            $pemilik->load('user');

            return response()->json([
                'status'  => 'success',
                'message' => 'Profil berhasil diperbarui.',
                'data'    => $pemilik,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Gagal memperbarui profil: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function indexJadwalTemu()
    {
        $user = Auth::user();

        $pemilik = Pemilik::where('iduser', $user->id)->first();

        if (! $pemilik) {
            return redirect()->back()->with('error', 'Data pemilik tidak ditemukan.');
        }

        $pets = Pet::where('idpemilik', $pemilik->idpemilik)
            ->orderBy('nama', 'asc')
            ->get();

        $petIds     = $pets->pluck('idpet');
        $jadwalTemu = JadwalTemu::whereIn('idpet', $petIds)
            ->with('pet')
            ->orderBy('waktu_temu', 'desc')
            ->get();

        return view('pemilik.jadwaltemu', compact('user', 'pemilik', 'pets', 'jadwalTemu'));
    }

    public function indexRekamMedis($id)
    {
        $rekamMedis = RekamMedis::with([
            'pet.pemilik.user',                          
            'pet.rasHewan.jenisHewan',                   
            'dokter',                                    
            'details.kodeTindakanTerapi.kategoriKlinis', 
        ])->findOrFail($id);

        $pet = $rekamMedis->pet;

        $tglPeriksa = $rekamMedis->created_at
            ? \Carbon\Carbon::parse($rekamMedis->created_at)->format('d-m-Y')
            : '-';

        $detailsData = $rekamMedis->details->map(function ($detail) {
            $tindakan = $detail->kodeTindakanTerapi;

            return [
                'kode'            => $tindakan?->kode ?? '-',
                'namaTindakan'    => $tindakan?->deskripsi_tindakan_terapi ?? '-',
                'qty'             => $detail->jumlah ?? 1,
                'kategori_klinis' => $tindakan?->kategoriKlinis?->nama_kategori_klinis ?? '-',
            ];
        });

        $data = [
            'rekamMedis'  => $rekamMedis,
            'pet'         => $pet,
            'pemilik'     => $pet?->pemilik,
            'dokter'      => $rekamMedis->dokter, 
            'tglPeriksa'  => $tglPeriksa,
            'detailsData' => $detailsData,

            'namaPet'     => $pet?->nama ?? '-',
            'namaPemilik' => $pet?->pemilik?->user?->name ?? '-',
            'noWa'        => $pet?->pemilik?->no_wa ?? '-',
            'namaDokter'  => $rekamMedis->dokter?->name ?? '-', 
            'diagnosa'    => $rekamMedis->diagnosa,
            'keluhan'     => $rekamMedis->anamnesa,
            'catatan'     => $rekamMedis->temuan_klinis,
        ];

        return view('pemilik.rekammedis', $data);
    }
}
