<div class="modal fade" id="modal-soap-{{ $medis->id }}">
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
                <h5 class="text-center modal-title">Pemeriksaan SOAP</h5>
                <hr class="my-0">
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-5">Nama Dokter</div>
                            <div class="col-7">:
                                {{ $medis->practitioner->namaPractitioner ?? '' }}
                            </div>
                            <div class="col-5">Subjectif</div>
                            <div class="col-7">: {{ $medis->subyektif }}</div>
                            <div class="col-5">Objectif</div>
                            <div class="col-7">: {{ $medis->obyektif }}</div>
                            <div class="col-5">Anamnesis</div>
                            <div class="col-7">: {{ $medis->assesment }}</div>
                            <div class="col-5">Plan</div>
                            <div class="col-7">: {{ $medis->plan }}</div>
                            <div class="col-5">Instruksi</div>
                            <div class="col-7">: {{ $medis->instruksi }}</div>
                            <div class="col-5">Evaluasi</div>
                            <div class="col-7">: {{ $medis->evaluasi }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>