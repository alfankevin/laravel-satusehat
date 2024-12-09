<!-- Tindakan Card -->
<div id="tindakan" class="card" style="display: none;">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Tindakan(ICD 9)</h3>
        </div>
    </div>
    <div class="card-body">
        <form id="formTambahTindakan">
            <div class="row mb-3">
                <div class="col-7">
                    <label for="tindakanSelect" class="form-label">Tindakan(ICD 9)</label>
                    <select id="tindakanSelect" class="form-control js-select2`" required>
                        <option value="" disabled selected>--Pilih tindakan--</option>
                        <option value="Vaksin Covid" data-harga="20000">Vaksin Covid</option>
                        <option value="Suntik Vitamin" data-harga="30000">Suntik Vitamin</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="hargaInputtindakan" class="form-label">Harga</label>
                    <input type="text" id="hargaInputtindakan" class="form-control" readonly />
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
                    <th>Tindakan</th>
                    <th width="20%">Harga</th>
                    <th width="5%"></th>
                </tr>
            </thead>
            <tbody id="tindakanTableBody">

            </tbody>
        </table>
    </div>
</div>


@push('scripts')
    <!-- Script -->
    <script>
        $(document).ready(function() {
            // Update hargaInputtindakan on tindakanSelect change
            $('#tindakanSelect').on('change', function() {
                const selectedOption = $(this).find(':selected');
                const harga = selectedOption.data('harga'); // Ambil data-harga
                $('#hargaInputtindakan').val(harga ? `Rp. ${new Intl.NumberFormat('id-ID').format(harga)}` :
                    '');
            });

            // Handle form submission
            $('#formTambahTindakan').on('submit', function(e) {
                e.preventDefault();

                const tindakan = $('#tindakanSelect').val();
                const harga = $('#hargaInputtindakan').val();

                if (tindakan && harga) {
                    const newRow = `
                    <tr>
                        <td>${$('#tindakanTableBody tr').length + 1}</td>
                        <td>${tindakan}</td>
                        <td>${harga}</td>
                        <td><button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td>
                    </tr>
                `;

                    $('#tindakanTableBody').append(newRow);
                    $('#modalTambahTindakan').modal('hide');
                    $('#formTambahTindakan')[0].reset();
                    $('#tindakanSelect').val(null).trigger('change');
                    $('#hargaInputtindakan').val('');
                }
            });

            // Handle delete button click
            $('#tindakanTableBody').on('click', '.btn-danger', function() {
                $(this).closest('tr').remove();

                // Update numbering
                $('#tindakanTableBody tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
            });
        });
    </script>
@endpush
