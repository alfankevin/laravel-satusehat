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
                                            <form action="{{ route('app.info.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <div class="mb-2 row">
                                                    <label for="nama" class="col-sm-3 col-form-label fw-bold">Nama
                                                        Instansi</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="nama"
                                                            id="nama" value="{{ $appInfo->nama ?? '' }}"
                                                            placeholder="Nama Instansi">
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="kode" class="col-sm-3 col-form-label fw-bold">Kode
                                                        Fasyankes</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="kode"
                                                            id="kode" value="{{ $appInfo->kode ?? '' }}"
                                                            placeholder="Kode Fasyankes">
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="email"
                                                        class="col-sm-3 col-form-label fw-bold">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" class="form-control" name="email"
                                                            id="email" value="{{ $appInfo->email ?? '' }}"
                                                            placeholder="Email">
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="telepon"
                                                        class="col-sm-3 col-form-label fw-bold">Telepon</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="telepon"
                                                            id="telepon" value="{{ $appInfo->telepon ?? '' }}"
                                                            placeholder="Telepon">
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="provinsi"
                                                        class="col-sm-3 col-form-label fw-bold">Alamat</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="provinsi"
                                                            id="provinsi" value="{{ $appInfo->provinsi ?? '' }}"
                                                            placeholder="Alamat">
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="logo"
                                                        class="col-sm-3 col-form-label fw-bold">Logo</label>
                                                    <div class="col-sm-9">
                                                        @if (!empty($appInfo->logo))
                                                            <img src="{{ asset('storage/' . $appInfo->logo) }}"
                                                                alt="Logo" class="img-thumbnail mb-2" width="150">
                                                        @endif
                                                        <input type="file" class="form-control" name="logo"
                                                            id="logo" accept=".jpg,.jpeg,.png">
                                                    </div>
                                                </div>
                                                

                                                <div class="text-end">
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
                                                    <label for="tempat" class="col-sm-3 col-form-label fw-bold">Aktifkan
                                                        Penjamin BPJS</label>
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
                                            <form action="{{ route('satusehat.store') }}" method="POST">
                                                @csrf

                                                <div class="mb-2 row">
                                                    <label for="status" class="col-sm-3 col-form-label fw-bold">Status
                                                        Integrasi</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="status" id="status"
                                                            required>
                                                            <option value="TIDAK AKTIF"
                                                                {{ ($satusehat->status ?? '') === 'TIDAK AKTIF' ? 'selected' : '' }}>
                                                                TIDAK AKTIF</option>
                                                            <option value="AKTIF"
                                                                {{ ($satusehat->status ?? '') === 'AKTIF' ? 'selected' : '' }}>
                                                                AKTIF</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="environment"
                                                        class="col-sm-3 col-form-label fw-bold">Environment</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="environment" id="environment"
                                                            required>
                                                            <option value="TESTING"
                                                                {{ ($satusehat->environment ?? '') === 'TESTING' ? 'selected' : '' }}>
                                                                TESTING</option>
                                                            <option value="PRODUCTION"
                                                                {{ ($satusehat->environment ?? '') === 'PRODUCTION' ? 'selected' : '' }}>
                                                                PRODUCTION</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="organization_id"
                                                        class="col-sm-3 col-form-label fw-bold">Organization ID</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="organization_id"
                                                            id="organization_id"
                                                            value="{{ $satusehat->organization_id ?? '' }}"
                                                            placeholder="ORGANIZATION ID">
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="client_id" class="col-sm-3 col-form-label fw-bold">Client
                                                        ID</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" name="client_id"
                                                                id="client_id" value="{{ $satusehat->client_id ?? '' }}"
                                                                placeholder="CLIENT ID">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary toggle-visibility"
                                                                data-target="#client_id">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-2 row">
                                                    <label for="client_secret"
                                                        class="col-sm-3 col-form-label fw-bold">Client Secret</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <input type="password" class="form-control"
                                                                name="client_secret" id="client_secret"
                                                                value="{{ $satusehat->client_secret ?? '' }}"
                                                                placeholder="CLIENT SECRET">
                                                            <button type="button"
                                                                class="btn btn-outline-secondary toggle-visibility"
                                                                data-target="#client_secret">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
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


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".toggle-visibility").forEach(button => {
                button.addEventListener("click", function() {
                    const target = document.querySelector(this.getAttribute("data-target"));
                    if (target) {
                        const type = target.getAttribute("type") === "password" ? "text" :
                            "password";
                        target.setAttribute("type", type);

                        // Toggle icon
                        this.querySelector("i").classList.toggle("fa-eye");
                        this.querySelector("i").classList.toggle("fa-eye-slash");
                    }
                });
            });
        });
    </script>
@endpush



