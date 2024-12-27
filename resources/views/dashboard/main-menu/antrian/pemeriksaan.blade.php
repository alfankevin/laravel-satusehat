@extends('dashboard.app')
@section('content')
    <div class="container-fluid">
        <div class="card mt-1 card-info">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Form Perawatan Pasien</h3>
                    <div>
                        <button id="btn-keluhan-ttv" class="btn btn-light text-dark btn-sm" onclick="showCard('keluhan-ttv')">
                            <i class="fas fa-stethoscope"></i> Tanda Vital
                        </button>
                        <button id="btn-assesment" class="btn btn-light text-dark btn-sm" onclick="showCard('assesment')">
                            <i class="fas fa-stethoscope"></i> SOAP
                        </button>
                        <button id="btn-pemeriksaan" class="btn btn-light text-dark btn-sm" onclick="showCard('pemeriksaan')">
                            <i class="fas fa-flask"></i> Laborat
                        </button>
                        <button id="btn-diagnosa" class="btn btn-light text-dark btn-sm" onclick="showCard('diagnosa')">
                            <i class="fas fa-medkit"></i> Diagnosa
                        </button>
                        <button id="btn-tindakan" class="btn btn-light text-dark btn-sm" onclick="showCard('tindakan')">
                            <i class="fas fa-plus-square"></i> Tindakan
                        </button>
                        <button id="btn-obat" class="btn btn-light text-dark btn-sm" onclick="showCard('obat')">
                            <i class="fas fa-capsules"></i> Obat
                        </button>
                        <button data-toggle="modal"
                        data-target="#modal-riwayat-medis-2" class="btn btn-danger btn-sm"><i class="fas fa-book  "></i> Riwayat Medis</button>
    
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-4">
                        <div class="card shadow-lg mb-4">
                            <div class="card-header">
                                <h5 class="card-title"><i class="fas fa-user me-2"></i> Data Pasien</h5>
                            </div>
                            <div class="card-body border">
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Nomor RM</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ substr(str_pad($pemeriksaan->pasien->nomorRm, 6, '0', STR_PAD_LEFT), 0, 2) . '-' . substr(str_pad($pemeriksaan->pasien->nomorRm, 6, '0', STR_PAD_LEFT), 2, 2) . '-' . substr(str_pad($pemeriksaan->pasien->nomorRm, 6, '0', STR_PAD_LEFT), 4, 2) }} 
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Nama Pasien</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pemeriksaan->pasien->nama }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Tanggal Lahir</b>
                                    </div>
                                    <div class="col-7">
                                        :
                                        {{ \Carbon\Carbon::parse($pemeriksaan->pasien->tglLahir)->locale('id')->translatedFormat('d F Y') }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Usia</b>
                                    </div>
                                    <div class="col-7">
                                        :
                                        {{ \Carbon\Carbon::parse($pemeriksaan->pasien->tglLahir)->diff(\Carbon\Carbon::now())->format('%y tahun') }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Poli</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pemeriksaan->poli->namaPoli }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Dokter</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pemeriksaan->practitioner->namaPractitioner }}
                                    </div>
                                </div>
                                <hr class="my-1">
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Tanggal Daftar</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ \Carbon\Carbon::parse($pemeriksaan->tglDaftar)->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($pemeriksaan->created_at)->format('H:i:s') }}
                                    </div>
                                </div>
                                <hr class="my-1">                 
                                <div class="row">
                                    <div class="col-5 ">
                                        <b>Alamat</b>
                                    </div>
                                    <div class="col-7">
                                        : {{ $pemeriksaan->pasien->alamat }}
                                    </div>
                                </div>
                                <hr class="my-1">
                            </div>
                        </div>
                    </div>

                    <div class="col-8">
                        {{-- KELUHAN TTV --}}
                        @include('dashboard.main-menu.antrian.tandavital')

                        {{-- Assesment --}}
                        @include('dashboard.main-menu.antrian.assesment')

                        {{-- Pemeriksaan --}}
                        @include('dashboard.main-menu.antrian.layanan')

                        {{-- Diagnosa --}}
                        @include('dashboard.main-menu.antrian.diagnosa')

                        {{-- Tindakan --}}
                        @include('dashboard.main-menu.antrian.tindakan')

                        {{--  Obat --}}
                        @include('dashboard.main-menu.antrian.obat')

                        
                    </div>
                </div>



            </div>
        </div>
    </div>


    {{-- riwayat medis 1--}}
    @include('dashboard.main-menu.antrian.modal.riwayat-medis')

    {{-- riwayat medis 2--}}
    @include('dashboard.main-menu.antrian.modal.riwayat-medis-2')

    <script>
        // Function to show only the specified card and hide the others
        function showCard(cardId) {
            const cardIds = ['keluhan-ttv','assesment', 'pemeriksaan', 'diagnosa', 'tindakan', 'obat'];
            const buttonIds = ['btn-keluhan-ttv','btn-assesment', 'btn-pemeriksaan', 'btn-diagnosa', 'btn-tindakan', 'btn-obat'];
            
            // Loop through all card IDs, displaying only the one with a matching cardId and hiding others
            cardIds.forEach((id, index) => {
                const card = document.getElementById(id);
                const button = document.getElementById(buttonIds[index]);
                
                if (id === cardId) {
                    card.style.display = 'block';
                    button.classList.add('btn-warning'); // Add red background
                    button.classList.remove('btn-light'); // Remove default background
                } else {
                    card.style.display = 'none';
                    button.classList.add('btn-light'); // Reset to default background
                    button.classList.remove('btn-warning'); // Remove red background
                }
            });
        }
    
        // Show only the initial card on page load
        document.addEventListener("DOMContentLoaded", function() {
            showCard('keluhan-ttv');
        });
    </script>
@endsection
