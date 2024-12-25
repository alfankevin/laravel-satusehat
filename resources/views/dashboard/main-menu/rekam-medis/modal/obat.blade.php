<div class="modal fade" id="modal-obat-{{ $medis->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Detail Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row py-2" style="background-color: #b8d6f5; border-color: black">
                    <div class=" col text-center" width="5%"><b>No</b></div>
                    <div class="col"><b>Nama Obat</b></div>
                    <div class="col"><b>Instruksi</b></div>
                    <div class="col"><b>Jumlah</b></div>
                    <div class="col" width="20%"><b>Harga</b></div>
                </div>
                @foreach ($medis->obat as $key => $data)
                    <div class="row py-1" style="background-color: #e9eff5; border-color: black">
                        <div class="col text-center">{{ $key + 1 }}</div>
                        <div class="col">
                            {{ $data->obat->nama_obat }}</div>
                        <div class="col">
                            {{ $data->instruksi }}</div>
                        <div class="col">
                            {{ $data->jumlah_obat }}</div>
                        <div class="col">
                            Rp{{ number_format($data->harga_obat, 0, ',', '.') }}
                        </div>
                    </div>
                    <hr class="my-0">
                @endforeach
            </div>
        </div>
    </div>
</div>
