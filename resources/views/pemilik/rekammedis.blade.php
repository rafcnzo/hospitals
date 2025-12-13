<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Ratatouille Hospital - Riwayat Rekam Medis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap-5.0.0-beta1.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/lindy-uikit.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* --- CSS Base --- */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9f9ff;
        }

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

        /* --- Card Soft --- */
        .card-soft {
            border: 1px solid rgba(0, 0, 0, .06);
            border-radius: 14px;
            box-shadow: 0 10px 26px rgba(0, 0, 0, .06);
            background: #fff;
        }

        .card-soft .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, .06);
            padding: 18px 20px;
        }

        .card-soft .card-body {
            padding: 20px;
        }

        .help-mini {
            font-size: 12px;
            color: #6c757d;
            margin-top: 4px;
        }

        /* --- Shell Wrapper --- */
        .rm-shell {
            position: relative;
            border-radius: 18px;
            padding: 18px;
            border: 1px solid rgba(0, 0, 0, .06);
            background: linear-gradient(135deg, rgba(47, 128, 237, .12) 0%, rgba(118, 75, 162, .10) 100%);
            box-shadow: 0 18px 44px rgba(0, 0, 0, .10);
            overflow: hidden;
            margin-top: 20px;
        }

        .rm-shell:before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            right: -180px;
            top: -160px;
            background: radial-gradient(circle, rgba(47, 128, 237, .22) 0%, rgba(47, 128, 237, 0) 60%);
        }

        .rm-shell:after {
            content: "";
            position: absolute;
            width: 480px;
            height: 480px;
            left: -220px;
            bottom: -220px;
            background: radial-gradient(circle, rgba(118, 75, 162, .20) 0%, rgba(118, 75, 162, 0) 60%);
        }

        .rm-shell>.inner {
            position: relative;
            z-index: 2;
        }

        /* --- Header & Pills --- */
        .rm-card .card-header {
            background: linear-gradient(135deg, rgba(47, 128, 237, .16) 0%, rgba(255, 255, 255, .85) 55%);
            border-bottom: 1px solid rgba(0, 0, 0, .08);
        }

        .rm-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 15px;
        }

        .rm-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .pill {
            font-size: 12px;
            font-weight: 700;
            color: rgba(50, 52, 80, .78);
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .65);
            border: 1px solid rgba(0, 0, 0, .08);
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .pill i {
            color: #4299e1;
        }

        .badge-soft {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            background: rgba(47, 128, 237, .10);
            color: #2F80ED;
            border: 1px solid rgba(0, 0, 0, .10);
        }

        .badge-soft.purple {
            background: rgba(118, 75, 162, .10);
            color: #764ba2;
        }

        /* --- Tabs --- */
        .tabs-pills {
            border-bottom: 1px solid rgba(0, 0, 0, .06);
            padding-bottom: 10px;
            margin-bottom: 20px;
            gap: 10px;
            display: flex;
        }

        .tabs-pills .nav-link {
            border-radius: 999px;
            padding: .55rem 1.2rem;
            font-weight: 700;
            color: rgba(50, 52, 80, .75);
            border: 1px solid rgba(0, 0, 0, .08);
            background: rgba(255, 255, 255, .6);
            margin-right: 5px;
            transition: all .2s ease;
        }

        .tabs-pills .nav-link:hover {
            background: #fff;
            transform: translateY(-1px);
        }

        .tabs-pills .nav-link.active {
            color: #fff;
            border-color: transparent;
            background: linear-gradient(135deg, #2F80ED 0%, #56CCF2 100%);
            box-shadow: 0 4px 12px rgba(102, 126, 234, .3);
        }

        /* --- Info Cards --- */
        .info-card {
            height: 100%;
            border: 1px solid rgba(0, 0, 0, .08);
            box-shadow: 0 10px 22px rgba(0, 0, 0, .04);
            border-radius: 16px;
            overflow: hidden;
        }

        .info-card .card-header {
            background: linear-gradient(135deg, rgba(118, 75, 162, .14) 0%, rgba(255, 255, 255, .88) 55%);
            border-bottom: 1px solid rgba(0, 0, 0, .08);
        }

        .info-card.left-col .card-header {
            background: linear-gradient(135deg, rgba(47, 128, 237, .16) 0%, rgba(255, 255, 255, .85) 55%);
        }

        .kv {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed rgba(0, 0, 0, .08);
        }

        .kv:last-child {
            border-bottom: none;
        }

        .kv .k {
            color: rgba(50, 52, 80, .70);
            font-size: 13px;
            font-weight: 600;
        }

        .kv .v {
            color: #323450;
            font-size: 13px;
            font-weight: 700;
            text-align: right;
        }

        /* --- Table --- */
        .rm-table .table {
            border-collapse: separate;
            border-spacing: 0 8px;
            margin-bottom: 0;
        }

        .rm-table thead th {
            font-size: 12px;
            letter-spacing: .6px;
            text-transform: uppercase;
            color: rgba(50, 52, 80, .70);
            border: none;
            padding: 8px 12px;
        }

        .rm-table tbody tr {
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .03);
            border-radius: 12px;
            transition: all .18s ease;
        }

        .rm-table tbody td {
            border: none;
            padding: 14px 12px;
            vertical-align: middle;
            color: #323450;
            font-size: 14px;
        }

        .rm-table tbody tr td:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }

        .rm-table tbody tr td:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        .qty-badge {
            background: rgba(0, 0, 0, .05);
            color: #323450;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
        }

        @media (max-width: 991px) {
            .rm-shell {
                padding: 14px;
            }

            .tabs-pills {
                overflow-x: auto;
                flex-wrap: nowrap;
            }

            .tabs-pills .nav-link {
                white-space: nowrap;
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

    <section id="home" class="hero-section-wrapper-5">
        @include('layouts.pemilik.navbar')

        <div class="hero-section hero-style-5 img-bg"
            style="background-image: url('{{ asset('img/hero/hero-5/hero-bg.svg') }}'); min-height: 100vh; display: flex; align-items: stretch; padding-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <div class="rm-shell wow fadeInUp" data-wow-delay=".2s">
                            <div class="inner">
                                <input type="hidden" id="idpet" value="{{ $pet?->idpet ?? '' }}">

                                <div class="card card-soft rm-card">
                                    <div class="card-header">
                                        <div class="rm-head">
                                            <div>
                                                <h5 class="mb-0">
                                                    <i class="fas fa-file-medical text-primary me-2"></i> Detail Rekam
                                                    Medis
                                                </h5>
                                                <div class="help-mini">
                                                    No. RM: <b>#{{ $rekamMedis->idrekam_medis ?? '-' }}</b> &bull;
                                                    Tanggal: <b>{{ $tglPeriksa }}</b>
                                                </div>
                                            </div>

                                            <div class="rm-actions">
                                                <div class="pill">
                                                    <i class="fas fa-user-doctor"></i> {{ $namaDokter }}
                                                </div>
                                                <div class="pill">
                                                    <i class="fas fa-list-check"></i> {{ $detailsData->count() }} Item
                                                </div>
                                                <a href="{{ route('pemilik.profile.index') }}"
                                                    class="btn btn-outline-primary"
                                                    style="border-radius: 50px; font-weight: 500; font-size: 0.85rem; padding: 6px 16px;">
                                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <ul class="nav tabs-pills" id="rmTabs" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="tab-ringkasan" data-bs-toggle="tab"
                                                    data-bs-target="#pane-ringkasan" type="button" role="tab"
                                                    aria-controls="pane-ringkasan" aria-selected="true">
                                                    <i class="fas fa-info-circle me-1"></i> Ringkasan Medis
                                                </button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="tab-tindakan" data-bs-toggle="tab"
                                                    data-bs-target="#pane-tindakan" type="button" role="tab"
                                                    aria-controls="pane-tindakan" aria-selected="false">
                                                    <i class="fas fa-pills me-1"></i> Tindakan & Terapi
                                                </button>
                                            </li>
                                        </ul>

                                        <div class="tab-content" id="rmTabsContent">

                                            <div class="tab-pane fade show active" id="pane-ringkasan" role="tabpanel"
                                                aria-labelledby="tab-ringkasan">
                                                <div class="row g-4">
                                                    <div class="col-lg-5">
                                                        <div class="card card-soft info-card left-col h-100">
                                                            <div class="card-header">
                                                                <h6><i class="fas fa-paw me-2 text-primary"></i>
                                                                    Identitas Pasien</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="kv">
                                                                    <div class="k">Nama Hewan</div>
                                                                    <div class="v text-primary">{{ $namaPet }}
                                                                    </div>
                                                                </div>
                                                                <div class="kv">
                                                                    <div class="k">Jenis & Ras</div>
                                                                    <div class="v">
                                                                        {{ $pet?->rasHewan?->jenisHewan?->nama_jenis_hewan ?? '-' }}
                                                                        /
                                                                        {{ $pet?->rasHewan?->nama_ras ?? '-' }}
                                                                    </div>
                                                                </div>
                                                                <div class="kv">
                                                                    <div class="k">Jenis Kelamin</div>
                                                                    <div class="v">
                                                                        @if ($pet && $pet->jenis_kelamin == 'L')
                                                                            Jantan <i
                                                                                class="fas fa-mars text-info ms-1"></i>
                                                                        @elseif($pet && $pet->jenis_kelamin == 'P')
                                                                            Betina <i
                                                                                class="fas fa-venus text-danger ms-1"></i>
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="mt-4 pt-3 border-top"
                                                                    style="border-color: rgba(0,0,0,0.08) !important;">
                                                                </div>
                                                                <h6 class="mb-3"
                                                                    style="font-size: 0.9rem; font-weight: 700; color: #4a5568;">
                                                                    Data Pemilik</h6>
                                                                <div class="kv">
                                                                    <div class="k">Nama Pemilik</div>
                                                                    <div class="v">{{ $namaPemilik }}</div>
                                                                </div>
                                                                <div class="kv">
                                                                    <div class="k">Kontak (WA)</div>
                                                                    <div class="v">{{ $noWa }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-7">
                                                        <div class="card card-soft info-card h-100">
                                                            <div class="card-header">
                                                                <h6><i
                                                                        class="fas fa-clipboard-check me-2 text-primary"></i>
                                                                    Hasil Pemeriksaan</h6>
                                                            </div>
                                                            <div class="card-body">

                                                                {{-- TAMBAHAN: Info Dokter & Waktu Periksa --}}
                                                                <div class="row mb-4 g-3">
                                                                    <div class="col-md-6">
                                                                        <div class="p-3 rounded border h-100"
                                                                            style="background-color: #f8f9fa; border-color: #e9ecef !important;">
                                                                            <div class="text-muted mb-1"
                                                                                style="font-size: 0.8rem; font-weight: 600;">
                                                                                <i class="fas fa-user-md me-1"></i>
                                                                                DOKTER PEMERIKSA
                                                                            </div>
                                                                            <div
                                                                                style="font-weight: 700; color: #323450;">
                                                                                {{ $namaDokter }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="p-3 rounded border h-100"
                                                                            style="background-color: #f8f9fa; border-color: #e9ecef !important;">
                                                                            <div class="text-muted mb-1"
                                                                                style="font-size: 0.8rem; font-weight: 600;">
                                                                                <i class="fas fa-clock me-1"></i> WAKTU
                                                                                DIPERIKSA
                                                                            </div>
                                                                            <div
                                                                                style="font-weight: 700; color: #323450;">
                                                                                {{ $rekamMedis->created_at ? \Carbon\Carbon::parse($rekamMedis->created_at)->format('d F Y, H:i') . ' WIB' : '-' }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- END TAMBAHAN --}}

                                                                <div class="mb-4">
                                                                    <div class="badge-soft mb-2">
                                                                        <i class="fas fa-comment-medical"></i> Keluhan
                                                                        (Anamnesa)
                                                                    </div>
                                                                    <p class="mb-0 text-dark"
                                                                        style="font-weight: 600; line-height: 1.6; font-size: 0.95rem;">
                                                                        {{ $keluhan }}
                                                                    </p>
                                                                </div>

                                                                <div class="mb-4">
                                                                    <div class="badge-soft purple mb-2">
                                                                        <i class="fas fa-stethoscope"></i> Diagnosa
                                                                        Dokter
                                                                    </div>
                                                                    <p class="mb-0 text-dark"
                                                                        style="font-weight: 600; line-height: 1.6; font-size: 0.95rem;">
                                                                        {{ $diagnosa }}
                                                                    </p>
                                                                </div>

                                                                @if ($catatan)
                                                                    <div class="p-3 rounded border"
                                                                        style="background-color: #f8f9fa; border-color: rgba(0,0,0,0.06) !important;">
                                                                        <div class="d-flex align-items-center mb-2"
                                                                            style="font-size: 0.85rem; font-weight: 700; color: #6c757d;">
                                                                            <i class="fas fa-sticky-note me-2"></i>
                                                                            Catatan Tambahan
                                                                        </div>
                                                                        <div class="text-muted"
                                                                            style="font-size: 0.9rem;">
                                                                            {{ $catatan }}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tab-pane fade" id="pane-tindakan" role="tabpanel"
                                                aria-labelledby="tab-tindakan">
                                                <div class="card card-soft info-card">
                                                    @if ($detailsData->count() == 0)
                                                        <div class="card-body text-center py-5">
                                                            <div class="mb-3 text-muted opacity-50">
                                                                <i class="fas fa-box-open fa-3x"></i>
                                                            </div>
                                                            <h6 class="text-muted">Belum ada data tindakan atau terapi.
                                                            </h6>
                                                        </div>
                                                    @else
                                                        <div class="table-responsive rm-table" style="padding: 10px;">
                                                            <table class="table table-hover mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="15%">Kode</th>
                                                                        <th width="35%">Nama Tindakan</th>
                                                                        <th width="10%" class="text-center">Qty
                                                                        </th>
                                                                        <th width="40%" class="text-end">Keterangan
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($detailsData as $detail)
                                                                        <tr>
                                                                            <td>
                                                                                <div class="fw-bold text-primary">
                                                                                    #{{ $detail['kode'] }}</div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="fw-bold"
                                                                                    style="color: #323450;">
                                                                                    {{ $detail['namaTindakan'] }}</div>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <span
                                                                                    class="qty-badge">{{ $detail['qty'] }}</span>
                                                                            </td>
                                                                            <td class="text-end">
                                                                                @if ($detail['kategori_klinis'])
                                                                                    <span class="text-muted"
                                                                                        style="font-size: 0.9rem;">{{ $detail['kategori_klinis'] }}</span>
                                                                                @else
                                                                                    <span class="text-muted fst-italic"
                                                                                        style="font-size: 0.85rem;">-</span>
                                                                                @endif
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
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            // Hapus class page-scroll dari link navbar agar main.js tidak mencoba scrollspy
            $('.navbar-nav .nav-link').removeClass('page-scroll');
        });
    </script>

    <script src="{{ asset('js/bootstrap-5.0.0-beta1.min.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        // OVERRIDE onscroll main.js yang error dengan versi aman
        window.onscroll = function() {
            var navbar = document.querySelector('.navbar-area');
            if (navbar) {
                var sticky = navbar.offsetTop;
                if (window.pageYOffset > sticky) {
                    navbar.classList.add("sticky");
                    navbar.classList.add("scrolled");
                } else {
                    navbar.classList.remove("sticky");
                    navbar.classList.remove("scrolled");
                }
            }

            // Handle back to top jika ada (biar gak error console)
            var backToTop = document.querySelector(".back-to-top");
            if (backToTop) {
                if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                    backToTop.style.display = "flex";
                } else {
                    backToTop.style.display = "none";
                }
            }
        };

        // Tab Persistence
        document.addEventListener('DOMContentLoaded', function() {
            var hash = window.location.hash;
            if (hash) {
                var triggerEl = document.querySelector(
                    `.nav-link[data-bs-target="${hash.replace('#', '#pane-')}"]`);
                if (triggerEl) {
                    var tab = new bootstrap.Tab(triggerEl);
                    tab.show();
                }
            }

            var tabLinks = document.querySelectorAll('.nav-link[data-bs-toggle="tab"]');
            tabLinks.forEach(function(link) {
                link.addEventListener('shown.bs.tab', function(event) {
                    var targetId = event.target.getAttribute('data-bs-target').replace('#pane-',
                        '');
                    history.replaceState(null, null, '#' + targetId);
                });
            });
        });
    </script>
</body>

</html>
