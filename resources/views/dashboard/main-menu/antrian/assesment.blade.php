<div id="assesment" class="card">
    <div class="card-header">
        <h5 class="card-title">SOAP</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('soap.store') }}" method="POST">
            @csrf
            <div class="row ">
                <div class="col-sm-6 ">
                    <div class="form-group">
                        <label>Subjectif</label>
                        <input type="hidden" name="id" value="{{ $pemeriksaan->id }}">
                        <textarea class="form-control" rows="2" name="subyektif" placeholder="Masukkan data subjectif pasien ...">{{ $pemeriksaan->subyektif }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Objectif</label>
                        <textarea class="form-control" rows="2" name="obyektif" placeholder="Masukkan data objectif pasien ...">{{ $pemeriksaan->obyektif }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Assesment</label>
                        <textarea class="form-control" rows="2" name="assesment" placeholder="Masukkan data assesment pasien ...">{{ $pemeriksaan->assesment }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Plan</label>
                        <textarea class="form-control" rows="2" name="plan" placeholder="Masukkan rencana pengobatan ...">{{ $pemeriksaan->plan }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Instruksi</label>
                        <textarea class="form-control" rows="2" name="instruksi" placeholder="Enter ...">{{ $pemeriksaan->instruksi }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Evaluasi</label>
                        <textarea class="form-control" rows="2" name="evaluasi" placeholder="Enter ...">{{ $pemeriksaan->evaluasi }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Status Pulang</label>
                        <select class="form-control" name="" required>
                            <option value="1">Rawat Jalan</option>
                            {{-- <option value="0" {{ $pemeriksaan->status == 0 ? 'selected' : '' }}>Belum Diperiksa</option> --}}
                        </select>
                    </div>
                </div>
                <input type="hidden" name="end_inProgress" value="{{ now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s') }}">
                <div class="col-sm-6 mt-4">
                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary form-control mt-2">Simpan</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
