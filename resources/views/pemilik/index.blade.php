@extends('layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title-wrapper">
                        <div class="page-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Master Pemilik</h1>
                            <p class="page-subtitle">Kelola data pemilik hewan</p>
                        </div>
                    </div>
                    <button class="btn-add-primary" id="btnTambahPemilik">
                        <i class="bi bi-plus-circle"></i>
                        <span>Tambah Pemilik</span>
                    </button>
                </div>
            </div>

            <!-- Data Table Card -->
            <div class="data-card">
                <div class="data-card-header">
                    <div class="data-card-title">
                        <i class="bi bi-list-ul"></i>
                        <span>Daftar Pemilik</span>
                    </div>
                </div>
                <div class="data-card-body">
                    <div class="table-container">
                        <table class="data-table" id="tabel-pemilik">
                            <thead>
                                <tr>
                                    <th class="col-number">#</th>
                                    <th class="col-main">Nama Pemilik</th>
                                    <th class="col-secondary">No. WhatsApp</th>
                                    <th class="col-secondary">Alamat</th>
                                    <th class="col-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pemilik as $i => $owner)
                                    <tr class="data-row">
                                        <td class="col-number">
                                            <span class="row-number">{{ $i + 1 }}</span>
                                        </td>
                                        <td class="col-main">
                                            <div class="item-info">
                                                <span class="item-name">{{ $owner->user->name ?? '-' }}</span>
                                                <span class="item-email">{{ $owner->user->email ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="col-secondary">
                                            <span class="badge bg-success">{{ $owner->no_wa }}</span>
                                        </td>
                                        <td class="col-secondary">
                                            {{ $owner->alamat }}
                                        </td>
                                        <td class="col-action">
                                            <div class="action-buttons">
                                                <button class="btn-action btn-edit btnEditPemilik"
                                                    data-id="{{ $owner->idpemilik }}" 
                                                    data-no-wa="{{ $owner->no_wa }}"
                                                    data-alamat="{{ $owner->alamat }}"
                                                    data-iduser="{{ $owner->iduser }}"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn-action btn-delete btnHapusPemilik"
                                                    data-id="{{ $owner->idpemilik }}" 
                                                    data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($pemilik->count() == 0)
                                    <tr>
                                        <td colspan="5" class="empty-state">
                                            <div class="empty-content">
                                                <i class="bi bi-people"></i>
                                                <h4>Belum ada data pemilik</h4>
                                                <p>Klik tombol "Tambah Pemilik" untuk memulai</p>
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

    <!-- Modal Pemilik -->
    <div class="modal fade" id="modalPemilik" tabindex="-1" aria-labelledby="modalPemilikLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal">
                <form id="formPemilik">
                    @csrf
                    <input type="hidden" name="id" id="pemilik_id">
                    <div class="modal-header custom-modal-header">
                        <div class="modal-header-content">
                            <div class="modal-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <h5 class="modal-title" id="modalPemilikLabel">Tambah Pemilik</h5>
                        </div>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Tutup">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <div id="formPemilikAlert"></div>
                        <div class="form-group-custom">
                            <label for="iduser" class="form-label-custom required">
                                <i class="bi bi-person"></i> Nama Pemilik (User)
                            </label>
                            <select class="form-control-custom" id="iduser" name="iduser" required>
                                <option value="">Pilih User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group-custom">
                            <label for="no_wa" class="form-label-custom required">
                                <i class="bi bi-whatsapp"></i> No. WhatsApp
                            </label>
                            <input type="text" class="form-control-custom" id="no_wa" name="no_wa" required maxlength="45" placeholder="Contoh: 081234567890">
                        </div>
                        <div class="form-group-custom">
                            <label for="alamat" class="form-label-custom required">
                                <i class="bi bi-geo-alt"></i> Alamat
                            </label>
                            <textarea class="form-control-custom" id="alamat" name="alamat" required maxlength="100" rows="3" placeholder="Masukkan alamat lengkap"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer custom-modal-footer">
                        <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn-primary-custom" id="btnSimpanPemilik">
                            <i class="bi bi-check"></i>
                            Simpan
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

            const modalEl = document.getElementById('modalPemilik');
            const modalPemilik = new window.bootstrap.Modal(modalEl);
            const $form = $('#formPemilik');
            const $btnTambah = $('#btnTambahPemilik');
            const $btnSimpan = $('#btnSimpanPemilik');
            const $alert = $('#formPemilikAlert');

            function resetForm() {
                $form[0].reset();
                $('#pemilik_id').val('');
                $alert.html('');
                $('#modalPemilikLabel').text('Tambah Pemilik');
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

            $btnTambah.on('click', function() {
                resetForm();
                modalPemilik.show();
            });

            $(document).on('click', '.btnEditPemilik', function() {
                resetForm();
                const id = $(this).data('id');
                const noWa = $(this).data('no-wa');
                const alamat = $(this).data('alamat');
                const iduser = $(this).data('iduser');

                $('#modalPemilikLabel').text('Edit Pemilik');
                $('#pemilik_id').val(id);
                $('#no_wa').val(noWa);
                $('#alamat').val(alamat);
                $('#iduser').val(iduser);
                modalPemilik.show();
            });

            $(document).on('click', '.btnHapusPemilik', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus Pemilik?',
                    text: 'Data pemilik ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (!result.isConfirmed) return;

                    showLoading('Menghapus pemilik...');
                    $.ajax({
                        url: "{{ route('admin.pemilik.destroy') }}",
                        type: 'POST',
                        data: {
                            id: id,
                            _method: 'DELETE'
                        },
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        success: function(res) {
                            hideLoading();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: res.message || 'Pemilik berhasil dihapus.'
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            hideLoading();
                            let msg = 'Terjadi kesalahan saat menghapus pemilik.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            showSwalError(msg);
                        }
                    });
                });
            });

            $form.on('submit', function(e) {
                e.preventDefault();
                $alert.html('');

                const id = $('#pemilik_id').val();
                const isEdit = !!id;

                const url = isEdit ?
                    "{{ url('admin/pemilik') }}/" + id :
                    "{{ route('admin.pemilik.store') }}";

                const method = isEdit ? 'PUT' : 'POST';

                const payload = {
                    iduser: $('#iduser').val(),
                    no_wa: $('#no_wa').val(),
                    alamat: $('#alamat').val()
                };

                $btnSimpan.prop('disabled', true)
                    .html('<i class="bi bi-arrow-repeat bx-spin"></i> Menyimpan...');

                showLoading('Menyimpan data pemilik...');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        ...payload,
                        _method: method
                    },
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    success: function(res) {
                        hideLoading();
                        $btnSimpan.prop('disabled', false)
                            .html('<i class="bi bi-check"></i> Simpan');

                        modalPemilik.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message || 'Pemilik berhasil disimpan.'
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
                            let html = `<div class="alert-custom alert-danger">
                                <i class="bi bi-exclamation-triangle"></i>
                                <div>`;
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
