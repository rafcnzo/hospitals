<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
            <div class="header-datetime d-none d-md-flex align-items-center ms-3">
                <i class="bi bi-calendar3 me-2"></i>
                <span id="currentDate">Sabtu, 18 Oktober 2025</span>
                <i class="bi bi-clock ms-3 me-2"></i>
                <span id="currentTime">13:01:05</span>
            </div>
            <div class="top-menu ms-auto">

                {{-- Notifikasi pembayaran H-3 jatuh tempo, status != lunas (statik dulu, non fungsional) --}}
                <div class="dropdown notif-dropdown me-3">
                    <a href="#" class="nav-link position-relative" data-bs-toggle="dropdown" aria-expanded="false" id="notifDropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-danger notif-badge">2</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="notifDropdown" style="min-width: 300px;">
                        <li class="dropdown-header px-3 pt-2 pb-2 fw-semibold">Notifikasi Pembayaran Jatuh Tempo H-3</li>
                        <li>
                            <a class="dropdown-item d-flex align-items-start" href="#">
                                <div class="me-2">
                                    <i class="bi bi-exclamation-triangle text-warning"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <b>PO #1234</b> - Supplier ABC
                                    </div>
                                    <div class="small text-muted">
                                        Jatuh tempo: 20 Okt 2025 | Status: 
                                        <span class="badge bg-danger">Belum Dibayar</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-start" href="#">
                                <div class="me-2">
                                    <i class="bi bi-exclamation-triangle text-warning"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div>
                                        <b>PO #1235</b> - Supplier XYZ
                                    </div>
                                    <div class="small text-muted">
                                        Jatuh tempo: 20 Okt 2025 | Status: 
                                        <span class="badge bg-warning text-dark">Sebagian Dibayar</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="user-box dropdown ms-3">
                @php
                    use Illuminate\Support\Facades\Auth;
                    $user = Auth::user();
                    $userName = $user?->name ?? 'User';
                    $userEmail = $user?->email ?? '-';
                    // API avatar inisial dari ui-avatars.com
                    $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=667eea&color=fff&rounded=true&size=64&bold=true';
                @endphp
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ $avatarUrl }}"
                        class="user-img" alt="user avatar">
                    <div class="user-info ps-2 mt-1">
                        <p class="user-name mb-0">{{ $userName }}</p>
                        <p class="designattion mb-0">{{ $userEmail }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-person"></i><span> Profil</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li>
                        <form method="POST" action="#">
                            <button type="submit" class="dropdown-item"
                                style="border: none !important; outline: none !important; box-shadow: none !important; background: none; padding-left: 15px; width: 100%; text-align: left;">
                                <i class="bi bi-box-arrow-right"></i><span> Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function updateClock() {
                const now = new Date();

                // 1. Format Tanggal (Contoh: "Sabtu, 18 Oktober 2025")
                const dateOptions = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const dateString = now.toLocaleDateString('id-ID', dateOptions);

                // 2. Format Waktu (Contoh: "13:01:05")
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                const timeString = `${hours}:${minutes}:${seconds}`;

                // 3. Terapkan ke HTML
                const dateEl = document.getElementById('currentDate');
                const timeEl = document.getElementById('currentTime');

                if (dateEl) {
                    dateEl.textContent = dateString;
                }
                if (timeEl) {
                    timeEl.textContent = timeString;
                }
            }

            // Panggil fungsi sekali saat halaman dimuat
            updateClock();

            // Atur agar fungsi updateClock dipanggil setiap detik
            setInterval(updateClock, 1000);
        });
    </script>
@endpush
