<!-- Pemeriksaan Card -->
<div id="pemeriksaan" class="card" style="display: none;">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Pemeriksaan</h3>
        </div>
    </div>
    <div class="card-body">
        <form id="formTambahPemeriksaan">
            <div class="row mb-3">
                <div class="col-5">
                    <label for="pemeriksaanSelect" class="form-label">Pemeriksaan</label>
                    <select id="pemeriksaanSelect" class="form-control js-select2">
                        <option value="">--Pilih Pemeriksaan--</option>
                        <option value="Cek Gulah Darah" data-harga="20000">Cek Gulah Darah</option>
                        <option value="Asam Urat" data-harga="30000">Asam Urat</option>
                        <option value="Cholestrol" data-harga="25000">Cholestrol</option>
                    </select>
                </div>
                <div class="col-5">
                    <label for="hasil" class="form-label">Hasil</label>
                    <input type="text" id="hasil" class="form-control"/>
                </div>
                <div class="col-3" style="display: none">
                    <label for="hargaInput" class="form-label">Harga</label>
                    <input type="text" id="hargaInput" class="form-control" readonly />
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
                    <th>Pemeriksaan</th>
                    <th>Hasil</th>
                    <th width="20%">Harga</th>
                    <th width="5%"></th>
                </tr>
            </thead>
            <tbody id="pemeriksaanTableBody">
                
            </tbody>
        </table>
    </div>
</div>


@push('scripts')
    <!-- Script -->
    <script>
        $(document).ready(function() {

            // Update hargaInput on pemeriksaanSelect change
            $('#pemeriksaanSelect').on('change', function() {
                const selectedOption = $(this).find(':selected');
                const harga = selectedOption.data('harga');
                $('#hargaInput').val(harga ? `Rp. ${new Intl.NumberFormat('id-ID').format(harga)}` :
                    '');
            });

            // Handle form submission
            $('#formTambahPemeriksaan').on('submit', function(e) {
                e.preventDefault();

                const pemeriksaan = $('#pemeriksaanSelect').val();
                const harga = $('#hargaInput').val();

                if (pemeriksaan && harga) {
                    const newRow = `
                    <tr>
                        <td>${$('#pemeriksaanTableBody tr').length + 1}</td>
                        <td>${pemeriksaan}</td>
                        <td>Normal</td>
                        <td>${harga}</td>
                        <td><button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td>
                    </tr>
                `;

                    $('#pemeriksaanTableBody').append(newRow);
                    $('#modalTambahPemeriksaan').modal('hide');
                    $('#formTambahPemeriksaan')[0].reset();
                    $('#pemeriksaanSelect').val(null).trigger('change');
                }
            });

            // Handle delete button click
            $('#pemeriksaanTableBody').on('click', '.btn-danger', function() {
                $(this).closest('tr').remove();

                // Update numbering
                $('#pemeriksaanTableBody tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
            });
        });
    </script>
@endpush
