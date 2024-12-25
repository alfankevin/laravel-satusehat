<div class="modal fade" id="modal-pasien">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Data Pasien</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="dataTable" class=" display nowrap table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Pilih</th>
                            <th>Nomor RM</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pasiens as $key => $pasien)
                            <tr>
                                <td class="text-center align-middle">
                                    <form action="{{ route('rekam-medis.index') }}" method="GET">
                                        <input type="hidden" name="pasien_id" value="{{ $pasien->id }}">
                                        <button type="submit" class="btn btn-sm btn-info">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                </td>

                                <td class="align-middle">
                                    {{ substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 0, 2) . '-' . substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 2, 2) . '-' . substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 4, 2) }}
                                </td>
                                <td class="align-middle">{{ $pasien->nama }}</td>
                                <td class="align-middle">{{ $pasien->sex === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td class="align-middle">{{ $pasien->tglLahir }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>