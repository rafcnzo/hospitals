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
        <header class="header header-6">
            <div class="navbar-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg">
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    <img src="{{ asset('logo.png') }}" alt="Ratatouille Hospital" />
                                </a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent6" aria-controls="navbarSupportedContent6"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                    <span class="toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent6">
                                    <ul id="nav6" class="navbar-nav ms-auto">
                                        <li class="nav-item">
                                            <a class="page-scroll active" href="#home">Beranda</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="#struktur">Struktur Organisasi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="#visi-misi">Visi & Misi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="page-scroll" href="#contact">Kontak</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="header-action d-flex align-items-center ms-4">
                                    @if (Route::has('login'))
                                        @auth
                                            <a href="{{ url('/dashboard') }}" class="btn btn-primary radius-30" title="Dashboard">
                                                <i class="fas fa-th-large me-1"></i> Dashboard
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-outline-primary radius-30 me-2" title="Masuk">
                                                <i class="fas fa-sign-in-alt me-1"></i> Masuk
                                            </a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="btn btn-primary radius-30" title="Daftar">
                                                    <i class="fas fa-user-plus me-1"></i> Daftar
                                                </a>
                                            @endif
                                        @endauth
                                    @endif
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>

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
</body>

</html>
