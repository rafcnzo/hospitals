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
                                    <a class="page-scroll" href="{{ url('/#home') }}">Beranda</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="{{ url('/#struktur') }}">Struktur Organisasi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="{{ url('/#visi-misi') }}">Visi & Misi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="page-scroll" href="{{ url('/#contact') }}">Kontak</a>
                                </li>
                            </ul>
                        </div>

                        <div class="header-action">
                            @if (Route::has('login'))
                                @auth
                                    {{-- Menu untuk user yang sudah login --}}
                                    <div class="dropdown">
                                        <div class="user-badge" data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="user-avatar">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </div>
                                            <div class="user-info">
                                                <span class="user-name">{{ Str::limit(Auth::user()->name, 15) }}</span>
                                                <span class="user-role">
                                                    {{ ucfirst(Auth::user()->roles->first()?->name ?? 'User') }}
                                                </span>
                                            </div>
                                            <i class="fas fa-chevron-down"></i>
                                        </div>

                                        <ul class="dropdown-menu dropdown-menu-end">
                                            {{-- Menu Dashboard untuk semua role --}}
                                            @role('admin')
                                                <li>
                                                    <a class="dropdown-item" href="{{ url('/dashboard') }}">
                                                        <i class="fas fa-th-large"></i> Dashboard
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                            @endrole

                                            {{-- Menu khusus untuk role pemilik --}}
                                            @role('pemilik')
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('pemilik.profile.index') }}">
                                                        <i class="fas fa-user"></i> Profil Saya
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="{{ route('pemilik.profile.index') }}">
                                                        <i class="fas fa-paw"></i> Hewan Peliharaan
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item" href="{{ route('pemilik.jadwal-temu.index') }}">
                                                        <i class="fas fa-calendar-alt"></i> Jadwal Temu
                                                        @if (isset($upcomingAppointments) && $upcomingAppointments > 0)
                                                            <span
                                                                class="badge bg-success ms-auto">{{ $upcomingAppointments }}</span>
                                                        @endif
                                                    </a>
                                                </li>
                                            @endrole

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fas fa-cog"></i> Pengaturan
                                                </a>
                                            </li>

                                            <li>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-sign-out-alt"></i> Keluar
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    {{-- Tombol Login & Register untuk guest --}}
                                    <a href="{{ route('login') }}" class="btn btn-outline-primary" title="Masuk">
                                        <i class="fas fa-sign-in-alt me-1"></i> Masuk
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-primary" title="Daftar">
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
