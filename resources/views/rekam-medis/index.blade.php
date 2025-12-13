@extends('layouts.app')
@section('style')
    <style>
        #viewRekamMedisContent .info-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        #viewRekamMedisContent .info-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        #viewRekamMedisContent .info-item {
            display: flex;
            align-items: start;
            gap: 12px;
        }

        #viewRekamMedisContent .info-item i {
            color: #0d6efd;
            font-size: 20px;
            margin-top: 2px;
        }

        #viewRekamMedisContent .info-label {
            font-size: 12px;
            color: #6c757d;
            font-weight: 500;
            margin-bottom: 4px;
        }

        #viewRekamMedisContent .info-value {
            font-size: 15px;
            color: #212529;
            font-weight: 600;
        }

        #viewRekamMedisContent .medical-section {
            margin-bottom: 24px;
        }

        #viewRekamMedisContent .section-title {
            font-size: 15px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        #viewRekamMedisContent .section-title i {
            color: #0d6efd;
        }

        #viewRekamMedisContent .section-content {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 15px;
            color: #495057;
            line-height: 1.6;
        }

        #viewRekamMedisContent .treatment-item {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-left: 3px solid #0d6efd;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 12px;
        }

        #viewRekamMedisContent .treatment-header {
            display: flex;
            gap: 12px;
            margin-bottom: 8px;
        }

        #viewRekamMedisContent .treatment-number {
            background-color: #0d6efd;
            color: white;
            width: 26px;
            height: 26px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 13px;
            flex-shrink: 0;
        }

        #viewRekamMedisContent .treatment-title {
            flex: 1;
        }

        #viewRekamMedisContent .treatment-code {
            color: #0d6efd;
            font-weight: 600;
            font-size: 13px;
        }

        #viewRekamMedisContent .treatment-name {
            color: #212529;
            font-weight: 500;
            font-size: 14px;
        }

        #viewRekamMedisContent .treatment-detail {
            color: #6c757d;
            font-size: 14px;
            margin-left: 38px;
        }

        #viewRekamMedisContent .empty-state {
            text-align: center;
            padding: 30px;
            color: #6c757d;
        }

        #viewRekamMedisContent .empty-state i {
            font-size: 40px;
            color: #dee2e6;
            margin-bottom: 12px;
        }
    </style>
@endsection
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
                                                <span class="item-email">{{ $rm->pet->rasHewan->nama_ras ?? '-' }}
                                                    ({{ $rm->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }})
                                                </span>
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
                                                    data-id="{{ $rm->idrekam_medis }}" data-bs-toggle="tooltip"
                                                    title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn-action btn-edit btnEditRekamMedis"
                                                    data-id="{{ $rm->idrekam_medis }}" data-bs-toggle="tooltip"
                                                    title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn-action btn-delete btnHapusRekamMedis"
                                                    data-id="{{ $rm->idrekam_medis }}" data-bs-toggle="tooltip"
                                                    title="Hapus">
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
                                    <select class="form-control-custom select2" id="idpet" name="idpet" required
                                        style="width: 100%;">
                                        <option value="">Pilih Pet</option>
                                        @foreach ($pets as $pet)
                                            <option value="{{ $pet->idpet }}">{{ $pet->nama }} -
                                                {{ $pet->pemilik->user->name ?? '-' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="hidden" id="dokter_pemeriksa" name="dokter_pemeriksa"
                                    value="{{ auth()->user()->id }}">
                                <div class="form-group-custom">
                                    <label class="form-label-custom required">
                                        <i class="bi bi-person-badge"></i> Dokter Pemeriksa
                                    </label>
                                    <div class="form-control-custom" style="background-color: #f5f7fa;" readonly>
                                        {{ auth()->user()->name }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group-custom">
                            <label for="anamnesa" class="form-label-custom required">
                                <i class="bi bi-chat-left-text"></i> Anamnesa
                            </label>
                            <textarea class="form-control-custom" id="anamnesa" name="anamnesa" required maxlength="1000" rows="3"
                                placeholder="Riwayat penyakit dan keluhan"></textarea>
                        </div>

                        <div class="form-group-custom">
                            <label for="temuan_klinis" class="form-label-custom required">
                                <i class="bi bi-clipboard-pulse"></i> Temuan Klinis
                            </label>
                            <textarea class="form-control-custom" id="temuan_klinis" name="temuan_klinis" required maxlength="1000"
                                rows="3" placeholder="Hasil pemeriksaan fisik"></textarea>
                        </div>

                        <div class="form-group-custom">
                            <label for="diagnosa" class="form-label-custom required">
                                <i class="bi bi-clipboard2-check"></i> Diagnosa
                            </label>
                            <textarea class="form-control-custom" id="diagnosa" name="diagnosa" required maxlength="1000" rows="2"
                                placeholder="Diagnosa penyakit"></textarea>
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

    <div class="modal fade" id="modalViewRekamMedis" tabindex="-1" aria-labelledby="modalViewRekamMedisLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalViewRekamMedisLabel">
                        <i class="fas fa-file-medical me-2"></i>Detail Rekam Medis
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="viewRekamMedisContent">
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
                    $(`.detail-item[data-index="${detailCount}"] select[name="details[${detailCount}][idkode_tindakan_terapi]"]`)
                        .val(data.idkode_tindakan_terapi);
                    $(`.detail-item[data-index="${detailCount}"] input[name="details[${detailCount}][detail]"]`)
                        .val(data.detail);
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
                    url: "{{ url('dokter/rekam-medis') }}/" + id,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    success: function(res) {
                        hideLoading();
                        const data = res.data;

                        // Format tanggal
                        const tanggal = new Date(data.created_at).toLocaleString('id-ID', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });

                        // Generate treatment list
                        let detailsHtml = '';
                        if (data.details && data.details.length > 0) {
                            data.details.forEach((detail, idx) => {
                                detailsHtml += `
                            <div class="treatment-item">
                                <div class="treatment-header">
                                    <div class="treatment-number">${idx + 1}</div>
                                    <div class="treatment-title">
                                        <div class="treatment-code">${detail.kode_tindakan_terapi.kode}</div>
                                        <div class="treatment-name">${detail.kode_tindakan_terapi.deskripsi_tindakan_terapi}</div>
                                    </div>
                                </div>
                                <div class="treatment-detail">${detail.detail || '-'}</div>
                            </div>
                        `;
                            });
                        } else {
                            detailsHtml = `
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p class="mb-0">Tidak ada detail tindakan terapi</p>
                        </div>
                    `;
                        }

                        const content = `
                    <!-- Info Section -->
                    <div class="info-section">
                        <div class="info-row">
                            <div class="info-item">
                                <i class="fas fa-paw"></i>
                                <div>
                                    <div class="info-label">Nama Pet</div>
                                    <div class="info-value">${data.pet.nama}</div>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-user"></i>
                                <div>
                                    <div class="info-label">Pemilik</div>
                                    <div class="info-value">${data.pet.pemilik.user.name}</div>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-user-md"></i>
                                <div>
                                    <div class="info-label">Dokter</div>
                                    <div class="info-value">${data.dokter.name}</div>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-calendar-alt"></i>
                                <div>
                                    <div class="info-label">Tanggal Pemeriksaan</div>
                                    <div class="info-value">${tanggal}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Anamnesa -->
                    <div class="medical-section">
                        <div class="section-title">
                            <i class="fas fa-comments"></i>
                            Anamnesa
                        </div>
                        <div class="section-content">${data.anamnesa || '-'}</div>
                    </div>

                    <!-- Temuan Klinis -->
                    <div class="medical-section">
                        <div class="section-title">
                            <i class="fas fa-heartbeat"></i>
                            Temuan Klinis
                        </div>
                        <div class="section-content">${data.temuan_klinis || '-'}</div>
                    </div>

                    <!-- Diagnosa -->
                    <div class="medical-section">
                        <div class="section-title">
                            <i class="fas fa-stethoscope"></i>
                            Diagnosa
                        </div>
                        <div class="section-content">${data.diagnosa || '-'}</div>
                    </div>

                    <!-- Detail Tindakan Terapi -->
                    <div class="medical-section">
                        <div class="section-title">
                            <i class="fas fa-pills"></i>
                            Detail Tindakan Terapi
                        </div>
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
                    url: "{{ url('dokter/rekam-medis') }}/" + id,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    success: function(res) {
                        hideLoading();
                        const data = res.data;

                        $('#idpet').val(data.idpet).trigger(
                            'change'); // Pastikan select2 pet terisi
                        $('#dokter_pemeriksa').val(data.dokter_pemeriksa);
                        $('#anamnesa').val(data.anamnesa);
                        $('#temuan_klinis').val(data.temuan_klinis);
                        $('#diagnosa').val(data.diagnosa);

                        // Kosongkan detail sebelum menambah ulang
                        $('#detailContainer').empty();
                        detailCount = 0;
                        if (data.details && data.details.length > 0) {
                            data.details.forEach(function(detail) {
                                addDetailRow(detail);
                            });
                        } else {
                            addDetailRow();
                        }

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
                        url: "{{ route('dokter.rekam-medis.destroy') }}",
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
                                text: res.message ||
                                    'Rekam medis berhasil dihapus.'
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
                    "{{ url('dokter/rekam-medis') }}/" + id :
                    "{{ route('dokter.rekam-medis.store') }}";

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
                        idkode_tindakan_terapi: $(
                                `select[name="details[${index}][idkode_tindakan_terapi]"]`)
                            .val(),
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
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
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

            if (window.jQuery && $.fn.select2) {
                $('#idpet').select2({
                    placeholder: 'Pilih Pet',
                    allowClear: true,
                    width: 'resolve',
                    dropdownParent: $('#modalRekamMedis')
                });
            }
        });
    </script>
@endpush
