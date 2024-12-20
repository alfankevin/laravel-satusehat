@extends('dashboard.app')
@section('content')
    <div class="container-fluid">
        <div class="card mt-1 card-info">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Pembayaran</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        @include('dashboard.main-menu.kasir.section.obat')

                        @include('dashboard.main-menu.kasir.section.tindakan')

                        @include('dashboard.main-menu.kasir.section.laborat')
                    </div>

                    <div class="col-4">
                        <div class="card shadow-lg mb-4">
                            <div class="card-header">
                                <h5 class="card-title"><i class="fas fa-user me-2"></i> Data Pasien</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body border">
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Nomor RM</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pendaftarans->pasien->nomorRm }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Nama Pasien</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pendaftarans->pasien->nama }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Tanggal Lahir</b>
                                    </div>
                                    <div class="col-7">
                                        :
                                        {{ \Carbon\Carbon::parse($pendaftarans->pasien->tglLahir)->locale('id')->translatedFormat('d F Y') }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Usia</b>
                                    </div>
                                    <div class="col-7">
                                        :
                                        {{ \Carbon\Carbon::parse($pendaftarans->pasien->tglLahir)->diff(\Carbon\Carbon::now())->format('%y tahun') }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Poli</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pendaftarans->poli->namaPoli }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Dokter</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pendaftarans->practitioner->namaPractitioner }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Tanggal Daftar</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ \Carbon\Carbon::parse($pendaftarans->tglDaftar)->format('d-m-Y') }} -
                                        {{ \Carbon\Carbon::parse($pendaftarans->created_at)->format('H:i') }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Alamat</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pendaftarans->pasien->alamat }}
                                    </div>
                                </div>
                                <hr class="my-1">
                            </div>
                        </div>

                        <div class="card shadow-lg mb-4">
                            <div class="card-header">
                                <h5 class="card-title"><i class="fas fa-th-list mx-2"></i>Rincihan Tagihan</h5>
                            </div>
                            <div class="card-body border">
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-6">
                                        <b>Subtotal :</b>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        Rp. 137.000
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row align-items-center">
                                    <div class="col-4 ">
                                        <b>Diskon</b>
                                    </div>
                                    <div class="col-4 ">
                                        <input type="number" class="form-control">
                                    </div>
                                    <div class="col-4 d-flex justify-content-end">
                                        Rp. 12.000
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row align-items-center">
                                    <div class="col-4 ">
                                        <b>Pajak(%)</b>
                                    </div>
                                    <div class="col-4 ">
                                        <input type="number" class="form-control">
                                    </div>
                                    <div class="col-4 d-flex justify-content-end">
                                        Rp. 5.000
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-6">
                                        <b>Total Tagihan:</b>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        Rp. 120.000
                                    </div>
                                </div>
                                <hr class="mt-1 mb-3">

                                <div class="p-3" style="background-color: #f5b8b8">
                                    <form action="">

                                        <!-- Input Jumlah Bayar -->
                                        <div class="form-group mb-2">
                                            <label>Jumlah Bayar</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="number" id="jumlah_bayar" name="jumlah_bayar"
                                                    class="form-control" value="150000">
                                            </div>
                                        </div>

                                        <!-- Input Kembalian -->
                                        <div class="form-group mb-3">
                                            <label>Kembalian</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="number" readonly id="kembalian" name="kembalian"
                                                    class="form-control" value="30000">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info form-control">Bayar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
