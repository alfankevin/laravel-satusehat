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
                                            value="0002456" disabled>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label for="name" class="col-sm-4 col-form-label fw-bold">Nama Pasien</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="name" value="Jhon Doe">
                                            <span class="input-group-text" id="basic-addon2"><i
                                                    class="fas fa-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label for="tglLahir" class="col-sm-4 col-form-label ">Tanggal Lahir</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="tglLahir" name="tglLahir"
                                            value="21-12-1990" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2 row">
                                    <label for="sex" class="col-sm-4 col-form-label ">Jenis Kelamin</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="sex" name="sex"
                                            value="Laki-Laki" disabled>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <label for="alamat" class="col-sm-4 col-form-label ">Alamat</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="3" disabled>Jl. soekarno Hatta 001, Wonocolo, Surabaya, Jawa Timur</textarea>
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
                                        <th width="14%">No Pendaftaran</th>
                                        <th>Nama Pemeriksa</th>
                                        <th class="text-center" width="5%">PTV</th>
                                        <th class="text-center" width="5%">MCU</th>
                                        <th class="text-center" width="8%">Tindakan</th>
                                        <th class="text-center" width="5%">Obat</th>
                                        <th width="13%">Diagnosa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>18 Mei 2024 10:00:23</td>
                                        <td>REQ2409382</td>
                                        <td>dr. Budi Santoso</td>
                                        <td class="text-center">
                                            <a href="" data-toggle="modal"
                                                data-target="#modal-default">
                                                <i class="fas fa-stethoscope"></i>
                                            </a>
                                        </td>
                                        <td class="text-center"><a href="" data-toggle="modal"
                                                data-target="#modal-default"><i class="fas fa-stethoscope"></i></a>
                                        </td>
                                        <td class="text-center"><a href="" data-toggle="modal"
                                                data-target="#modal-default"><i class="fas fa-plus-square"></i></a>
                                        </td>
                                        <td class="text-center"><a href=""data-toggle="modal"
                                            data-target="#modal-default"><i class="fas fa-capsules"></i></a></td>
                                        <td>Diabetes</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Detail Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center modal-title">Pemeriksaan Tanda Vital</h5>
                    <hr class="my-0">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <div class="col-5">Nama Dokter</div>
                                <div class="col-7">: dr. Budi Santoso</div>
                                <div class="col-5">Suhu Tubuh</div>
                                <div class="col-7">: 37,5° Celsius</div>
                                <div class="col-5">Tinggi Badan</div>
                                <div class="col-7">: 177 cm</div>
                                <div class="col-5">Berat Badan</div>
                                <div class="col-7">: 70 kg</div>
                                <div class="col-5">Lingkar Perut</div>
                                <div class="col-7">: 80 cm</div>
                                <div class="col-5">Sistole</div>
                                <div class="col-7">: 100</div>
                                <div class="col-5">Diastole</div>
                                <div class="col-7">: 100</div>
                                <div class="col-5">Respiratore Rate</div>
                                <div class="col-7">: 100</div>
                                <div class="col-5">Heart Rate</div>
                                <div class="col-7">: 100</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
