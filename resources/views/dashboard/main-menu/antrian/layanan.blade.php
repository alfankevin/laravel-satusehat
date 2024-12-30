<!-- Pemeriksaan Card -->
<div id="pemeriksaan" class="card" style="display: none;">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Pemeriksaan</h3>
        </div>
    </div>
    <div class="card-body">
        <form id="formTambahPemeriksaan">
            @csrf
            <div class="row mb-3">
                <div class="col-4">
                    <input type="hidden" name="kunjungan_id" value="{{ $pemeriksaan->id }}">
                    <label for="pemeriksaanSelect" class="form-label">Pemeriksaan</label>
                    <select id="pemeriksaanSelect" name="kategori_pemeriksaan_id" class="form-control js-select2">
                        <option value="">--Pilih Pemeriksaan--</option>
                        @foreach ($laborats as $laborat)
                            <option value="{{ $laborat->id }}" data-harga="{{ $laborat->biaya }}" data-nilai-normal="{{ $laborat->nilai_normal }}">
                                {{ $laborat->pemeriksaan }}
                            </option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="col-3">
                    <label for="hasil" class="form-label">Hasil</label>
                    <input type="text" id="hasil" name="hasil_pemeriksaan" class="form-control"
                        placeholder="{{ $laborat->nilai_normal }}" />
                </div>
                <div class="col-4">
                    <label for="petugas" class="form-label">Petugas</label>
                    <select id="petugas" name="practitioner_id" class="form-control js-select2">
                        <option value="">--Pilih Petugas--</option>
                        @foreach ($practitioners as $practitioner)
                            <option value="{{ $practitioner->id }}">{{ $practitioner->namaPractitioner }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3" style="display: none">
                    <label for="hargaInput" class="form-label">Biaya</label>
                    <input type="text" id="hargaInput" name="biaya" class="form-control" readonly />
                    <input type="hidden" id="hargaLayanan" name="biaya" class="form-control" readonly />
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
                    <th>Pemeriksaan</th>
                    <th>Hasil</th>
                    <th>Petugas</th>
                    <th width="20%">Biaya</th>
                    <th width="5%"></th>
                </tr>
            </thead>
            <tbody id="pemeriksaanTableBody">
                @foreach ($pemeriksaan->laborat as $key => $data)
                    <tr id="laborat-{{ $data->id }}">
                        <td class="text-center" width="5%">{{ $key + 1 }}</td>
                        <td>{{ $data->kategoriPemeriksaan->pemeriksaan }}</td>
                        <td>{{ $data->hasil_pemeriksaan }}</td>
                        <td>{{ $data->practitioner->namaPractitioner }}</td>
                        <td width="20%">Rp{{ number_format($data->biaya, 0, ',', '.') }}</td>
                        <td width="5%"><button class="btn btn-sm btn-danger delete-laborat"
                                data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button></td>
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
            // Update hargaInput dan placeholder hasil berdasarkan pemeriksaanSelect
            $('#pemeriksaanSelect').on('change', function() {
                const selectedOption = $(this).find(':selected');
                const harga = selectedOption.data('harga');
                const nilaiNormal = selectedOption.data('nilai-normal');

                // Update harga
                $('#hargaLayanan').val(harga);
                $('#hargaInput').val(harga ? `Rp${new Intl.NumberFormat('id-ID').format(harga)}` : '');

                // Update placeholder hasil
                $('#hasil').attr('placeholder', nilaiNormal || '');
            });

            // Handle form submission
            $('#formTambahPemeriksaan').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('pasien-laborat.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        const pemeriksaanOption = $('#pemeriksaanSelect').find(':selected');
                        const pemeriksaan = pemeriksaanOption.text();
                        const petugasOption = $('#petugas').find(':selected');
                        const petugas = petugasOption.text();
                        const hasil = $('#hasil').val();
                        const harga = $('#hargaInput').val();

                        if (pemeriksaan && harga) {
                            const newRow = `
                        <tr id="laborat-${response.no}">
                            <td class="text-center">${$('#pemeriksaanTableBody tr').length + 1}</td>
                            <td>${pemeriksaan}</td>
                            <td>${hasil}</td>
                            <td>${petugas}</td>
                            <td>${harga}</td>
                            <td><button class="btn btn-sm btn-danger delete-laborat" data-id="` + response.no + `"><i class="fas fa-trash"></i></button></td>
                        </tr>
                    `;

                            $('#pemeriksaanTableBody').append(newRow);
                            $('#modalTambahPemeriksaan').modal('hide');
                            $('#formTambahPemeriksaan')[0].reset();
                            $('#pemeriksaanSelect').val(null).trigger('change');
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
        $(document).on('click', '.delete-laborat', function() {
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
                        url: "{{ route('pasien-laborat.destroy', '') }}/" + id,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.success) {
                                // Hapus baris dari tampilan
                                $('#laborat-' + id).remove();
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
