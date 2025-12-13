@extends('layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title-wrapper">
                        <div class="page-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Manajemen User</h1>
                            <p class="page-subtitle">Kelola akun user aplikasi</p>
                        </div>
                    </div>
                    <button class="btn-add-primary" id="btnTambahUser">
                        <i class="bi bi-plus-circle"></i>
                        <span>Tambah User</span>
                    </button>
                </div>
            </div>

            <div class="data-card">
                <div class="data-card-header">
                    <div class="data-card-title">
                        <i class="bi bi-list-ul"></i>
                        <span>Daftar User</span>
                    </div>
                </div>
                <div class="data-card-body">
                    <div class="table-container">
                        <table class="data-table" id="tabel-users">
                            <thead>
                                <tr>
                                    <th class="col-number">#</th>
                                    <th class="col-main">Nama</th>
                                    <th class="col-secondary">Email</th>
                                    <th class="col-secondary">Role</th>
                                    <th class="col-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $i => $user)
                                    <tr class="data-row">
                                        <td class="col-number">
                                            <span class="row-number">{{ $i + 1 }}</span>
                                        </td>
                                        <td class="col-main">
                                            <div class="item-info">
                                                <span class="item-name">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="col-secondary">
                                            <span class="badge-unit">{{ $user->email }}</span>
                                        </td>
                                        <td class="col-secondary">
                                            {{-- PERBAIKAN 1: Gunakan $role->name --}}
                                            @foreach ($user->roles as $role)
                                                <span class="badge bg-info">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="col-action">
                                            <div class="action-buttons">
                                                {{-- PERBAIKAN 2: pluck('name') untuk data roles --}}
                                                <button class="btn-action btn-edit btnEditUser"
                                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                    data-email="{{ $user->email }}"
                                                    data-roles="{{ json_encode($user->roles->pluck('name')) }}"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn-action btn-delete btnHapusUser"
                                                    data-id="{{ $user->id }}" data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($users->count() == 0)
                                    <tr>
                                        <td colspan="5" class="empty-state">
                                            <div class="empty-content">
                                                <i class="bi bi-people"></i>
                                                <h4>Belum ada data user</h4>
                                                <p>Klik tombol "Tambah User" untuk memulai</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="modalUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal">
                <form id="formUser">
                    @csrf
                    <input type="hidden" name="id" id="user_id">
                    <div class="modal-header custom-modal-header">
                        <div class="modal-header-content">
                            <div class="modal-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            <h5 class="modal-title" id="modalUserLabel">Tambah User</h5>
                        </div>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Tutup">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <div id="formUserAlert"></div>
                        <div class="form-group-custom">
                            <label for="user_name" class="form-label-custom required">
                                <i class="bi bi-person-badge"></i> Nama
                            </label>
                            <input type="text" class="form-control-custom" id="user_name" name="name" required>
                        </div>
                        <div class="form-group-custom">
                            <label for="user_email" class="form-label-custom required">
                                <i class="bi bi-envelope"></i> Email
                            </label>
                            <input type="email" class="form-control-custom" id="user_email" name="email" required>
                        </div>
                        <div class="form-group-custom">
                            <label for="user_password" class="form-label-custom">
                                <i class="bi bi-key"></i> Password
                                <span id="passwordHelp" class="text-muted"></span>
                            </label>
                            <input type="password" class="form-control-custom" id="user_password" name="password">
                        </div>
                        <div class="form-group-custom">
                            <label for="user_roles" class="form-label-custom required">
                                <i class="bi bi-person-gear"></i> Role
                            </label>
                            <select class="form-control-custom" id="user_roles" name="roles[]" required
                                multiple="multiple" style="width: 100%">
                                {{-- PERBAIKAN 3: Value dan Label menggunakan $role->name --}}
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer custom-modal-footer">
                        <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i> Batal
                        </button>
                        <button type="submit" class="btn-primary-custom" id="btnSimpanUser">
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

            const modalEl = document.getElementById('modalUser');
            const modalUser = new window.bootstrap.Modal(modalEl);
            const $form = $('#formUser');
            const $btnTambah = $('#btnTambahUser');
            const $btnSimpan = $('#btnSimpanUser');
            const $alert = $('#formUserAlert');
            const $password = $('#user_password');
            const $passwordHelp = $('#passwordHelp');
            const $rolesSelect = $('#user_roles');

            function resetForm() {
                $form[0].reset();
                $('#user_id').val('');
                $rolesSelect.val(null).trigger('change');
                $alert.html('');
                $passwordHelp.text('');
                $('#modalUserLabel').text('Tambah User');
                $btnSimpan.prop('disabled', false).html('<i class="bi bi-check"></i> Simpan');
            }

            function showFormError(message) {
                $alert.html(`
                <div class="alert-custom alert-danger">
                    <i class="bi bi-exclamation-triangle"></i>
                    <div>${message}</div>
                </div>
            `);
            }

            function showSwalError(message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: message || 'Terjadi kesalahan. Silakan coba lagi.'
                });
            }

            // Tambahkan fungsi loading helper jika belum ada global
            function showLoading(msg) {
                Swal.fire({
                    title: msg,
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });
            }

            function hideLoading() {
                Swal.close();
            }

            // Tombol "Tambah User"
            $btnTambah.on('click', function() {
                resetForm();
                modalUser.show();
            });

            // Tombol Edit
            $(document).on('click', '.btnEditUser', function() {
                resetForm();

                const id = $(this).data('id');
                const name = $(this).data('name');
                const email = $(this).data('email');
                const roles = $(this).data('roles') || [];

                $('#modalUserLabel').text('Edit User');
                $('#user_id').val(id);
                $('#user_name').val(name);
                $('#user_email').val(email);
                $passwordHelp.text('(kosongkan jika tidak ingin mengganti password)');

                // Trigger change agar jika pakai Select2, tampilannya update
                $rolesSelect.val(roles).trigger('change');

                modalUser.show();
            });

            // Tombol Hapus
            $(document).on('click', '.btnHapusUser', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus User?',
                    text: 'Data user ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (!result.isConfirmed) return;

                    showLoading('Menghapus user...');
                    $.ajax({
                        url: "{{ route('admin.users.destroy') }}",
                        type: 'POST',
                        data: {
                            id: id,
                            _method: 'DELETE'
                        },
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        success: function(res) {
                            hideLoading();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message || 'User berhasil dihapus.'
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            hideLoading();
                            let msg = 'Terjadi kesalahan saat menghapus user.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            showSwalError(msg);
                        }
                    });
                });
            });

            // Submit form (tambah / edit)
            $form.on('submit', function(e) {
                e.preventDefault();
                $alert.html('');

                const id = $('#user_id').val();
                const isEdit = !!id;

                const url = isEdit ?
                    "{{ url('admin/users') }}/" + id :
                    "{{ route('admin.users.store') }}";

                const method = isEdit ? 'PUT' : 'POST';

                const payload = {
                    name: $('#user_name').val(),
                    email: $('#user_email').val(),
                    password: $password.val(),
                    roles: $rolesSelect.val()
                };

                $btnSimpan.prop('disabled', true)
                    .html('<i class="bi bi-arrow-repeat bx-spin"></i> Menyimpan...');

                showLoading('Menyimpan data user...');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        ...payload,
                        _method: method
                    },
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    success: function(res) {
                        hideLoading();
                        $btnSimpan.prop('disabled', false)
                            .html('<i class="bi bi-check"></i> Simpan');

                        modalUser.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message || 'User berhasil disimpan.'
                        }).then(() => {
                            window.location.reload();
                        });
                    },
                    error: function(xhr) {
                        hideLoading();
                        $btnSimpan.prop('disabled', false)
                            .html('<i class="bi bi-check"></i> Simpan');

                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = xhr.responseJSON.errors;
                            let html = `
                            <div class="alert-custom alert-danger">
                                <i class="bi bi-exclamation-triangle"></i>
                                <div>
                        `;
                            Object.keys(errors).forEach(function(key) {
                                html += `<div>${errors[key].join('<br>')}</div>`;
                            });
                            html += `</div></div>`;
                            $alert.html(html);
                        } else {
                            let msg = 'Terjadi kesalahan saat menyimpan data.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            showSwalError(msg);
                        }
                    }
                });
            });
        });
    </script>
@endpush
