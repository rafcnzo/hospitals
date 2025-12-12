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
                                <th class="col-main">Nama Role</th>
                                <th class="col-secondary">Jumlah User</th>
                                <th class="col-action">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $i => $role)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $role->nama_role }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $role->users_count }} user</span>
                                    </td>
                                    <td>
                                        <button class="btn-action btn-edit btnEditRole"
                                            data-id="{{ $role->idrole }}" 
                                            data-nama="{{ $role->nama_role }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn-action btn-delete btnHapusRole"
                                            data-id="{{ $role->idrole }}">
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
                            </div>

                            <div class="modal-footer custom-modal-footer">
                                <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal"><i class="bi bi-x"></i>
                                    Batal</button>
                                <button type="submit" class="btn-primary-custom" id="btnSimpanRole"><i class="bi bi-check"></i>
                                    Simpan</button>
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

                    function resetForm() {
                        $form[0].reset();
                        $('#role_id').val('');
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
                                $name.val(d.nama_role);
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
                            nama_role: $name.val(),
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
                });
            </script>
        @endpush
