@extends('dashboard.app')
@section('content')
    <div class="container-fluid">
        <div class="card mt-3 card-info">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Data Pasien</h3>
                    <div>
                        <a href="{{ route('pasien.create') }}" class="btn btn-light text-dark btn-sm"><i
                                class="fas fa-plus"></i> Tambah Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <table id="dataTable" class="table-responsive display nowrap table table-striped table-bordered"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th >Nama & Nomor RM</th>
                            <th>T.Lahir Sex</th>
                            <th>Usia</th>
                            <th>NIK & No Kartu</th>
                            <th class="text-start">No HP</th>
                            <th>Alamat</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Kabupaten</th>
                            <th>Provinsi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pasiens as $key => $pasien)
                            <tr>
                                <td class="text-center align-middle">{{ $key + 1 }}</td>
                                <td class="align-middle">{{ $pasien->id }}</td>
                                <td  class="align-middle">{{ $pasien->nama }} <br> {{ $pasien->nomorRm }}</td>
                                <td class="align-middle">
                                    <span
                                        class="text-nowrap">{{ \Carbon\Carbon::parse($pasien->tglLahir)->format('d-m-Y') }}</span><br>
                                    {{ $pasien->sex === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </td>
                                <td class="align-middle">
                                    @php
                                        $usia = \Carbon\Carbon::parse($pasien->tglLahir);
                                    @endphp
                                    <span
                                        class="text-nowrap">{{ $usia->diff(\Carbon\Carbon::now())->format('%y tahun,') }}</span>
                                    <span
                                        class="text-nowrap">{{ $usia->diff(\Carbon\Carbon::now())->format('%m bulan,') }}</span>
                                    <span
                                        class="text-nowrap">{{ $usia->diff(\Carbon\Carbon::now())->format('%d hari') }}</span>
                                </td>
                                <td class="align-middle">
                                    <span class="text-nowrap">NIK: {{ $pasien->noKtp }}</span><br>
                                    <span class="text-nowrap">No Kartu: {{ $pasien->noKartu }}</span>
                                </td>
                                <td class="text-start align-middle">{{ $pasien->noHp }}</td>
                                <td class="align-middle">{{ $pasien->alamat }}</td>
                                <td class="align-middle text-capitalize">{{ ucfirst(strtolower($pasien->kelurahan->KELURAHAN)) }}</td>
                                <td class="align-middle text-capitalize">{{ $pasien->kelurahan->kecamatan->KECAMATAN }}</td>
                                <td class="align-middle text-capitalize">{{ $pasien->kelurahan->kecamatan->kabupaten->KABUPATEN  }}</td>
                                <td class="align-middle text-capitalize">{{ $pasien->kelurahan->kecamatan->kabupaten->provinsi->PROVINSI  }}</td>
                                <td class="text-center align-middle text-nowrap">
                                    <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">
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
