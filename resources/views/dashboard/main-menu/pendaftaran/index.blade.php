@extends('dashboard.app')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-0 fw-bold">Data Kunjungan</h3>
            <div>
                <a href="{{ route('kunjungan.create') }}" class="btn btn-primary "><i class="fas fa-plus"></i> Tambah Data</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Antrian</th>
                        <th>ID Pasien</th>
                        <th>Nama Pasien</th>
                        <th>Nomor RM</th>
                        <th>Poliklinik</th>
                        <th>Dokter</th>
                        <th>Tgl Daftar</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendaftarans as $key => $pendaftaran)
                    <tr>
                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                        <td class="align-middle">A-01</td>
                        <td class="align-middle">{{ $pendaftaran->pasien->id }}</td>
                        <td class="align-middle">{{ $pendaftaran->pasien->nama }}</td>
                        <td class="align-middle">{{ $pendaftaran->pasien->nomorRm }}</td>
                        <td class="align-middle">{{ $pendaftaran->poli->namaPoli }}</td>
                        <td class="align-middle">{{ $pendaftaran->practitioner->namaPractitioner }}</td>
                        <td class="align-middle">{{ \Carbon\Carbon::parse($pendaftaran->tglDaftar)->format('d-m-Y') }}</td>
                        <td class="align-middle"><span class="badge bg-danger">Belum Diperiksa</span></td>
                        <td class="text-center align-middle">
                            <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin untuk menghapus obat ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection