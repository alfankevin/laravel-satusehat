@extends('dashboard.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 fw-bold">Data Practitioner Group</h3>
                        <div>
                            <!-- Button to trigger modal -->
                            <button type="button" class="btn btn-sm btn-light text-dark" data-toggle="modal"
                                data-target="#addGroupModal">
                                <i class="fas fa-plus"></i> Tambah Data
                            </button>
                            <a href="" class="btn btn-sm btn-warning ms-1"><i class="fas fa-upload me-2"></i>Import
                                Data</a>
                            <a href="" class="btn btn-sm btn-success ms-1"><i
                                    class="fas fa-file-excel me-2"></i>Export
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
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->namaGroup }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-warning btn-sm edit-btn"
                                            data-id="{{ $item->id }}" data-nama-group="{{ $item->namaGroup }}"
                                            data-toggle="modal" data-target="#editGroupModal">
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>

                                        <form id="delete-form-{{ $item->id }}" action="{{ route('practitioner-group.destroy', $item->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $item->id }}')">
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
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="group_name" class="form-label">Nama Group</label>
                            <input type="text" class="form-control" id="group_name" name="namaGroup" required>
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

    <div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editGroupForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editGroupModalLabel">Ubah Data Group</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_group_name" class="form-label">Nama Group</label>
                            <input type="text" class="form-control" id="edit_group_name" name="namaGroup" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

@endsection


@push('scripts')
<script>
    $(document).on('click', '.edit-btn', function () {
        var id = $(this).data('id');
        var namaGroup = $(this).data('nama-group');

        // Set data pada modal
        $('#edit_group_name').val(namaGroup);

        // Set action form
        var actionUrl = "{{ url('practitioner-group') }}/" + id;
        $('#editGroupForm').attr('action', actionUrl);
    });
</script>
@endpush

