@extends('dashboard.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info mt-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 fw-bold">Data Layanan</h3>
                        <button class="btn btn-sm btn-light text-dark" data-toggle="modal" data-target="#modalAddEdit"
                            onclick="resetModal()">
                            <i class="fas fa-plus"></i> Tambah Data
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="30%">Nama Layanan</th>
                                    <th width="60%">Tarif</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tindakans as $tindakan)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $tindakan->tindakan }}</td>
                                        <td>Rp.{{ number_format($tindakan->biaya, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-warning btn-sm btn-edit" data-toggle="modal" data-target="#modalAddEdit" data-id="{{ $tindakan->id }}"
                                                data-tindakan="{{ $tindakan->tindakan }}"
                                                data-biaya="{{ $tindakan->biaya }}">
                                                <i class="fas fa-edit"></i> Ubah
                                            </button>
                                            <form action="{{ route('tindakan.destroy', $tindakan->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin untuk menghapus layanan ini?')">
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
                <input type="hidden" id="tindakan_id" name="id">
                <input type="hidden" name="_method" id="_method" value="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddEditLabel">Tambah/Ubah Data</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tindakan" class="form-label">Nama Layanan</label>
                            <input type="text" class="form-control" id="tindakan" name="tindakan" required>
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
        document.querySelectorAll('.btn-warning').forEach(btn => {
            btn.addEventListener('click', function() {
                const modal = document.getElementById('modalAddEdit');
                const form = document.getElementById('formAddEdit');
                const methodInput = document.getElementById('_method');

                // Ganti action dan metode
                form.action = '{{ route('tindakan.update', ':id') }}'.replace(':id', this.dataset.id);
                methodInput.value = 'PUT';

                // Isi data ke form
                modal.querySelector('#tindakan').value = this.dataset.tindakan;
                modal.querySelector('#biaya').value = this.dataset.biaya;
            });
        });
    </script>
@endpush
