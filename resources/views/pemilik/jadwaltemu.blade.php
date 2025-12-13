<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Ratatouille Hospital - Jadwal Temu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap-5.0.0-beta1.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/lindy-uikit.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* --- (CSS kamu tetap) --- */
        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .12);
            border-radius: 12px;
            padding: .5rem 0;
            min-width: 240px;
            margin-top: .5rem !important
        }

        .dropdown-item {
            padding: .7rem 1.25rem;
            transition: all .2s ease;
            display: flex;
            align-items: center;
            font-size: .95rem;
            color: #495057
        }

        .dropdown-item i {
            width: 20px;
            margin-right: 12px;
            font-size: 1rem
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #0d6efd;
            padding-left: 1.5rem
        }

        .dropdown-item.text-danger:hover {
            background-color: #fff5f5;
            color: #dc3545
        }

        .dropdown-divider {
            margin: .5rem 0;
            opacity: .1
        }

        .user-badge {
            display: flex;
            align-items: center;
            padding: .4rem .8rem;
            background-color: transparent;
            border: 1px solid #2F80ED;
            border-radius: 50px;
            cursor: pointer;
            transition: all .3s ease;
            min-height: 48px
        }

        .user-badge:hover {
            background-color: rgba(0, 0, 0, .03);
            border-color: rgba(0, 0, 0, .12);
            transform: translateY(-1px)
        }

        .navbar.scrolled .user-badge {
            border-color: rgba(0, 0, 0, .1)
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2F80ED 0%, #56CCF2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: .9rem;
            margin-right: 10px;
            flex-shrink: 0
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-right: 8px;
            line-height: 1.3
        }

        .user-name {
            font-weight: 600;
            font-size: .9rem;
            color: #212529
        }

        .user-role {
            font-size: .75rem;
            color: #6c757d;
            margin-top: 1px
        }

        .user-badge .fas.fa-chevron-down {
            font-size: .75rem;
            color: #6c757d;
            margin-left: 4px;
            transition: transform .3s ease
        }

        .user-badge[aria-expanded="true"] .fas.fa-chevron-down {
            transform: rotate(180deg)
        }

        .badge {
            font-size: .7rem;
            padding: .25rem .5rem;
            border-radius: 10px;
            font-weight: 600
        }

        .header-action {
            display: flex;
            align-items: center;
            gap: .75rem
        }

        .header-action .btn {
            font-size: .95rem;
            padding: .5rem 1.25rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all .3s ease;
            white-space: nowrap;
            border-width: 2px;
            min-height: 48px;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .header-action .btn i {
            font-size: .9rem
        }

        .header-action .btn-outline-primary {
            color: #212529;
            border-color: rgba(0, 0, 0, .15);
            background-color: transparent
        }

        .header-action .btn-outline-primary:hover {
            background-color: rgba(0, 0, 0, .03);
            border-color: rgba(0, 0, 0, .2);
            color: #212529;
            transform: translateY(-1px)
        }

        .header-action .btn-primary {
            background: linear-gradient(135deg, #2F80ED 0%, #56CCF2 100%);
            border: none;
            box-shadow: 0 4px 12px rgba(102, 126, 234, .3)
        }

        .header-action .btn-primary:hover {
            box-shadow: 0 6px 16px rgba(102, 126, 234, .4);
            transform: translateY(-2px)
        }

        .navbar-nav .nav-item .page-scroll {
            padding: .5rem 1rem;
            font-size: .95rem;
            font-weight: 500;
            display: flex;
            align-items: center
        }

        @media (max-width:991px) {
            .user-badge {
                width: 100%;
                justify-content: space-between;
                margin-bottom: 1rem;
                border-radius: 12px
            }

            .dropdown-menu {
                position: static !important;
                transform: none !important;
                box-shadow: none;
                border: 1px solid #dee2e6;
                margin-top: .5rem !important;
                width: 100%
            }

            .header-action {
                width: 100%;
                flex-direction: column
            }

            .header-action .btn {
                width: 100%;
                justify-content: center
            }

            .navbar-nav .nav-item .page-scroll {
                height: auto
            }
        }

        .navbar-area {
            transition: all .3s ease
        }

        .navbar-area.scrolled {
            background-color: rgba(255, 255, 255, .98);
            box-shadow: 0 2px 12px rgba(0, 0, 0, .08)
        }

        /* --- UI umum --- */
        .card-soft {
            border: 1px solid rgba(0, 0, 0, .06);
            border-radius: 14px;
            box-shadow: 0 10px 26px rgba(0, 0, 0, .06);
        }

        .card-soft .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, .06);
            padding: 14px 16px;
        }

        .card-soft .card-body {
            padding: 16px;
        }

        .help-mini {
            font-size: 12px;
            color: #6c757d
        }

        .table td,
        .table th {
            vertical-align: middle
        }

        /* ====== Shell wrapper ====== */
        .schedule-shell {
            position: relative;
            border-radius: 18px;
            padding: 18px;
            border: 1px solid rgba(0, 0, 0, .06);
            background: linear-gradient(135deg, rgba(47, 128, 237, .12) 0%, rgba(118, 75, 162, .10) 100%);
            box-shadow: 0 18px 44px rgba(0, 0, 0, .10);
            overflow: hidden;
        }

        .schedule-shell:before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            right: -180px;
            top: -160px;
            background: radial-gradient(circle, rgba(47, 128, 237, .22) 0%, rgba(47, 128, 237, 0) 60%);
        }

        .schedule-shell:after {
            content: "";
            position: absolute;
            width: 480px;
            height: 480px;
            left: -220px;
            bottom: -220px;
            background: radial-gradient(circle, rgba(118, 75, 162, .20) 0%, rgba(118, 75, 162, 0) 60%);
        }

        .schedule-shell>.inner {
            position: relative;
            z-index: 1;
        }

        /* ====== Header card ====== */
        .schedule-card .card-header {
            background: linear-gradient(135deg, rgba(47, 128, 237, .16) 0%, rgba(255, 255, 255, .85) 55%);
            border-bottom: 1px solid rgba(0, 0, 0, .08);
        }

        .schedule-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .schedule-stat {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .stat-pill {
            font-size: 12px;
            font-weight: 700;
            color: rgba(50, 52, 80, .78);
            padding: 8px 10px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .08);
            background: rgba(255, 255, 255, .65);
            white-space: nowrap;
        }

        /* ====== Tabs ====== */
        .tabs-pills {
            border-bottom: 1px solid rgba(0, 0, 0, .06);
            padding-bottom: 10px;
            margin-bottom: 12px;
        }

        .tabs-pills .nav-link {
            border-radius: 999px;
            padding: .55rem 1rem;
            font-weight: 700;
            color: rgba(50, 52, 80, .75);
            border: 1px solid rgba(0, 0, 0, .08);
            background: rgba(255, 255, 255, .6);
            margin-right: 10px;
        }

        .tabs-pills .nav-link.active {
            color: #fff;
            border-color: transparent;
            background: linear-gradient(135deg, #2F80ED 0%, #56CCF2 100%);
            box-shadow: 0 10px 22px rgba(102, 126, 234, .22);
        }

        /* ====== Table: row clickable ====== */
        .appt-table .table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .appt-table thead th {
            font-size: 12px;
            letter-spacing: .6px;
            text-transform: uppercase;
            color: rgba(50, 52, 80, .70);
            border: none;
            padding: 8px 10px;
        }

        .appt-table tbody tr {
            background: #fff;
            box-shadow: 0 10px 22px rgba(0, 0, 0, .06);
            border-radius: 14px;
            cursor: pointer;
            transition: all .18s ease;
        }

        .appt-table tbody td {
            border: none;
            padding: 12px 12px;
        }

        .appt-table tbody tr td:first-child {
            border-top-left-radius: 14px;
            border-bottom-left-radius: 14px;
        }

        .appt-table tbody tr td:last-child {
            border-top-right-radius: 14px;
            border-bottom-right-radius: 14px;
        }

        .appt-table tbody tr:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, .09);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            border: 1px solid rgba(0, 0, 0, .10);
        }

        .status-wait {
            background: rgba(47, 128, 237, .12);
            color: #2F80ED;
        }

        .status-done {
            background: rgba(40, 167, 69, .12);
            color: #28a745;
        }

        .row-chevron {
            width: 30px;
            height: 30px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(50, 52, 80, .55);
            border: 1px solid rgba(0, 0, 0, .08);
            background: rgba(255, 255, 255, .6);
        }

        @media (max-width: 991px) {
            .schedule-shell {
                padding: 14px;
            }

            .tabs-pills .nav-link {
                margin-bottom: 10px;
                margin-right: 8px;
            }
        }
    </style>
</head>

<body>
    <div class="preloader">
        <div class="loader">
            <div class="spinner">
                <div class="spinner-container">
                    <div class="spinner-rotator">
                        <div class="spinner-left">
                            <div class="spinner-circle"></div>
                        </div>
                        <div class="spinner-right">
                            <div class="spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="jadwal" class="hero-section-wrapper-5">
        @include('layouts.pemilik.navbar', ['activeSection' => 'jadwal'])

        <div class="hero-section hero-style-5 img-bg"
            style="background-image: url('{{ asset('img/hero/hero-5/hero-bg.svg') }}'); height: 100vh; min-height: 100vh; display: flex; align-items: stretch;">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="schedule-shell">
                            <div class="inner">

                                <div class="card card-soft schedule-card">
                                    <div class="card-header">
                                        <div class="schedule-head">
                                            <div>
                                                <h5 class="mb-0">
                                                    <i class="fas fa-calendar-check me-2"></i> Jadwal Temu
                                                </h5>
                                                <div class="help-mini">
                                                    Lihat daftar jadwal temu yang terjadwal maupun yang sudah selesai.
                                                </div>
                                            </div>

                                            <div class="schedule-stat">
                                                <div class="stat-pill">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Terjadwal:
                                                    {{ isset($jadwalTemu) ? $jadwalTemu->where('status', 'terjadwal')->count() : 0 }}
                                                </div>
                                                <div class="stat-pill">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    Selesai:
                                                    {{ isset($jadwalTemu) ? $jadwalTemu->where('status', 'selesai')->count() : 0 }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">

                                        {{-- Tabs --}}
                                        <ul class="nav tabs-pills" id="jadwalTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="tab-terjadwal" data-bs-toggle="tab"
                                                    data-bs-target="#pane-terjadwal" type="button" role="tab"
                                                    aria-controls="pane-terjadwal" aria-selected="true">
                                                    <i class="fas fa-clock me-1"></i> Terjadwal
                                                </button>
                                            </li>

                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="tab-selesai" data-bs-toggle="tab"
                                                    data-bs-target="#pane-selesai" type="button" role="tab"
                                                    aria-controls="pane-selesai" aria-selected="false">
                                                    <i class="fas fa-check-circle me-1"></i> Selesai
                                                </button>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="jadwalTabsContent">

                                            {{-- TERJADWAL --}}
                                            <div class="tab-pane fade show active" id="pane-terjadwal" role="tabpanel"
                                                aria-labelledby="tab-terjadwal">

                                                @php
                                                    $terjadwal = isset($jadwalTemu)
                                                        ? $jadwalTemu->where('status', 'terjadwal')
                                                        : collect();
                                                    $countTerjadwal = $terjadwal->count();
                                                @endphp

                                                @if ($countTerjadwal == 0)
                                                    <div class="alert alert-light mb-0">
                                                        Belum ada jadwal temu yang terjadwal.
                                                    </div>
                                                @else
                                                    <div class="table-responsive appt-table">
                                                        <table class="table table-sm mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Tanggal</th>
                                                                    <th>Pet</th>
                                                                    <th>Dokter</th>
                                                                    <th class="text-center" style="width:120px;">Status
                                                                    </th>
                                                                    <th class="text-end" style="width:56px;"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($terjadwal as $a)
                                                                    @php
                                                                        $tgl = $a->waktu_temu
                                                                            ? \Carbon\Carbon::parse(
                                                                                $a->waktu_temu,
                                                                            )->format('d-m-Y')
                                                                            : '-';
                                                                        $jam = $a->waktu_temu
                                                                            ? \Carbon\Carbon::parse(
                                                                                $a->waktu_temu,
                                                                            )->format('H:i')
                                                                            : '-';
                                                                        $petNama = isset($a->pet) ? $a->pet->nama : '-';
                                                                        $dokterNama = isset($a->dokter_nama)
                                                                            ? $a->dokter_nama
                                                                            : '-';
                                                                        $poli = isset($a->poli) ? $a->poli : '';
                                                                        $keluhan = isset($a->keluhan)
                                                                            ? \Illuminate\Support\Str::limit(
                                                                                $a->keluhan,
                                                                                40,
                                                                            )
                                                                            : '';
                                                                        $href = '#'; // replace with actual route if available
                                                                    @endphp

                                                                    <tr class="appt-row"
                                                                        data-href="{{ $href }}">
                                                                        <td>
                                                                            <div class="fw-bold">{{ $tgl }}
                                                                            </div>
                                                                            <div class="help-mini">
                                                                                <i class="fas fa-clock me-1"></i>
                                                                                {{ $jam }}
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="fw-bold">{{ $petNama }}
                                                                            </div>
                                                                            <div class="help-mini">
                                                                                {{ $keluhan }}
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="fw-bold">{{ $dokterNama }}
                                                                            </div>
                                                                            <div class="help-mini">
                                                                                {{ $poli }}
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <span
                                                                                class="status-pill status-wait">Terjadwal</span>
                                                                        </td>
                                                                        <td class="text-end">
                                                                            <div class="row-chevron">
                                                                                <i class="fas fa-chevron-right"></i>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- SELESAI --}}
                                            <div class="tab-pane fade" id="pane-selesai" role="tabpanel"
                                                aria-labelledby="tab-selesai">

                                                @php
                                                    $selesai = isset($jadwalTemu)
                                                        ? $jadwalTemu->where('status', 'selesai')
                                                        : collect();
                                                    $countSelesai = $selesai->count();
                                                @endphp

                                                @if ($countSelesai == 0)
                                                    <div class="alert alert-light mb-0">
                                                        Belum ada jadwal temu yang selesai.
                                                    </div>
                                                @else
                                                    <div class="table-responsive appt-table">
                                                        <table class="table table-sm mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Tanggal</th>
                                                                    <th>Pet</th>
                                                                    <th>Dokter</th>
                                                                    <th class="text-center" style="width:120px;">
                                                                        Status</th>
                                                                    <th class="text-end" style="width:56px;"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($selesai as $a)
                                                                    @php
                                                                        $tgl = $a->waktu_temu
                                                                            ? \Carbon\Carbon::parse(
                                                                                $a->waktu_temu,
                                                                            )->format('d-m-Y')
                                                                            : '-';
                                                                        $jam = $a->waktu_temu
                                                                            ? \Carbon\Carbon::parse(
                                                                                $a->waktu_temu,
                                                                            )->format('H:i')
                                                                            : '-';
                                                                        $petNama = isset($a->pet) ? $a->pet->nama : '-';
                                                                        $dokterNama = isset($a->dokter_nama)
                                                                            ? $a->dokter_nama
                                                                            : '-';
                                                                        $poli = isset($a->poli) ? $a->poli : '';
                                                                        $diagnosa = isset($a->diagnosa)
                                                                            ? \Illuminate\Support\Str::limit(
                                                                                $a->diagnosa,
                                                                                40,
                                                                            )
                                                                            : '';
                                                                        $href = '#'; // replace with actual route if available
                                                                    @endphp

                                                                    <tr class="appt-row"
                                                                        data-href="{{ $href }}">
                                                                        <td>
                                                                            <div class="fw-bold">{{ $tgl }}
                                                                            </div>
                                                                            <div class="help-mini">
                                                                                <i class="fas fa-clock me-1"></i>
                                                                                {{ $jam }}
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="fw-bold">{{ $petNama }}
                                                                            </div>
                                                                            <div class="help-mini">
                                                                                {{ $diagnosa }}
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="fw-bold">{{ $dokterNama }}
                                                                            </div>
                                                                            <div class="help-mini">
                                                                                {{ $poli }}
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <span
                                                                                class="status-pill status-done">Selesai</span>
                                                                        </td>
                                                                        <td class="text-end">
                                                                            <div class="row-chevron">
                                                                                <i class="fas fa-chevron-right"></i>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="{{ asset('js/bootstrap-5.0.0-beta1.min.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Navbar scroll effect (tanpa arrow function)
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.navbar-area');
            if (!navbar) return;

            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        });

        // Row klik -> href (sementara '#')
        $(document).on('click', '.appt-row', function() {
            var href = $(this).data('href');
            if (!href) href = '#';
            window.location.href = href;
        });

        // Persist tab via hash (#terjadwal / #selesai)
        document.addEventListener('DOMContentLoaded', function() {
            function activateByHash() {
                var hash = window.location.hash || '';
                if (!hash) return;

                if (hash === '#selesai') {
                    var btn = document.getElementById('tab-selesai');
                    if (btn) btn.click();
                } else if (hash === '#terjadwal') {
                    var btn2 = document.getElementById('tab-terjadwal');
                    if (btn2) btn2.click();
                }
            }

            // update hash saat tab diklik
            var t1 = document.getElementById('tab-terjadwal');
            var t2 = document.getElementById('tab-selesai');

            if (t1) {
                t1.addEventListener('click', function() {
                    window.location.hash = 'terjadwal';
                });
            }
            if (t2) {
                t2.addEventListener('click', function() {
                    window.location.hash = 'selesai';
                });
            }

            activateByHash();
        });
    </script>
</body>

</html>
