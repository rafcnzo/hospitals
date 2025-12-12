@extends('layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title-wrapper">
                        <div class="page-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Master Pet</h1>
                            <p class="page-subtitle">Kelola data hewan peliharaan</p>
                        </div>
                    </div>
                    <button class="btn-add-primary" id="btnTambahPet">
                        <i class="bi bi-plus-circle"></i>
                        <span>Tambah Pet</span>
                    </button>
                </div>
            </div>

            <!-- Data Table Card -->
            <div class="data-card">
                <div class="data-card-header">
                    <div class="data-card-title">
                        <i class="bi bi-list-ul"></i>
                        <span>Daftar Pet</span>
                    </div>
                </div>
                <div class="data-card-body">
                    <div class="table-container">
                        <table class="data-table" id="tabel-pet">
                            <thead>
                                <tr>
                                    <th class="col-number">#</th>
                                    <th class="col-main">Nama Pet</th>
                                    <th class="col-secondary">Pemilik</th>
                                    <th class="col-secondary">Ras</th>
                                    <th class="col-secondary">Kelamin</th>
                                    <th class="col-secondary">Tanggal Lahir</th>
                                    <th class="col-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pets as $i => $pet)
                                    <tr class="data-row">
                                        <td class="col-number">
                                            <span class="row-number">{{ $i + 1 }}</span>
                                        </td>
                                        <td class="col-main">
                                            <div class="item-info">
                                                <span class="item-name">{{ $pet->nama }}</span>
                                                <span class="item-email">{{ $pet->warna_tanda }}</span>
                                            </div>
                                        </td>
                                        <td class="col-secondary">
                                            <span class="badge bg-info">{{ $pet->pemilik->user->name ?? '-' }}</span>
                                        </td>
                                        <td class="col-secondary">
                                            <span class="badge bg-success">{{ $pet->rasHewan->nama_ras ?? '-' }}</span>
                                            <small class="d-block text-muted mt-1">{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</small>
                                        </td>
                                        <td class="col-secondary">
                                            @if($pet->jenis_kelamin == 'L')
                                                <span class="badge bg-primary">Jantan</span>
                                            @else
                                                <span class="badge bg-danger">Betina</span>
                                            @endif
                                        </td>
                                        <td class="col-secondary">
                                            {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d/m/Y') }}
                                        </td>
                                        <td class="col-action">
                                            <div class="action-buttons">
                                                <button class="btn-action btn-edit btnEditPet"
                                                    data-id="{{ $pet->idpet }}" 
                                                    data-nama="{{ $pet->nama }}"
                                                    data-tanggal-lahir="{{ $pet->tanggal_lahir }}"
                                                    data-warna-tanda="{{ $pet->warna_tanda }}"
                                                    data-jenis-kelamin="{{ $pet->jenis_kelamin }}"
                                                    data-idpemilik="{{ $pet->idpemilik }}"
                                                    data-idras-hewan="{{ $pet->idras_hewan }}"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn-action btn-delete btnHapusPet"
                                                    data-id="{{ $pet->idpet }}" 
                                                    data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($pets->count() == 0)
                                    <tr>
                                        <td colspan="7" class="empty-state">
                                            <div class="empty-content">
                                                <i class="bi bi-heart"></i>
                                                <h4>Belum ada data pet</h4>
                                                <p>Klik tombol "Tambah Pet" untuk memulai</p>
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

    <!-- Modal Pet -->
    <div class="modal fade" id="modalPet" tabindex="-1" aria-labelledby="modalPetLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content custom-modal">
                <form id="formPet">
                    @csrf
                    <input type="hidden" name="id" id="pet_id">
                    <div class="modal-header custom-modal-header">
                        <div class="modal-header-content">
                            <div class="modal-icon">
                                <i class="bi bi-heart"></i>
                            </div>
                            <h5 class="modal-title" id="modalPetLabel">Tambah Pet</h5>
                        </div>
                        <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Tutup">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body custom-modal-body">
                        <div id="formPetAlert"></div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group-custom">
                                    <label for="nama" class="form-label-custom required">
                                        <i class="bi bi-heart-fill"></i> Nama Pet
                                    </label>
                                    <input type="text" class="form-control-custom" id="nama" name="nama" required maxlength="100" placeholder="Contoh: Milo, Luna">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group-custom">
                                    <label for="tanggal_lahir" class="form-label-custom required">
                                        <i class="bi bi-calendar"></i> Tanggal Lahir
                                    </label>
                                    <input type="date" class="form-control-custom" id="tanggal_lahir" name="tanggal_lahir" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="idpemilik" class="form-label-custom required">
                                        <i class="bi bi-person"></i> Pemilik
                                    </label>
                                    <select class="form-control-custom" id="idpemilik" name="idpemilik" required>
                                        <option value="">Pilih Pemilik</option>
                                        @foreach ($pemilik as $owner)
                                            <option value="{{ $owner->idpemilik }}">{{ $owner->user->name ?? '-' }} ({{ $owner->no_wa }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label for="idras_hewan" class="form-label-custom required">
                                        <i class="bi bi-tags"></i> Ras Hewan
                                    </label>
                                    <select class="form-control-custom" id="idras_hewan" name="idras_hewan" required>
                                        <option value="">Pilih Ras</option>
                                        @foreach ($rasHewan as $ras)
                                            <option value="{{ $ras->idras_hewan }}">{{ $ras->nama_ras }} ({{ $ras->jenisHewan->nama_jenis_hewan ?? '-' }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group-custom">
                            <label for="warna_tanda" class="form-label-custom required">
                                <i class="bi bi-palette"></i> Warna/Tanda
                            </label>
                            <input type="text" class="form-control-custom" id="warna_tanda" name="warna_tanda" required maxlength="45" placeholder="Contoh: Putih belang coklat, Abu-abu kehitaman">
                        </div>
                        <div class="form-group-custom">
                            <label class="form-label-custom required">
                                <i class="bi bi-gender-ambiguous"></i> Jenis Kelamin
                            </label>
                            <div class="radio-group">
                                <div class="radio-item">
                                    <input type="radio" class="form-radio-custom" id="jenis_kelamin_l" name="jenis_kelamin" value="L" required>
                                    <label for="jenis_kelamin_l" class="radio-label-custom">
                                        <i class="bi bi-gender-male"></i> Jantan
                                    </label>
                                </div>
                                <div class="radio-item">
                                    <input type="radio" class="form-radio-custom" id="jenis_kelamin_p" name="jenis_kelamin" value="P" required>
                                    <label for="jenis_kelamin_p" class="radio-label-custom">
                                        <i class="bi bi-gender-female"></i> Betina
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer custom-modal-footer">
                        <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn-primary-custom" id="btnSimpanPet">
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

            const modalEl = document.getElementById('modalPet');
            const modalPet = new window.bootstrap.Modal(modalEl);
            const $form = $('#formPet');
            const $btnTambah = $('#btnTambahPet');
            const $btnSimpan = $('#btnSimpanPet');
            const $alert = $('#formPetAlert');

            function resetForm() {
                $form[0].reset();
                $('#pet_id').val('');
                $alert.html('');
                $('#modalPetLabel').text('Tambah Pet');
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
                modalPet.show();
            });

            $(document).on('click', '.btnEditPet', function() {
                resetForm();
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                const tanggalLahir = $(this).data('tanggal-lahir');
                const warnaTanda = $(this).data('warna-tanda');
                const jenisKelamin = $(this).data('jenis-kelamin');
                const idpemilik = $(this).data('idpemilik');
                const idrasHewan = $(this).data('idras-hewan');

                $('#modalPetLabel').text('Edit Pet');
                $('#pet_id').val(id);
                $('#nama').val(nama);
                $('#tanggal_lahir').val(tanggalLahir);
                $('#warna_tanda').val(warnaTanda);
                $('input[name="jenis_kelamin"][value="' + jenisKelamin + '"]').prop('checked', true);
                $('#idpemilik').val(idpemilik);
                $('#idras_hewan').val(idrasHewan);
                modalPet.show();
            });

            $(document).on('click', '.btnHapusPet', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus Pet?',
                    text: 'Data pet ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (!result.isConfirmed) return;

                    showLoading('Menghapus pet...');
                    $.ajax({
                        url: "{{ route('admin.pet.destroy') }}",
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
                                text: res.message || 'Pet berhasil dihapus.'
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr) {
                            hideLoading();
                            let msg = 'Terjadi kesalahan saat menghapus pet.';
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

                const id = $('#pet_id').val();
                const isEdit = !!id;

                const url = isEdit ?
                    "{{ url('admin/pet') }}/" + id :
                    "{{ route('admin.pet.store') }}";

                const method = isEdit ? 'PUT' : 'POST';

                const payload = {
                    nama: $('#nama').val(),
                    tanggal_lahir: $('#tanggal_lahir').val(),
                    warna_tanda: $('#warna_tanda').val(),
                    jenis_kelamin: $('input[name="jenis_kelamin"]:checked').val(),
                    idpemilik: $('#idpemilik').val(),
                    idras_hewan: $('#idras_hewan').val()
                };

                $btnSimpan.prop('disabled', true)
                    .html('<i class="bi bi-arrow-repeat bx-spin"></i> Menyimpan...');

                showLoading('Menyimpan data pet...');

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

                        modalPet.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message || 'Pet berhasil disimpan.'
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
