@extends('dashboard.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">{{ now()->format('d F Y') }}</h1>
                </div>
                <div class="card-body">
                    <h3 class="card-title">Selamat Datang di Modul Rawat Jalan,
                        <span><b>{{ auth()->user()->name }}</b></span></h3>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $jumlahPasienUmum }}</h3>
                            <p> Total Kunjungan Umum</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $jumlahPasienBpjs }}</h3>
                            <p> Total Kunjungan BPJS</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $jumlahPasien }}</h3>
                            <p>Jumlah Pasien Baru</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
            <!-- /.row (main row) -->

            <div class="row">
                <div class="col-md-6">
                    <!-- BAR CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-users mx-1"></i>Pendapatan PerBulan</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChartPendapatan"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-6">
                    <!-- BAR CHART -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-users mx-1"></i> Kunjungan Pasien PerBulan</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col (RIGHT) -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('scripts')
    @push('scripts')
        <script>
            $(function() {
                //-------------
                //- BAR CHART -
                //-------------
                var barChartCanvas = $('#barChartPendapatan').get(0).getContext('2d');

                var barChartData = {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
                    datasets: [{
                            label: 'Pendapatan Umum',
                            backgroundColor: '#007bff',
                            borderColor: '#00a65a',
                            data: [65000, 59000, 80000, 81000, 56000, 55000] // Nilai dalam format angka
                        },
                        {
                            label: 'Pendapatan BPJS',
                            backgroundColor: '#f39c12',
                            borderColor: '#f39c12',
                            data: [45000, 39000, 60000, 71000, 46000, 45000]
                        }
                    ]
                };

                var barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID'); // Format ke Rupiah
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += 'Rp ' + context.raw.toLocaleString(
                                    'id-ID'); // Format tooltip ke Rupiah
                                    return label;
                                }
                            }
                        }
                    }
                };

                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                });

                //-------------
                //- BAR CHART -
                //-------------
                var barChartCanvas = $('#barChart').get(0).getContext('2d');
                var barChartData = {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
                    datasets: [{
                            label: 'Jumlah Pasien Umum',
                            backgroundColor: '#007bff',
                            borderColor: '#00a65a',
                            data: [65, 59, 80, 81, 56, 55]
                        },
                        {
                            label: 'Jumlah Pasien BPJS',
                            backgroundColor: '#f39c12',
                            borderColor: '#f39c12',
                            data: [45, 39, 60, 71, 46, 45]
                        }
                    ]
                };
                var barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                };
                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                });
            });
        </script>
    @endpush
@endpush
