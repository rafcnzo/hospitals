@extends('layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title-wrapper">
                        <div class="page-icon">
                            <i class="bi bi-file-medical-fill"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Manajemen Rekam Medis</h1>
                            <p class="page-subtitle">Kelola rekam medis hewan peliharaan</p>
                        </div>
                    </div>
                    <button class="btn-add-primary" id="btnTambahRekamMedis">
                        <i class="bi bi-plus-circle"></i>
                        <span>Tambah Rekam Medis</span>
                    </button>
                </div>
            </div>

            <!-- Data Table Card -->
            <div class="data-card">
                <div class="data-card-header">
                    <div class="data-card-title">
                        <i class="bi bi-list-ul"></i>
                        <span>Daftar Rekam Medis</span>
                    </div>
                </div>
                <div class="data-card-body">
                    <div class="table-container">
                        <table class="data-table" id="tabel-rekam-medis">
                            <thead>
                                <tr>
                                    <th class="col-number">#</th>
                                    <th class="col-secondary">Tanggal</th>
                                    <th class="col-main">Pet</th>
                                    <th class="col-secondary">Pemilik</th>
                                    <th class="col-secondary">Diagnosa</th>
                                    <th class="col-secondary">Dokter</th>
                                    <th class="col-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekamMedis as $i => $rm)
                                    <tr class="data-row">
                                        <td class="col-number">
                                            <span class="row-number">{{ $i + 1 }}</span>
                                        </td>
                                        <td class="col-secondary">
                                            {{ \Carbon\Carbon::parse($rm->created_at)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="col-main">
                                            <div class="item-info">
                                                <span class="item-name">{{ $rm->pet->nama ?? '-' }}</span>
                                                <span class="item-email">{{ $rm->pet->rasHewan->nama_ras ?? '-' }} ({{ $rm->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }})</span>
                                            </div>
                                        </td>
                                        <td class="col-secondary">
                                            <span class="badge bg-info">{{ $rm->pet->pemilik->user->name ?? '-' }}</span>
                                        </td>
                                        <td class="col-secondary">
                                            {{ \Illuminate\Support\Str::limit($rm->diagnosa, 50) }}
                                        </td>
                                        <td class="col-secondary">
                                            <span class="badge bg-success">{{ $rm->dokter->name ?? '-' }}</span>
                                        </td>
                                        <td class="col-action">
                                            <div class="action-buttons">
                                                <button class="btn-action btn-view btnViewRekamMedis"
                                                    data-id="{{ $rm->idrekam_medis }}"
                                                    data-bs-toggle="tooltip" title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn-action btn-edit btnEditRekamMedis"
                                                    data-id="{{ $rm->idrekam_medis }}"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn-action btn-delete btnHapusRekamMedis"
                                                    data-id="{{ $rm->idrekam_medis }}"
                                                    data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($rekamMedis->count() == 0)
                                    <tr>
                                        <td colspan="7" class="empty-state">
                                            <div class="empty-content">
                                                <i class="bi bi-file-medical-fill"></i>
                                                <h4>Belum ada data rekam medis</h4>
                                                <p>Klik tombol "Tambah Rekam Medis" untuk memulai</p>
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

    <!-- Modal Rekam Medis -->
    <div class="modal fade" id="modalRekamMedis" tabindex="-1" aria-labelledby="modalRekamMedisLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content custom-modal">
                <form id="formRekamMedis">
                    @csrf
                    <input type="hidden" name="id" id="rekam_medis_id">
                    <div class="modal-header custom-modal-header">
                        <div class="modal-header-content">
                            <div class="modal-icon">
                                <i class="bi bi-file-medical-fill"></i>
                            </div>
                            <h5 class="modal-title" id="modalRekamMedisLabel">Tambah Rekam Medis</h5>
                        </div>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Tutup">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <div id="formRekamMedisAlert"></div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="idpet" class="form-label-custom required">
                                        <i class="bi bi-heart-fill"></i> Pet
                                    </label>
                                    <select class="form-control-custom" id="idpet" name="idpet" required>
                                        <option value="">Pilih Pet</option>
                                        @foreach ($pets as $pet)
                                            <option value="{{ $pet->idpet }}">{{ $pet->nama }} - {{ $pet->pemilik->user->name ?? '-' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="dokter_pemeriksa" class="form-label-custom required">
                                        <i class="bi bi-person-badge"></i> Dokter Pemeriksa
                                    </label>
                                    <select class="form-control-custom" id="dokter_pemeriksa" name="dokter_pemeriksa" required>
                                        <option value="">Pilih Dokter</option>
                                        @foreach ($dokters as $dokter)
                                            <option value="{{ $dokter->id }}">{{ $dokter->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group-custom">
                            <label for="anamnesa" class="form-label-custom required">
                                <i class="bi bi-chat-left-text"></i> Anamnesa
                            </label>
                            <textarea class="form-control-custom" id="anamnesa" name="anamnesa" required maxlength="1000" rows="3" placeholder="Riwayat penyakit dan keluhan"></textarea>
                        </div>

                        <div class="form-group-custom">
                            <label for="temuan_klinis" class="form-label-custom required">
                                <i class="bi bi-clipboard-pulse"></i> Temuan Klinis
                            </label>
                            <textarea class="form-control-custom" id="temuan_klinis" name="temuan_klinis" required maxlength="1000" rows="3" placeholder="Hasil pemeriksaan fisik"></textarea>
                        </div>

                        <div class="form-group-custom">
                            <label for="diagnosa" class="form-label-custom required">
                                <i class="bi bi-clipboard2-check"></i> Diagnosa
                            </label>
                            <textarea class="form-control-custom" id="diagnosa" name="diagnosa" required maxlength="1000" rows="2" placeholder="Diagnosa penyakit"></textarea>
                        </div>

                        <hr class="my-4">
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0"><i class="bi bi-list-check"></i> Detail Tindakan Terapi</h6>
                            <button type="button" class="btn btn-sm btn-primary" id="btnTambahDetail">
                                <i class="bi bi-plus-circle"></i> Tambah Tindakan
                            </button>
                        </div>

                        <div id="detailContainer">
                            <!-- Detail items akan ditambahkan di sini -->
                        </div>
                    </div>
                    <div class="modal-footer custom-modal-footer">
                        <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn-primary-custom" id="btnSimpanRekamMedis">
                            <i class="bi bi-check"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal View Rekam Medis -->
    <div class="modal fade" id="modalViewRekamMedis" tabindex="-1" aria-labelledby="modalViewRekamMedisLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content custom-modal">
                <div class="modal-header custom-modal-header">
                    <div class="modal-header-content">
                        <div class="modal-icon">
                            <i class="bi bi-file-medical-fill"></i>
                        </div>
                        <h5 class="modal-title" id="modalViewRekamMedisLabel">Detail Rekam Medis</h5>
                    </div>
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Tutup">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
                <div class="modal-body custom-modal-body" id="viewRekamMedisContent">
                    <!-- Content akan diisi via AJAX -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        window.addEventListener('app-libraries-loaded', function() {
            const $ = window.jQuery;

            const modalEl = document.getElementById('modalRekamMedis');
            const modalRekamMedis = new window.bootstrap.Modal(modalEl);
            const modalViewEl = document.getElementById('modalViewRekamMedis');
            const modalViewRekamMedis = new window.bootstrap.Modal(modalViewEl);
            const $form = $('#formRekamMedis');
            const $btnTambah = $('#btnTambahRekamMedis');
            const $btnSimpan = $('#btnSimpanRekamMedis');
            const $alert = $('#formRekamMedisAlert');
            const $detailContainer = $('#detailContainer');
            let detailCount = 0;

            const kodeTindakanOptions = `
                <option value="">Pilih Tindakan</option>
                @foreach ($kodeTindakanTerapis as $kt)
                    <option value="{{ $kt->idkode_tindakan_terapi }}">{{ $kt->kode }} - {{ $kt->deskripsi_tindakan_terapi }}</option>
                @endforeach
            `;

            function addDetailRow(data = null) {
                detailCount++;
                const row = `
                    <div class="detail-item mb-3 p-3 border rounded" data-index="${detailCount}">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong>Tindakan #${detailCount}</strong>
                            <button type="button" class="btn btn-sm btn-danger btnHapusDetail" data-index="${detailCount}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom required">Kode Tindakan Terapi</label>
                                    <select class="form-control-custom detail-tindakan" name="details[${detailCount}][idkode_tindakan_terapi]" required>
                                        ${kodeTindakanOptions}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom required">Detail Tindakan</label>
                                    <input type="text" class="form-control-custom" name="details[${detailCount}][detail]" required maxlength="1000" placeholder="Keterangan detail tindakan">
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                $detailContainer.append(row);

                if (data) {
                    $(`.detail-item[data-index="${detailCount}"] select[name="details[${detailCount}][idkode_tindakan_terapi]"]`).val(data.idkode_tindakan_terapi);
                    $(`.detail-item[data-index="${detailCount}"] input[name="details[${detailCount}][detail]"]`).val(data.detail);
                }
            }

            $(document).on('click', '.btnHapusDetail', function() {
                const index = $(this).data('index');
                $(`.detail-item[data-index="${index}"]`).remove();
            });

            $('#btnTambahDetail').on('click', function() {
                addDetailRow();
            });

            function resetForm() {
                $form[0].reset();
                $('#rekam_medis_id').val('');
                $alert.html('');
                $detailContainer.empty();
                detailCount = 0;
                $('#modalRekamMedisLabel').text('Tambah Rekam Medis');
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
                addDetailRow(); // Tambah 1 row default
                modalRekamMedis.show();
            });

            $(document).on('click', '.btnViewRekamMedis', function() {
                const id = $(this).data('id');
                
                showLoading('Memuat data...');
                $.ajax({
                    url: "{{ url('admin/rekam-medis') }}/" + id,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    success: function(res) {
                        hideLoading();
                        const data = res.data;
                        
                        let detailsHtml = '';
                        data.details.forEach((detail, idx) => {
                            detailsHtml += `
                                <div class="mb-3">
                                    <strong>${idx + 1}. ${detail.kode_tindakan_terapi.kode} - ${detail.kode_tindakan_terapi.deskripsi_tindakan_terapi}</strong>
                                    <p class="mb-0 text-muted">${detail.detail}</p>
                                </div>
                            `;
                        });
                        
                        const content = `
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Pet:</strong> ${data.pet.nama}<br>
                                    <strong>Pemilik:</strong> ${data.pet.pemilik.user.name}
                                </div>
                                <div class="col-md-6">
                                    <strong>Dokter:</strong> ${data.dokter.name}<br>
                                    <strong>Tanggal:</strong> ${new Date(data.created_at).toLocaleString('id-ID')}
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <strong>Anamnesa:</strong>
                                <p>${data.anamnesa}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Temuan Klinis:</strong>
                                <p>${data.temuan_klinis}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Diagnosa:</strong>
                                <p>${data.diagnosa}</p>
                            </div>
                            <hr>
                            <div>
                                <strong>Detail Tindakan Terapi:</strong>
                                ${detailsHtml}
                            </div>
                        `;
                        
                        $('#viewRekamMedisContent').html(content);
                        modalViewRekamMedis.show();
                    },
                    error: function(xhr) {
                        hideLoading();
                        showSwalError('Gagal memuat data rekam medis.');
                    }
                });
            });

            $(document).on('click', '.btnEditRekamMedis', function() {
                const id = $(this).data('id');
                
                resetForm();
                $('#modalRekamMedisLabel').text('Edit Rekam Medis');
                $('#rekam_medis_id').val(id);
                
                showLoading('Memuat data...');
                $.ajax({
                    url: "{{ url('admin/rekam-medis') }}/" + id,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    success: function(res) {
                        hideLoading();
                        const data = res.data;
                        
                        $('#idpet').val(data.idpet);
                        $('#dokter_pemeriksa').val(data.dokter_pemeriksa);
                        $('#anamnesa').val(data.anamnesa);
                        $('#temuan_klinis').val(data.temuan_klinis);
                        $('#diagnosa').val(data.diagnosa);
                        
                        data.details.forEach(detail => {
                            addDetailRow(detail);
                        });
                        
                        modalRekamMedis.show();
                    },
                    error: function(xhr) {
                        hideLoading();
                        showSwalError('Gagal memuat data rekam medis.');
                    }
                });
            });

            $(document).on('click', '.btnHapusRekamMedis', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus Rekam Medis?',
                    text: 'Data rekam medis ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (!result.isConfirmed) return;

                    showLoading('Menghapus rekam medis...');
                    $.ajax({
                        url: "{{ route('admin.rekam-medis.destroy') }}",
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
                                text: res.message || 'Rekam medis berhasil dihapus.'
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            hideLoading();
                            let msg = 'Terjadi kesalahan saat menghapus rekam medis.';
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

                if ($('.detail-item').length === 0) {
                    showFormError('Minimal harus ada 1 detail tindakan terapi.');
                    return;
                }

                const id = $('#rekam_medis_id').val();
                const isEdit = !!id;

                const url = isEdit ?
                    "{{ url('admin/rekam-medis') }}/" + id :
                    "{{ route('admin.rekam-medis.store') }}";

                const method = isEdit ? 'PUT' : 'POST';

                const formData = new FormData(this);
                const payload = {
                    idpet: $('#idpet').val(),
                    dokter_pemeriksa: $('#dokter_pemeriksa').val(),
                    anamnesa: $('#anamnesa').val(),
                    temuan_klinis: $('#temuan_klinis').val(),
                    diagnosa: $('#diagnosa').val(),
                    details: []
                };

                $('.detail-item').each(function() {
                    const index = $(this).data('index');
                    payload.details.push({
                        idkode_tindakan_terapi: $(`select[name="details[${index}][idkode_tindakan_terapi]"]`).val(),
                        detail: $(`input[name="details[${index}][detail]"]`).val()
                    });
                });

                $btnSimpan.prop('disabled', true)
                    .html('<i class="bi bi-arrow-repeat bx-spin"></i> Menyimpan...');

                showLoading('Menyimpan data rekam medis...');

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

                        modalRekamMedis.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message || 'Rekam medis berhasil disimpan.'
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
