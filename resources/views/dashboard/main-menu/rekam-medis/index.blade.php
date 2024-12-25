@extends('dashboard.app')
@section('content')
    <div class="container-fluid">
        <div class="card card-info mt-4">
            <div class="card-header">
                <h3 class="card-title">Rekam Medis Elektronik Pasien</h3>
            </div>
            <div class="card-body">
                <div class="card border">
                    <div class="card-header">
                        <h5 class="card-title"><i class="fas fa-user mr-1"></i> Data Pasien</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-2 row">
                                    <label for="noRM" class="col-sm-4 col-form-label ">No Rekam Medis</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="noRM" name="noRM"
                                            value="{{ substr(str_pad($selectedPasien->nomorRm ?? '', 6, '0', STR_PAD_LEFT), 0, 2) . '-' . substr(str_pad($selectedPasien->nomorRm ?? '', 6, '0', STR_PAD_LEFT), 2, 2) . '-' . substr(str_pad($selectedPasien->nomorRm ?? '', 6, '0', STR_PAD_LEFT), 4, 2) }} "
                                            disabled>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label for="name" class="col-sm-4 col-form-label fw-bold">Nama Pasien</label>                                    
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="{{ $selectedPasien->nama ?? '' }}">
                                                
                                            <span class="input-group-text" id="basic-addon2"><a href=""
                                                    data-toggle="modal" data-target="#modal-pasien">Cari Pasien<i
                                                        class="fas fa-search mx-1"></i></a></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label for="tglLahir" class="col-sm-4 col-form-label ">Tanggal Lahir</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="tglLahir" name="tglLahir"
                                            value="{{ $selectedPasien->tglLahir ?? '' }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2 row">
                                    <label for="sex" class="col-sm-4 col-form-label ">Jenis Kelamin</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="sex" name="sex"
                                            value="{{ $selectedPasien ? ($selectedPasien->sex === 'L' ? 'Laki-Laki' : 'Perempuan') : '' }}"
                                            disabled>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label for="alamat" class="col-sm-4 col-form-label ">Alamat</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="alamat" rows="3" disabled>{{ $selectedPasien->alamat ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Riwayat Pasien</h5>
                    </div>
                    <div class="card-body">
                        <div class="tabel-responsive">
                            <table id="" class="table table-bordered table-hover">
                                <thead style="background-color: #b8d6f5; border-color: black">
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th width="17%">Tgl Kunjungan</th>
                                        <th width="14%">Poli</th>
                                        <th>Nama Dokter</th>
                                        <th class="text-center" width="5%">PTV</th>
                                        <th class="text-center" width="5%">SOAP</th>
                                        <th class="text-center" width="5%">LAB</th>
                                        <th class="text-center" width="8%">Tindakan</th>
                                        <th class="text-center" width="5%">Obat</th>
                                        <th class="text-center" width="10%">Cetak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rekamMedis as $key => $medis)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($medis->tglDaftar)->translatedFormat('d F Y') }}
                                            </td>
                                            <td>{{ $medis->poli->namaPoli }}</td>
                                            <td>{{ $medis->practitioner->namaPractitioner ?? '' }}</td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#modal-pvt-{{ $medis->id }}"
                                                    data-id="{{ $medis->id }}">
                                                    <i class="fas fa-stethoscope"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal"
                                                    data-target="#modal-soap-{{ $medis->id }}"
                                                    data-id="{{ $medis->id }}" >
                                                    <i class="fas fa-stethoscope"></i>
                                                </a>
                                            </td>
                                            <td class="text-center"><a href="#" data-toggle="modal"
                                                    data-target="#modal-lab-{{ $medis->id }}"
                                                    data-id="{{ $medis->id }}" >
                                                    <i class="fas fa-flask"></i>
                                                </a></td>
                                            <td class="text-center"><a href="#" data-toggle="modal"
                                                data-target="#modal-layanan-{{ $medis->id }}"
                                                data-id="{{ $medis->id }}" >
                                                <i class="fas fa-plus-square"></i>
                                            </a></td>
                                            <td class="text-center"><a href="#" data-toggle="modal"
                                                data-target="#modal-obat-{{ $medis->id }}"
                                                data-id="{{ $medis->id }}" >
                                                <i class="fas fa-capsules"></i>
                                            </a></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info">
                                                    <i class="fas fa-print mx-1"></i>Print
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal PVT -->
                                        @include('dashboard.main-menu.rekam-medis.modal.pvt')

                                        <!-- Modal SOAP -->
                                        @include('dashboard.main-menu.rekam-medis.modal.soap')

                                        <!-- Modal LAB -->
                                        @include('dashboard.main-menu.rekam-medis.modal.lab')

                                        <!-- Modal Layanan -->
                                        @include('dashboard.main-menu.rekam-medis.modal.layanan')

                                        <!-- Modal Obat -->
                                        @include('dashboard.main-menu.rekam-medis.modal.obat')
                                    @endforeach
                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- //Modal Pasien --}}
    @include('dashboard.main-menu.rekam-medis.modal.pasien')
@endsection
