<!-- Diagnosa Card -->
<div id="diagnosa" class="card" style="display: none;">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Diagnosa (ICD 10)</h3>
        </div>
    </div>
    <div class="card-body">
        <form id="formTambahDiagnosa">
            @csrf
            <div class="row mb-3">
                <div class="col-10">
                <input type="hidden" name="kunjungan_id" value="{{ $pemeriksaan->id }}">
                    <label for="diagnosaSelect" class="form-label">Diagnosa (ICD 10)</label>
                    <select id="diagnosaSelect" name="diagnosa_id" class="form-control js-select2" style="width: 100%" required>
                        <option value="">--Pilih Diagnosa--</option>
                        @foreach ($diagnosas as $diagnosa)
                            <option value="{{ $diagnosa->id }}" data-icd="{{ $diagnosa->kode }}" data-nama="{{ $diagnosa->diagnosa }}">{{ $diagnosa->kode }} - {{ $diagnosa->diagnosa }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 mt-2">
                    <button class="btn btn-primary btn-sm form-control mt-4" type="submit">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            </div>
        </form>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th width="5%">ICD</th>
                    <th>Diagnosa</th>
                    <th width="5%"></th>
                </tr>
            </thead>
            <tbody id="diagnosaTableBody">
                @foreach ($pemeriksaan->diagnosa as $key => $data)
                    <tr id="diagnosa-{{ $data->id }}">
                        <td class="text-center" width="5%">{{ $key + 1 }}</td>
                        <td width="5%">{{ $data->diagnosa->kode }}</td>
                        <td>{{ $data->diagnosa->diagnosa }}</td>
                        <td width="5%"><button class="btn btn-sm btn-danger delete-diagnosa" data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button></td>
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

            // Handle form submission
            $('#formTambahDiagnosa').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('pasien-diagnosa.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        const selectedOption = $('#diagnosaSelect').find(':selected');
                        const diagnosa = selectedOption.text();
                        const nama = selectedOption.data('nama');
                        const icd = selectedOption.data('icd');

                        if (diagnosa && icd) {
                            const tableBody = $('#diagnosaTableBody');
                            const newRow = `
                                <tr id="diagnosa-${response.no}">
                                    <td class="text-center">${tableBody.find('tr').length + 1}</td>
                                    <td>${icd}</td>
                                    <td>${nama}</td>
                                    <td><button class="btn btn-sm btn-danger delete-diagnosa" data-id="` + response.no + `"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            `;

                            // Append new row to table
                            tableBody.append(newRow);

                            // Reset form and close modal
                            $('#diagnosaSelect').val(null).trigger('change');
                            const modal = bootstrap.Modal.getInstance(document.getElementById(
                                'modalTambahDiagnosa'));
                            modal.hide();
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
        $(document).on('click', '.delete-diagnosa', function() {
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
                        url: "{{ route('pasien-diagnosa.destroy', '') }}/" + id,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.success) {
                                // Hapus baris dari tampilan
                                $('#diagnosa-' + id).remove();
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
