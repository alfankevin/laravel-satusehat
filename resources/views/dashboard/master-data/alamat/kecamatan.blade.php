<div id="kecamatan" class="card mb-5">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center ">
            <h3 class="mb-0 fw-bold">Data Kecamatan</h3>
            <div>
                <a href="" class="btn btn-sm btn-primary "><i class="fas fa-plus"></i> Tambah Data</a>
                <a href="" class="btn btn-sm btn-warning  ms-1"><i class="fas fa-upload me-2"></i>Import Data</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="dataTableKecamatan" class="display nowrap table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Kode</th>
                    <th width="20%">Kecamatan</th>
                    <th width="45%">Kabupaten</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data Rows -->
                <tr>
                    <td>1</td>
                    <td>182</td>
                    <td>Kesamben</td>
                    <td>Jombang</td>
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
                    <td>183</td>
                    <td>Sumobito</td>
                    <td>Jombang</td>
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