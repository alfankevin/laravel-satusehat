<!-- Diagnosa Card -->
<div id="diagnosa" class="card" style="display: none;">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title">Diagnosa(ICD 10)</h3>
        </div>
    </div>
    <div class="card-body">
        <form id="formTambahDiagnosa">
            <div class="row mb-3">
                <div class="col-10">
                    <label for="diagnosaSelect" class="form-label">Diagnosa (ICD 10)</label>
                        <select id="diagnosaSelect" class="form-control js-select2" style="width: 100%" required>
                            <option value="">--Pilih Diagnosa--</option>
                            <option value="Diabetes" data-icd="D10">D10 - Diabetes</option>
                            <option value="Stunting" data-icd="D11">D11 - Stunting</option>
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
                
            </tbody>
        </table>
    </div>
</div>



@push('scripts')
    <!-- Script -->
    <script>
        $(document).ready(function() {

            // Handle form submission
            $('#formTambahDiagnosa').on('submit', function(e) {
                e.preventDefault();

                // Get selected value and data
                const selectedOption = $('#diagnosaSelect').find(':selected');
                const diagnosa = selectedOption.val();
                const icd = selectedOption.data('icd');

                if (diagnosa && icd) {
                    const tableBody = $('#diagnosaTableBody');
                    const newRow = `
                    <tr>
                        <td>${tableBody.find('tr').length + 1}</td>
                        <td>${icd}</td>
                        <td>${diagnosa}</td>
                        <td><button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td>
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
            });

            // Handle delete button click
            $('#diagnosaTableBody').on('click', '.btn-danger', function() {
                const row = $(this).closest('tr');
                row.remove();

                // Update numbering
                $('#diagnosaTableBody tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
            });
        });
    </script>
@endpush
