@extends('dashboard.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold">Data Practitioner Group</h3>
                <div>
                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addGroupModal">
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
                        <th width="5%">No</th>
                        <th width="80%">Nama Group</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data Rows -->
                    @foreach ($practitionerGroups as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->namaGroup}}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                                <form action="{{ route('practitioner-group.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">
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

    <!-- Modal Form for Adding Group -->
    <div class="modal fade" id="addGroupModal" tabindex="-1" aria-labelledby="addGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('practitioner-group.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGroupModalLabel">Tambah Data Group</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="group_name" class="form-label">Nama Group</label>
                            <input type="text" class="form-control" id="group_name" name="namaGroup" required>
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
