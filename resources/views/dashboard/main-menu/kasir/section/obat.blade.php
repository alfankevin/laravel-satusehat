<!-- Obat Card -->
<div id="obat" class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title"><i class="fas fa-th-list mx-2"></i>Tagihan Obat Pasien</h3>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Obat</th>
                    <th width="5%">Qty</th>
                    <th width="20%">Harga</th>
                    <th width="20%">Subtotal</th>
                </tr>
            </thead>
            <tbody id="obatTableBody">
                {{-- @foreach ( as ) --}}
                <tr>
                    <td class="text-center" width="5%">1</td>
                    <td>Panadol</td>
                    <td width="5%">2</td>
                    <td width="20%">Rp. 15000</td>
                    <td width="20%">Rp.30000</td>
                </tr>
                <tr>
                    <th colspan="4">Total Fee Obat:</th>
                    <td >Rp.30000</td>
                </tr>
                {{-- {{ @endforeach --}} 
            </tbody>
        </table>
    </div>
</div>




