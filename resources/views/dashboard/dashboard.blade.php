@extends('dashboard.app')
@section('content')
    <h3 class="mb-3">Dashboard</h3>
    <div class="row" id="dashboard">
        <div class="col-lg-4 col-6">
            <div class="card bg-info">
                <div class="card-body">
                    <div>
                        <h3>
                            150
                        </h3>
                        <p>
                            Total Kunjungan Umum
                        </p>
                    </div>
                    <i class="fas fa-shopping-cart">
                    </i>
                </div>
                <div class="card-footer ">
                    <a class="text-white" href="#">
                        More info
                        <i class="fas fa-arrow-circle-right">
                        </i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="card bg-secondary">
                <div class="card-body">
                    <div>
                        <h3>
                            53
                        </h3>
                        <p>
                            Total Kunjungan BPJS
                        </p>
                    </div>
                    <i class="fas fa-chart-bar">
                    </i>
                </div>
                <div class="card-footer ">
                    <a class="text-white" href="#">
                        More info
                        <i class="fas fa-arrow-circle-right">
                        </i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="card bg-warning">
                <div class="card-body">
                    <div>
                        <h3>
                            203
                        </h3>
                        <p>
                            Jumlah Pasien
                        </p>
                    </div>
                    <i class="fas fa-users">
                    </i>
                </div>
                <div class="card-footer ">
                    <a class="text-white" href="#">
                        More info
                        <i class="fas fa-arrow-circle-right">
                        </i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="card bg-primary">
                <div class="card-body">
                    <div>
                        <h3>
                            20
                        </h3>
                        <p>
                            Jumlah Dokter
                        </p>
                    </div>
                    <i class="fas fa-user">
                    </i>
                </div>
                <div class="card-footer ">
                    <a class="text-white" href="#">
                        More info
                        <i class="fas fa-arrow-circle-right">
                        </i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="card bg-success">
                <div class="card-body">
                    <div>
                        <h3>
                            Rp, 200.000.000
                        </h3>
                        <p>
                            Total Pendapatan Bulan ini
                        </p>
                    </div>
                    <i class="fas fa-dollar-sign">
                    </i>
                </div>
                <div class="card-footer ">
                    <a class="text-white" href="#">
                        More info
                        <i class="fas fa-arrow-circle-right">
                        </i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="card bg-danger">
                <div class="card-body">
                    <div>
                        <h3>
                            Rp, 50.000.000
                        </h3>
                        <p>
                            Total Pengeluaran Bulan Ini
                        </p>
                    </div>
                    <i class="fas fa-dollar-sign">
                    </i>
                </div>
                <div class="card-footer ">
                    <a class="text-white" href="#">
                        More info
                        <i class="fas fa-arrow-circle-right">
                        </i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
