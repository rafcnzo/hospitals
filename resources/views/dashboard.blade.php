@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="page-header-content">
                    @php
                        $user = Auth::user();
                        $userName = $user?->name ?? 'User';
                    @endphp
                    <div class="page-title-wrapper">
                        <div class="page-icon">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Dashboard RS</h1>
                            <p class="page-subtitle">Ringkasan operasional rumah sakit hari ini</p>
                        </div>
                    </div>
                    <div class="dashboard-date">
                        Selamat datang, <strong>{{ $userName }}</strong>!
                    </div>
                </div>
            </div>

            <div class="stats-grid stats-grid-4">
                <div class="stat-card stat-primary">
                    <div class="stat-icon"><i class="bi bi-people"></i></div>
                    <div class="stat-info">
                        <h3 class="stat-value">{{ $totalPasien }}</h3>
                        <p class="stat-label">Total Pasien Terdaftar</p>
                        <div class="stat-trend trend-neutral">
                            <i class="bi bi-activity"></i> <span>Total Akumulasi</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card stat-success">
                    <div class="stat-icon"><i class="bi bi-calendar-check"></i></div>
                    <div class="stat-info">
                        <h3 class="stat-value">{{ $jadwalHariIniCount }}</h3>
                        <p class="stat-label">Jadwal Temu Hari Ini</p>
                        <div class="stat-trend trend-neutral">
                            <i class="bi bi-calendar-event"></i> <span>Terjadwal</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card stat-warning">
                    <div class="stat-icon"><i class="bi bi-journal-plus"></i></div>
                    <div class="stat-info">
                        <h3 class="stat-value">{{ $pasienBaruCount }}</h3>
                        <p class="stat-label">Pasien Baru Hari Ini</p>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up"></i> <span>{{ $trendPasien }}</span>
                        </div>
                    </div>
                </div>

                <div class="stat-card stat-info">
                    <div class="stat-icon"><i class="bi bi-person-badge"></i></div>
                    <div class="stat-info">
                        <h3 class="stat-value">{{ $dokterBertugasCount }}</h3>
                        <p class="stat-label">Total Dokter</p>
                        <div class="stat-trend trend-neutral">
                            <span class="text-muted small">Terdaftar</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-lg-8">
                    <div class="data-card">
                        <div class="data-card-header">
                            <div class="data-card-title">
                                <i class="bi bi-clock"></i>
                                <span>Jadwal Temu Hari Ini ({{ \Carbon\Carbon::now()->format('d M Y') }})</span>
                            </div>
                        </div>
                        <div class="data-card-body">
                            <div class="table-responsive">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Pasien (Hewan)</th>
                                            <th>Pemilik</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($jadwalHariIni as $jadwal)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($jadwal->waktu_temu)->format('H:i') }}</td>
                                                <td>{{ $jadwal->pet->nama ?? '-' }}</td>
                                                <td>{{ $jadwal->pet->pemilik->user->name ?? '-' }}</td>
                                                <td>
                                                    @if ($jadwal->status == 'selesai')
                                                        <span class="badge bg-success">Selesai</span>
                                                    @elseif($jadwal->status == 'batal')
                                                        <span class="badge bg-danger">Batal</span>
                                                    @else
                                                        <span class="badge bg-warning">Terjadwal</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Tidak ada jadwal temu hari
                                                    ini.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="data-card">
                        <div class="data-card-header">
                            <div class="data-card-title">
                                <i class="bi bi-person-heart"></i>
                                <span>Pasien Baru Daftar</span>
                            </div>
                        </div>
                        <div class="data-card-body">
                            <ul class="list-group">
                                @forelse($hewanBaru as $hewan)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $hewan->nama }}</strong>
                                            <small
                                                class="d-block text-muted">{{ $hewan->pemilik->user->name ?? 'Anonim' }}</small>
                                        </div>
                                        <span class="badge bg-primary">Baru</span>
                                    </li>
                                @empty
                                    <li class="list-group-item text-muted text-center">Belum ada pasien baru.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-lg-6">
                    <div class="data-card">
                        <div class="data-card-header">
                            <div class="data-card-title">
                                <i class="bi bi-person-rolodex"></i>
                                <span>Detail Hewan Baru</span>
                            </div>
                        </div>
                        <div class="data-card-body">
                            <ul class="list-group">
                                @forelse($hewanBaru as $hewan)
                                    <li class="list-group-item">
                                        <strong>{{ $hewan->rasHewan->jenisHewan->nama_jenis_hewan ?? 'Hewan' }}</strong> -
                                        {{ $hewan->nama }}
                                        (Pemilik: {{ $hewan->pemilik->user->name ?? '-' }})
                                    </li>
                                @empty
                                    <li class="list-group-item text-muted">Belum ada data.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="data-card">
                        <div class="data-card-header">
                            <div class="data-card-title">
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Daftar Dokter</span>
                            </div>
                        </div>
                        <div class="data-card-body">
                            <ul class="list-group">
                                @forelse($dokterList as $dokter)
                                    <li class="list-group-item">
                                        {{ $dokter->name }}
                                        {{-- <span class="text-muted">({{ $dokter->spesialis ?? 'Umum' }})</span> --}}
                                    </li>
                                @empty
                                    <li class="list-group-item text-muted">Belum ada data dokter.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quick-stats-footer mt-3">
                <div class="quick-stat-item">
                    <i class="bi bi-calendar-week"></i>
                    <div class="quick-stat-info">
                        <div class="quick-stat-value">{{ $temuSelesai }}</div>
                        <div class="quick-stat-label">Temu Selesai Hari Ini</div>
                    </div>
                </div>
                <div class="quick-stat-item">
                    <i class="bi bi-calendar2-x"></i>
                    <div class="quick-stat-info">
                        <div class="quick-stat-value">{{ $temuBatal }}</div>
                        <div class="quick-stat-label">Batal/Pindah</div>
                    </div>
                </div>
                <div class="quick-stat-item">
                    <i class="bi bi-journal-medical"></i>
                    <div class="quick-stat-info">
                        <div class="quick-stat-value">{{ $totalPendaftaran }}</div>
                        <div class="quick-stat-label">Total Jadwal Hari Ini</div>
                    </div>
                </div>
                <div class="quick-stat-item">
                    <i class="bi bi-clock"></i>
                    <div class="quick-stat-info">
                        <div class="quick-stat-value">08:00 - 17:00</div>
                        <div class="quick-stat-label">Jam Operasional</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
