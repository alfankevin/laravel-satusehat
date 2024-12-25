@extends('dashboard.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 fw-bold">Data Diagnosa</h3>
                        <div>
                            <button class="btn btn-sm btn-light text-dark" data-toggle="modal" data-target="#modalAddEdit">
                                <i class="fas fa-plus"></i> Tambah Data
                            </button>
                            <a href="" class="btn btn-sm btn-warning ms-1"><i class="fas fa-upload me-2"></i> Import Data</a>
                            <a href="" class="btn btn-sm btn-success ms-1"><i class="fas fa-file-excel me-2"></i> Export Excel</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>ICD 10</th>
                                <th>Diagnosa</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diagnosas as $diagnosa)
                                <tr>
                                    <td class="text-center" width="5%">{{ $loop->iteration }}</td>
                                    <td width="10%">{{ $diagnosa->kode }}</td>
                                    <td width="70%">{{ $diagnosa->diagnosa }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm btn-edit" 
                                            data-toggle="modal" 
                                            data-target="#modalAddEdit" 
                                            data-id="{{ $diagnosa->id }}" 
                                            data-kode="{{ $diagnosa->kode }}" 
                                            data-diagnosa="{{ $diagnosa->diagnosa }}">
                                            <i class="fas fa-edit"></i> Ubah
                                        </button>
                                        <form action="{{ route('diagnosa.destroy', $diagnosa->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin untuk menghapus diagnosa ini?')">
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

    <!-- Modal Tambah/Ubah -->
    <div class="modal fade" id="modalAddEdit" tabindex="-1" aria-labelledby="modalAddEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formAddEdit" method="POST" action="{{ route('diagnosa.store') }}">
                @csrf
                <input type="hidden" id="diagnosa_id" name="id">
                <input type="hidden" name="_method" id="_method" value="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddEditLabel">Tambah/Ubah Diagnosa</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode" class="form-label">ICD 10</label>
                            <input type="text" class="form-control" id="kode" name="kode" required>
                        </div>
                        <div class="mb-3">
                            <label for="diagnosa" class="form-label">Diagnosa</label>
                            <input type="text" class="form-control" id="diagnosa" name="diagnosa" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Handle edit button click
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const modal = document.getElementById('modalAddEdit');
                const form = document.getElementById('formAddEdit');
                const methodInput = document.getElementById('_method');

                // Update form action and method
                form.action = '{{ route('diagnosa.update', ':id') }}'.replace(':id', this.dataset.id);
                methodInput.value = 'PUT';

                // Populate form fields
                modal.querySelector('#kode').value = this.dataset.kode;
                modal.querySelector('#diagnosa').value = this.dataset.diagnosa;
            });
        });

        // Reset form on modal close
        $('#modalAddEdit').on('hidden.bs.modal', function() {
            const form = document.getElementById('formAddEdit');
            form.reset();
            form.action = '{{ route('diagnosa.store') }}';
            document.getElementById('_method').value = 'POST';
        });
    </script>
@endsection
