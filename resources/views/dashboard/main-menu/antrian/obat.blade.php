<!-- Obat Card -->
<div id="obat" class="card" style="display: none;">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Obat</h3>
        </div>
    </div>
    <div class="card-body">
        <form id="formTambahObat">
            @csrf
            <div class="row mb-3">
                <div class="col-5">
                    <input type="hidden" name="kunjungan_id" value="{{ $pemeriksaan->id }}" hidden>
                    <input type="hidden" name="harga_obat" id="hargaObat">
                    <input type="hidden" name="instruksi" id="instruksi">
                    <label for="obatSelect" class="form-label">Obat</label>
                    <select id="obatSelect" class="form-control js-select2" name="obat_id" required>
                        <option value="" disabled selected>--Pilih obat--</option>
                        @foreach ($obats as $obat)
                            <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">{{ $obat->nama_obat }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label for="qtyInput" class="form-label">Jumlah</label>
                    <input type="number" id="qtyInput" class="form-control" name="jumlah_obat" placeholder="Jumlah"
                        min="1" required />
                </div>
                <div class="col-4">
                    <label for="hargaInputObat" class="form-label">Harga</label>
                    <input type="text" id="hargaInputObat" class="form-control" readonly />
                </div>
                <div class="col-5 mt-2">
                    <label for="cara_minum" class="form-label">Cara Minum</label>
                    <select id="cara_minum" class="form-control js-select2" required>
                        <option value="" disabled selected>--Pilih cara minum--</option>
                        <option value="Sebelum Makan">Sebelum Makan</option>
                        <option value="Setelah Makan">Setelah Makan</option>
                    </select>
                </div>
                <div class="col-5 mt-2">
                    <label for="dosis" class="form-label">Dosis</label>
                    <select id="dosis" class="form-control js-select2" required>
                        <option value="" disabled selected>--Pilih Dosis--</option>
                        <option value="3x1">3 x 1</option>
                        <option value="2x1">2 x 1</option>
                    </select>
                </div>
                <div class="col-2 mt-3">
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
                    <th>Obat</th>
                    <th width="5%">Qty</th>
                    <th width="20%">Harga</th>
                    <th width="20%">Subtotal</th>
                    <th width="5%"></th>
                </tr>
            </thead>
            <tbody id="obatTableBody">
                @foreach ($pemeriksaan->obat as $key => $data)
                    <tr class="obat-{{ $data->id }}" data-main>
                        <td class="text-center" width="5%">{{ $key + 1 }}</td>
                        <td>{{ $data->obat->nama_obat }}</td>
                        <td width="5%">{{ $data->jumlah_obat }}</td>
                        <td width="20%">Rp{{ number_format($data->harga_obat, 0, ',', '.') }}</td>
                        <td width="20%">Rp{{ number_format($data->harga_obat * $data->jumlah_obat, 0, ',', '.') }}
                        </td>

                        <td width="5%"><button class="btn btn-sm btn-danger delete-obat"
                                data-id="{{ $data->id }}"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr class="obat-{{ $data->id }}">
                        <td></td>
                        <th width="17%">Intruksi:</th>
                        <td colspan="4">{{ $data->instruksi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <!-- Include SweetAlert2 and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- <script>
        $(document).ready(function() {
            $('#formTambahObat').on('submit', function(e) {
                e.preventDefault();

                // Ambil data dari form
                var formData = $(this).serialize();

                // Kirim data melalui AJAX
                $.ajax({
                    url: "{{ route('pasien-obat.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        const rowCount = $('#obatContainer .obatRow').length;
                        const namaObat = $('#nama_obat option:selected').text();
                        const hargaObat = $('#nama_obat option:selected').data('harga')
                            .toLocaleString('id-ID');
                        const jumlahObat = $('#jumlah_obat').val();
                        const subTotal = hargaObat * jumlahObat;
                        const formattedSubTotal = (subTotal.toFixed(3)).toLocaleString('id-ID');

                        // Jika sukses, tambahkan row baru ke container
                        $('.resepEmpty').remove();
                        $('#obatContainer').append(`
                            <div class="row obatRow" id="obat-${response.no}">
                                <div class="col-1 border py-2">` + (rowCount + 1) + `</div>
                                <div class="col-3 border py-2">` + namaObat + `</div>
                                <div class="col-3 border py-2">Rp` + hargaObat + `</div>
                                <div class="col-1 border py-2">` + jumlahObat + `</div>
                                <div class="col-3 border py-2">Rp` + formattedSubTotal + `</div>
                                <div class="col-1 border py-1">
                                    <button class="btn btn-danger btn-sm delete-obat" data-id="` + response.no + `"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        `);

                        // Reset form setelah submit
                        $('#obatForm')[0].reset();
                    },
                    error: function(xhr) {
                        // Tangani error (misal validasi)
                        alert('Something went wrong!');
                    }
                });
            });
        });
    </script> -->
@endpush

@push('scripts')
    <!-- Script -->
    <script>
        $(document).ready(function() {
            // Update harga saat obat dipilih
            $('#obatSelect').on('change', function() {
                const selectedOption = $(this).find(':selected');
                const obat = selectedOption.text();
                const harga = selectedOption.data('harga') || 0;

                $('#hargaObat').val(harga);
                $('#hargaInputObat').val(harga ? `Rp${new Intl.NumberFormat('id-ID').format(harga)}` : '');
            });

            $('#dosis, #cara_minum').on('change', function() {
                const dosis = $('#dosis').val();
                const caraMinum = $('#cara_minum').val();
                const instruksi = `${dosis} ${caraMinum}`;

                $('#instruksi').val(instruksi);
            });

            // Handle form submission
            $('#formTambahObat').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('pasien-obat.store') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        const qty = parseInt($('#qtyInput').val());
                        const selectedOption = $('#obatSelect').find(':selected');
                        const obat = selectedOption.text();
                        const harga = selectedOption.data('harga') || 0;
                        const subtotal = harga * qty;

                        if (!obat || !qty || qty < 1 || !harga) {
                            alert('Pastikan semua field terisi dengan benar!');
                            return;
                        }

                        // Format harga dan subtotal
                        const formattedHarga =
                            `Rp${new Intl.NumberFormat('id-ID').format(harga)}`;
                        const formattedSubtotal =
                            `Rp${new Intl.NumberFormat('id-ID').format(subtotal)}`;

                        // Tambahkan baris ke tabel
                        const tableBody = $('#obatTableBody');
                        const rowCount = tableBody.find('tr[data-main]').length + 1;
                        const newRow = `
                            <tr class="obat-${response.no}" data-main>
                                <td class="text-center">${rowCount}</td>
                                <td>${obat}</td>
                                <td>${qty}</td>
                                <td>${formattedHarga}</td>
                                <td>${formattedSubtotal}</td>
                                <td><button class="btn btn-sm btn-danger delete-obat" data-id="` + response.no + `"><i class="fas fa-trash"></i></button></td>
                            </tr>
                            <tr class="obat-${response.no}">
                                <td></td>
                                <th width="17%">Intruksi:</th>
                                <td colspan="4">${$('#instruksi').val()}</td>
                            </tr>
                        `;
                        tableBody.append(newRow);

                        // Reset form
                        $('#formTambahObat')[0].reset();
                        $('#hargaInputObat').val('');
                        $('#obatSelect').val(null).trigger('change');
                    },
                    error: function(xhr) {
                        // Tangani error (misal validasi)
                        alert('Something went wrong!');
                    }
                });
            });

            // Hapus baris dari tabel
            // $('#obatTableBody').on('click', '.btn-danger', function() {
            //     $(this).closest('tr').remove();

            //     // Update nomor urut
            //     $('#obatTableBody tr').each(function(index) {
            //         $(this).find('td:first').text(index + 1);
            //     });
            // });
        });
    </script>

    <script>
        $(document).on('click', '.delete-obat', function() {
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
                        url: "{{ route('pasien-obat.destroy', '') }}/" + id,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        type: 'DELETE',
                        success: function(response) {
                            if (response.success) {
                                // Hapus baris dari tampilan
                                $('.obat-' + id).remove();
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
