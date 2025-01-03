@extends('dashboard.app')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <h3 class="page-title pt-3">Master Data</h3>
            <div class="card mt-3 card-info">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Data Pasien</h3>
                        <div>
                            {{-- sinkronisasi semua data pasien --}}
                            <a href="javascript:void(0);" class="btn btn-sm btn-light text-dark ms-1 sync-all-btn">
                                <i class="fas fa-sync-alt mx-1"></i> Sinkronisasi Satusehat
                            </a>

                            <a href="{{ route('pasien.create') }}" class="btn btn-light text-dark btn-sm"><i
                                    class="fas fa-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div id="sync-alert" class="alert alert-warning alert-dismissible d-none">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-info"></i> Info!</h5>
                        Proses Sinkronisasi Satusehat sedang berjalan. Mohon tunggu hingga selesai.
                    </div>

                    <table id="dataTable" class="table-responsive display nowrap table table-striped table-bordered"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama & Nomor RM</th>
                                <th>T.Lahir Sex</th>
                                <th>Usia</th>
                                <th>NIK & No Kartu</th>
                                <th class="text-start">No HP</th>
                                <th>Alamat</th>
                                <th>Kelurahan</th>
                                <th>Kecamatan</th>
                                <th>Kabupaten</th>
                                <th>Provinsi</th>
                                <th>Id Satusehat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasiens as $key => $pasien)
                                <tr>
                                    <td class="text-center align-middle">{{ $key + 1 }}</td>
                                    <td class="align-middle">{{ $pasien->id }}</td>
                                    <td class="align-middle">{{ $pasien->nama }} <br>
                                        {{ substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 0, 2) . '-' . substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 2, 2) . '-' . substr(str_pad($pasien->nomorRm, 6, '0', STR_PAD_LEFT), 4, 2) }}
                                    </td>
                                    <td class="align-middle">
                                        <span
                                            class="text-nowrap">{{ \Carbon\Carbon::parse($pasien->tglLahir)->format('d-m-Y') }}</span><br>
                                        {{ $pasien->sex === 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </td>
                                    <td class="align-middle">
                                        @php
                                            $usia = \Carbon\Carbon::parse($pasien->tglLahir);
                                        @endphp
                                        <span
                                            class="text-nowrap">{{ $usia->diff(\Carbon\Carbon::now())->format('%y tahun,') }}</span>
                                        <span
                                            class="text-nowrap">{{ $usia->diff(\Carbon\Carbon::now())->format('%m bulan,') }}</span>
                                        <span
                                            class="text-nowrap">{{ $usia->diff(\Carbon\Carbon::now())->format('%d hari') }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-nowrap">NIK: {{ $pasien->noKtp }}</span><br>
                                        <span class="text-nowrap">No Kartu: {{ $pasien->noKartu }}</span>
                                    </td>
                                    <td class="text-start align-middle">{{ $pasien->noHp }}</td>
                                    <td class="align-middle">{{ $pasien->alamat }}</td>
                                    <td class="align-middle text-capitalize">
                                        {{ ucfirst(strtolower($pasien->kelurahan->KELURAHAN ?? 'Data kosong')) }}</td>
                                    <td class="align-middle text-capitalize">
                                        {{ $pasien->kelurahan->kecamatan->KECAMATAN ?? 'Data kosong' }}</td>
                                    <td class="align-middle text-capitalize">
                                        {{ $pasien->kelurahan->kecamatan->kabupaten->KABUPATEN ?? 'Data kosong' }}</td>
                                    <td class="align-middle text-capitalize">
                                        {{ $pasien->kelurahan->kecamatan->kabupaten->provinsi->PROVINSI ?? 'Data kosong' }}
                                    </td>
                                    <td class="align-middle text-capitalize">{{ $pasien->satusehat_id ?? '' }}</td>
                                    <td class="text-center align-middle text-nowrap">
                                        {{-- sinkronisasi satu data pasien --}}
                                        <button type="button" class="btn btn-info btn-sm sync-btn"
                                            data-nik="{{ $pasien->noKtp }}">
                                            <i class="fas fa-sync-alt mx-1"></i> Sinkronisasi Satusehat
                                        </button>

                                        <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form id="delete-form-{{ $pasien->id }}"
                                            action="{{ route('pasien.destroy', $pasien->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete('{{ $pasien->id }}')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sinkronisasi satu pasien
            const syncButtons = document.querySelectorAll(".sync-btn");
            const syncAlert = document.getElementById("sync-alert");

            // Fungsi untuk menampilkan alert
            function showAlert() {
                syncAlert.classList.remove("d-none");
            }

            // Fungsi untuk menyembunyikan alert
            function hideAlert() {
                syncAlert.classList.add("d-none");
            }

            syncButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const nik = this.getAttribute("data-nik");
                    syncSinglePatient(nik);
                });
            });

            // Sinkronisasi semua pasien
            const syncAllButton = document.querySelector(".sync-all-btn");
            if (syncAllButton) {
                syncAllButton.addEventListener("click", function() {
                    if (confirm("Apakah Anda yakin ingin menyinkronkan semua data pasien?")) {
                        // Tampilkan alert saat sinkronisasi dimulai
                        showAlert();

                        fetch('/sync-all-satusehat', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Sembunyikan alert setelah sinkronisasi selesai
                                hideAlert();

                                if (data.success) {
                                    alert(data.message);
                                    location.reload();
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Gagal melakukan sinkronisasi.');
                            });
                    }
                });
            }

            // Fungsi sinkronisasi pasien tunggal
            function syncSinglePatient(nik) {
                alert(`Sinkronisasi ke Satusehat untuk NIK: ${nik}`);
                fetch('/sync-satusehat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            nik: nik
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal melakukan sinkronisasi.');
                    });
            }
        });
    </script>
@endpush
