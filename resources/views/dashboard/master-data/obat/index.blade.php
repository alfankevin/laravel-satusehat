@extends('dashboard.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center ">
                <h3 class="mb-0 fw-bold">Data Obat</h3>
                <div>
                    <a href="" class="btn btn-sm btn-primary "><i class="fas fa-plus"></i> Tambah Data</a>
                    <a href="" class="btn btn-sm btn-warning  ms-1"><i class="fas fa-upload me-2"></i>Import Data</a>
                    <a href="" class="btn btn-sm btn-success  ms-1"><i class="fas fa-file-excel me-2"></i>Export Excel</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
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
                    <!-- Data Rows -->
                    <tr>
                        <td>1</td>
                        <td>Paramex</td>
                        <td>Strip</td>
                        <td>Rp. 2,000</td>
                        <td>Rp. 2,500</td>
                        <td>16</td>
                        <td>Aktif</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                            <form action="" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin untuk menghapus obat ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Panadol</td>
                        <td>Strip</td>
                        <td>Rp. 2,000</td>
                        <td>Rp. 2,500</td>
                        <td>16</td>
                        <td>Aktif</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                            <form action="" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin untuk menghapus obat ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Amoxilin</td>
                        <td>Strip</td>
                        <td>Rp. 2,000</td>
                        <td>Rp. 2,500</td>
                        <td>16</td>
                        <td>Aktif</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                            <form action="" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin untuk menghapus obat ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

  
@endsection
