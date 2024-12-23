@extends('dashboard.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h5 class="card-title">Antrian Sekarang</h5>
                                    @if ($antrian_sekarang)
                                        <h3 class="card-text" style="font-weight: 800">{{ $antrian_sekarang }}</h3>
                                    @else
                                        <h3 class="card-text" style="font-weight: 800">-</h3>
                                    @endif
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
                                    @if ($antrian_selanjutnya)
                                        <h3 class="card-text" style="font-weight: 800">{{ $antrian_selanjutnya }}</h3>
                                    @else
                                        <h3 class="card-text" style="font-weight: 800">-</h3>
                                    @endif
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
                                    <h3 class="card-text" style="font-weight: 800">{{ $pendaftarans->count() }}</h3>
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
            <div class="card card-info">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Data Antrian Pemeriksaan</h3>
                        <div>
                            @php
                                use Carbon\Carbon;
    
                                // Mengatur zona waktu ke WIB
                                $now = Carbon::now('Asia/Jakarta');
    
                                // Mengatur locale untuk bahasa Indonesia
                                Carbon::setLocale('id');
                            @endphp
                            <i class="fas fa-calendar"></i> {{ $now->translatedFormat('l d - F Y H:i:s') }}
    
    
                        </div>
                    </div>
                </div>
                <div class="card-body" style="overflow-x: hidden;">
                    <table id="dataTablePemeriksaan" class="display nowrap  table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>No Antrian</th>
                                <th>Nama Pasien</th>
                                <th>Nomor RM</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Status</th>
                                <th>Periksa</th>
                                <th>Panggil</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendaftarans as $key => $pendaftaran)
                                <tr>
                                    <td class="text-center align-middle">{{ $key + 1 }}</td>
                                    <td class="align-middle">{{ $pendaftaran->noAntrian }}</td>
                                    <td class="align-middle">{{ $pendaftaran->pasien->nama }}</td>
                                    <td class="align-middle">{{ substr(str_pad($pendaftaran->pasien->nomorRm, 6, '0', STR_PAD_LEFT), 0, 2) . '-' . substr(str_pad($pendaftaran->pasien->nomorRm, 6, '0', STR_PAD_LEFT), 2, 2) . '-' . substr(str_pad($pendaftaran->pasien->nomorRm, 6, '0', STR_PAD_LEFT), 4, 2) }} </td>
                                    <td class="align-middle">
                                        {{ \Carbon\Carbon::parse($pendaftaran->tglDaftar)->format('d-m-Y') }}</td>
                                    <td class="align-middle">
                                        {{ \Carbon\Carbon::parse($pendaftaran->created_at)->timezone('Asia/Jakarta') }}
                                    </td>
                                    <td class="align-middle">
                                        @if ($pendaftaran->status == 1)
                                            <span class="badge bg-success"><i class="fas fa-stethoscope"></i> Sudah
                                                Diperiksa</span>
                                        @elseif ($pendaftaran->status == 0)
                                            <span class="badge bg-danger"><i class="fas fa-stethoscope"></i> Belum
                                                Diperiksa</span>
                                        @endif
                                    </td>
                                    <td class="align-middle"><a href="{{ route('antrian.pemeriksaan', $pendaftaran->id) }}"
                                            class="btn btn-primary btn-sm"> <i class="fas fa-stethoscope"></i> Periksa</a>
                                    </td>
                                    <td class="align-middle">
                                        <!-- Tombol Panggil -->
                                        <button class="btn btn-danger btn-panggil btn-sm"
                                            data-nomor="{{ $pendaftaran->noAntrian }}">
                                            <i class="fas fa-bullhorn"></i> Panggil
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Section untuk Kotak Informasi Antrian -->




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
