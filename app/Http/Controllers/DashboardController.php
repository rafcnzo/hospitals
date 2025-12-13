<?php
namespace App\Http\Controllers;

use App\Models\JadwalTemu;
use App\Models\Pet;
use App\Models\User;
use Carbon\Carbon; // Asumsi 'Pasien' adalah Pet

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $totalPasien = Pet::count();
        $pasienKemarin = Pet::whereDate('created_at', Carbon::yesterday())->count();
        $pasienHariIni = Pet::whereDate('created_at', $today)->count();
        $trendPasien   = $pasienHariIni > 0 ? "+{$pasienHariIni} hari ini" : "Stabil";

        $jadwalHariIniCount = JadwalTemu::whereDate('waktu_temu', $today)->count();

        $pasienBaruCount = $pasienHariIni; // Sama dengan perhitungan di atas

        $dokterBertugasCount = User::role('dokter')->count();

        $jadwalHariIni = JadwalTemu::with(['pet.pemilik.user', 'pet']) // Load relasi biar hemat query
            ->whereDate('waktu_temu', $today)
            ->orderBy('waktu_temu', 'asc')
            ->take(5)
            ->get();

        $hewanBaru = Pet::with('pemilik.user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $dokterList = User::role('dokter')->get();

        $temuSelesai      = JadwalTemu::whereDate('waktu_temu', $today)->where('status', 'selesai')->count();
        $temuBatal        = JadwalTemu::whereDate('waktu_temu', $today)->where('status', 'batal')->count();
        $totalPendaftaran = $jadwalHariIniCount; // Asumsi pendaftaran = jadwal temu

        return view('dashboard', compact(
            'totalPasien', 'trendPasien',
            'jadwalHariIniCount', 'pasienBaruCount', 'dokterBertugasCount',
            'jadwalHariIni', 'hewanBaru', 'dokterList',
            'temuSelesai', 'temuBatal', 'totalPendaftaran'
        ));
    }
}
