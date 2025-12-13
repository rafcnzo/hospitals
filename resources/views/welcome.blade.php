<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Ratatouille Hospital - Melayani dengan Hati</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap-5.0.0-beta1.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/lindy-uikit.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Styling untuk dropdown menu */
        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-radius: 12px;
            padding: 0.5rem 0;
            min-width: 240px;
            margin-top: 0.5rem !important;
        }

        .dropdown-item {
            padding: 0.7rem 1.25rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
            color: #495057;
        }

        .dropdown-item i {
            width: 20px;
            margin-right: 12px;
            font-size: 1rem;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
            color: #0d6efd;
            padding-left: 1.5rem;
        }

        .dropdown-item.text-danger:hover {
            background-color: #fff5f5;
            color: #dc3545;
        }

        .dropdown-divider {
            margin: 0.5rem 0;
            opacity: 0.1;
        }

        /* User badge yang lebih clean dan transparent */
        .user-badge {
            display: flex;
            align-items: center;
            padding: 0.4rem 0.8rem;
            background-color: transparent;
            border: 1px solid #2F80ED;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-height: 48px;
        }

        .user-badge:hover {
            background-color: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.12);
            transform: translateY(-1px);
        }

        /* Navbar scrolled state */
        .navbar.scrolled .user-badge {
            border-color: rgba(0, 0, 0, 0.1);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2F80ED 0%, #56CCF2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            margin-right: 10px;
            flex-shrink: 0;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-right: 8px;
            line-height: 1.3;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #212529;
        }

        .user-role {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 1px;
        }

        .user-badge .fas.fa-chevron-down {
            font-size: 0.75rem;
            color: #6c757d;
            margin-left: 4px;
            transition: transform 0.3s ease;
        }

        .user-badge[aria-expanded="true"] .fas.fa-chevron-down {
            transform: rotate(180deg);
        }

        /* Notification badge */
        .badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 10px;
            font-weight: 600;
        }

        /* Fix button alignment dengan nav items */
        .header-action {
            margin-inline-start: 10px;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-action .btn {
            font-size: 0.95rem;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
            white-space: nowrap;
            border-width: 2px;
            min-height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-action .btn i {
            font-size: 0.9rem;
        }

        .header-action .btn-outline-primary {
            color: #212529;
            border-color: #2F80ED ;
            background-color: transparent;
        }

        .header-action .btn-outline-primary:hover {
            background-color: #2F80ED;
            border-color: rgba(0, 0, 0, 0.2);
            color: #000000;
            transform: translateY(-1px);
        }

        .header-action .btn-primary {
            background: linear-gradient(135deg, #2F80ED 0%, #56CCF2 100%);
            border: none;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .header-action .btn-primary:hover {
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
            transform: translateY(-2px);
            color:#000000;
        }

        /* Navbar items alignment */
        .navbar-nav .nav-item .page-scroll {
            padding: 0.5rem 1rem;
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        /* Mobile responsive */
        @media (max-width: 991px) {
            .user-badge {
                width: 100%;
                justify-content: space-between;
                margin-bottom: 1rem;
                border-radius: 12px;
            }

            .dropdown-menu {
                position: static !important;
                transform: none !important;
                box-shadow: none;
                border: 1px solid #dee2e6;
                margin-top: 0.5rem !important;
                width: 100%;
            }

            .header-action {
                width: 100%;
                flex-direction: column;
            }

            .header-action .btn {
                width: 100%;
                justify-content: center;
            }

            .navbar-nav .nav-item .page-scroll {
                height: auto;
            }
        }

        /* Smooth scroll untuk navbar background */
        .navbar-area {
            transition: all 0.3s ease;
        }

        .navbar-area.scrolled {
            background-color: rgba(255, 255, 255, 0.98);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
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
            style="background-image: url('{{ asset('img/hero/hero-5/hero-bg.svg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="hero-content-wrapper">
                            <h2 class="mb-30 wow fadeInUp" data-wow-delay=".2s">Selamat Datang di Ratatouille Hospital
                            </h2>
                            <p class="mb-30 wow fadeInUp" data-wow-delay=".4s">
                                Memberikan pelayanan kesehatan terbaik dengan teknologi modern dan sentuhan kemanusiaan.
                                Kesehatan Anda adalah prioritas utama kami.
                            </p>
                            <a href="#struktur" class="button button-lg radius-50 wow fadeInUp" data-wow-delay=".6s">
                                Lihat Layanan Kami <i class="fas fa-chevron-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-end">
                        <div class="hero-image wow fadeInUp" data-wow-delay=".5s">
                            <img src="{{ asset('img/hero/doctor-hero.svg') }}" alt="Dokter Ramah">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Sections lainnya tetap sama --}}
    <section id="struktur" class="feature-section feature-style-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-8">
                    <div class="section-title text-center mb-60">
                        <h3 class="mb-15 wow fadeInUp" data-wow-delay=".2s">Struktur & Departemen</h3>
                        <p class="wow fadeInUp" data-wow-delay=".4s">
                            Dipimpin oleh tenaga medis profesional yang berdedikasi tinggi untuk keselamatan pasien.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <div class="icon">
                            <i class="fas fa-user-tie fa-2x text-primary"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Direktur Utama</h5>
                            <p>Memimpin arah strategis rumah sakit untuk mencapai standar internasional.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                        <div class="icon">
                            <i class="fas fa-stethoscope fa-2x text-primary"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Kepala Medis</h5>
                            <p>Mengawasi seluruh prosedur medis dan tim dokter spesialis.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                        <div class="icon">
                            <i class="fas fa-user-nurse fa-2x text-primary"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Kepala Keperawatan</h5>
                            <p>Menjamin asuhan keperawatan yang ramah, sigap, dan profesional.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <div class="icon">
                            <i class="fas fa-hospital-user fa-2x text-primary"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Administrasi & Umum</h5>
                            <p>Mendukung operasional rumah sakit dan pelayanan pasien.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                        <div class="icon">
                            <i class="fas fa-ambulance fa-2x text-primary"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Instalasi Gawat Darurat</h5>
                            <p>Siap sedia 24/7 menangani kondisi darurat medis.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                        <div class="icon">
                            <i class="fas fa-flask fa-2x text-primary"></i>
                            <svg width="110" height="72" viewBox="0 0 110 72" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M110 54.7589C110 85.0014 85.3757 66.2583 55 66.2583C24.6243 66.2583 0 85.0014 0 54.7589C0 24.5164 24.6243 0 55 0C85.3757 0 110 24.5164 110 54.7589Z"
                                    fill="#EBF4FF" />
                            </svg>
                        </div>
                        <div class="content">
                            <h5>Laboratorium & Penunjang</h5>
                            <p>Fasilitas diagnostik modern untuk hasil yang akurat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="visi-misi" class="about-section about-style-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-7 col-lg-6">
                    <div class="about-content-wrapper">
                        <div class="section-title mb-30">
                            <h3 class="mb-25 wow fadeInUp" data-wow-delay=".2s">Visi Kami</h3>
                            <p class="wow fadeInUp" data-wow-delay=".3s">
                                "Menjadi Rumah Sakit pilihan utama yang terpercaya, modern, dan memberikan pelayanan
                                kesehatan paripurna berstandar internasional bagi seluruh lapisan masyarakat."
                            </p>
                        </div>

                        <div class="section-title mb-10">
                            <h4 class="mb-15 wow fadeInUp" data-wow-delay=".35s">Misi Kami</h4>
                        </div>

                        <ul>
                            <li class="wow fadeInUp" data-wow-delay=".35s">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Memberikan pelayanan medis berkualitas tinggi dengan mengutamakan keselamatan pasien.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".4s">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Menyediakan fasilitas kesehatan modern dan ramah lingkungan.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".45s">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Meningkatkan kompetensi SDM secara berkelanjutan melalui pendidikan dan pelatihan.
                            </li>
                            <li class="wow fadeInUp" data-wow-delay=".50s">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Melayani dengan hati, empati, dan integritas tinggi.
                            </li>
                        </ul>

                        <a href="#contact" class="button button-lg radius-10 wow fadeInUp"
                            data-wow-delay=".5s">Hubungi Kami</a>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="about-image text-lg-right wow fadeInUp" data-wow-delay=".5s">
                        <img src="{{ asset('img/about/hospital-building.svg') }}" alt="Gedung Ratatouille Hospital">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact-section contact-style-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-5 col-xl-5 col-lg-7 col-md-10">
                    <div class="section-title text-center mb-50">
                        <h3 class="mb-15">Hubungi Kami</h3>
                        <p>Kami siap melayani kebutuhan informasi dan pendaftaran Anda 24 Jam.</p>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6">
                            <div class="single-item text-center">
                                <div class="icon mx-auto mb-3">
                                    <i class="fas fa-phone-alt fa-2x text-primary"></i>
                                </div>
                                <div class="text">
                                    <h5>Telepon Darurat</h5>
                                    <p>(021) 555-0123</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-item text-center">
                                <div class="icon mx-auto mb-3">
                                    <i class="fas fa-envelope fa-2x text-primary"></i>
                                </div>
                                <div class="text">
                                    <h5>Email</h5>
                                    <p>info@ratatouillehospital.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="single-item text-center">
                                <div class="icon mx-auto mb-3">
                                    <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                                </div>
                                <div class="text">
                                    <h5>Alamat</h5>
                                    <p>Jl. Sehat Selalu No. 99, Jakarta</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer footer-style-4">
        <div class="container">
            <div class="copyright-wrapper wow fadeInUp" data-wow-delay=".2s">
                <p>
                    &copy; {{ date('Y') }} Ratatouille Hospital. All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

    <a href="#" class="scroll-top"> <i class="fas fa-chevron-up"></i> </a>

    <script src="{{ asset('js/bootstrap-5.0.0-beta1.min.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-area');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>
