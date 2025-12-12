@extends('layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title-wrapper">
                        <div class="page-icon">
                            <i class="bi bi-flower2"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Master Jenis Hewan</h1>
                            <p class="page-subtitle">Kelola data jenis hewan</p>
                        </div>
                    </div>
                    <button class="btn-add-primary" id="btnTambahJenisHewan">
                        <i class="bi bi-plus-circle"></i>
                        <span>Tambah Jenis Hewan</span>
                    </button>
                </div>
            </div>

            <!-- Data Table Card -->
            <div class="data-card">
                <div class="data-card-header">
                    <div class="data-card-title">
                        <i class="bi bi-list-ul"></i>
                        <span>Daftar Jenis Hewan</span>
                    </div>
                </div>
                <div class="data-card-body">
                    <div class="table-container">
                        <table class="data-table" id="tabel-jenis-hewan">
                            <thead>
                                <tr>
                                    <th class="col-number">#</th>
                                    <th class="col-main">Nama Jenis Hewan</th>
                                    <th class="col-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenisHewan as $i => $jenis)
                                    <tr class="data-row">
                                        <td class="col-number">
                                            <span class="row-number">{{ $i + 1 }}</span>
                                        </td>
                                        <td class="col-main">
                                            <div class="item-info">
                                                <span class="item-name">{{ $jenis->nama_jenis_hewan }}</span>
                                            </div>
                                        </td>
                                        <td class="col-action">
                                            <div class="action-buttons">
                                                <button class="btn-action btn-edit btnEditJenisHewan"
                                                    data-id="{{ $jenis->idjenis_hewan }}" 
                                                    data-nama="{{ $jenis->nama_jenis_hewan }}"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn-action btn-delete btnHapusJenisHewan"
                                                    data-id="{{ $jenis->idjenis_hewan }}" 
                                                    data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($jenisHewan->count() == 0)
                                    <tr>
                                        <td colspan="3" class="empty-state">
                                            <div class="empty-content">
                                                <i class="bi bi-flower2"></i>
                                                <h4>Belum ada data jenis hewan</h4>
                                                <p>Klik tombol "Tambah Jenis Hewan" untuk memulai</p>
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

    <!-- Modal Jenis Hewan -->
    <div class="modal fade" id="modalJenisHewan" tabindex="-1" aria-labelledby="modalJenisHewanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal">
                <form id="formJenisHewan">
                    @csrf
                    <input type="hidden" name="id" id="jenis_hewan_id">
                    <div class="modal-header custom-modal-header">
                        <div class="modal-header-content">
                            <div class="modal-icon">
                                <i class="bi bi-flower2"></i>
                            </div>
                            <h5 class="modal-title" id="modalJenisHewanLabel">Tambah Jenis Hewan</h5>
                        </div>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Tutup">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <div id="formJenisHewanAlert"></div>
                        <div class="form-group-custom">
                            <label for="nama_jenis_hewan" class="form-label-custom required">
                                <i class="bi bi-flower2"></i> Nama Jenis Hewan
                            </label>
                            <input type="text" class="form-control-custom" id="nama_jenis_hewan" name="nama_jenis_hewan" required maxlength="100" placeholder="Contoh: Anjing, Kucing, Kelinci">
                        </div>
                    </div>
                    <div class="modal-footer custom-modal-footer">
                        <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn-primary-custom" id="btnSimpanJenisHewan">
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

            const modalEl = document.getElementById('modalJenisHewan');
            const modalJenisHewan = new window.bootstrap.Modal(modalEl);
            const $form = $('#formJenisHewan');
            const $btnTambah = $('#btnTambahJenisHewan');
            const $btnSimpan = $('#btnSimpanJenisHewan');
            const $alert = $('#formJenisHewanAlert');

            function resetForm() {
                $form[0].reset();
                $('#jenis_hewan_id').val('');
                $alert.html('');
                $('#modalJenisHewanLabel').text('Tambah Jenis Hewan');
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
                modalJenisHewan.show();
            });

            $(document).on('click', '.btnEditJenisHewan', function() {
                resetForm();
                const id = $(this).data('id');
                const nama = $(this).data('nama');

                $('#modalJenisHewanLabel').text('Edit Jenis Hewan');
                $('#jenis_hewan_id').val(id);
                $('#nama_jenis_hewan').val(nama);
                modalJenisHewan.show();
            });

            $(document).on('click', '.btnHapusJenisHewan', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus Jenis Hewan?',
                    text: 'Data jenis hewan ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (!result.isConfirmed) return;

                    showLoading('Menghapus jenis hewan...');
                    $.ajax({
                        url: "{{ route('admin.jenis-hewan.destroy') }}",
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
                                text: res.message || 'Jenis hewan berhasil dihapus.'
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            hideLoading();
                            let msg = 'Terjadi kesalahan saat menghapus jenis hewan.';
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

                const id = $('#jenis_hewan_id').val();
                const isEdit = !!id;

                const url = isEdit ?
                    "{{ url('admin/jenis-hewan') }}/" + id :
                    "{{ route('admin.jenis-hewan.store') }}";

                const method = isEdit ? 'PUT' : 'POST';

                const payload = {
                    nama_jenis_hewan: $('#nama_jenis_hewan').val()
                };

                $btnSimpan.prop('disabled', true)
                    .html('<i class="bi bi-arrow-repeat bx-spin"></i> Menyimpan...');

                showLoading('Menyimpan data jenis hewan...');

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

                        modalJenisHewan.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message || 'Jenis hewan berhasil disimpan.'
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
