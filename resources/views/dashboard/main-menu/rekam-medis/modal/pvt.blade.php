<div class="modal fade" id="modal-pvt-{{ $medis->id }}">
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
                <h5 class="text-center modal-title">Pemeriksaan Tanda Vital</h5>
                <hr class="my-0">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-5">Nama Dokter</div>
                            <div class="col-7">:
                                {{ $medis->practitioner->namaPractitioner ?? '' }}
                            </div>
                            <div class="col-5">Keluhan</div>
                            <div class="col-7">: {{ $medis->keluhan }}</div>
                            <div class="col-5">Suhu Tubuh</div>
                            <div class="col-7">: {{ $medis->suhu }}</div>
                            <div class="col-5">Tinggi Badan</div>
                            <div class="col-7">: {{ $medis->tinggiBadan }} cm
                            </div>
                            <div class="col-5">Berat Badan</div>
                            <div class="col-7">: {{ $medis->beratBadan }} kg
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-5">Lingkar Perut</div>
                            <div class="col-7">: {{ $medis->lingkarPerut }} cm
                            </div>
                            <div class="col-5">Sistole</div>
                            <div class="col-7">: {{ $medis->sistole }}</div>
                            <div class="col-5">Diastole</div>
                            <div class="col-7">: {{ $medis->diastole }}</div>
                            <div class="col-5">Respiratore Rate</div>
                            <div class="col-7">: {{ $medis->respRate }}</div>
                            <div class="col-5">Heart Rate</div>
                            <div class="col-7">: {{ $medis->heartRate }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>