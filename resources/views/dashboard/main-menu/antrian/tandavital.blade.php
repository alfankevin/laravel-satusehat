<div id="keluhan-ttv" class="card">
    <div class="card-header">
        <h5 class="card-title">Keluhan dan TTV</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('antrian.store') }}" method="POST">
            @csrf
            <input type="hidden" name="start_inProgress"
                value="{{ now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s') }}">

            <div class="mb-2 row">
                <label for="keluhan" class="col-sm-3 col-form-label ">Keluhan</label>
                <div class="col-sm-9">
                    <input type="hidden" name="id" value="{{ $pemeriksaan->id }}">
                    <input type="text" class="form-control" id="keluhan" name="keluhan"
                        value="{{ $pemeriksaan->keluhan }}">
                </div>
            </div>
            <div class="mb-2 row">
                <label for="suhu" class="col-sm-3 col-form-label fw-bold">Suhu</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="number" class="form-control" name="suhu" value="{{ $pemeriksaan->suhu }}">
                        <span class="input-group-text" id="basic-addon2">&#8451;</span>
                    </div>
                </div>
            </div>

            <div class="mb-2 row">
                <label for="tempat" class="col-sm-3 col-form-label fw-bold">Pemeriksaan
                    Fisik</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <div class="input-group">
                                <input type="number" class="form-control" name="tinggiBadan"
                                    value="{{ $pemeriksaan->tinggiBadan }}">
                                <span class="input-group-text" id="basic-addon2">cm</span>
                            </div>
                            <label for="" class="text-secondary">Tinggi Badan</label>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <div class="input-group">
                                <input type="number" class="form-control" name="beratBadan"
                                    value="{{ $pemeriksaan->beratBadan }}">
                                <span class="input-group-text" id="basic-addon2">kg</span>
                            </div>
                            <label for="" class="text-secondary">Berat Badan</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="number" class="form-control" name="lingkarPerut"
                                    value="{{ $pemeriksaan->lingkarPerut }}">
                                <span class="input-group-text" id="basic-addon2">cm</span>
                            </div>
                            <label for="" class="text-secondary">Lingkar Perut</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-2 row">
                <label for="tempat" class="col-sm-3 col-form-label fw-bold">Tekanan
                    Darah</label>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <div class="input-group">
                                <input type="number" class="form-control" name="sistole"
                                    value="{{ $pemeriksaan->sistole }}">
                                <span class="input-group-text" id="basic-addon2">mmHg</span>
                            </div>
                            <label for="" class="text-secondary">Sistole</label>
                        </div>
                        <div class="col-sm-6 mb-2">
                            <div class="input-group">
                                <input type="number" class="form-control" name="diastole"
                                    value="{{ $pemeriksaan->diastole }}">
                                <span class="input-group-text" id="basic-addon2">mmHg</span>
                            </div>
                            <label for="" class="text-secondary">Diastole</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="number" class="form-control" name="respRate"
                                    value="{{ $pemeriksaan->respRate }}">
                                <span class="input-group-text" id="basic-addon2">/minute</span>
                            </div>
                            <label for="" class="text-secondary">Respiratore Rate</label>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="number" class="form-control" name="heartRate"
                                    value="{{ $pemeriksaan->heartRate }}">
                                <span class="input-group-text" id="basic-addon2">bpm</span>
                            </div>
                            <label for="" class="text-secondary">Heart Rate</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-end d-flex justify-content-end">
                <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary mx-2">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
