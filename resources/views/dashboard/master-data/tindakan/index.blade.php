@extends('dashboard.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info mt-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 fw-bold">Data Layanan</h3>
                        <div>
                            <button class="btn btn-sm btn-light text-dark" data-toggle="modal" data-target="#modalAddEdit"
                                onclick="resetModal()">
                                <i class="fas fa-plus"></i> Tambah Data
                            </button>
                            <a href="#" class="btn btn-sm btn-warning ms-1" data-toggle="modal"
                                data-target="#modalImport">
                                <i class="fas fa-upload me-2"></i> Import Data
                            </a>
                            <a href="{{ route('tindakan.export') }}" class="btn btn-sm btn-success ms-1">
                                <i class="fas fa-file-excel me-2"></i> Export Excel
                            </a>

                        </div>
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
                                            <button class="btn btn-warning btn-sm btn-edit" data-toggle="modal"
                                                data-target="#modalAddEdit" data-id="{{ $tindakan->id }}"
                                                data-tindakan="{{ $tindakan->tindakan }}"
                                                data-biaya="{{ $tindakan->biaya }}">
                                                <i class="fas fa-edit"></i> Ubah
                                            </button>
                                            <form id="delete-form-{{ $tindakan->id }}" action="{{ route('tindakan.destroy', $tindakan->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $tindakan->id }}')">
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


    <!-- Modal Import Data -->
    <div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="modalImportLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('tindakan.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalImportLabel">Import Data Tindakan</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h2>PERHATIAN!</h2>
                                <h5 class="card-title">Silakan melakukan penyesuaian format data yang akan diupload menggunakan template yang sudah kami sediakan, anda bisa mendownload nya <a
                                        href=""><u > disini</u></a></h5>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file">Pilih File Excel</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file" id="file" accept=".xlsx,.xls,.csv" required>
                                    <label class="custom-file-label" for="file">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id=""><i class="fas fa-file-import"></i></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
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

                // // Show modal
                // $('#modalAddEdit').modal('show');
            });
        });

        // Reset form on modal close
        $('#modalAddEdit').on('hidden.bs.modal', function() {
            const form = document.getElementById('formAddEdit');
            form.reset(); // Clear form values
            form.action = '{{ route('tindakan.store') }}'; // Reset action to store
            document.getElementById('_method').value = 'POST'; // Reset method to POST
        });
    </script>
@endpush
