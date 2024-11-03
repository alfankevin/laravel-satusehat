@extends('dashboard.app')
@section('content')
    <!-- Section untuk Tabel Data Antrian -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center ">
                <h3 class="mb-0 fw-bold">Data Kasir</h3>
                <div>
                    <button class="btn btn-primary btn-sm">Data Penjualan Obat</button>
                    <button class="btn btn-warning btn-sm text-white">Laporan Pasien Bulanan</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">Antrian</th>
                            <th>No. Reg/RM</th>
                            <th>Nama</th>
                            <th>Status Bayar</th>
                            <th>Alamat</th>
                            <th class="text-start">No HP</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Dummy -->
                        <tr>
                            <td class="text-center text-danger fw-bold align-middle">A-02</td>
                            <td class="align-middle">REG/20240116/002<br><small>No. RM: 000005</small></td>
                            <td class="align-middle">Agus Susanto, Tn<br><small>01-01-1987</small></td>
                            <td class="align-middle"><span class="badge bg-warning text-dark">Belum Bayar</span></td>
                            <td class="align-middle">Jepara rt 001 rw 009</td>
                            <td class="text-start align-middle">08564011111</td>
                            <td class="align-middle">
                                <button class="btn btn-primary btn-sm mb-1"><i class="bi bi-eye-fill"></i> Nota</button>
                                <button class="btn btn-danger btn-sm"><i class="bi bi-cash-stack"></i> Bayar</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle text-danger fw-bold">A-01</td>
                            <td class="align-middle">REG/20240116/001<br><small>No. RM: 000006</small></td>
                            <td class="align-middle">Sampurna, Tn<br><small>01-01-1987</small></td>
                            <td class="align-middle"><span class="badge bg-warning text-dark">Belum Bayar</span></td>
                            <td class="align-middle">Jepara 01/09</td>
                            <td class="text-start align-middle">08564011112</td>
                            <td class="align-middle">
                                <button class="btn btn-primary btn-sm mb-1"><i class="bi bi-eye-fill"></i> Nota</button>
                                <button class="btn btn-danger btn-sm"><i class="bi bi-cash-stack"></i> Bayar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
