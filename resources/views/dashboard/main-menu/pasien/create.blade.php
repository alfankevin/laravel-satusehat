@extends('dashboard.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Form Pendaftaran Pasien</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="mb-3 row">
                    <label for="nomorrm" class="col-sm-3 col-form-label fw-bold">Nomor RM</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nomorrm" value="0000001" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-3 col-form-label fw-bold">Nama Pasien</label>
                    <div class="col-sm-2">
                        <select class="form-select" id="sex" name="sex" required>
                            <option value="Laki-laki">Tn.</option>
                            <option value="Perempuan">Ny.</option>
                        </select>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="name" placeholder="Nama Pasien">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tempat" class="col-sm-3 col-form-label fw-bold">Tempat, Tgl Lahir</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="tempat" placeholder="Tempat Lahir">
                    </div>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" id="tglLahir">
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" id="umur" value="27 Tahun" disabled>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nik" class="col-sm-3 col-form-label fw-bold">NIK & No HP</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nik" placeholder="NIK">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="noKartu" placeholder="No. HP">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="nik" class="col-sm-3 col-form-label fw-bold">No Kartu & Jenis Peserta</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="nik" placeholder="No Kartu">
                            </div>
                            <div class="col-sm-6">
                                <select class="form-select" id="golongan_darah" name="golongan_darah" required>
                                    <option value="">--Pilih Jenis Peserta--</option>
                                    <option value="1">JKN</option>
                                    <option value="2">Non JKN</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="golongan_darah" class="col-sm-3 col-form-label fw-bold">Golongan Darah</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="golongan_darah" name="golongan_darah" required>
                            <option value="Pribadi">A</option>
                            <option value="Pribadi">C</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tempat" class="col-sm-3 col-form-label fw-bold">Alamat Lengkap</label>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <select class="form-select" id="kelurahan" name="kelurahan" required>
                                    <option value="">--Pilih Kelurahan--</option>
                                    <option value="Pribadi">A</option>
                                    <option value="Pribadi">C</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <select class="form-select" id="kecamatan" name="kecamatan" required>
                                    <option value="">--Pilih Kecamatan--</option>
                                    <option value="Pribadi">A</option>
                                    <option value="Pribadi">C</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-select" id="kabupaten" name="kabupaten" required>
                                    <option value="">--Pilih Kabupaten--</option>
                                    <option value="Pribadi">A</option>
                                    <option value="Pribadi">C</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select class="form-select" id="provinsi" name="provinsi" required>
                                    <option value="">--Pilih Provinsi--</option>
                                    <option value="Pribadi">A</option>
                                    <option value="Pribadi">C</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
