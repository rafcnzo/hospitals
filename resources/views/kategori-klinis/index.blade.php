@extends('layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title-wrapper">
                        <div class="page-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Manajemen Kategori Klinis</h1>
                            <p class="page-subtitle">Kelola kategori klinis tindakan terapi</p>
                        </div>
                    </div>
                    <button class="btn-add-primary" id="btnTambahKategoriKlinis">
                        <i class="bi bi-plus-circle"></i>
                        <span>Tambah Kategori Klinis</span>
                    </button>
                </div>
            </div>

            <!-- Data Table Card -->
            <div class="data-card">
                <div class="data-card-header">
                    <div class="data-card-title">
                        <i class="bi bi-list-ul"></i>
                        <span>Daftar Kategori Klinis</span>
                    </div>
                </div>
                <div class="data-card-body">
                    <div class="table-container">
                        <table class="data-table" id="tabel-kategori-klinis">
                            <thead>
                                <tr>
                                    <th class="col-number">#</th>
                                    <th class="col-main">Nama Kategori Klinis</th>
                                    <th class="col-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategoriKlinis as $i => $item)
                                    <tr class="data-row">
                                        <td class="col-number">
                                            <span class="row-number">{{ $i + 1 }}</span>
                                        </td>
                                        <td class="col-main">
                                            <div class="item-info">
                                                <span class="item-name">{{ $item->nama_kategori_klinis }}</span>
                                            </div>
                                        </td>
                                        <td class="col-action">
                                            <div class="action-buttons">
                                                <button class="btn-action btn-edit btnEditKategoriKlinis"
                                                    data-id="{{ $item->idkategori_klinis }}" 
                                                    data-nama="{{ $item->nama_kategori_klinis }}"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn-action btn-delete btnHapusKategoriKlinis"
                                                    data-id="{{ $item->idkategori_klinis }}" 
                                                    data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($kategoriKlinis->count() == 0)
                                    <tr>
                                        <td colspan="3" class="empty-state">
                                            <div class="empty-content">
                                                <i class="bi bi-heart-pulse"></i>
                                                <h4>Belum ada data kategori klinis</h4>
                                                <p>Klik tombol "Tambah Kategori Klinis" untuk memulai</p>
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

    <!-- Modal Kategori Klinis -->
    <div class="modal fade" id="modalKategoriKlinis" tabindex="-1" aria-labelledby="modalKategoriKlinisLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal">
                <form id="formKategoriKlinis">
                    @csrf
                    <input type="hidden" name="id" id="kategori_klinis_id">
                    <div class="modal-header custom-modal-header">
                        <div class="modal-header-content">
                            <div class="modal-icon">
                                <i class="bi bi-heart-pulse"></i>
                            </div>
                            <h5 class="modal-title" id="modalKategoriKlinisLabel">Tambah Kategori Klinis</h5>
                        </div>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Tutup">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <div id="formKategoriKlinisAlert"></div>
                        <div class="form-group-custom">
                            <label for="nama_kategori_klinis" class="form-label-custom required">
                                <i class="bi bi-heart-pulse-fill"></i> Nama Kategori Klinis
                            </label>
                            <input type="text" class="form-control-custom" id="nama_kategori_klinis" name="nama_kategori_klinis" required maxlength="50">
                        </div>
                    </div>
                    <div class="modal-footer custom-modal-footer">
                        <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn-primary-custom" id="btnSimpanKategoriKlinis">
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

            const modalEl = document.getElementById('modalKategoriKlinis');
            const modalKategoriKlinis = new window.bootstrap.Modal(modalEl);
            const $form = $('#formKategoriKlinis');
            const $btnTambah = $('#btnTambahKategoriKlinis');
            const $btnSimpan = $('#btnSimpanKategoriKlinis');
            const $alert = $('#formKategoriKlinisAlert');

            function resetForm() {
                $form[0].reset();
                $('#kategori_klinis_id').val('');
                $alert.html('');
                $('#modalKategoriKlinisLabel').text('Tambah Kategori Klinis');
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
                modalKategoriKlinis.show();
            });

            $(document).on('click', '.btnEditKategoriKlinis', function() {
                resetForm();
                const id = $(this).data('id');
                const nama = $(this).data('nama');

                $('#modalKategoriKlinisLabel').text('Edit Kategori Klinis');
                $('#kategori_klinis_id').val(id);
                $('#nama_kategori_klinis').val(nama);
                modalKategoriKlinis.show();
            });

            $(document).on('click', '.btnHapusKategoriKlinis', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus Kategori Klinis?',
                    text: 'Data kategori klinis ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (!result.isConfirmed) return;

                    showLoading('Menghapus kategori klinis...');
                    $.ajax({
                        url: "{{ route('admin.kategori-klinis.destroy') }}",
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
                                text: res.message || 'Kategori Klinis berhasil dihapus.'
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            hideLoading();
                            let msg = 'Terjadi kesalahan saat menghapus kategori klinis.';
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

                const id = $('#kategori_klinis_id').val();
                const isEdit = !!id;

                const url = isEdit ?
                    "{{ url('admin/kategori-klinis') }}/" + id :
                    "{{ route('admin.kategori-klinis.store') }}";

                const method = isEdit ? 'PUT' : 'POST';

                const payload = {
                    nama_kategori_klinis: $('#nama_kategori_klinis').val()
                };

                $btnSimpan.prop('disabled', true)
                    .html('<i class="bi bi-arrow-repeat bx-spin"></i> Menyimpan...');

                showLoading('Menyimpan data kategori klinis...');

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

                        modalKategoriKlinis.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message || 'Kategori Klinis berhasil disimpan.'
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
