<!-- Obat Card -->
<div id="obat" class="card mt-3">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-th-list mx-2"></i>Tagihan Tindakan Pasien</h3>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Tindakan</th>
                    <th width="20%">Harga</th>
                </tr>
            </thead>
            <tbody id="obatTableBody">
                {{-- @foreach ( as ) --}}
                <tr>
                    <td class="text-center" width="5%">1</td>
                    <td>Suntik NovoRapid</td>
                    <td width="20%">Rp.30000</td>
                </tr>
                <tr>
                    <th colspan="2">Total Fee Tindakan:</th>
                    <td >Rp.30000</td>
                </tr>
                {{-- {{ @endforeach --}} 
            </tbody>
        </table>
    </div>
</div>




