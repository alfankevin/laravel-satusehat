@extends('dashboard.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold">Data Practitioner</h3>
                <div>
                    <!-- Button to trigger the modal -->
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addPractitionerModal">
                        <i class="fas fa-plus"></i> Tambah Data
                    </button>
                    <a href="" class="btn btn-sm btn-warning ms-1"><i class="fas fa-upload me-2"></i> Import Data</a>
                    <a href="" class="btn btn-sm btn-success ms-1"><i class="fas fa-file-excel me-2"></i> Export
                        Excel</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Group</th>
                        <th width="20%">Nama</th>
                        <th width="50%">NIK</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data Rows -->
                    <tr>
                        <td>1</td>
                        <td>Dokter</td>
                        <td>Dr. Abdul Kodir</td>
                        <td>1234567890</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                            <form action="" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Bidan</td>
                        <td>Catur Wulandari</td>
                        <td>1234567890</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                            <form action="" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal Form with Select2 for Group -->
    <div class="modal fade" id="addPractitionerModal" tabindex="-1" aria-labelledby="addPractitionerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPractitionerModalLabel">Tambah Data Practitioner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Group field with Select2 -->
                        <div class="mb-3">
                            <label class="form-label">Group</label>
                            <select class="form-control select2" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" required>
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
        //Initialize Select2 Elements
        $('.select2').select2()
    </script>
@endsection
