@extends('dashboard.app')
@section('content')
    <!-- Section untuk Kotak Informasi Antrian -->
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="card-title">Antrian Sekarang</h5>
                            <h3 class="card-text" style="font-weight: 800">A-02</h3>
                        </div>
                        <div class="col-4 text-end">
                            <i class="fas fa-stethoscope fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="card-title">Antrian Selanjutnya</h5>
                            <h3 class="card-text" style="font-weight: 800">A-03</h3>
                        </div>
                        <div class="col-4 text-end">
                            <i class="fas fa-user-plus fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h5 class="card-title">Sisa Antrian</h5>
                            <h3 class="card-text" style="font-weight: 800">1</h3>
                        </div>
                        <div class="col-4 text-end">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Section untuk Tabel Data Antrian -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0 fw-bold">Data Antrian Pemeriksaan</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>No Antrian</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Assesment</th>
                            <th>Panggil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Dummy -->
                        <tr>
                            <td class="text-center align-middle">1</td>
                            <td  class="align-middle">A 02</td>
                            <td  class="align-middle">Mr. Candido Kautzer DDS</td>
                            <td  class="align-middle">07-10-2024</td>
                            <td  class="align-middle">12:03</td>
                            <td  class="align-middle"><span class="badge bg-info">Sedang Diperiksa</span></td>
                            <td  class="align-middle"><button class="btn btn-primary btn-sm"> <i class="fas fa-stethoscope"></i> Periksa (O)</button>
                            </td>
                            <td  class="align-middle">
                                <!-- Tombol Panggil -->
                                <button class="btn btn-danger btn-panggil btn-sm" data-nomor="A 02">
                                    <i class="bi bi-megaphone-fill"></i> Panggil
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">2</td>
                            <td class="align-middle">A 03</td>
                            <td class="align-middle">Budi Santoso</td>
                            <td class="align-middle">07-10-2024</td>
                            <td class="align-middle">12:30</td>
                            <td class="align-middle"><span class="badge bg-danger">Belum Diperiksa</span></td>
                            <td class="align-middle"><a href="{{ route('antrian.pemeriksaan') }}" class="btn btn-primary btn-sm"> <i class="fas fa-stethoscope"></i> Periksa (S)</a>
                            </td>
                            <td class="align-middle">
                                <!-- Tombol Panggil -->
                                <button class="btn btn-danger btn-panggil btn-sm" data-nomor="A 02">
                                    <i class="bi bi-megaphone-fill"></i> Panggil
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Audio Bell -->
    <audio id="tingtung" src="{{ asset('audio/tingtung.mp3') }}"></audio>

    <!-- ResponsiveVoice Script -->
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=jQZ2zcdq"></script>

    <!-- Script Panggil -->
    <script>
        // Ketika tombol "Panggil" diklik
        document.querySelectorAll('.btn-panggil').forEach(function(button) {
            button.addEventListener('click', function() {
                var bell = document.getElementById('tingtung');
                var nomorAntrian = this.getAttribute('data-nomor');
                var message = "Nomor Antrian, " + nomorAntrian + ", harap menuju ke ruang periksa.";
                var currentButton = this;

                // Memutar suara bel
                bell.play();

                // Menggunakan 'ended' event listener untuk menunggu bel selesai diputar
                bell.onended = function() {
                    // Memanggil nomor pasien setelah bel selesai
                    if (responsiveVoice) {
                        responsiveVoice.speak(message, "Indonesian Female", {
                            onend: function() {
                                // Setelah suara pemanggilan selesai, ubah tombol menjadi secondary
                                currentButton.classList.remove('btn-info');
                                currentButton.classList.add('btn-secondary');
                                currentButton.disabled =
                                    true; // Opsional: Nonaktifkan tombol setelah dipanggil
                            }
                        });
                    } else {
                        alert("Fitur suara tidak tersedia.");
                    }
                };

                // Memanggil bel setelah nomor pasien selesai dipanggil
            });
        });
    </script>
@endsection
