@extends('dashboard.app')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Form Kunjungan Pasien</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('kunjungan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="tkp_id" value="1">
            <input type="hidden" name="noAntrian" value="1">
            <input type="hidden" name="status" value="1">
            <div class="mb-3 row">
                <label for="nomorrm" class="col-sm-3 col-form-label fw-bold">Nomor Antrian</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="nomorrm" value="A-01" disabled>
                </div>
                <div class="col-sm-4">
                    <select class="form-select" id="kunSakit" name="kunjSakit" required>
                        <option value="1">Kunjungan Sakit.</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-sm-3 col-form-label fw-bold">Nama Pasien</label>
                <div class="col-sm-5">
                    <select class="form-select select2" id="name" name="pasien_id" required>
                        <option value="0">--Pilih Pasien--</option>
                        @foreach ($pasiens as $pasien)
                        <option value="{{ $pasien->id }}">{{ $pasien->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="nomorrm" value="000006" disabled>
                </div>
            </div>
            <!-- <div class="mb-3 row">
                <label for="tempat" class="col-sm-3 col-form-label fw-bold">Tanggal & Jam Kunjungan</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" id="tglKun" name="tglDaftar">
                </div>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="tglKun">
                </div>
            </div> -->

            <div class="mb-3 row">
                <label for="tempat" class="col-sm-3 col-form-label fw-bold">Poli & Dokter</label>
                <div class="col-sm-5">
                    <select class="form-select select2" id="name" name="poli_id" required>
                        <option value="">--Pilih Poli--</option>
                        @foreach ($polis as $poli)
                        <option value="{{ $poli->id }}">{{ $poli->namaPoli }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <select class="form-select select2" id="name" name="practitioner_id" required>
                        <option value="">--Pilih Dokter--</option>
                        @foreach ($practitioners as $practitioner)
                        <option value="{{ $practitioner->id }}">{{ $practitioner->namaPractitioner }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('kunjungan.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection