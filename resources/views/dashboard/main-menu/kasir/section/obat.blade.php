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
                @php
                    $totalFeeObat = 0; // Variabel untuk menyimpan total fee obat
                @endphp
                @foreach ($pendaftarans->obat as $key => $data)
                    @php
                        $subtotal = $data->harga_obat * $data->jumlah_obat; // Hitung subtotal untuk setiap obat
                        $totalFeeObat += $subtotal; // Tambahkan subtotal ke total fee obat
                    @endphp
                    <tr class="obat-{{ $data->id }}" data-main>
                        <td class="text-center" width="5%">{{ $key + 1 }}</td>
                        <td>{{ $data->obat->nama_obat }}</td>
                        <td width="5%">{{ $data->jumlah_obat }}</td>
                        <td width="20%">Rp {{ number_format($data->harga_obat, 0, ',', '.') }}</td>
                        <td width="20%">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="4" class="text-end">Total Fee Obat:</th>
                    <td>Rp {{ number_format($totalFeeObat, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
