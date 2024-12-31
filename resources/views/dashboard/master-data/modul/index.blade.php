@extends('dashboard.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card card-primary card-outline card-tabs">
                        <div class="card-header p-0 pt-1 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill"
                                        href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home"
                                        aria-selected="true"><i class="fas fa-hospital"></i> INFORMASI KLINIK</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-two-profile" role="tab"
                                        aria-controls="custom-tabs-two-profile" aria-selected="false"><i
                                            class="fas fa-credit-card"></i> INTREGASI BPJS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill"
                                        href="#custom-tabs-two-messages" role="tab"
                                        aria-controls="custom-tabs-two-messages" aria-selected="false"><i
                                            class="fas fa-handshake"></i> INTEGRASI SATUSEHAT</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-two-home-tab">
                                    <div class="row">
                                        <div class="col-9">
                                            <form action="{{ route('antrian.store') }}" method="POST">
                                                @csrf

                                                <div class="mb-2 row">
                                                    <label for="tempat"
                                                        class="col-sm-3 col-form-label fw-bold">Nama Instansi</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control"
                                                                        name="nama" placeholder="nama instansi">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control"
                                                                        name="kode" placeholder="kode fasyankes">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="tempat"
                                                        class="col-sm-3 col-form-label fw-bold">Email & Telepon</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control"
                                                                        name="email" placeholder="Email">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control"
                                                                        name="telepon" placeholder="Telepon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="tempat"
                                                        class="col-sm-3 col-form-label fw-bold">Alamat</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="input-group">
                                                                    <select class="js-select2 form-control" name="provinsi" id="">
                                                                        <option value="">Pilih Provinsi</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="input-group">
                                                                    <select class="js-select2 form-control" name="provinsi" id="">
                                                                        <option value="">Pilih Kabupaten</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="input-group">
                                                                    <select class="js-select2 form-control" name="provinsi" id="">
                                                                        <option value="">Pilih Kecamatan</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 mb-2">
                                                                <div class="input-group">
                                                                    <select class="js-select2 form-control" name="provinsi" id="">
                                                                        <option value="">Pilih Kelurahan</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="tempat"
                                                        class="col-sm-3 col-form-label fw-bold">Logo</label>
                                                    <div class="col-sm-9">
                                                        <div class="row">
                                                            <div class="col-sm-12 mb-2">
                                                                <div class="input-group">
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" name="logo" id="logo" accept=".jpg,.jpeg,.png" required>
                                                                        <label class="custom-file-label" for="logo">Choose file</label>
                                                                    </div>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text" id=""><i class="fas fa-file-import"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="text-end d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-danger">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-two-profile-tab">
                                    <div class="row">
                                        <div class="col-9">
                                            <form action="{{ route('antrian.store') }}" method="POST">
                                                @csrf

                                                <div class="mb-2 row">
                                                    <label for="tempat"
                                                        class="col-sm-3 col-form-label fw-bold">Aktifkan Penjamin BPJS</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <select class="form-control" name="staus" id="status">
                                                                <option value="">TIDAK AKTIF</option>
                                                                <option value="">AKTIF</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="text-end d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-danger">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel"
                                    aria-labelledby="custom-tabs-two-messages-tab">
                                    <div class="row">
                                        <div class="col-9">
                                            <form action="{{ route('antrian.store') }}" method="POST">
                                                @csrf

                                                <div class="mb-2 row">
                                                    <label for="tempat"
                                                        class="col-sm-3 col-form-label fw-bold">Status Integrasi</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <select class="form-control" name="staus" id="status">
                                                                <option value="">TIDAK AKTIF</option>
                                                                <option value="">AKTIF</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="tempat"
                                                        class="col-sm-3 col-form-label fw-bold">Enveronment</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <select class="form-control" name="staus" id="status">
                                                                <option value="">TESTING</option>
                                                                <option value="">PRODUCTION</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="tempat"
                                                        class="col-sm-3 col-form-label fw-bold">Organization id</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="organization_id" id="organization_id" placeholder="ORGANIZATION ID">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="tempat"
                                                        class="col-sm-3 col-form-label fw-bold">Client id</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="client_id" id="client_id" placeholder="CLIENT ID">
                                                            <span class="input-group-text" id="basic-addon2"><i class="fas fa-eye"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-2 row">
                                                    <label for="tempat"
                                                        class="col-sm-3 col-form-label fw-bold">Client Secret</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" name="client_secret" id="client_secret" placeholder="CLIENT SECRET">
                                                            <span class="input-group-text" id="basic-addon2"><i class="fas fa-eye"></i></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="text-end d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-danger">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
