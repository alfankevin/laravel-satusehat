<!-- Obat Card -->
<div id="obat" class="card" style="display: none;">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Obat</h3>
        </div>
    </div>
    <div class="card-body">
        <form id="formTambahObat">
            <div class="row mb-3">
                <div class="col-5">
                    <label for="obatSelect" class="form-label">Obat</label>
                    <select id="obatSelect" class="form-control js-select2" required>
                        <option value="" disabled selected>--Pilih obat--</option>
                        <option value="Paramex" data-harga="20000">Paramex</option>
                        <option value="Panadol" data-harga="15000">Panadol</option>
                        <option value="Bodrex" data-harga="28000">Bodrex</option>
                        <option value="Amoxicilin 500 Mg" data-harga="12000">Amoxicilin 500 Mg</option>
                        <option value="Paracetamol 500 Mg" data-harga="14000">Paracetamol 500 Mg</option>
                    </select>
                </div>
                <div class="col-2">
                    <label for="qtyInput" class="form-label">Jumlah</label>
                    <input type="number" id="qtyInput" class="form-control" placeholder="Jumlah" min="1"
                        required />
                </div>
                <div class="col-3">
                    <label for="hargaInputObat" class="form-label">Harga</label>
                    <input type="text" id="hargaInputObat" class="form-control" readonly />
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
                    <th>Obat</th>
                    <th width="5%">Qty</th>
                    <th width="20%">Harga</th>
                    <th width="20%">Subtotal</th>
                    <th width="5%"></th>
                </tr>
            </thead>
            <tbody id="obatTableBody">
                <!-- Data Obat Ditambahkan di Sini -->
            </tbody>
        </table>
    </div>
</div>



@push('scripts')
    <!-- Script -->
    <script>
        $(document).ready(function() {
            // Update harga saat obat dipilih
            $('#obatSelect').on('change', function() {
                const selectedOption = $(this).find(':selected');
                const harga = selectedOption.data('harga') || 0;
                $('#hargaInputObat').val(harga ? `Rp. ${new Intl.NumberFormat('id-ID').format(harga)}` :
                    '');
            });

            // Handle form submission
            $('#formTambahObat').on('submit', function(e) {
                e.preventDefault();

                const obat = $('#obatSelect').val();
                const qty = parseInt($('#qtyInput').val());
                const selectedOption = $('#obatSelect').find(':selected');
                const harga = selectedOption.data('harga') || 0;
                const subtotal = harga * qty;

                if (!obat || !qty || qty < 1 || !harga) {
                    alert('Pastikan semua field terisi dengan benar!');
                    return;
                }

                // Format harga dan subtotal
                const formattedHarga = `Rp. ${new Intl.NumberFormat('id-ID').format(harga)}`;
                const formattedSubtotal = `Rp. ${new Intl.NumberFormat('id-ID').format(subtotal)}`;

                // Tambahkan baris ke tabel
                const tableBody = $('#obatTableBody');
                const newRow = `
            <tr>
                <td>${tableBody.find('tr').length + 1}</td>
                <td>${obat}</td>
                <td>${qty}</td>
                <td>${formattedHarga}</td>
                <td>${formattedSubtotal}</td>
                <td><button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td>
            </tr>
        `;
                tableBody.append(newRow);

                // Reset form
                $('#formTambahObat')[0].reset();
                $('#hargaInputObat').val('');
                $('#obatSelect').val(null).trigger('change');
            });

            // Hapus baris dari tabel
            $('#obatTableBody').on('click', '.btn-danger', function() {
                $(this).closest('tr').remove();

                // Update nomor urut
                $('#obatTableBody tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
            });
        });
    </script>
@endpush
