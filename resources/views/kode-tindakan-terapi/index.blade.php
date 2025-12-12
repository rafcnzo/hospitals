@extends('layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title-wrapper">
                        <div class="page-icon">
                            <i class="bi bi-file-medical"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Manajemen Kode Tindakan Terapi</h1>
                            <p class="page-subtitle">Kelola kode tindakan terapi rumah sakit</p>
                        </div>
                    </div>
                    <button class="btn-add-primary" id="btnTambahKodeTindakan">
                        <i class="bi bi-plus-circle"></i>
                        <span>Tambah Kode Tindakan</span>
                    </button>
                </div>
            </div>

            <!-- Data Table Card -->
            <div class="data-card">
                <div class="data-card-header">
                    <div class="data-card-title">
                        <i class="bi bi-list-ul"></i>
                        <span>Daftar Kode Tindakan Terapi</span>
                    </div>
                </div>
                <div class="data-card-body">
                    <div class="table-container">
                        <table class="data-table" id="tabel-kode-tindakan">
                            <thead>
                                <tr>
                                    <th class="col-number">#</th>
                                    <th class="col-secondary">Kode</th>
                                    <th class="col-main">Deskripsi Tindakan Terapi</th>
                                    <th class="col-secondary">Kategori</th>
                                    <th class="col-secondary">Kategori Klinis</th>
                                    <th class="col-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kodeTindakanTerapis as $i => $item)
                                    <tr class="data-row">
                                        <td class="col-number">
                                            <span class="row-number">{{ $i + 1 }}</span>
                                        </td>
                                        <td class="col-secondary">
                                            <span class="badge bg-primary">{{ $item->kode }}</span>
                                        </td>
                                        <td class="col-main">
                                            <div class="item-info">
                                                <span class="item-name">{{ $item->deskripsi_tindakan_terapi }}</span>
                                            </div>
                                        </td>
                                        <td class="col-secondary">
                                            <span class="badge bg-info">{{ $item->kategori->nama_kategori ?? '-' }}</span>
                                        </td>
                                        <td class="col-secondary">
                                            <span class="badge bg-success">{{ $item->kategoriKlinis->nama_kategori_klinis ?? '-' }}</span>
                                        </td>
                                        <td class="col-action">
                                            <div class="action-buttons">
                                                <button class="btn-action btn-edit btnEditKodeTindakan"
                                                    data-id="{{ $item->idkode_tindakan_terapi }}" 
                                                    data-kode="{{ $item->kode }}"
                                                    data-deskripsi="{{ $item->deskripsi_tindakan_terapi }}"
                                                    data-idkategori="{{ $item->idkategori }}"
                                                    data-idkategori-klinis="{{ $item->idkategori_klinis }}"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn-action btn-delete btnHapusKodeTindakan"
                                                    data-id="{{ $item->idkode_tindakan_terapi }}" 
                                                    data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($kodeTindakanTerapis->count() == 0)
                                    <tr>
                                        <td colspan="6" class="empty-state">
                                            <div class="empty-content">
                                                <i class="bi bi-file-medical"></i>
                                                <h4>Belum ada data kode tindakan terapi</h4>
                                                <p>Klik tombol "Tambah Kode Tindakan" untuk memulai</p>
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

    <!-- Modal Kode Tindakan Terapi -->
    <div class="modal fade" id="modalKodeTindakan" tabindex="-1" aria-labelledby="modalKodeTindakanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content custom-modal">
                <form id="formKodeTindakan">
                    @csrf
                    <input type="hidden" name="id" id="kode_tindakan_id">
                    <div class="modal-header custom-modal-header">
                        <div class="modal-header-content">
                            <div class="modal-icon">
                                <i class="bi bi-file-medical"></i>
                            </div>
                            <h5 class="modal-title" id="modalKodeTindakanLabel">Tambah Kode Tindakan Terapi</h5>
                        </div>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Tutup">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <div id="formKodeTindakanAlert"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group-custom">
                                    <label for="kode" class="form-label-custom required">
                                        <i class="bi bi-code-square"></i> Kode
                                    </label>
                                    <input type="text" class="form-control-custom" id="kode" name="kode" required maxlength="5">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group-custom">
                                    <label for="deskripsi_tindakan_terapi" class="form-label-custom required">
                                        <i class="bi bi-card-text"></i> Deskripsi Tindakan Terapi
                                    </label>
                                    <input type="text" class="form-control-custom" id="deskripsi_tindakan_terapi" name="deskripsi_tindakan_terapi" required maxlength="1000">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="idkategori" class="form-label-custom required">
                                        <i class="bi bi-tags"></i> Kategori
                                    </label>
                                    <select class="form-control-custom" id="idkategori" name="idkategori" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategoris as $kategori)
                                            <option value="{{ $kategori->idkategori }}">{{ $kategori->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="idkategori_klinis" class="form-label-custom required">
                                        <i class="bi bi-heart-pulse"></i> Kategori Klinis
                                    </label>
                                    <select class="form-control-custom" id="idkategori_klinis" name="idkategori_klinis" required>
                                        <option value="">Pilih Kategori Klinis</option>
                                        @foreach ($kategoriKlinis as $item)
                                            <option value="{{ $item->idkategori_klinis }}">{{ $item->nama_kategori_klinis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer custom-modal-footer">
                        <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn-primary-custom" id="btnSimpanKodeTindakan">
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

            const modalEl = document.getElementById('modalKodeTindakan');
            const modalKodeTindakan = new window.bootstrap.Modal(modalEl);
            const $form = $('#formKodeTindakan');
            const $btnTambah = $('#btnTambahKodeTindakan');
            const $btnSimpan = $('#btnSimpanKodeTindakan');
            const $alert = $('#formKodeTindakanAlert');

            function resetForm() {
                $form[0].reset();
                $('#kode_tindakan_id').val('');
                $alert.html('');
                $('#modalKodeTindakanLabel').text('Tambah Kode Tindakan Terapi');
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
                modalKodeTindakan.show();
            });

            $(document).on('click', '.btnEditKodeTindakan', function() {
                resetForm();
                const id = $(this).data('id');
                const kode = $(this).data('kode');
                const deskripsi = $(this).data('deskripsi');
                const idkategori = $(this).data('idkategori');
                const idkategoriKlinis = $(this).data('idkategori-klinis');

                $('#modalKodeTindakanLabel').text('Edit Kode Tindakan Terapi');
                $('#kode_tindakan_id').val(id);
                $('#kode').val(kode);
                $('#deskripsi_tindakan_terapi').val(deskripsi);
                $('#idkategori').val(idkategori);
                $('#idkategori_klinis').val(idkategoriKlinis);
                modalKodeTindakan.show();
            });

            $(document).on('click', '.btnHapusKodeTindakan', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus Kode Tindakan Terapi?',
                    text: 'Data kode tindakan terapi ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (!result.isConfirmed) return;

                    showLoading('Menghapus kode tindakan terapi...');
                    $.ajax({
                        url: "{{ route('admin.kode-tindakan-terapi.destroy') }}",
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
                                text: res.message || 'Kode Tindakan Terapi berhasil dihapus.'
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            hideLoading();
                            let msg = 'Terjadi kesalahan saat menghapus kode tindakan terapi.';
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

                const id = $('#kode_tindakan_id').val();
                const isEdit = !!id;

                const url = isEdit ?
                    "{{ url('admin/kode-tindakan-terapi') }}/" + id :
                    "{{ route('admin.kode-tindakan-terapi.store') }}";

                const method = isEdit ? 'PUT' : 'POST';

                const payload = {
                    kode: $('#kode').val(),
                    deskripsi_tindakan_terapi: $('#deskripsi_tindakan_terapi').val(),
                    idkategori: $('#idkategori').val(),
                    idkategori_klinis: $('#idkategori_klinis').val()
                };

                $btnSimpan.prop('disabled', true)
                    .html('<i class="bi bi-arrow-repeat bx-spin"></i> Menyimpan...');

                showLoading('Menyimpan data kode tindakan terapi...');

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

                        modalKodeTindakan.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message || 'Kode Tindakan Terapi berhasil disimpan.'
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
