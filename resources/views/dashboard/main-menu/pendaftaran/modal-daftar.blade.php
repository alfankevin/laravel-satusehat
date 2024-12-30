<!-- Modal Tambah Kunjungan -->
<div class="modal fade" id="modalTambahKunjungan" tabindex="-1" aria-labelledby="modalTambahKunjunganLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h3 class="modal-title" id="modalTambahKunjunganLabel">Tambah Kunjungan</h3>
                <div>
                    <button class="btn btn-light text-dark" data-toggle="modal" data-target="#modalCariPasien">
                        <i class="fas fa-search"></i> Cari Pasien
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form action="{{ route('kunjungan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tkp_id" value="1">
                    <input type="hidden" name="status" value="0">
                    <input type="hidden" name="nomorrm" value="{{ $nomorRmBaru ?? '' }}">
                    <input type="hidden" name="noAntrian" value="A-02">
                    <input type="hidden" name="tglDaftar" value="{{ now()->format('Y-m-d') }}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="pasien_id_disabled">Nama Pasien (No. RM)</label>
                                <!-- Hanya untuk tampilan -->
                                <select class="form-control js-select2" id="pasien_id_disabled" disabled>
                                    <option value="">--Pilih Pasien--</option>
                                    @foreach ($pasiens as $pasien)
                                        <option value="{{ $pasien->id }}" {{ $pasien->id == $selectedPasienId ? 'selected' : '' }}>
                                            {{ $pasien->nama }} ({{ substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 0, 2) . '-' . substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 2, 2) . '-' . substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 4, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                                <!-- Input hidden untuk data -->
                                <input type="hidden" id="pasien_id" name="pasien_id" value="{{ $selectedPasienId }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kunjSakit">Kunjungan</label>
                                <select class="form-control" id="kunjSakit" name="kunjSakit" required>
                                    <option value="1">Kunjungan Sakit</option>
                                    <option value="2">Kunjungan Sehat</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="poli_id">Poli</label>
                                <select class="form-control js-select2" id="poli_id" name="poli_id" required>
                                    <option value="">--Pilih Poli--</option>
                                    @foreach ($polis as $poli)
                                        <option value="{{ $poli->id }}">{{ $poli->namaPoli }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="practitioner_id">Dokter</label>
                                <select class="form-control js-select2" id="practitioner_id" name="practitioner_id"
                                    required>
                                    <option value="">--Pilih Dokter--</option>
                                    @foreach ($practitioners as $practitioner)
                                        <option value="{{ $practitioner->id }}">{{ $practitioner->namaPractitioner }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cari Pasien -->
<div class="modal fade" id="modalCariPasien" tabindex="-1" aria-labelledby="modalCariPasienLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalCariPasienLabel">Data Pasien</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
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
                        @foreach ($pasiens as $pasien)
                            <tr>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-sm btn-info btn-pilih-pasien"
                                        data-id="{{ $pasien->id }}"
                                        data-nama="{{ substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 0, 2) . '-' . substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 2, 2) . '-' . substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 4, 2) }} - {{ $pasien->nama }}">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </td>
                                <td class="align-middle">{{ substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 0, 2) . '-' . substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 2, 2) . '-' . substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 4, 2) }}</td>
                                <td class="align-middle">{{ $pasien->nama }}</td>
                                <td class="align-middle">{{ $pasien->sex === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td class="align-middle">{{ $pasien->tglLahir }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Event handler untuk tombol "Pilih Pasien"
        document.querySelectorAll('.btn-pilih-pasien').forEach(button => {
            button.addEventListener('click', function() {
                const pasienId = this.getAttribute('data-id');
                const pasienNama = this.getAttribute('data-nama');

                // Isi input hidden pasien_id
                document.querySelector('#modalTambahKunjungan #pasien_id').value = pasienId;

                // Isi select untuk tampilan
                const pasienSelect = document.querySelector('#modalTambahKunjungan #pasien_id_disabled');
                pasienSelect.innerHTML = `<option>${pasienNama}</option>`;

                // Tutup modal Cari Pasien
                $('#modalCariPasien').modal('hide');

                // Tampilkan modal Tambah Kunjungan
                $('#modalTambahKunjungan').modal('show');
            });
        });
    });
</script>
@endpush





