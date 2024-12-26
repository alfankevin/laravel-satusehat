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
                @php
                    $totalFeeTindakan = 0; // Variabel untuk menyimpan total biaya
                @endphp
                @foreach ($pendaftarans->tindakan as $key => $data)
                    @php
                        $totalFeeTindakan += $data->biaya; // Tambahkan biaya setiap tindakan ke totalFeeTindakan
                    @endphp
                    <tr id="tindakan-{{ $data->id }}">
                        <td class="text-center" width="5%">{{ $key + 1 }}</td>
                        <td>{{ $data->tindakan->tindakan }}</td>
                        <td width="20%">Rp {{ number_format($data->biaya, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="2" class="text-end">Total Fee Tindakan:</th>
                    <td>Rp {{ number_format($totalFeeTindakan, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            
        </table>
    </div>
</div>
