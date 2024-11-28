@extends('dashboard.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold">Data Poli</h3>
                <div>
                    <!-- Button to trigger the modal -->
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPoliModal">
                        <i class="fas fa-plus"></i> Tambah Data
                    </button>
                    <a href="" class="btn btn-sm btn-warning ms-1"><i class="fas fa-upload me-2"></i>Import Data</a>
                    <a href="" class="btn btn-sm btn-success ms-1"><i class="fas fa-file-excel me-2"></i>Export
                        Excel</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Poli</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data Rows -->
                    @foreach ($polis as $item)
                        <tr>
                            <td width="5%">{{ $loop->iteration }}</td>
                            <td width="10%">{{ $item->kodePoli }}</td>
                            <td width="70%">{{ $item->namaPoli }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#updatePoliModal{{ $item->id }}">
                                    <i class="fas fa-edit"></i> Ubah
                                </button>

                                <form action="{{ route('poli.destroy', $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin untuk menghapus poli ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for Adding Data -->
    <div class="modal fade" id="addPoliModal" tabindex="-1" aria-labelledby="addPoliModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('poli.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPoliModalLabel">Tambah Data Poli</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Poli</label>
                            <input type="text" class="form-control" id="kode" name="kodePoli" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_poli" class="form-label">Nama Poli</label>
                            <input type="text" class="form-control" id="nama_poli" name="namaPoli" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Data -->
    @foreach ($polis as $poli)
        <div class="modal fade" id="updatePoliModal{{ $poli->id }}" tabindex="-1"
            aria-labelledby="updatePoliModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('poli.update', $poli->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="updatePoliModalLabel">Ubah Data Poli</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode Poli</label>
                                <input type="text" class="form-control" id="kode" name="kodePoli"
                                    value="{{ $poli->kodePoli }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_poli" class="form-label">Nama Poli</label>
                                <input type="text" class="form-control" id="nama_poli" name="namaPoli"
                                    value="{{ $poli->namaPoli }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script>
        // Optional: Custom scripts for handling the modal or form validation can go here
    </script>
@endsection
