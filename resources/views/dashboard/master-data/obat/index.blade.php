@extends('dashboard.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card card-info mt-3">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 fw-bold">Data Obat</h3>
                        <div>
                            <button class="btn btn-sm btn-light text-dark" data-toggle="modal" data-target="#modalAddEdit">
                                <i class="fas fa-plus"></i> Tambah Data
                            </button>
                            <a href="" class="btn btn-sm btn-warning ms-1"><i class="fas fa-upload me-2"></i>Import
                                Data</a>
                            <a href="" class="btn btn-sm btn-success ms-1"><i
                                    class="fas fa-file-excel me-2"></i>Export Excel</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Obat</th>
                                <th>Satuan</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($obats as $obat)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $obat->nama_obat }}</td>
                                    <td>Strip</td>
                                    <td>{{ $obat->harga_beli }}</td>
                                    <td>{{ $obat->harga_jual }}</td>
                                    <td>{{ $obat->stok }}</td>
                                    <td>{{ $obat->status ? 'Aktif' : 'Non Aktif' }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modalAddEdit" data-id="{{ $obat->id }}"
                                            data-nama="{{ $obat->nama_obat }}" data-satuan="{{ $obat->satuan }}"
                                            data-harga-beli="{{ $obat->harga_beli }}"
                                            data-harga-jual="{{ $obat->harga_jual }}" data-stok="{{ $obat->stok }}"
                                            data-status="{{ $obat->status }}">
                                            <i class="fas fa-edit"></i> Ubah
                                        </button>

                                        <form id="delete-form-{{ $obat->id }}" action="{{ route('obat.destroy', $obat->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $obat->id }}')">
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
            <form id="formAddEdit" method="POST" action="{{ route('obat.store') }}">
                @csrf
                <input type="hidden" id="obat_id" name="id">
                <input type="hidden" name="_method" id="_method" value="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddEditLabel">Tambah/Ubah Data</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="obat_id">
                        <div class="mb-3">
                            <label for="nama_obat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="1">Aktif</option>
                                <option value="0">Non Aktif</option>
                            </select>
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
                form.action = '{{ route('obat.update', ':id') }}'.replace(':id', this.dataset.id);
                methodInput.value = 'PUT';

                // Isi data ke form
                modal.querySelector('#obat_id').value = this.dataset.id;
                modal.querySelector('#nama_obat').value = this.dataset.nama;
                modal.querySelector('#harga_beli').value = this.dataset.hargaBeli;
                modal.querySelector('#harga_jual').value = this.dataset.hargaJual;
                modal.querySelector('#stok').value = this.dataset.stok;
                modal.querySelector('#status').value = this.dataset.status;
            });
        });

    </script>
@endpush
