@extends('dashboard.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info mt-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 fw-bold">Data Laborat</h3>
                        <div>
                            <button class="btn btn-sm btn-light text-dark" data-toggle="modal" data-target="#modalAddEdit">
                                <i class="fas fa-plus"></i> Tambah Data
                            </button>
                            <a href="" class="btn btn-sm btn-warning ms-1"><i class="fas fa-upload me-2"></i> Import
                                Data</a>
                            <a href="" class="btn btn-sm btn-success ms-1"><i class="fas fa-file-excel me-2"></i>
                                Export Excel</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="30%">Nama Lab</th>
                                    <th>Satuan</th>
                                    <th>Nilai Normal</th>
                                    <th width="60%">Tarif</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laborats as $laborat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $laborat->pemeriksaan }}</td>
                                        <td>{{ $laborat->satuan }}</td>
                                        <td>{{ $laborat->nilai_normal }}</td>
                                        <td>Rp{{ number_format($laborat->biaya, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm btn-edit" data-toggle="modal"
                                                data-target="#modalAddEdit" data-id="{{ $laborat->id }}"
                                                data-pemeriksaan="{{ $laborat->pemeriksaan }}"
                                                data-biaya="{{ $laborat->biaya }}"  data-satuan="{{ $laborat->satuan }}"  data-nilai_normal="{{ $laborat->nilai_normal }}">
                                                <i class="fas fa-edit"></i> Ubah
                                            </button>

                                            <form id="delete-form-{{ $laborat->id }}" action="{{ route('laborat.destroy', $laborat->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $laborat->id }}')">
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
    </div>

    <!-- Modal Tambah/Ubah -->
    <div class="modal fade" id="modalAddEdit" tabindex="-1" aria-labelledby="modalAddEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formAddEdit" method="POST">
                @csrf
                <input type="hidden" id="laborat_id" name="id">
                <input type="hidden" name="_method" id="_method" value="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddEditLabel">Tambah/Ubah Data</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="pemeriksaan" class="form-label">Nama Laborat</label>
                            <input type="text" class="form-control" id="pemeriksaan" name="pemeriksaan" required>
                        </div>
                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan" required>
                        </div>
                        <div class="mb-3">
                            <label for="nilai_normal" class="form-label">Nilai Normal</label>
                            <input type="text" class="form-control" id="nilai_normal" name="nilai_normal" required>
                        </div>
                        <div class="mb-3">
                            <label for="biaya" class="form-label">Tarif</label>
                            <input type="number" class="form-control" id="biaya" name="biaya" required>
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

@push('scripts')
    <script>
        // Handle edit button click
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const modal = document.getElementById('modalAddEdit');
                const form = document.getElementById('formAddEdit');
                const methodInput = document.getElementById('_method');

                // Update form action and method
                form.action = '{{ route('laborat.update', ':id') }}'.replace(':id', this.dataset.id);
                methodInput.value = 'PUT';

                // Populate form fields
                modal.querySelector('#pemeriksaan').value = this.dataset.pemeriksaan;
                modal.querySelector('#satuan').value = this.dataset.satuan;
                modal.querySelector('#nilai_normal').value = this.dataset.nilai_normal;
                modal.querySelector('#biaya').value = this.dataset.biaya;

                // Show modal
                $('#modalAddEdit').modal('show');
            });
        });

        // Reset form on modal close
        $('#modalAddEdit').on('hidden.bs.modal', function() {
            const form = document.getElementById('formAddEdit');
            form.reset(); // Clear form values
            form.action = '{{ route('laborat.store') }}'; // Reset action to store
            document.getElementById('_method').value = 'POST'; // Reset method to POST
        });
    </script>
@endpush
