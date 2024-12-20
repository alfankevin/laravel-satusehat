@extends('dashboard.app')
@section('content')
    <!-- Section untuk Tabel Data Antrian -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center ">
                        <h3 class="mb-0 fw-bold">Data Kasir</h3>
                        <div>
                            
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Antrian</th>
                                    <th>No Rekam Medis</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>tanggal Lahir</th>
                                    <th>Status Bayar</th>
                                    <th class="text-center">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data Dummy -->
                                @foreach ($pendaftarans as $key => $pendaftaran)
                                    <tr>
                                        <td class="text-center text-danger fw-bold align-middle">{{ $pendaftaran->noAntrian }}
                                        </td>
                                        <td>{{ $pendaftaran->pasien->nomorRm }}</td> 
                                        <td class="align-middle">
                                            {{ $pendaftaran->pasien->nama }}</small>
                                        </td>
                                        <td class="align-middle">{{ Str::limit($pendaftaran->pasien->alamat, 15) }}
                                        </td>
                                        <td class="text-start align-middle">{{ $pendaftaran->pasien->tglLahir }}</td>
                                        <td class="align-middle"><span class="badge bg-warning text-dark">Belum Bayar</span></td>
                                        <td class="align-middle text-center">
                                            <button class="btn btn-primary btn-sm"><i class="fas fa-receipt"></i>
                                                Nota</button>
                                            <a href="{{ route('kasir.bayar', $pendaftaran->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-money-bill"></i>
                                                Bayar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
