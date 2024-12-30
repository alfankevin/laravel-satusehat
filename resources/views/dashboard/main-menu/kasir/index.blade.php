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
                                        <td class="text-center text-danger fw-bold align-middle">
                                            {{ $pendaftaran->noAntrian }}
                                        </td>
                                        <td>{{ substr(str_pad($pendaftaran->pasien->nomorRm, 6, '0', STR_PAD_LEFT), 0, 2) . '-' . substr(str_pad($pendaftaran->pasien->nomorRm, 6, '0', STR_PAD_LEFT), 2, 2) . '-' . substr(str_pad($pendaftaran->pasien->nomorRm, 6, '0', STR_PAD_LEFT), 4, 2) }}
                                        </td>
                                        <td class="align-middle">
                                            {{ $pendaftaran->pasien->nama }}</small>
                                        </td>
                                        <td class="align-middle">{{ Str::limit($pendaftaran->pasien->alamat, 15) }}
                                        </td>
                                        <td class="text-start align-middle">
                                            {{ \Carbon\Carbon::parse($pendaftaran->pasien->tglLahir)->locale('id')->translatedFormat('d F Y') }}
                                        </td>
                                        @php
                                            // Cek apakah kunjungan_id sudah dibayar
                                            $isPaid = \App\Models\Bayar::where(
                                                'kunjungan_id',
                                                $pendaftaran->id,
                                            )->exists();
                                        @endphp
                                        @if ($isPaid)
                                            <td class="align-middle"><span class="badge bg-success">Sudah Bayar</span>
                                            </td>
                                        @else
                                            <td class="align-middle"><span class="badge bg-warning text-dark">Belum
                                                    Bayar</span></td>
                                        @endif

                                        <td class="align-middle text-center">
                                            <a href="{{ route('kasir.cetak-kwitansi', $pendaftaran->id) }}" target="_blank"
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-receipt"></i> Kwitansi
                                            </a>

                                            <a href="{{ route('kasir.bayar', $pendaftaran->id) }}"
                                                class="btn btn-danger btn-sm"><i class="fas fa-money-bill"></i>
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
