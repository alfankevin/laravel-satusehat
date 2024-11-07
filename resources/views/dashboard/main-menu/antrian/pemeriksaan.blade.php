@extends('dashboard.app')
@section('content')
<div class="mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0 fw-bold">Form Perawatan Pasien</h3>
        </div>
        <div class="card-body">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-3 fw-bold">
                                    No. Registrasi
                                </div>
                                <div class="col-9">
                                    : REG/20230116/001
                                </div>
                                <div class="col-3 fw-bold">
                                    Nomor RM
                                </div>
                                <div class="col-9">
                                    : 000006
                                </div>
                                <div class="col-3 fw-bold">
                                    Nama Pasien
                                </div>
                                <div class="col-9">
                                    : {{ $pemeriksaan->pasien->nama }}
                                </div>
                                <div class="col-3 fw-bold">
                                    TTL Pasien
                                </div>
                                <div class="col-9">
                                    : Tempat, {{ \Carbon\Carbon::parse($pemeriksaan->pasien->tglLahir)->format('d-m-Y') }}
                                </div>
                                <div class="col-3 fw-bold">
                                    Alamat
                                </div>
                                <div class="col-9">
                                    : Jepara 01/09
                                </div>
                                <div class="col-3 fw-bold">
                                    Poli
                                </div>
                                <div class="col-9">
                                    : {{ $pemeriksaan->poli->namaPoli }}
                                </div>
                                <div class="col-3 fw-bold">
                                    Dokter
                                </div>
                                <div class="col-9">
                                    : {{ $pemeriksaan->practitioner->namaPractitioner }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-warning btn-sm"><i class="fas fa-notes-medical"></i> Assesment</button>
                        <button class="btn btn-primary btn-sm"><i class="fas fa-capsules"></i> Obat Non Racikan</button>
                        <button class="btn btn-info btn-sm"><i class="fas fa-prescription-bottle-alt"></i> Obat
                            Racikan</button>
                        <button class="btn btn-success btn-sm"><i class="fas fa-stethoscope"></i> Tindakan</button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-vials"></i> Laborat</button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-history"></i> Riwayat Berobat</button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-print"></i> Cetak Surat</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold">Assesment</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('antrian.store') }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label for="anamnesa" class="col-sm-3 col-form-label fw-bold">Anamnesa</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="id" value="{{ $pemeriksaan->id }}">
                                <input type="text" class="form-control" id="anamnesa" name="keluhan" value="{{ $pemeriksaan->keluhan }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="suhu" class="col-sm-3 col-form-label fw-bold">Suhu</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="number" class="form-control">
                                    <span class="input-group-text" id="basic-addon2"> C</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tempat" class="col-sm-3 col-form-label fw-bold">Pemeriksaan Fisik</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="tinggiBadan" value="{{ $pemeriksaan->tinggiBadan }}">
                                            <span class="input-group-text" id="basic-addon2">cm</span>
                                        </div>
                                        <label for="" class="text-secondary">Tinggi Badan</label>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="beratBadan" value="{{ $pemeriksaan->beratBadan }}">
                                            <span class="input-group-text" id="basic-addon2">kg</span>
                                        </div>
                                        <label for="" class="text-secondary">Berat Badan</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="lingkarPerut" value="{{ $pemeriksaan->lingkarPerut }}">
                                            <span class="input-group-text" id="basic-addon2">cm</span>
                                        </div>
                                        <label for="" class="text-secondary">Lingkar Perut</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="number" class="form-control" value="20" disabled>
                                            <span class="input-group-text" id="basic-addon2">kg/m2</span>
                                        </div>
                                        <label for="" class="text-secondary">IMT</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tempat" class="col-sm-3 col-form-label fw-bold">Tekanan Darah</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="sistole" value="{{ $pemeriksaan->sistole }}">
                                            <span class="input-group-text" id="basic-addon2">mmHg</span>
                                        </div>
                                        <label for="" class="text-secondary">Sistole</label>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="diastole" value="{{ $pemeriksaan->diastole }}">
                                            <span class="input-group-text" id="basic-addon2">mmHg</span>
                                        </div>
                                        <label for="" class="text-secondary">Diastole</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="respRate" value="{{ $pemeriksaan->respRate }}">
                                            <span class="input-group-text" id="basic-addon2">/minute</span>
                                        </div>
                                        <label for="" class="text-secondary">Respiratore Rate</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="heartRate" value="{{ $pemeriksaan->heartRate }}">
                                            <span class="input-group-text" id="basic-addon2">bpm</span>
                                        </div>
                                        <label for="" class="text-secondary">Heart Rate</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection