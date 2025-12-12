@extends('layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title-wrapper">
                        <div class="page-icon">
                            <i class="bi bi-tags-fill"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Master Ras Hewan</h1>
                            <p class="page-subtitle">Kelola data ras hewan berdasarkan jenis</p>
                        </div>
                    </div>
                    <button class="btn-add-primary" id="btnTambahRasHewan">
                        <i class="bi bi-plus-circle"></i>
                        <span>Tambah Ras Hewan</span>
                    </button>
                </div>
            </div>

            <!-- Data Table Card -->
            <div class="data-card">
                <div class="data-card-header">
                    <div class="data-card-title">
                        <i class="bi bi-list-ul"></i>
                        <span>Daftar Ras Hewan</span>
                    </div>
                </div>
                <div class="data-card-body">
                    <div class="table-container">
                        <table class="data-table" id="tabel-ras-hewan">
                            <thead>
                                <tr>
                                    <th class="col-number">#</th>
                                    <th class="col-main">Nama Ras</th>
                                    <th class="col-secondary">Jenis Hewan</th>
                                    <th class="col-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rasHewan as $i => $ras)
                                    <tr class="data-row">
                                        <td class="col-number">
                                            <span class="row-number">{{ $i + 1 }}</span>
                                        </td>
                                        <td class="col-main">
                                            <div class="item-info">
                                                <span class="item-name">{{ $ras->nama_ras }}</span>
                                            </div>
                                        </td>
                                        <td class="col-secondary">
                                            <span class="badge bg-info">{{ $ras->jenisHewan->nama_jenis_hewan ?? '-' }}</span>
                                        </td>
                                        <td class="col-action">
                                            <div class="action-buttons">
                                                <button class="btn-action btn-edit btnEditRasHewan"
                                                    data-id="{{ $ras->idras_hewan }}" 
                                                    data-nama="{{ $ras->nama_ras }}"
                                                    data-idjenis-hewan="{{ $ras->idjenis_hewan }}"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn-action btn-delete btnHapusRasHewan"
                                                    data-id="{{ $ras->idras_hewan }}" 
                                                    data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($rasHewan->count() == 0)
                                    <tr>
                                        <td colspan="4" class="empty-state">
                                            <div class="empty-content">
                                                <i class="bi bi-tags-fill"></i>
                                                <h4>Belum ada data ras hewan</h4>
                                                <p>Klik tombol "Tambah Ras Hewan" untuk memulai</p>
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

    <!-- Modal Ras Hewan -->
    <div class="modal fade" id="modalRasHewan" tabindex="-1" aria-labelledby="modalRasHewanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal">
                <form id="formRasHewan">
                    @csrf
                    <input type="hidden" name="id" id="ras_hewan_id">
                    <div class="modal-header custom-modal-header">
                        <div class="modal-header-content">
                            <div class="modal-icon">
                                <i class="bi bi-tags-fill"></i>
                            </div>
                            <h5 class="modal-title" id="modalRasHewanLabel">Tambah Ras Hewan</h5>
                        </div>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Tutup">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <div id="formRasHewanAlert"></div>
                        <div class="form-group-custom">
                            <label for="nama_ras" class="form-label-custom required">
                                <i class="bi bi-tag"></i> Nama Ras
                            </label>
                            <input type="text" class="form-control-custom" id="nama_ras" name="nama_ras" required maxlength="100" placeholder="Contoh: Golden Retriever, Persian">
                        </div>
                        <div class="form-group-custom">
                            <label for="idjenis_hewan" class="form-label-custom required">
                                <i class="bi bi-flower2"></i> Jenis Hewan
                            </label>
                            <select class="form-control-custom" id="idjenis_hewan" name="idjenis_hewan" required>
                                <option value="">Pilih Jenis Hewan</option>
                                @foreach ($jenisHewan as $jenis)
                                    <option value="{{ $jenis->idjenis_hewan }}">{{ $jenis->nama_jenis_hewan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer custom-modal-footer">
                        <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn-primary-custom" id="btnSimpanRasHewan">
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

            const modalEl = document.getElementById('modalRasHewan');
            const modalRasHewan = new window.bootstrap.Modal(modalEl);
            const $form = $('#formRasHewan');
            const $btnTambah = $('#btnTambahRasHewan');
            const $btnSimpan = $('#btnSimpanRasHewan');
            const $alert = $('#formRasHewanAlert');

            function resetForm() {
                $form[0].reset();
                $('#ras_hewan_id').val('');
                $alert.html('');
                $('#modalRasHewanLabel').text('Tambah Ras Hewan');
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
                modalRasHewan.show();
            });

            $(document).on('click', '.btnEditRasHewan', function() {
                resetForm();
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                const idjenisHewan = $(this).data('idjenis-hewan');

                $('#modalRasHewanLabel').text('Edit Ras Hewan');
                $('#ras_hewan_id').val(id);
                $('#nama_ras').val(nama);
                $('#idjenis_hewan').val(idjenisHewan);
                modalRasHewan.show();
            });

            $(document).on('click', '.btnHapusRasHewan', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus Ras Hewan?',
                    text: 'Data ras hewan ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (!result.isConfirmed) return;

                    showLoading('Menghapus ras hewan...');
                    $.ajax({
                        url: "{{ route('admin.ras-hewan.destroy') }}",
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
                                text: res.message || 'Ras hewan berhasil dihapus.'
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            hideLoading();
                            let msg = 'Terjadi kesalahan saat menghapus ras hewan.';
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

                const id = $('#ras_hewan_id').val();
                const isEdit = !!id;

                const url = isEdit ?
                    "{{ url('admin/ras-hewan') }}/" + id :
                    "{{ route('admin.ras-hewan.store') }}";

                const method = isEdit ? 'PUT' : 'POST';

                const payload = {
                    nama_ras: $('#nama_ras').val(),
                    idjenis_hewan: $('#idjenis_hewan').val()
                };

                $btnSimpan.prop('disabled', true)
                    .html('<i class="bi bi-arrow-repeat bx-spin"></i> Menyimpan...');

                showLoading('Menyimpan data ras hewan...');

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

                        modalRasHewan.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message || 'Ras hewan berhasil disimpan.'
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
