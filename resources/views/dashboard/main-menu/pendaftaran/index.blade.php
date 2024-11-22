@extends('dashboard.app')
@section('content')
    <div class="container-fluid">
        <div class="card card-info mt-3">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Form Tambah Kunjungan</h3>
                    <div>
                        <a href="{{ route('pasien.create') }}" class="btn btn-light text-dark btn-sm"><i
                                class="fas fa-plus"></i> Tambah Pasien Baru</a>
                    </div>
                </div>
            </div>
            <div class="card-body" >
                <form action="{{ route('kunjungan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tkp_id" value="1">
                    <input type="hidden" name="status" value="0">
                    <input type="hidden" name="nomorrm" value="000006">
                    <input type="hidden" name="noAntrian" value="A-02">
                    <input type="hidden" name="kunjSakit" value="1">
                    <input type="hidden" name="tglDaftar" value="{{ now()->format('Y-m-d') }}">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="nomorrm">Cari Pasien (Nama, Nomor RM, NIK)</label>
                                <select class="js-select2" id="pasien_id" name="pasien_id" required>
                                    <option value="0">--Pilih Pasien--</option>
                                    @foreach ($pasiens as $pasien)
                                        <option value="{{ $pasien->id }}">{{ $pasien->nama }} - {{ $pasien->nomorRm }} -
                                            {{ $pasien->noKtp }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="tempat">Poli</label>
                                <select class="js-select2" id="poli_id" name="poli_id" required>
                                    <option value="">--Pilih Poli--</option>
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}">{{ $poli->namaPoli }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="tempat">Dokter</label>
                                <select class=" js-select2" id="practitioner_id" name="practitioner_id" required>
                                    <option value="">--Pilih Dokter--</option>
                                    @foreach ($practitioners as $practitioner)
                                        <option value="{{ $practitioner->id }}">{{ $practitioner->namaPractitioner }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2 mt-2">
                            <button type="submit" class="btn btn-primary form-control mt-4">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mt-3 card-info">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Data Kunjungan</h3>
                    <div>

                    </div>
                </div>
            </div>
            <div class="card-body" style="overflow-x: hidden;">
                <table id="dataTable" class="table-responsive display nowrap table table-striped table-bordered"
                    style="width:100%">
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
                                <td class="align-middle">{{ $pendaftaran->noAntrian }}</td>
                                <td class="align-middle">{{ $pendaftaran->pasien->id }}</td>
                                <td class="align-middle">{{ $pendaftaran->pasien->nama }}</td>
                                <td class="align-middle">{{ $pendaftaran->pasien->nomorRm }}</td>
                                <td class="align-middle">{{ $pendaftaran->poli->namaPoli }}</td>
                                <td class="align-middle">{{ $pendaftaran->practitioner->namaPractitioner }}</td>
                                <td class="align-middle">
                                    {{ \Carbon\Carbon::parse($pendaftaran->tglDaftar)->format('d-m-Y') }}</td>
                                <td class="align-middle">
                                    @if ($pendaftaran->status == 1)
                                        <span class="badge bg-success"><i class="fas fa-stethoscope"></i> Sudah
                                            Diperiksa</span>
                                    @elseif ($pendaftaran->status == 0)
                                        <span class="badge bg-danger"><i class="fas fa-stethoscope"></i> Belum
                                            Diperiksa</span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>

                                    <form action="{{ route('kunjungan.destroy', $pendaftaran->id) }}" method="POST" 
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
