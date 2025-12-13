@extends('layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title-wrapper">
                        <div class="page-icon"><i class="bi bi-shield-lock"></i></div>
                        <div>
                            <h1 class="page-title">Manajemen Role</h1>
                            <p class="page-subtitle">Kelola role sistem</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="data-card">
                <ul class="nav nav-tabs mb-3" id="rolePermissionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-role" data-bs-toggle="tab" data-bs-target="#tabContentRole"
                            type="button" role="tab" aria-controls="tabContentRole" aria-selected="true">
                            <i class="bi bi-person-badge"></i> Role
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-permission" data-bs-toggle="tab"
                            data-bs-target="#tabContentPermission" type="button" role="tab"
                            aria-controls="tabContentPermission" aria-selected="false">
                            <i class="bi bi-key"></i> Permission
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="rolePermissionTabsContent">
                    <!-- Role Tab Content -->
                    <div class="tab-pane fade show active" id="tabContentRole" role="tabpanel" aria-labelledby="tab-role">
                        <div class="data-card-header d-flex justify-content-between align-items-center">
                            <div class="data-card-title">
                                <i class="bi bi-list-ul"></i>
                                <span>Daftar Role</span>
                            </div>
                            <button class="btn-add-primary" id="btnTambahRole">
                                <i class="bi bi-plus-circle"></i> Tambah Role
                            </button>
                        </div>
                        <div class="data-card-body">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Role</th>
                                        <th>Permission Akses</th> {{-- Tambah kolom info --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $i => $role)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @if ($role->permissions_count > 0)
                                                    <span class="badge bg-info">{{ $role->permissions_count }}
                                                        Permission</span>
                                                @else
                                                    <span class="text-muted small">Tidak ada akses</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn-action btn-edit btnEditRole"
                                                    data-id="{{ $role->id }}"><i class="bi bi-pencil"></i></button>
                                                <button class="btn-action btn-delete btnHapusRole"
                                                    data-id="{{ $role->id }}"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Role Tab Content -->

                    <!-- Permission Tab Content -->
                    <div class="tab-pane fade" id="tabContentPermission" role="tabpanel" aria-labelledby="tab-permission">
                        <div class="data-card-header d-flex justify-content-between align-items-center">
                            <div class="data-card-title">
                                <i class="bi bi-list-ul"></i>
                                <span>Daftar Permission</span>
                            </div>
                            <button class="btn-add-primary" id="btnTambahPermission">
                                <i class="bi bi-plus-circle"></i> Tambah Permission
                            </button>
                        </div>
                        <div class="data-card-body">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Permission</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $i => $p)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $p->name }}</td>
                                            <td>
                                                <button class="btn-action btn-edit btnEditPermission"
                                                    data-id="{{ $p->id }}" data-name="{{ $p->name }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn-action btn-delete btnHapusPermission"
                                                    data-id="{{ $p->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($permissions->count() == 0)
                                        <tr>
                                            <td colspan="3" class="empty-state">
                                                <div class="empty-content">
                                                    <i class="bi bi-shield-slash"></i>
                                                    <h4>Belum ada permission</h4>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Permission Tab Content -->
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalRole">
            <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Pakai modal-lg biar lega --}}
                <div class="modal-content custom-modal">
                    <form id="formRole">
                        @csrf
                        <input type="hidden" id="role_id">

                        <div class="modal-header custom-modal-header">
                            <h5 class="modal-title">Tambah Role</h5>
                            <button type="button" class="btn-close-custom" data-bs-dismiss="modal"><i
                                    class="bi bi-x"></i></button>
                        </div>

                        <div class="modal-body custom-modal-body">
                            <div id="formAlert"></div>

                            {{-- Nama Role --}}
                            <div class="form-group-custom mb-4">
                                <label class="form-label-custom required"><i class="bi bi-shield-lock"></i> Nama
                                    Role</label>
                                <input type="text" class="form-control-custom" id="role_name" name="nama_role" required
                                    placeholder="Contoh: admin, staff">
                            </div>

                            {{-- LIST CHECKBOX PERMISSION --}}
                            <div class="form-group-custom">
                                <label class="form-label-custom mb-2"><i class="bi bi-key"></i> Pilih Hak Akses
                                    (Permission)</label>
                                <div class="p-3 border rounded bg-light" style="max-height: 300px; overflow-y: auto;">
                                    <div class="row">
                                        {{-- Kita loop variable $permissions yang dikirim dari controller --}}
                                        @foreach ($permissions as $perm)
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    {{-- Name harus array permissions[] agar bisa ditangkap controller --}}
                                                    <input class="form-check-input check-permission" type="checkbox"
                                                        name="permissions[]" value="{{ $perm->name }}"
                                                        id="perm_{{ $perm->id }}">
                                                    <label class="form-check-label" for="perm_{{ $perm->id }}">
                                                        {{ $perm->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-text mt-1 text-muted">Centang permission yang ingin diberikan ke role ini.
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer custom-modal-footer">
                            <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn-primary-custom" id="btnSimpanRole"><i
                                    class="bi bi-check"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Permission --}}
        <div class="modal fade" id="modalPermission">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custom-modal">

                    <form id="formPermission">
                        @csrf
                        <input type="hidden" id="permission_id">

                        <div class="modal-header custom-modal-header">
                            <h5 class="modal-title">Tambah Permission</h5>
                            <button type="button" class="btn-close-custom" data-bs-dismiss="modal"><i
                                    class="bi bi-x"></i></button>
                        </div>

                        <div class="modal-body custom-modal-body">
                            <div id="formAlertPermission"></div>

                            <div class="form-group-custom">
                                <label class="form-label-custom required"><i class="bi bi-key"></i> Nama
                                    Permission</label>
                                <input type="text" class="form-control-custom" id="permission_name" required>
                            </div>
                        </div>

                        <div class="modal-footer custom-modal-footer">
                            <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                                <i class="bi bi-x"></i> Batal
                            </button>
                            <button type="submit" class="btn-primary-custom" id="btnSimpanPermission">
                                <i class="bi bi-check"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        window.addEventListener('app-libraries-loaded', function() {
            const $ = window.jQuery;

            const modalEl = document.getElementById('modalRole');
            const modalRole = new window.bootstrap.Modal(modalEl);
            const $form = $('#formRole');
            const $alert = $('#formAlert');
            const $btnSimpan = $('#btnSimpanRole');
            const $name = $('#role_name');
            const $checkboxes = $('.check-permission');

            function resetForm() {
                $form[0].reset();
                $('#role_id').val('');
                $alert.html('');
                $('#formRole .modal-title').text('Tambah Role');
                $btnSimpan.html('<i class="bi bi-check"></i> Simpan').prop('disabled', false);
                $checkboxes.prop('checked', false);
            }

            // Tambah Role
            $('#btnTambahRole').on('click', function() {
                resetForm();
                modalRole.show();
            });

            $(document).on('click', '.btnEditRole', function() {
                resetForm();
                const id = $(this).data('id');

                $('#formRole .modal-title').text('Edit Role');
                $('#role_id').val(id);

                // Tambahkan loading visual jika perlu
                $btnSimpan.prop('disabled', true).html(
                    '<i class="bi bi-arrow-repeat bx-spin"></i> Memuat...');

                $.ajax({
                    // URL ini akan memanggil method 'edit' di Controller yang me-return JSON
                    url: `/admin/roles/${id}`,
                    type: 'GET',
                    success: function(res) {
                        $btnSimpan.prop('disabled', false).html(
                            '<i class="bi bi-check"></i> Simpan');

                        const d = res.data; // Data Role
                        const perms = res.rolePermissions; // Array permission names

                        $name.val(d.name); // Isi nama role

                        // Loop checkbox permission
                        $checkboxes.each(function() {
                            let val = $(this).val();
                            // Jika nama permission ada di array perms, centang checkbox
                            if (perms.includes(val)) {
                                $(this).prop('checked', true);
                            } else {
                                $(this).prop('checked', false);
                            }
                        });

                        modalRole.show();
                    },
                    error: function() {
                        $btnSimpan.prop('disabled', false).html(
                            '<i class="bi bi-check"></i> Simpan');
                        Swal.fire('Error', 'Gagal memuat data role.', 'error');
                    }
                });
            });

            // Hapus Role
            $(document).on('click', '.btnHapusRole', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Hapus Role?',
                    text: 'Role akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.roles.destroy') }}",
                            type: 'POST',
                            data: {
                                id: id,
                                _method: 'DELETE'
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(res) {
                                Swal.fire('Berhasil', res.message, 'success').then(() =>
                                    window.location.reload());
                            },
                            error: function(xhr) {
                                Swal.fire('Error', xhr.responseJSON?.message ||
                                    'Gagal menghapus.', 'error');
                            }
                        });
                    }
                });
            });

            // Submit Create/Update Role
            $form.on('submit', function(e) {
                e.preventDefault();
                $alert.html('');

                const id = $('#role_id').val();
                const isEdit = id !== '';
                const url = isEdit ? `/admin/roles/${id}` : "{{ route('admin.roles.store') }}";
                const method = isEdit ? 'PUT' : 'POST';

                // Gunakan serialize() agar array permissions[] ikut terkirim otomatis
                const formData = $form.serialize() + `&_method=${method}`;

                $btnSimpan.prop('disabled', true).html(
                    '<i class="bi bi-arrow-repeat bx-spin"></i> Menyimpan...');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        Swal.fire('Berhasil', res.message, 'success').then(() => window.location
                            .reload());
                    },
                    error: function(xhr) {
                        $btnSimpan.prop('disabled', false).html(
                            '<i class="bi bi-check"></i> Simpan');
                        if (xhr.status === 422) {
                            let html =
                                `<div class="alert-custom alert-danger"><i class="bi bi-exclamation-triangle"></i><div>`;
                            let errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(k => html += `<div>${errors[k]}</div>`);
                            html += `</div></div>`;
                            $alert.html(html);
                        } else {
                            Swal.fire('Error', xhr.responseJSON?.message ||
                                'Gagal menyimpan role.', 'error');
                        }
                    }
                });
            });

            // ---- PERMISSION SECTION ----
            const modalPermissionEl = document.getElementById('modalPermission');
            const modalPermission = new window.bootstrap.Modal(modalPermissionEl);

            const $formPermission = $('#formPermission');
            const $alertPermission = $('#formAlertPermission');
            const $btnTambahPermission = $('#btnTambahPermission');
            const $btnSimpanPermission = $('#btnSimpanPermission');
            const $namePermission = $('#permission_name');

            function resetFormPermission() {
                $formPermission[0].reset();
                $('#permission_id').val('');
                $alertPermission.html('');
                $('#formPermission .modal-title').text('Tambah Permission');
                $btnSimpanPermission.html('<i class="bi bi-check"></i> Simpan').prop('disabled', false);
            }

            // Tambah Permission
            $btnTambahPermission.on('click', function() {
                resetFormPermission();
                modalPermission.show();
            });

            // Edit Permission
            $(document).on('click', '.btnEditPermission', function() {
                resetFormPermission();

                const id = $(this).data('id');

                $('#formPermission .modal-title').text('Edit Permission');
                $('#permission_id').val(id);

                $.ajax({
                    url: `/admin/permissions/${id}`,
                    type: 'GET',
                    success: function(res) {
                        const d = res.data;
                        $namePermission.val(d.name);
                        modalPermission.show();
                    },
                    error: function() {
                        Swal.fire('Error', 'Gagal memuat data permission.', 'error');
                    }
                });
            });

            // Hapus Permission
            $(document).on('click', '.btnHapusPermission', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus Permission?',
                    text: 'Permission akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (!result.isConfirmed) return;

                    $.ajax({
                        url: "{{ url('admin/permissions') }}",
                        type: 'DELETE',
                        data: {
                            id: id,
                            _method: 'DELETE'
                        },
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content,
                        },
                        success: function(res) {
                            Swal.fire('Berhasil', res.message, 'success')
                                .then(() => window.location.reload());
                        },
                        error: function(xhr) {
                            let msg = xhr.responseJSON?.message ||
                                'Gagal menghapus permission.';
                            Swal.fire('Error', msg, 'error');
                        }
                    });
                });
            });

            // Submit Create/Update Permission
            $formPermission.on('submit', function(e) {
                e.preventDefault();
                $alertPermission.html('');

                const id = $('#permission_id').val();
                const isEdit = id !== '';

                const url = isEdit ? `/admin/permissions/${id}` : "{{ url('admin/permissions') }}";
                const method = isEdit ? 'PUT' : 'POST';

                const payload = {
                    name: $namePermission.val(),
                    _method: method
                };

                $btnSimpanPermission.prop('disabled', true)
                    .html('<i class="bi bi-arrow-repeat bx-spin"></i> Menyimpan...');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: payload,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    success: function(res) {
                        Swal.fire('Berhasil', res.message, 'success')
                            .then(() => window.location.reload());
                    },
                    error: function(xhr) {
                        $btnSimpanPermission.prop('disabled', false)
                            .html('<i class="bi bi-check"></i> Simpan');

                        if (xhr.status === 422) {
                            let html =
                                `<div class="alert-custom alert-danger"><i class="bi bi-exclamation-triangle"></i><div>`;
                            let errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(k => html += `<div>${errors[k]}</div>`);
                            html += `</div></div>`;
                            $alertPermission.html(html);
                        } else {
                            Swal.fire('Error', xhr.responseJSON?.message ||
                                'Gagal menyimpan permission.', 'error');
                        }
                    }
                });
            });
        });
    </script>
@endpush
