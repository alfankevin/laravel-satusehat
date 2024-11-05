@extends('dashboard.app')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-0 fw-bold">Data Pasien</h3>
            <div>
                <a href="{{ route('pasien.create') }}" class="btn btn-primary "><i class="fas fa-plus"></i> Tambah Data</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="dataTable" class=" table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor RM</th>
                        <th>Nama Pasien</th>
                        <th>Tgl Lahir & JK</th>
                        <th>NIK & No Kartu</th>
                        <th class="text-start">No HP</th>
                        <th>Alamat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data Rows -->
                    <tr>
                        <td class="text-center align-middle">0</td>
                        <td class="align-middle">K2024-000001</td>
                        <td class="align-middle">Budi Santoso</td>
                        <td class="align-middle">
                            07-10-1989 <br>
                            Laki-laki
                        </td>
                        <td class="align-middle">
                            NIK: 1234567890 <br>
                            No Kartu: 1234567890
                        </td>
                        <td class="text-start align-middle">081234567890</td>
                        <td class="align-middle">Surabaya</td>
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
                    @foreach ($pasiens as $key => $pasien)
                    <tr>
                        <td class="text-center align-middle">{{ $key + 1 }}</td>
                        <td class="align-middle">{{ $pasien->nomorRm }}</td>
                        <td class="align-middle">{{ $pasien->nama }}</td>
                        <td class="align-middle">
                            {{ \Carbon\Carbon::parse($pasien->tglLahir)->format('d-m-Y') }}<br>
                            {{ $pasien->sex === 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </td>
                        <td class="align-middle">
                            <span style="white-space: nowrap">NIK: {{ $pasien->noKtp }}</span><br>
                            <span style="white-space: nowrap">No Kartu: {{ $pasien->noKartu }}</span>
                        </td>
                        <td class="text-start align-middle">{{ $pasien->noHp }}</td>
                        <td class="align-middle">{{ $pasien->alamat }}</td>
                        <td class="text-center align-middle" style="white-space: nowrap">
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