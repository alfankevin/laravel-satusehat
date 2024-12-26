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
                    <th width="20%">Harga</th>
                </tr>
            </thead>
            <tbody id="obatTableBody">
                @php
                    $totalFeeLaborat = 0; // Variabel untuk menyimpan total biaya
                @endphp
                @foreach ($pendaftarans->laborat as $key => $data)
                    @php
                        $totalFeeLaborat += $data->biaya; // Tambahkan biaya setiap tindakan ke totalFeeLaborat
                    @endphp
                    <tr id="laborat-{{ $data->id }}">
                        <td class="text-center" width="5%">{{ $key + 1 }}</td>
                        <td>{{ $data->kategoriPemeriksaan->pemeriksaan }}</td>
                        <td width="20%">Rp {{ number_format($data->biaya, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="2">Total Fee Laborat:</th>
                    <td>Rp {{ number_format($totalFeeLaborat, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
