@extends('dashboard.app')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card card-info mt-3">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0 fw-bold">Data Practitioner</h3>
                    <div>
                        <!-- Button to trigger the modal -->
                        <button type="button" class="btn btn-sm btn-light text-dark" data-toggle="modal"
                            data-target="#addPractitionerModal">
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
                        @foreach ($practitioners as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->PractitionerGroup->namaGroup }}</td>
                            <td>{{ $item->namaPractitioner }}</td>
                            <td>{{ $item->nikPractitioner }}</td>
                            <td class="text-center">
                                <!-- Button to trigger Edit Modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                    data-target="#editPractitionerModal{{ $item->id }}">
                                    <i class="fas fa-edit"></i> Ubah
                                </button>
                                <form action="{{ route('practitioner.destroy', $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin untuk menghapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editPractitionerModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editPractitionerModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('practitioner.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPractitionerModalLabel">Edit Data Practitioner</h5>
                                            <button type="button" class="btn-close" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Group field with Select2 -->
                                            <div class="mb-3">
                                                <label class="form-label">Group</label>
                                                <select class="form-control" name="practitioner_group_id">
                                                    <option selected="selected">Pilih</option>
                                                    @foreach (\App\Models\PractitionerGroup::all() as $group)
                                                    <option value="{{ $group->id }}" {{ $item->practitioner_group_id ==
                                                        $group->id ? 'selected' : '' }}>{{ $group->namaGroup }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="name" name="namaPractitioner"
                                                    value="{{ $item->namaPractitioner }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nik" class="form-label">NIK</label>
                                                <input type="text" class="form-control" id="nik" name="nikPractitioner"
                                                    value="{{ $item->nikPractitioner }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addPractitionerModal" tabindex="-1" aria-labelledby="addPractitionerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('practitioner.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPractitionerModalLabel">Tambah Data Practitioner</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Group field with Select2 -->
                    <div class="mb-3">
                        <label class="form-label">Group</label>
                        <select class="form-control" name="practitioner_group_id">
                            <option selected="selected">Pilih</option>
                            @foreach (\App\Models\PractitionerGroup::all() as $group)
                            <option value="{{ $group->id }}">{{ $group->namaGroup }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="namaPractitioner" required>
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nikPractitioner" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
