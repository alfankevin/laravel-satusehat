<!-- Tindakan Card -->
<div id="tindakan" class="card" style="display: none;">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Tindakan (ICD 9)</h3>
        </div>
    </div>
    <div class="card-body">
        <form id="formTambahTindakan">
            @csrf
            <div class="row mb-3">
                <div class="col-4">
                    <input type="hidden" name="kunjungan_id" value="{{ $pemeriksaan->id }}">
                    <label for="tindakanSelect" class="form-label">Tindakan (ICD 9)</label>
                    <select id="tindakanSelect" name="tindakan_id" class="form-control js-select2" required>
                        <option value="" disabled selected>--Pilih Tindakan--</option>
                        @foreach ($tindakans as $tindakan)
                            <option value="{{ $tindakan->id }}" data-harga="{{ $tindakan->biaya }}">{{ $tindakan->tindakan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label for="petugas" class="form-label">Petugas</label>
                    <select id="petugasTindakan" name="practitioner_id" class="form-control js-select2">
                        <option value="">--Pilih Petugas--</option>
                        @foreach ($practitioners as $practitioner)
                            <option value="{{ $practitioner->id }}">{{ $practitioner->namaPractitioner }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="hargaInputtindakan" class="form-label">Harga</label>
                    <input type="text" id="hargaInputtindakan" class="form-control" readonly />
                    <input type="hidden" id="hargaTindakan" name="biaya" class="form-control" readonly />
                </div>
                <div class="col-1 mt-2">
                    <button class="btn btn-primary btn-sm form-control mt-4" type="submit">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </form>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Tindakan</th>
                    <th>Petugas</th>
                    <th width="20%">Harga</th>
                    <th width="5%"></th>
                </tr>
            </thead>
            <tbody id="tindakanTableBody">
                @foreach ($pemeriksaan->tindakan as $key => $data)
                    <tr id="tindakan-{{ $data->id }}">
                        <td class="text-center" width="5%">{{ $key + 1 }}</td>
                        <td>{{ $data->tindakan->tindakan }}</td>
                        <td>{{ $data->practitioner->namaPractitioner }}</td>
                        <td width="20%">Rp{{ number_format($data->biaya, 0, ',', '.') }}</td>
                        <td width="5%"><button class="btn btn-sm btn-danger delete-tindakan" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Update hargaInputtindakan on tindakanSelect change
            $('#tindakanSelect').on('change', function() {
                const selectedOption = $(this).find(':selected');
                const harga = selectedOption.data('harga'); // Ambil data-harga
                $('#hargaTindakan').val(harga);
                $('#hargaInputtindakan').val(harga ? `Rp${new Intl.NumberFormat('id-ID').format(harga)}` : '');
            });

            // Handle form submission
            $('#formTambahTindakan').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('pasien-tindakan.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        const tindakanOption = $('#tindakanSelect').find(':selected');
                        const tindakan = tindakanOption.text();
                        const petugasOption = $('#petugasTindakan').find(':selected');
                        const petugas = petugasOption.text();
                        const harga = $('#hargaInputtindakan').val();

                        if (tindakan && harga) {
                            const newRow = `
                                <tr id="tindakan-${response.no}">
                                    <td class="text-center">${$('#tindakanTableBody tr').length + 1}</td>
                                    <td>${tindakan}</td>
                                    <td>${petugas}</td>
                                    <td>${harga}</td>
                                    <td><button class="btn btn-sm btn-danger delete-tindakan" data-id="` + response.no + `"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            `;

                            $('#tindakanTableBody').append(newRow);
                            $('#modalTambahTindakan').modal('hide');
                            $('#formTambahTindakan')[0].reset();
                            $('#tindakanSelect').val(null).trigger('change');
                            $('#hargaInputtindakan').val('');
                        }
                    },
                    error: function(xhr) {
                        // Tangani error (misal validasi)
                        alert('Something went wrong!');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).on('click', '.delete-tindakan', function() {
            var id = $(this).data('id'); // Ambil ID dari data-id tombol

            // Konfirmasi sebelum menghapus
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'danger',
                cancelButtonColor: 'info',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('pasien-tindakan.destroy', '') }}/" + id,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.success) {
                                // Hapus baris dari tampilan
                                $('#tindakan-' + id).remove();
                            }
                        },
                        error: function(xhr) {
                            alert('Something went wrong!');
                        }
                    });
                }
            });
        });
    </script>
@endpush
