<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Ratatouille Hospital - Profil Pemilik</title>
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

        /* --- tambahan UI profile --- */
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

        .form-label {
            font-weight: 600
        }

        .help-mini {
            font-size: 12px;
            color: #6c757d
        }

        .table td,
        .table th {
            vertical-align: middle
        }

        .profile-shell {
            position: relative;
            border-radius: 18px;
            padding: 18px;
            border: 1px solid rgba(0, 0, 0, .06);
            background: linear-gradient(135deg, rgba(47, 128, 237, .12) 0%, rgba(118, 75, 162, .10) 100%);
            box-shadow: 0 18px 44px rgba(0, 0, 0, .10);
            overflow: hidden;
        }

        .profile-shell:before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            right: -180px;
            top: -160px;
            background: radial-gradient(circle, rgba(47, 128, 237, .22) 0%, rgba(47, 128, 237, 0) 60%);
        }

        .profile-shell:after {
            content: "";
            position: absolute;
            width: 480px;
            height: 480px;
            left: -220px;
            bottom: -220px;
            background: radial-gradient(circle, rgba(118, 75, 162, .20) 0%, rgba(118, 75, 162, 0) 60%);
        }

        .profile-shell>.row {
            position: relative;
            z-index: 1;
        }

        /* ====== Card kontras kiri/kanan ====== */
        .profile-col .card-soft,
        .pet-col .card-soft {
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, .08);
            box-shadow: 0 14px 34px rgba(0, 0, 0, .10);
            overflow: hidden;
        }

        .profile-col .card-soft .card-header {
            background: linear-gradient(135deg, rgba(47, 128, 237, .16) 0%, rgba(255, 255, 255, .85) 55%);
            border-bottom: 1px solid rgba(0, 0, 0, .08);
        }

        .pet-col .card-soft .card-header {
            background: linear-gradient(135deg, rgba(118, 75, 162, .16) 0%, rgba(255, 255, 255, .85) 55%);
            border-bottom: 1px solid rgba(0, 0, 0, .08);
        }

        /* ====== Pet table: row clickable ====== */
        .pet-table .table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .pet-table thead th {
            font-size: 12px;
            letter-spacing: .6px;
            text-transform: uppercase;
            color: rgba(50, 52, 80, .70);
            border: none;
            padding: 8px 10px;
        }

        .pet-table tbody tr {
            background: #fff;
            box-shadow: 0 10px 22px rgba(0, 0, 0, .06);
            border-radius: 14px;
            cursor: pointer;
            transition: all .18s ease;
        }

        .pet-table tbody td {
            border: none;
            padding: 12px 12px;
            vertical-align: middle;
        }

        .pet-table tbody tr td:first-child {
            border-top-left-radius: 14px;
            border-bottom-left-radius: 14px;
        }

        .pet-table tbody tr td:last-child {
            border-top-right-radius: 14px;
            border-bottom-right-radius: 14px;
        }

        .pet-table tbody tr:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, .09);
        }

        /* pill JK + chevron */
        .pet-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 28px;
            border-radius: 999px;
            font-weight: 800;
            font-size: 12px;
            border: 1px solid rgba(0, 0, 0, .10);
        }

        .pet-pill-l {
            background: rgba(47, 128, 237, .12);
            color: #2F80ED;
        }

        .pet-pill-p {
            background: rgba(118, 75, 162, .12);
            color: #764ba2;
        }

        .pet-chevron {
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

        .pet-badge {
            font-size: 12px;
            font-weight: 700;
            color: rgba(50, 52, 80, .75);
            padding: 8px 10px;
            border-radius: 999px;
            border: 1px solid rgba(0, 0, 0, .08);
            background: rgba(255, 255, 255, .6);
        }

        /* mobile spacing */
        @media (max-width: 991px) {
            .profile-shell {
                padding: 14px;
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
            style="background-image: url('{{ asset('img/hero/hero-5/hero-bg.svg') }}'); height: 100vh; min-height: 100vh; display: flex; align-items: stretch;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="profile-shell">
                            <div class="row g-4 align-items-stretch">

                                {{-- KIRI: PROFILE PEMILIK --}}
                                <div class="col-md-7 profile-col">
                                    <div class="card card-soft">
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <div>
                                                <h5 class="mb-0"><i class="fas fa-user me-2"></i> Profil Pemilik</h5>
                                                <div class="help-mini">Edit data pemilik lalu klik simpan.</div>
                                            </div>
                                            <button type="button" id="btnSaveProfile" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i> Simpan
                                            </button>
                                        </div>
                                        <div class="card-body">

                                            <form id="formProfile">
                                                <div class="row g-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Nama</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $user->name }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">No WhatsApp</label>
                                                        <input type="text" name="no_wa" class="form-control"
                                                            value="{{ $pemilik->no_wa }}">
                                                        <div class="help-mini">Contoh: 08123456789</div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label class="form-label">Role</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ ucfirst($user->roles->first()?->name ?? 'User') }}"
                                                            readonly>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Alamat</label>
                                                        <textarea name="alamat" rows="3" class="form-control">{{ $pemilik->alamat }}</textarea>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                {{-- KANAN: PET --}}
                                <div class="col-md-5 pet-col">
                                    <div class="card card-soft h-100">
                                        <div class="card-header">
                                            <div class="d-flex align-items-start justify-content-between">
                                                <div>
                                                    <h5 class="mb-0"><i class="fas fa-paw me-2"></i> Pet Saya</h5>
                                                    <div class="help-mini">Klik salah satu pet untuk lihat detail.</div>
                                                </div>
                                                <div class="pet-badge">
                                                    <i class="fas fa-list me-1"></i> {{ count($pets) }} Pet
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            @if (count($pets) == 0)
                                                <div class="alert alert-light mb-0">
                                                    Belum ada pet terdaftar.
                                                </div>
                                            @else
                                                <div class="table-responsive pet-table">
                                                    <table class="table table-sm mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama</th>
                                                                <th class="text-center" style="width:70px;">Gender</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pets as $p)
                                                                <tr class="pet-row" data-idpet="{{ $p->idpet }}">
                                                                    <td>
                                                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                                                            <div>
                                                                                <div class="fw-bold">
                                                                                    {{ $p->nama }}
                                                                                </div>
                                                                                <div class="help-mini">
                                                                                    Ras:
                                                                                    {{ $p->rasHewan && $p->rasHewan->nama_ras ? $p->rasHewan->nama_ras : 'ID ' . $p->idras_hewan }}
                                                                                    &nbsp;•&nbsp;
                                                                                    Lahir:
                                                                                    {{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d-m-Y') }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="pet-chevron">
                                                                                <i class="fas fa-chevron-right"></i>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <span class="pet-pill {{ $p->jenis_kelamin == 'L' ? 'pet-pill-l' : 'pet-pill-p' }}">
                                                                            {{ $p->jenis_kelamin == 'L' ? 'L' : 'P' }}
                                                                        </span>
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

                            </div> {{-- row --}}
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
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        function csrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }

        function postForm(url, formData, onDone) {
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken()
                },
                success: function(res) {
                    if (onDone) onDone(res);
                },
                error: function(xhr) {
                    var msg = 'Terjadi kesalahan.';
                    if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: msg
                    });
                }
            });
        }

        // SAVE PROFILE
        $('#btnSaveProfile').on('click', function() {
            var fd = new FormData(document.getElementById('formProfile'));

            postForm("{{ route('pemilik.profile.update') }}", fd, function(res) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: res.message
                });
            });
        });

        $(document).on('click', '.pet-row', function() {
            var petId = $(this).data('idpet') || $(this).attr('data-idpet') || '';
            if (!petId) return;
            var href = "{{ url('pemilik/rekam-medis') }}/" + petId;
            window.location.href = href;
        });
    </script>
</body>

</html>
