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
                            <p class="page-subtitle">Kelola role dan permission</p>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs mb-3" id="rolePermissionTabs">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-roles">
                        <i class="bi bi-shield-lock"></i> Roles
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-permissions">
                        <i class="bi bi-key-fill"></i> Permissions
                    </button>
                </li>
            </ul>

            <div class="data-card">
                <div class="tab-content">
                    <!-- Tab Roles -->
                    <div class="tab-pane fade show active" id="tab-roles">
                        <div class="data-card-header">
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
                                        <th class="col-number">#</th>
                                        <th class="col-main">Role</th>
                                        <th class="col-secondary">Permissions</th>
                                        <th class="col-action">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $i => $role)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach ($role->permissions as $p)
                                                    <span class="badge bg-info">{{ $p->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                <button class="btn-action btn-edit btnEditRole"
                                                    data-id="{{ $role->id }}" data-name="{{ $role->name }}"
                                                    data-permissions="{{ json_encode($role->permissions->pluck('name')) }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn-action btn-delete btnHapusRole"
                                                    data-id="{{ $role->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($roles->count() == 0)
                                        <tr>
                                            <td colspan="4" class="empty-state">
                                                <div class="empty-content">
                                                    <i class="bi bi-shield-slash"></i>
                                                    <h4>Belum ada role</h4>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Tab Roles -->

                    <!-- Tab Permissions -->
                    <div class="tab-pane fade" id="tab-permissions">
                        <div class="data-card">
                            <div class="data-card-header d-flex justify-content-between align-items-center">
                                <div class="data-card-title">
                                    <i class="bi bi-key"></i> <span>Daftar Permission</span>
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
                    </div>
                    <!-- End Tab Permissions -->
                </div>
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="modalRole">
                <div class="modal-dialog modal-dialog-centered">
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

                                <div class="form-group-custom">
                                    <label class="form-label-custom required"><i class="bi bi-shield-lock"></i> Nama
                                        Role</label>
                                    <input type="text" class="form-control-custom" id="role_name" required>
                                </div>

                                <div class="form-group-custom">
                                    <label for="role_permissions" class="form-label-custom">
                                        <i class="bi bi-key-fill"></i> Izin Akses (Permissions)
                                    </label>
                                    <select class="form-control-custom" id="role_permissions" name="permissions[]" required
                                        multiple="multiple" style="width: 100%">
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="modal-footer custom-modal-footer">
                                <button class="btn-secondary-custom" data-bs-dismiss="modal"><i class="bi bi-x"></i>
                                    Batal</button>
                                <button class="btn-primary-custom" id="btnSimpanRole"><i class="bi bi-check"></i>
                                    Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalPermission">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content custom-modal">

                        <form id="formPermission">
                            @csrf
                            <input type="hidden" id="permission_id">

                            <div class="modal-header custom-modal-header">
                                <h5 class="modal-title">Tambah Permission</h5>
                                <button type="button" class="btn-close-custom" data-bs-dismiss="modal">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>

                            <div class="modal-body custom-modal-body">
                                <div id="permissionAlert"></div>

                                <div class="form-group-custom">
                                    <label class="form-label-custom required">
                                        <i class="bi bi-key"></i> Nama Permission
                                    </label>
                                    <input type="text" id="permission_name" class="form-control-custom" required>
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
        @endsection
        @push('script')
            <script>
                window.addEventListener('app-libraries-loaded', function() {
                    const $ = window.jQuery;

                    const modalEl = document.getElementById('modalRole');
                    const modalRole = new window.bootstrap.Modal(modalEl);

                    const $form = $('#formRole');
                    const $alert = $('#formAlert');
                    const $btnTambah = $('#btnTambahRole');
                    const $btnSimpan = $('#btnSimpanRole');
                    const $name = $('#role_name');
                    const $permissions = $('#role_permissions');
                    const modalPermission = new window.bootstrap.Modal(document.getElementById('modalPermission'));
                    const $formP = $('#formPermission');
                    const $alertP = $('#permissionAlert');
                    const $nameP = $('#permission_name');
                    const $btnSaveP = $('#btnSimpanPermission');

                    function resetForm() {
                        $form[0].reset();
                        $('#role_id').val('');
                        $permissions.val(null).trigger('change');
                        $alert.html('');
                        $('.modal-title').text('Tambah Role');
                        $btnSimpan.html('<i class="bi bi-check"></i> Simpan').prop('disabled', false);
                    }

                    function showError(message) {
                        $alert.html(`
                            <div class="alert-custom alert-danger">
                                <i class="bi bi-exclamation-triangle"></i>
                                <div>${message}</div>
                            </div>
                        `);
                    }

                    // Tambah Role
                    $btnTambah.on('click', function() {
                        resetForm();
                        modalRole.show();
                    });

                    // Edit Role
                    $(document).on('click', '.btnEditRole', function() {
                        resetForm();

                        const id = $(this).data('id');

                        $('.modal-title').text('Edit Role');
                        $('#role_id').val(id);

                        // Load dari controller
                        $.ajax({
                            url: `/admin/roles/${id}`,
                            type: 'GET',
                            success: function(res) {
                                const d = res.data;

                                $name.val(d.name);
                                $permissions.val(d.permissions).trigger('change');

                                modalRole.show();
                            },
                            error: function() {
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
                            cancelButtonText: 'Batal',
                        }).then((result) => {
                            if (!result.isConfirmed) return;

                            $.ajax({
                                url: "{{ route('admin.roles.destroy') }}",
                                type: 'POST',
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
                                        'Gagal menghapus role.';
                                    Swal.fire('Error', msg, 'error');
                                }
                            });
                        });
                    });

                    // Submit Create/Update
                    $form.on('submit', function(e) {
                        e.preventDefault();
                        $alert.html('');

                        const id = $('#role_id').val();
                        const isEdit = id !== '';

                        const url = isEdit ? `/admin/roles/${id}` : "{{ route('admin.roles.store') }}";
                        const method = isEdit ? 'PUT' : 'POST';

                        const payload = {
                            name: $name.val(),
                            permissions: $permissions.val(),
                            _method: method
                        };

                        $btnSimpan.prop('disabled', true)
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
                                $btnSimpan.prop('disabled', false)
                                    .html('<i class="bi bi-check"></i> Simpan');

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

                    function resetPermissionForm() {
                        $formP[0].reset();
                        $('#permission_id').val('');
                        $alertP.html('');
                        $('.modal-title', '#modalPermission').text('Tambah Permission');
                        $btnSaveP.prop('disabled', false).html('<i class="bi bi-check"></i> Simpan');
                    }

                    $(document).on('click', '#btnTambahPermission', function() {
                        resetPermissionForm();
                        modalPermission.show();
                    });

                    // Edit Permission
                    $(document).on('click', '.btnEditPermission', function() {
                        resetPermissionForm();

                        const id = $(this).data('id');
                        $('#permission_id').val(id);

                        $.get(`/admin/permissions/${id}`, function(res) {
                            $nameP.val(res.data.name);
                            $('.modal-title', '#modalPermission').text('Edit Permission');
                            modalPermission.show();
                        });
                    });

                    // Delete Permission
                    $(document).on('click', '.btnHapusPermission', function() {
                        const id = $(this).data('id');

                        Swal.fire({
                            title: 'Hapus Permission?',
                            text: 'Permission akan dihapus permanen.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, hapus'
                        }).then(r => {
                            if (!r.isConfirmed) return;

                            $.ajax({
                                url: "{{ route('admin.permissions.destroy') }}",
                                type: "POST",
                                data: {
                                    id: id,
                                    _method: "DELETE"
                                },
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')
                                        .content
                                },
                                success: res => {
                                    Swal.fire("Berhasil", res.message, "success")
                                        .then(() => location.reload());
                                }
                            });
                        });
                    });

                    // Submit Permission
                    $formP.on('submit', function(e) {
                        e.preventDefault();

                        const id = $('#permission_id').val();
                        const isEdit = id !== '';

                        const url = isEdit ?
                            `/admin/permissions/${id}` :
                            "{{ route('admin.permissions.store') }}";

                        const method = isEdit ? "PUT" : "POST";

                        $btnSaveP.prop('disabled', true).html(
                            '<i class="bi bi-arrow-repeat bx-spin"></i> Menyimpan...');

                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {
                                name: $nameP.val(),
                                _method: method
                            },
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                            },
                            success: res => {
                                Swal.fire("Berhasil", res.message, "success")
                                    .then(() => location.reload());
                            },
                            error: xhr => {
                                $btnSaveP.prop('disabled', false).html(
                                    '<i class="bi bi-check"></i> Simpan');

                                if (xhr.status === 422) {
                                    $alertP.html(`
                    <div class="alert-custom alert-danger">
                        <i class="bi bi-exclamation-triangle"></i>
                        ${xhr.responseJSON.errors.name}
                    </div>
                `);
                                }
                            }
                        });
                    });
                });
            </script>
        @endpush
