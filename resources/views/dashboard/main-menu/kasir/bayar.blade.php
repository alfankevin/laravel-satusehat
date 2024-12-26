@extends('dashboard.app')
@section('content')
    <div class="container-fluid">
        <div class="card mt-1 card-info">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Pembayaran</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        @if ($pendaftarans->obat->count() > 0)
                            @include('dashboard.main-menu.kasir.section.obat')
                        @endif

                        @if ($pendaftarans->tindakan->count() > 0)
                            @include('dashboard.main-menu.kasir.section.tindakan')
                        @endif

                        @if ($pendaftarans->laborat->count() > 0)
                            @include('dashboard.main-menu.kasir.section.laborat')                            
                        @endif

                    </div>

                    <div class="col-4">
                        {{-- Data Pasien --}}
                        <div class="card shadow-lg mb-4">
                            <div class="card-header">
                                <h5 class="card-title"><i class="fas fa-user me-2"></i> Data Pasien</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body border">
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Nomor RM</b>
                                    </div>
                                    <div class="col-7">
                                        :
                                        {{ substr(str_pad($pendaftarans->pasien->nomorRm, 6, '0', STR_PAD_LEFT), 0, 2) . '-' . substr(str_pad($pendaftarans->pasien->nomorRm, 6, '0', STR_PAD_LEFT), 2, 2) . '-' . substr(str_pad($pendaftarans->pasien->nomorRm, 6, '0', STR_PAD_LEFT), 4, 2) }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Nama Pasien</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pendaftarans->pasien->nama }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Tanggal Lahir</b>
                                    </div>
                                    <div class="col-7">
                                        :
                                        {{ \Carbon\Carbon::parse($pendaftarans->pasien->tglLahir)->locale('id')->translatedFormat('d F Y') }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Usia</b>
                                    </div>
                                    <div class="col-7">
                                        :
                                        {{ \Carbon\Carbon::parse($pendaftarans->pasien->tglLahir)->diff(\Carbon\Carbon::now())->format('%y tahun') }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Poli</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pendaftarans->poli->namaPoli }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Dokter</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pendaftarans->practitioner->namaPractitioner }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Tanggal Daftar</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ \Carbon\Carbon::parse($pendaftarans->tglDaftar)->format('d-m-Y') }} -
                                        {{ \Carbon\Carbon::parse($pendaftarans->created_at)->format('H:i:s') }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Alamat</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pendaftarans->pasien->alamat }}
                                    </div>
                                </div>
                                <hr class="my-1">
                            </div>
                        </div>

                        {{-- bayar --}}
                        <div class="card shadow-lg mb-4">
                            <div class="card-header">
                                <h5 class="card-title"><i class="fas fa-th-list mx-2"></i>Rincian Tagihan</h5>
                            </div>
                            <div class="card-body border">
                                <hr class="my-1">
                                <!-- Subtotal -->
                                <div class="row">
                                    <div class="col-6">
                                        <b>Subtotal :</b>
                                    </div>
                                    @php
                                        $totalFeeObat = $totalFeeObat ?? 0;
                                        $totalFeeTindakan = $totalFeeTindakan ?? 0;
                                        $totalFeeLaborat = $totalFeeLaborat ?? 0;
                                        $subtotalTagihan = $totalFeeObat + $totalFeeTindakan + $totalFeeLaborat;
                                    @endphp
                                    <div class="col-6 d-flex justify-content-end">
                                        Rp {{ number_format($subtotalTagihan, 0, ',', '.') }}
                                    </div>
                                </div>

                                <hr class="my-1">
                                <!-- Diskon -->
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <b>Diskon</b>
                                    </div>
                                    <div class="col-6">
                                        <input type="number" id="diskon" class="form-control"
                                            placeholder="Masukkan diskon">
                                    </div>
                                    <div class="col-3 d-flex justify-content-end" id="diskonDisplay">
                                        Rp 0
                                    </div>
                                </div>

                                <hr class="my-1">
                                <!-- Total Tagihan -->
                                <div class="row">
                                    <div class="col-6">
                                        <b>Total Tagihan:</b>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end" id="totalTagihanDisplay">
                                        Rp {{ number_format($subtotalTagihan, 0, ',', '.') }}
                                    </div>
                                </div>

                                <hr class="mt-1 mb-3">
                                <!-- Sistem Pembayaran -->
                                <div class="p-3" style="background-color: #f5b8b8">
                                    <form action="">
                                        <!-- Input Jumlah Bayar -->
                                        <div class="form-group mb-2">
                                            <label>Jumlah Bayar</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="number" id="jumlahBayar" name="jumlah_bayar"
                                                    class="form-control" placeholder="Masukkan jumlah bayar">
                                            </div>
                                        </div>

                                        <!-- Input Kembalian -->
                                        <div class="form-group mb-3">
                                            <label>Kembalian</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp</div>
                                                </div>
                                                <input type="number" readonly id="kembalian" name="kembalian"
                                                    class="form-control" value="0">
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-info form-control">Bayar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subtotalTagihan = {{ $subtotalTagihan }};
            const diskonInput = document.getElementById('diskon');
            const jumlahBayarInput = document.getElementById('jumlahBayar');
            const totalTagihanDisplay = document.getElementById('totalTagihanDisplay');
            const diskonDisplay = document.getElementById('diskonDisplay');
            const kembalianInput = document.getElementById('kembalian');

            diskonInput.addEventListener('input', function() {
                const diskon = parseFloat(this.value) || 0;
                const totalTagihan = subtotalTagihan - diskon;
                diskonDisplay.textContent = `Rp ${diskon.toLocaleString('id-ID')}`;
                totalTagihanDisplay.textContent = `Rp ${totalTagihan.toLocaleString('id-ID')}`;
            });

            jumlahBayarInput.addEventListener('input', function() {
                const jumlahBayar = parseFloat(this.value) || 0;
                const diskon = parseFloat(diskonInput.value) || 0;
                const totalTagihan = subtotalTagihan - diskon;
                const kembalian = jumlahBayar - totalTagihan;
                kembalianInput.value = kembalian > 0 ? kembalian : 0;
            });
        });
    </script>
@endpush
