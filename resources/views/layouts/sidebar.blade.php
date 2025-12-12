<div class="sidebar-wrapper" id="sidebar" data-simplebar="true">
    <div class="sidebar-header d-flex align-items-center">
        <div class="d-flex align-items-center" style="gap: 1rem;">
            <button type="button" class="btn p-0" id="sidebar-toggle-btn" style="cursor: pointer; background: transparent; border: none;" aria-label="Toggle Sidebar">
                <img src="{{ asset('logo.png') }}" alt="logo" style="display: block; max-width: 120px;">
            </button>
            <span class="sidebar-label fw-bold" style="font-size: 1rem; color: #0d6efd !important;">Ratatouille Hospital</span>
        </div>
    </div>
    <ul class="metismenu" id="menu">
        <li class="mb-1">
            <a href="{{ url('dashboard') }}">
                <div class="parent-icon"><i class="bi bi-speedometer2"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        
        @role('admin')
        <li class="mb-1">
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-hospital"></i></div>
                <div class="menu-title">Data Master</div>
            </a>
            <ul>
                <li class="mb-1">
                    <a href="{{ route('admin.kategori.index') }}"><i class="bi bi-tags"></i>Kategori</a>
                </li>
                <li class="mb-1">
                    <a href="{{ route('admin.kategori-klinis.index') }}"><i class="bi bi-heart-pulse"></i>Kategori Klinis</a>
                </li>
                <li class="mb-1">
                    <a href="{{ route('admin.kode-tindakan-terapi.index') }}"><i class="bi bi-file-medical"></i>Kode Tindakan Terapi</a>
                </li>
            </ul>
        </li>
        @endrole

        @role('admin')
        <li class="mb-1">
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-flower2"></i></div>
                <div class="menu-title">Data Master Hewan</div>
            </a>
            <ul>
                <li class="mb-1">
                    <a href="{{ route('admin.jenis-hewan.index') }}"><i class="bi bi-flower2"></i>Jenis Hewan</a>
                </li>
                <li class="mb-1">
                    <a href="{{ route('admin.ras-hewan.index') }}"><i class="bi bi-tags-fill"></i>Ras Hewan</a>
                </li>
            </ul>
        </li>
        @endrole

        @role('admin')
        <li class="mb-1">
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-heart"></i></div>
                <div class="menu-title">Manajemen Pet</div>
            </a>
            <ul>
                <li class="mb-1">
                    <a href="{{ route('admin.pemilik.index') }}"><i class="bi bi-people"></i>Pemilik</a>
                </li>
                <li class="mb-1">
                    <a href="{{ route('admin.pet.index') }}"><i class="bi bi-heart-fill"></i>Pet</a>
                </li>
            </ul>
        </li>
        @endrole

        @hasanyrole('admin|dokter')
        <li class="mb-1">
            <a href="{{ route('admin.rekam-medis.index') }}">
                <div class="parent-icon"><i class="bi bi-file-medical-fill"></i></div>
                <div class="menu-title">Rekam Medis</div>
            </a>
        </li>
        @endhasanyrole

        @role('admin')
        <li class="mb-1">
            <a href="#" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-person-gear"></i></div>
                <div class="menu-title">User Management</div>
            </a>
            <ul>
                <li class="mb-1">
                    <a href="{{ route('admin.users.index') }}"><i class="bi bi-person-check"></i>User
                        Authorization</a>
                </li>
                <li class="mb-1">
                    <a href="{{ route('admin.roles.index') }}"><i class="bi bi-shield-lock"></i>Roles & Permission</a>
                </li>
            </ul>
        </li>
        @endrole
    </ul>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var searchInput = document.getElementById('sidebar-search-input');
            var menu = document.getElementById('menu');
            if (searchInput && menu) {
                searchInput.addEventListener('input', function() {
                    var filter = searchInput.value.toLowerCase();
                    var items = menu.querySelectorAll('li.mb-1');
                    items.forEach(function(li) {
                        var text = li.innerText.toLowerCase();
                        if (filter === "") {
                            li.style.display = '';
                        } else if (text.indexOf(filter) !== -1) {
                            li.style.display = '';
                        } else {
                            li.style.display = 'none';
                        }
                    });
                });
            }
        });
    </script>
@endpush
