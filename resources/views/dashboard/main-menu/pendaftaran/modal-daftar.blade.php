<!-- Modal Tambah Kunjungan -->
<div class="modal fade" id="modalTambahKunjungan" tabindex="-1" aria-labelledby="modalTambahKunjunganLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTambahKunjunganLabel">Tambah Kunjungan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                                <label for="pasien_id">Nama Pasien</label>
                                <select class="js-select2" id="pasien_id" name="pasien_id" required>
                                    <option value="">--Pilih Pasien--</option>
                                    @foreach ($pasiens as $pasien)
                                        <option value="{{ $pasien->id }}"
                                            {{ isset($pasienBaru) && $pasien->id == $pasienBaru->id ? 'selected' : '' }}>
                                            {{ $pasien->nama }} - {{ $pasien->nomorRm }} - {{ $pasien->noKtp }}
                                        </option>
                                    @endforeach
                                </select>
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
                                <select class="js-select2" id="poli_id" name="poli_id" required>
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
                                <select class="js-select2" id="practitioner_id" name="practitioner_id" required>
                                    <option value="">--Pilih Dokter--</option>
                                    @foreach ($practitioners as $practitioner)
                                        <option value="{{ $practitioner->id }}">
                                            {{ $practitioner->namaPractitioner }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
