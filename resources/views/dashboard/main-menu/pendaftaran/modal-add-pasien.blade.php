<div class="modal fade" id="modalTambahPasien" tabindex="-1" aria-labelledby="modalTambahPasienLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTambahPasienLabel">Tambah Pasien Baru</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahPasien" action="{{ route('pasien.store') }}" method="POST">
                    @csrf
                    <div class="mb-3 row" hidden>
                        <label for="nomorrm" class="col-sm-3 col-form-label fw-bold">Nomor RM</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nomorrm" name="nomorRm"
                                value="{{ $nomorRm }}">
                            <input type="hidden" class="form-control" id="pstProl" name="pstProl" value="1">
                            <input type="hidden" class="form-control" id="pstPrb" name="pstPrb" value="1">
                            <input type="hidden" class="form-control" id="aktif" name="aktif" value="1">
                            <input type="hidden" class="form-control" id="ketAktif" name="ketAktif" value="1">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-3 col-form-label fw-bold">Nama Pasien</label>
                        <div class="col-sm-2">
                            <select class="form-select form-control" id="sex" name="sex" required>
                                <option value="L">Tn.</option>
                                <option value="P">Ny.</option>
                            </select>
                        </div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="name" name="nama"
                                placeholder="Nama Pasien">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tempat" class="col-sm-3 col-form-label fw-bold">Tgl Lahir & Gol.
                            Darah</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="tglLahir" name="tglLahir">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <select class="js-select2" id="golongan_darah" name="golDarah" required>
                                        <option value="">--Pilih Golongan Darah--</option>
                                        <option value="Tidak Tahu">Tidak Tahu</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nik" class="col-sm-3 col-form-label fw-bold">NIK & No HP</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="nik" name="noKtp"
                                        placeholder="NIK">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="noHp" name="noHp"
                                        placeholder="No. HP">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nik" class="col-sm-3 col-form-label fw-bold">Jenis Peserta & No
                            Kartu</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-6">
                                    <select class="form-select form-control" id="jnsPeserta" name="jnsPeserta"
                                        required>
                                        <option value="">--Pilih Jenis Peserta--</option>
                                        <option value="1">JKN</option>
                                        <option value="2">Non JKN</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="noKartu" name="noKartu"
                                        placeholder="No Kartu" value="" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tempat" class="col-sm-3 col-form-label fw-bold">Alamat Lengkap</label>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        placeholder="Alamat Lengkap">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <select class="js-select2" id="kelurahan" name="KD_KELURAHAN" required>
                                        <option value="0">--Pilih Kelurahan--</option>
                                        @foreach ($kelurahans as $kelurahan)
                                            <option class="text-capitalize" value="{{ $kelurahan->KD_KELURAHAN }}">
                                                {{ ucwords(strtolower($kelurahan->KELURAHAN)) }} -
                                                {{ ucwords(strtolower($kelurahan->kecamatan->KECAMATAN)) }} -
                                                {{ ucwords(strtolower($kelurahan->kecamatan->kabupaten->KABUPATEN)) }}
                                                <!-- {{ ucwords(strtolower($kelurahan->kecamatan->kabupaten->provinsi->PROVINSI)) }} -->
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.getElementById('jnsPeserta').addEventListener('change', function() {
            var noKartuInput = document.getElementById('noKartu');

            if (this.value === '1') {
                // Jika JKN dipilih, input noKartu tidak readonly
                noKartuInput.readOnly = false;
                noKartuInput.placeholder = "Masukkan No Kartu";
            } else {
                // Jika Non JKN atau Belum Memilih, input noKartu readonly
                noKartuInput.readOnly = true;
                noKartuInput.placeholder = "Masukkan No Kartu";
                noKartuInput.value = ""; // Kosongkan nilai jika readonly
            }
        });
    </script>


    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {

            const form = document.getElementById('formTambahPasien');
            const formData = new FormData(form);

            // Persiapkan payload
            const payload = {
                nama: formData.get('nama'),
                noHp: formData.get('noHp'),
                noKtp: formData.get('noKtp'),
                tglLahir: formData.get('tglLahir'),
                alamat: formData.get('alamat'),
                sex: formData.get('sex'),
                email: 'john.doe@example.com',
                homePhone: '02112345678',
                contactName: 'Jane Doe',
                contactPhone: '08198765432'
            };

            console.log(payload);


            // Kirim data ke API Satusehat
            fetch('http://integrasi-satusehat.test/api/patient-store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify(payload),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Data pasien berhasil disimpan ke Satusehat.');
                        form.submit(); // Lanjutkan submit ke server lokal
                    } else {
                        alert('Gagal menyimpan data ke Satusehat.');
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan saat menyimpan data ke Satusehat.');
                    console.error(error);
                });
        });
    </script> --}}
@endpush
