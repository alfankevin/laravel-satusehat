@extends('dashboard.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center ">
                <h3 class="mb-0 fw-bold">Data Tindakan</h3>
                <div>
                    <a href="" class="btn btn-sm btn-primary "><i class="fas fa-plus"></i> Tambah Data</a>
                    <a href="" class="btn btn-sm btn-warning  ms-1"><i class="fas fa-upload me-2"></i>Import Data</a>
                    <a href="" class="btn btn-sm btn-success  ms-1"><i class="fas fa-file-excel me-2"></i>Export Excel</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Tindakan</th>
                            <th>Tarif Tindakan</th>
                            <th>Fee Dokter</th>
                            <th>Fee Asisten</th>
                            <th>Fee Klinik</th>
                            <th>Poliklinik</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nebulizer (Inhalasi)</td>
                            <td>75000</td>
                            <td>75000</td>
                            <td>0</td>
                            <td>0</td>
                            <td>Poli Umum</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin untuk menghapus tindakan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Imunisasi Tetanus</td>
                            <td>100000</td>
                            <td>80000</td>
                            <td>10000</td>
                            <td>10000</td>
                            <td>Poli Umum</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin untuk menghapus tindakan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Hecting</td>
                            <td>100000</td>
                            <td>70000</td>
                            <td>3000</td>
                            <td>27000</td>
                            <td>Poli Umum</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin untuk menghapus tindakan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
