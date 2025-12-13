@extends('layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title-wrapper">
                        <div class="page-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Jadwal Temu</h1>
                            <p class="page-subtitle">Kelola jadwal temu pasien</p>
                        </div>
                    </div>
                    <button class="btn-add-primary" id="btnTambahJadwalTemu">
                        <i class="bi bi-plus-circle"></i>
                        <span>Tambah Jadwal</span>
                    </button>
                </div>
            </div>

            <div class="data-card">
                <div class="data-card-header">
                    <div class="data-card-title">
                        <i class="bi bi-list-ul"></i>
                        <span>Daftar Jadwal Temu</span>
                    </div>
                </div>
                <div class="data-card-body">
                    <div class="table-container">
                        <table class="data-table" id="tabel-jadwal-temu">
                            <thead>
                                <tr>
                                    <th class="col-number">#</th>
                                    <th class="col-secondary">Waktu Temu</th>
                                    <th class="col-main">Pasien (Hewan)</th>
                                    <th class="col-main">Pemilik</th>
                                    <th class="col-main">Keterangan</th>
                                    <th class="col-secondary">Status</th>
                                    <th class="col-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jadwalTemu as $i => $temu)
                                    <tr class="data-row">
                                        <td class="col-number">
                                            <span class="row-number">{{ $i + 1 }}</span>
                                        </td>
                                        <td class="col-secondary">
                                            {{-- Format Tanggal & Jam --}}
                                            {{ $temu->waktu_temu->format('d/m/Y') }} <br>
                                            <small class="text-muted">{{ $temu->waktu_temu->format('H:i') }} WIB</small>
                                        </td>
                                        <td class="col-main">
                                            <strong>{{ $temu->pet->nama ?? '-' }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                {{ $temu->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }} -
                                                {{ $temu->pet->rasHewan->nama_ras ?? '-' }}
                                            </small>
                                        </td>
                                        <td class="col-main">
                                            <strong>{{ $temu->pet->pemilik->user->name ?? '-' }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $temu->pet->pemilik->no_wa ?? '-' }}</small>
                                        </td>
                                        <td class="col-main">
                                            {{ $temu->keterangan }}
                                        </td>
                                        <td class="col-secondary">
                                            @switch($temu->status)
                                                @case('terjadwal')
                                                    <span class="badge bg-warning">Terjadwal</span>
                                                @break

                                                @case('selesai')
                                                    <span class="badge bg-success">Selesai</span>
                                                @break

                                                @case('batal')
                                                    <span class="badge bg-danger">Batal</span>
                                                @break

                                                @default
                                                    <span class="badge bg-secondary">-</span>
                                            @endswitch
                                        </td>
                                        <td class="col-action">
                                            <div class="action-buttons">
                                                <button class="btn-action btn-edit btnEditJadwalTemu"
                                                    data-id="{{ $temu->idjadwal_temu }}" data-idpet="{{ $temu->idpet }}"
                                                    data-keterangan="{{ $temu->keterangan }}"
                                                    data-status="{{ $temu->status }}" data-bs-toggle="tooltip"
                                                    title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn-action btn-delete btnHapusJadwalTemu"
                                                    data-id="{{ $temu->idjadwal_temu }}" data-bs-toggle="tooltip"
                                                    title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="empty-state">
                                                <div class="empty-content">
                                                    <i class="bi bi-calendar-check"></i>
                                                    <h4>Belum ada jadwal temu</h4>
                                                    <p>Klik tombol "Tambah Jadwal" untuk memulai</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalJadwalTemu" tabindex="-1" aria-labelledby="modalJadwalTemuLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content custom-modal">
                    <form id="formJadwalTemu">
                        @csrf
                        <input type="hidden" name="id" id="jadwal_temu_id">
                        <div class="modal-header custom-modal-header">
                            <div class="modal-header-content">
                                <div class="modal-icon">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <h5 class="modal-title" id="modalJadwalTemuLabel">Tambah Jadwal Temu</h5>
                            </div>
                            <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Tutup">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                        <div class="modal-body custom-modal-body">
                            <div id="formJadwalTemuAlert"></div>

                            {{-- Input Hewan (Pet) --}}
                            <div class="form-group-custom">
                                <label for="idpet" class="form-label-custom required">
                                    <i class="bi bi-search-heart"></i> Pilih Hewan Pasien
                                </label>
                                <select class="form-control-custom select2" id="idpet" name="idpet" required>
                                    <option value="">-- Pilih Hewan --</option>
                                    @foreach ($pets as $pet)
                                        <option value="{{ $pet->idpet }}">
                                            {{ $pet->nama }} (Pemilik: {{ $pet->pemilik->user->name ?? 'Anonim' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Input Waktu Temu (Gabungan Date & Time) --}}
                            <div class="form-group-custom">
                                <label for="waktu_temu" class="form-label-custom required">
                                    <i class="bi bi-clock"></i> Waktu Temu
                                </label>
                                <input type="datetime-local" class="form-control-custom" id="waktu_temu" name="waktu_temu"
                                    required>
                            </div>

                            {{-- Input Keterangan --}}
                            <div class="form-group-custom">
                                <label for="keterangan" class="form-label-custom required">
                                    <i class="bi bi-card-text"></i> Keterangan / Keluhan
                                </label>
                                <input type="text" class="form-control-custom" id="keterangan" name="keterangan"
                                    placeholder="Contoh: Vaksinasi Tahunan" required>
                            </div>

                            {{-- Input Status (Hanya Muncul saat Edit) --}}
                            <div class="form-group-custom d-none" id="groupStatus">
                                <label for="status" class="form-label-custom required">
                                    <i class="bi bi-flag"></i> Status
                                </label>
                                <select class="form-control-custom" id="status" name="status">
                                    <option value="terjadwal">Terjadwal</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="batal">Batal</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer custom-modal-footer">
                            <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                                <i class="bi bi-x"></i> Batal
                            </button>
                            <button type="submit" class="btn-primary-custom" id="btnSimpanJadwalTemu">
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

                const modalEl = document.getElementById('modalJadwalTemu');
                const modalJadwalTemu = new window.bootstrap.Modal(modalEl);
                const $form = $('#formJadwalTemu');
                const $btnTambah = $('#btnTambahJadwalTemu');
                const $btnSimpan = $('#btnSimpanJadwalTemu');
                const $alert = $('#formJadwalTemuAlert');
                const $groupStatus = $('#groupStatus');

                function resetForm() {
                    $form[0].reset();
                    $('#jadwal_temu_id').val('');
                    $alert.html('');
                    $('#modalJadwalTemuLabel').text('Tambah Jadwal Temu');
                    $btnSimpan.prop('disabled', false).html('<i class="bi bi-check"></i> Simpan');

                    // Status disembunyikan saat tambah baru (default: terjadwal)
                    $groupStatus.addClass('d-none');
                    $('#status').prop('required', false);
                }

                function showSwalError(message) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: message || 'Terjadi kesalahan. Silakan coba lagi.'
                    });
                }

                // Helper loading
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

                $btnTambah.on('click', function() {
                    resetForm();
                    modalJadwalTemu.show();
                });

                // Klik Tombol Edit
                $(document).on('click', '.btnEditJadwalTemu', function() {
                    resetForm();
                    const id = $(this).data('id');

                    // Tampilkan status karena ini mode edit
                    $groupStatus.removeClass('d-none');
                    $('#status').prop('required', true);

                    $('#modalJadwalTemuLabel').text('Edit Jadwal Temu');
                    $('#jadwal_temu_id').val(id);

                    showLoading('Memuat data...');

                    // AJAX Request ke method show() di Controller untuk dapat format tanggal yg benar
                    $.ajax({
                        url: "{{ url('resepsionis/jadwal-temu') }}/" + id +
                            "/show", // Pastikan route show ada
                        type: 'GET',
                        success: function(res) {
                            hideLoading();
                            if (res.status === 'success') {
                                const d = res.data;

                                $('#idpet').val(d.idpet).trigger('change');
                                // formatted_waktu dikirim dari controller (Y-m-d\TH:i)
                                $('#waktu_temu').val(d.formatted_waktu);
                                $('#keterangan').val(d.keterangan);
                                $('#status').val(d.status).trigger('change');

                                modalJadwalTemu.show();
                            }
                        },
                        error: function() {
                            hideLoading();
                            showSwalError('Gagal memuat data jadwal.');
                        }
                    });
                });

                // Klik Hapus
                $(document).on('click', '.btnHapusJadwalTemu', function() {
                    const id = $(this).data('id');

                    Swal.fire({
                        title: 'Hapus Jadwal Temu?',
                        text: 'Jadwal temu ini akan dihapus permanen.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d'
                    }).then((result) => {
                        if (!result.isConfirmed) return;

                        showLoading('Menghapus jadwal temu...');
                        $.ajax({
                            url: "{{ route('resepsionis.jadwal-temu.destroy') }}",
                            type: 'POST',
                            data: {
                                id: id,
                                _method: 'DELETE'
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'Accept': 'application/json'
                            },
                            success: function(res) {
                                hideLoading();
                                Swal.fire('Berhasil', res.message, 'success').then(() =>
                                    window.location.reload());
                            },
                            error: function(xhr) {
                                hideLoading();
                                showSwalError(xhr.responseJSON?.message ||
                                    'Gagal menghapus.');
                            }
                        });
                    });
                });

                // Submit Form
                $form.on('submit', function(e) {
                    e.preventDefault();
                    $alert.html('');

                    const id = $('#jadwal_temu_id').val();
                    const isEdit = !!id;

                    const url = isEdit ?
                        "{{ url('resepsionis/jadwal-temu') }}/" + id :
                        "{{ route('resepsionis.jadwal-temu.store') }}";
                    const method = isEdit ? 'PUT' : 'POST';

                    const payload = {
                        idpet: $('#idpet').val(),
                        waktu_temu: $('#waktu_temu').val(),
                        keterangan: $('#keterangan').val(),
                        // Status hanya dikirim kalau mode edit
                        ...(isEdit && {
                            status: $('#status').val()
                        })
                    };

                    $btnSimpan.prop('disabled', true).html(
                        '<i class="bi bi-arrow-repeat bx-spin"></i> Menyimpan...');
                    showLoading('Menyimpan jadwal temu...');

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            ...payload,
                            _method: method
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Accept': 'application/json'
                        },
                        success: function(res) {
                            hideLoading();
                            $btnSimpan.prop('disabled', false).html(
                                '<i class="bi bi-check"></i> Simpan');
                            modalJadwalTemu.hide();
                            Swal.fire('Berhasil', res.message, 'success').then(() => window.location
                                .reload());
                        },
                        error: function(xhr) {
                            hideLoading();
                            $btnSimpan.prop('disabled', false).html(
                                '<i class="bi bi-check"></i> Simpan');

                            if (xhr.status === 422 && xhr.responseJSON?.errors) {
                                const errors = xhr.responseJSON.errors;
                                let html =
                                    `<div class="alert-custom alert-danger"><i class="bi bi-exclamation-triangle"></i><div>`;
                                Object.keys(errors).forEach(key => {
                                    html += `<div>${errors[key].join('<br>')}</div>`;
                                });
                                html += `</div></div>`;
                                $alert.html(html);
                            } else {
                                showSwalError(xhr.responseJSON?.message || 'Gagal menyimpan data.');
                            }
                        }
                    });
                });
                if (window.jQuery && $.fn.select2) {
                    $('#idpet').select2({
                        placeholder: '-- Pilih Hewan --',
                        allowClear: true,
                        width: '100%',
                        dropdownParent: $('#modalJadwalTemu')
                    });

                }
            });
        </script>
    @endpush
