@extends('layouts.app')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="page-header-content">
                    @php
                        use Illuminate\Support\Facades\Auth;
                        $user = Auth::user();
                        $userName = $user?->name ?? 'User';
                    @endphp
                    <div class="page-title-wrapper">
                        <div class="page-icon">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Dashboard RS</h1>
                            <p class="page-subtitle">Ringkasan jadwal temu, pendaftaran, dan pelayanan dokter</p>
                        </div>
                    </div>
                    <div class="dashboard-date">
                        Selamat datang, <strong>{{ $userName }}</strong>!
                    </div>
                </div>
            </div>

            <div class="stats-grid stats-grid-4">
                <div class="stat-card stat-primary">
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-value">120</h3>
                        <p class="stat-label">Total Pasien Hari Ini</p>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up"></i>
                            <span>
                                +10% dari kemarin
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stat-card stat-success">
                    <div class="stat-icon">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-value">38</h3>
                        <p class="stat-label">Jadwal Temu Hari Ini</p>
                        <div class="stat-trend trend-neutral">
                            <i class="bi bi-calendar-event"></i>
                            <span>
                                Terjadwal
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stat-card stat-warning">
                    <div class="stat-icon">
                        <i class="bi bi-journal-plus"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-value">18</h3>
                        <p class="stat-label">Pasien Baru Daftar</p>
                        <div class="stat-trend trend-up">
                            <i class="bi bi-arrow-up"></i>
                            <span>
                                +3 hari ini
                            </span>
                        </div>
                    </div>
                </div>
                <div class="stat-card stat-info">
                    <div class="stat-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-value">9</h3>
                        <p class="stat-label">Dokter Bertugas</p>
                        <div class="stat-trend trend-neutral">
                            <span class="text-muted small">Di poliklinik</span>
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
                                <span>Jadwal Temu Hari Ini</span>
                            </div>
                        </div>
                        <div class="data-card-body">
                            <div class="table-responsive">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Pasien</th>
                                            <th>Dokter</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>08:00</td>
                                            <td>Ahmad Setiawan</td>
                                            <td>dr. Nia</td>
                                            <td><span class="badge bg-success">Selesai</span></td>
                                        </tr>
                                        <tr>
                                            <td>09:30</td>
                                            <td>Budi Santoso</td>
                                            <td>dr. Remy</td>
                                            <td><span class="badge bg-warning">Menunggu</span></td>
                                        </tr>
                                        <tr>
                                            <td>10:45</td>
                                            <td>Siti Aisyah</td>
                                            <td>dr. Lina</td>
                                            <td><span class="badge bg-info">Berlangsung</span></td>
                                        </tr>
                                        <tr>
                                            <td>11:15</td>
                                            <td>Wahyu Pratama</td>
                                            <td>dr. Remy</td>
                                            <td><span class="badge bg-warning">Menunggu</span></td>
                                        </tr>
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
                                <span>Daftar Pasien Baru</span>
                            </div>
                        </div>
                        <div class="data-card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Rina Oktaviani
                                    <span class="badge bg-primary">Terdaftar</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Yoga Prasetyawan
                                    <span class="badge bg-primary">Terdaftar</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Desi Intan
                                    <span class="badge bg-primary">Terdaftar</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Joko Mulyadi
                                    <span class="badge bg-primary">Terdaftar</span>
                                </li>
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
                                <span>Hewan Baru Terdaftar</span>
                            </div>
                        </div>
                        <div class="data-card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <strong>Kucing</strong> - Mmii (Pemilik: Rina Oktaviani)
                                </li>
                                <li class="list-group-item">
                                    <strong>Anjing</strong> - Brownie (Pemilik: Yoga Prasetyawan)
                                </li>
                                <li class="list-group-item">
                                    <strong>Kelinci</strong> - Snow (Pemilik: Desi Intan)
                                </li>
                                <li class="list-group-item">
                                    <strong>Kucing</strong> - Miko (Pemilik: Joko Mulyadi)
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="data-card">
                        <div class="data-card-header">
                            <div class="data-card-title">
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Dokter Bertugas Hari Ini</span>
                            </div>
                        </div>
                        <div class="data-card-body">
                            <ul class="list-group">
                                <li class="list-group-item">dr. Remy (Poli Umum)</li>
                                <li class="list-group-item">dr. Nia (Poli Anak)</li>
                                <li class="list-group-item">dr. Lina (Poli Bedah)</li>
                                <li class="list-group-item">dr. Yosep (Poli Saraf)</li>
                                <li class="list-group-item">dr. Sinta (Poli Gigi)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quick-stats-footer mt-3">
                <div class="quick-stat-item">
                    <i class="bi bi-calendar-week"></i>
                    <div class="quick-stat-info">
                        <div class="quick-stat-value">
                            16
                        </div>
                        <div class="quick-stat-label">Temu Selesai Hari Ini</div>
                    </div>
                </div>
                <div class="quick-stat-item">
                    <i class="bi bi-calendar2-x"></i>
                    <div class="quick-stat-info">
                        <div class="quick-stat-value">2</div>
                        <div class="quick-stat-label">Batal/Pindah Jadwal</div>
                    </div>
                </div>
                <div class="quick-stat-item">
                    <i class="bi bi-journal-medical"></i>
                    <div class="quick-stat-info">
                        <div class="quick-stat-value">74</div>
                        <div class="quick-stat-label">Pendaftaran Hari Ini</div>
                    </div>
                </div>
                <div class="quick-stat-item">
                    <i class="bi bi-clock"></i>
                    <div class="quick-stat-info">
                        <div class="quick-stat-value">14:00 - 16:00</div>
                        <div class="quick-stat-label">Jam Sibuk</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>

    </script>
@endpush
