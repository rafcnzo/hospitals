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
