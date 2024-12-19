@extends('dashboard.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mx-1">Data Kunjungan</h3>
                        <div>
                            <button class="btn btn-light text-dark btn-sm" data-toggle="modal" data-target="#modalTambahPasien">
                                <i class="fas fa-plus"></i> Tambah Pasien Baru
                            </button>
    
                            <button class="btn btn-light text-dark btn-sm" data-toggle="modal"
                                data-target="#modalTambahKunjungan">
                                <i class="fas fa-plus"></i> Tambah Kunjungan
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body" style="overflow-x: hidden;">
                    {{-- Filter --}}
                    <div class="row mb-3" style="background-color: #dadada; padding: 10px;">
                        <form action="{{ route('kunjungan.index') }}" method="GET" class="w-100">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="no_rm">No. Rekam Medis</label>
                                        <input type="text" name="no_rm" id="no_rm" class="form-control"
                                            value="{{ request('no_rm') }}" placeholder="Masukkan No. RM">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nama_pasien">Nama Pasien</label>
                                        <input type="text" name="nama_pasien" id="nama_pasien" class="form-control"
                                            value="{{ request('nama_pasien') }}" placeholder="Masukkan Nama Pasien">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tgl_daftar">Tanggal Daftar</label>
                                        <input type="date" name="tgl_daftar" id="tgl_daftar" class="form-control"
                                            value="{{ request('tgl_daftar') }}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="row mt-4">
                                        <div class="col form-group">
                                            <button type="submit" class="btn btn-primary btn-sm mt-2 form-control">
                                                <i class="fas fa-search"></i> Cari
                                            </button>
                                        </div>
                                        <div class="col">
                                            <a href="{{ route('kunjungan.index') }}"
                                                class="btn btn-secondary btn-sm mt-2 form-control">
                                                <i class="fas fa-undo"></i> Reset
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                        </form>
                    </div>
                    @if ($pendaftarans->isEmpty())
                        <div class="table-responsive">
                            <table id="dataTablePendaftaran" class="display nowrap  table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Antrian</th>
                                        <th>Nama Pasien</th>
                                        <th>Nomor RM</th>
                                        <th>Poliklinik</th>
                                        <th>Dokter</th>
                                        <th>Tgl Daftar</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    @else
                        <table id="dataTablePendaftaran" class="display nowrap  table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Antrian</th>
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
                    @endif
    
    
                </div>
            </div>
    
            <!-- Modal untuk menambahkan pasien baru -->
            @include('dashboard.main-menu.pendaftaran.modal-add-pasien')
    
            @include('dashboard.main-menu.pendaftaran.modal-daftar')
        </div>
    </div>
@endsection

@if (session('newPasien'))
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Ambil data pasien dari session
                const newPasien = @json(session('newPasien'));

                // Pastikan elemen modal sudah ada di DOM
                if (newPasien && document.getElementById('modalTambahKunjungan')) {
                    // Cari elemen dropdown pasien
                    const pasienDropdown = document.getElementById('pasien_id');
                    if (pasienDropdown) {
                        // Setel nilai default dropdown ke pasien baru
                        for (const option of pasienDropdown.options) {
                            if (option.value == newPasien.id) {
                                option.selected = true;
                                break;
                            }
                        }
                    }

                    // Tampilkan modal tambah kunjungan
                    $('#modalTambahKunjungan').modal('show');
                }
            });
        </script>
    @endpush
@endif
