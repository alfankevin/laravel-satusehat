@extends('dashboard.app')
@section('content')
    <div class="container-fluid">
        <div class="card mt-3">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0 fw-bold">Data Poli</h3>
                    <div>
                        <!-- Button to trigger the modal -->
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPoliModal">
                            <i class="fas fa-plus"></i> Tambah Data
                        </button>
                        <a href="" class="btn btn-sm btn-warning ms-1"><i class="fas fa-upload me-2"></i>Import Data</a>
                        <a href="" class="btn btn-sm btn-success ms-1"><i class="fas fa-file-excel me-2"></i>Export Excel</a>
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
                        <tr>
                            <td width="5%">1</td>
                            <td width="10%">P001</td>
                            <td width="70%">KIA</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                                <form action="" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin untuk menghapus poli ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>P002</td>
                            <td>Poli Umum</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                                <form action="" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin untuk menghapus poli ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for Adding Data -->
    <div class="modal fade" id="addPoliModal" tabindex="-1" aria-labelledby="addPoliModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPoliModalLabel">Tambah Data Poli</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Poli</label>
                            <input type="text" class="form-control" id="kode" name="kode" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_poli" class="form-label">Nama Poli</label>
                            <input type="text" class="form-control" id="nama_poli" name="nama_poli" required>
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
@endsection

@section('scripts')
<script>
    // Optional: Custom scripts for handling the modal or form validation can go here
</script>
@endsection
