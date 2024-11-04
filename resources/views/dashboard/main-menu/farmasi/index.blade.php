@extends('dashboard.app')
@section('content')
    <!-- Section untuk Tabel Data Antrian -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-start">
                <h3 class="mb-0 fw-bold">Data Farmasi</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="display nowrap table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">Antrian</th>
                            <th>No Reg/Resep</th>
                            <th>Tgl Periksa</th>
                            <th>Nama Pasien</th>
                            <th>No RM</th>
                            <th>Status Obat</th>
                            <th>Panggil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Dummy -->
                        <tr>
                            <td class="text-center align-middle">A-01</td>
                            <td class="align-middle">REG/20230116/002</td>
                            <td class="align-middle">2023-01-16</td>
                            <td class="align-middle">Agus Susanto, Tn</td>
                            <td class="align-middle">000005</td>
                            <td class="align-middle"><span class="badge bg-warning text-dark">Belum dilayani</span></td>
                            <td class="align-middle">
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-megaphone-fill"></i> Panggil
                                </button>
                            </td>
                            <td class="align-middle"><button class="btn btn-primary btn-sm"><i class="bi bi-eye-fill"></i> Detail</button></td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">A-02</td>
                            <td class="align-middle">REG/20230116/001</td>
                            <td class="align-middle">2023-01-16</td>
                            <td class="align-middle">Sampurna, Tn</td>
                            <td class="align-middle">000006</td>
                            <td class="align-middle"><span class="badge bg-warning text-dark">Belum dilayani</span></td>
                            <td class="align-middle">
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-megaphone-fill"></i> Panggil
                                </button>
                            </td>
                            <td class="align-middle"><button class="btn btn-primary btn-sm"><i class="bi bi-eye-fill"></i> Detail</button></td>
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
