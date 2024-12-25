<div class="modal fade" id="modal-lab-{{ $medis->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Detail Data</h4>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row py-2" style="background-color: #b8d6f5; border-color: black"> 
                    <div class=" col text-center" width="5%"><b>No</b></div>
                    <div class="col"><b>Nama Lab</b></div>
                    <div class="col"><b>Hasil Lab</b></div>
                    <div class="col"><b>Petugas</b></div>
                    <div class="col" width="20%"><b>Biaya</b></div>
                </div>
                @foreach ($medis->laborat as $key => $data)
                    <div class="row py-1" style="background-color: #e9eff5; border-color: black">
                        <div class="col text-center">{{ $key + 1 }}</div>
                        <div class="col">
                            {{ $data->kategoriPemeriksaan->pemeriksaan }}</div>
                        <div class="col">{{ $data->hasil_pemeriksaan }}</div>
                        <div class="col">
                            {{ $data->practitioner->namaPractitioner }}</div>
                        <div class="col">
                            Rp{{ number_format($data->biaya, 0, ',', '.') }}
                        </div>
                    </div>
                    <hr class="my-0">
                @endforeach
            </div>
        </div>
    </div>
</div>