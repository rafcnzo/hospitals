<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Ratatouille Hospital')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('app.css') }}">

    <style>
        /* Paksa body memenuhi layar dengan warna abu */
        body {
            background-color: #f5f7fb;
            overflow-x: hidden;
        }

        /* Pastikan Sidebar Fixed Penuh */
        .sidebar-wrapper {
            position: fixed !important;
            top: 0;
            left: 0;
            height: 100vh;
            z-index: 1000;
        }

        /* Pastikan Header Fixed Penuh di Atas */
        header,
        .topbar {
            position: fixed !important;
            top: 0;
            right: 0;
            height: 60px !important;
            z-index: 999;
        }

        /* PERBAIKAN UTAMA: Gunakan Padding, Hapus Margin */
        .page-wrapper {
            margin-top: 0 !important;
            padding-top: 65px !important;
            min-height: 100vh;
            position: relative;
        }

        /* Pastikan konten tidak ada margin aneh di atas */
        .page-content {
            padding: 1.5rem !important;
        }

        .container-fluid {
            padding: 0 !important;
        }

        /* Loading Overlay Style */
        #pageLoadingOverlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #fff;
            z-index: 99999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.3s, visibility 0.3s;
        }
    </style>
    @yield('style')
</head>

<body>
    <div id="pageLoadingOverlay">
        <div class="text-center">
            <div class="spinner-border text-primary" role="status"></div>
            <p class="mt-2 text-muted fw-bold">Memuat...</p>
        </div>
    </div>

    <div class="wrapper">

        @include('layouts.sidebar')

        @include('layouts.header')

        <div class="page-wrapper">
            @yield('content')
        </div>

        <div class="overlay toggle-icon"></div>

        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

        @include('layouts.footer')

    </div>

    <script>
        function showLoading(message = 'Memuat data...') {
            const overlay = document.getElementById('pageLoadingOverlay');
            if (overlay) {
                const textEl = overlay.querySelector('.loading-text');
                if (textEl) textEl.textContent = message;
                overlay.classList.remove('hidden');
            }
        }

        function hideLoading() {
            const overlay = document.getElementById('pageLoadingOverlay');
            if (overlay) {
                overlay.classList.add('hidden');
            }
        }

        // Auto hide saat page selesai load
        window.addEventListener('load', function() {
            setTimeout(() => {
                hideLoading();
            }, 300);
        });

        // Show loading saat navigasi ke halaman lain
        document.addEventListener('DOMContentLoaded', function() {
            // Show loading saat klik link navigasi
            const links = document.querySelectorAll('a:not([target="_blank"]):not([href^="#"]):not(.no-loading)');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href && !href.startsWith('javascript:') && !href.startsWith('#')) {
                        showLoading('Memuat halaman...');
                    }
                });
            });
        });
    </script>
    <script>
        window.addEventListener('load', function() {
            const overlay = document.getElementById('pageLoadingOverlay');
            if (overlay) {
                setTimeout(() => {
                    overlay.style.opacity = '0';
                    overlay.style.visibility = 'hidden';
                }, 300);
            }
        });
    </script>
    @stack('script')
</body>

</html>
