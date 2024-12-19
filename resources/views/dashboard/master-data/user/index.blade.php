@extends('dashboard.app')
@section('content')
  <div class="content">
    <div class="container-fluid">
        <div class="card card-info mt-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center ">
                    <h3 class="mb-0 fw-bold">Data Pengguna</h3>
                    <div>
                        <a href="" class="btn btn-sm btn-light text-dark "><i class="fas fa-plus"></i> Tambah Data</a>
                        <a href="" class="btn btn-sm btn-warning  ms-1"><i class="fas fa-upload me-2"></i>Import Data</a>
                        <a href="" class="btn btn-sm btn-success  ms-1"><i class="fas fa-file-excel me-2"></i>Export Excel</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="display nowrap table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th width="20%">Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th width="30%">Active</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>Agus</td>
                                <td>agus@gmail.com</td>
                                <td>Admin</td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-info btn-sm"><i class="fas fa-lock mx-1"></i>Hak Aakses</a>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                                    <form action="" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin untuk menghapus tindakan ini?')">
                                            <i class="fas fa-trash mx-1"></i>Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
    
            </div>
        </div>
       </div>
  </div>
@endsection
