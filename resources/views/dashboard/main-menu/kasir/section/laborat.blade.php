<!-- Obat Card -->
<div id="obat" class="card mt-3">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-th-list mx-2"></i>Tagihan Laborat Pasien</h3>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Laborat</th>
                    <th>Hasil</th>
                    <th width="20%">Harga</th>
                </tr>
            </thead>
            <tbody id="obatTableBody">
                {{-- @foreach ( as ) --}}
                <tr>
                    <td class="text-center" width="5%">1</td>
                    <td>Rontgen Thorax</td>
                    <td>Normal</td>
                    <td width="20%">Rp.30000</td>
                </tr>
                <tr>
                    <th colspan="3">Total Fee Laborat:</th>
                    <td >Rp.30000</td>
                </tr>
                {{-- {{ @endforeach --}} 
            </tbody>
        </table>
    </div>
</div>




