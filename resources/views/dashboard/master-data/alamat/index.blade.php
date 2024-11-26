@extends('dashboard.app')
@section('content')
    <div class="container-fluid">
        <div class="card my-3">
            <div class="card-body">
                <div class="justify-content-start align-items-center">
                    <a href="#" id="btn-kelurahan" class="btn btn-sm btn-primary">Kelurahan</a>
                    <a href="#" id="btn-kecamatan" class="btn btn-sm btn-primary ms-1">Kecamatan</a>
                    <a href="#" id="btn-kabupaten" class="btn btn-sm btn-primary ms-1">Kabupaten</a>
                    <a href="#" id="btn-provinsi" class="btn btn-sm btn-primary ms-1">Provinsi</a>
                </div>
            </div>
        </div>
    
    
        @include('dashboard.master-data.alamat.kelurahan')
    
        @include('dashboard.master-data.alamat.kecamatan')
    
        @include('dashboard.master-data.alamat.kabupaten')
    
        @include('dashboard.master-data.alamat.provinsi')
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk menampilkan card berdasarkan ID
            function showCard(cardId) {
                // Sembunyikan semua card
                document.querySelectorAll('.card.mb-5').forEach(card => card.style.display = 'none');
                // Tampilkan card yang dipilih
                document.getElementById(cardId).style.display = 'block';
            }

            // Event listener untuk tombol
            document.getElementById('btn-kelurahan').addEventListener('click', function(e) {
                e.preventDefault();
                showCard('kelurahan');
            });
            document.getElementById('btn-kecamatan').addEventListener('click', function(e) {
                e.preventDefault();
                showCard('kecamatan');
            });
            document.getElementById('btn-kabupaten').addEventListener('click', function(e) {
                e.preventDefault();
                showCard('kabupaten');
            });
            document.getElementById('btn-provinsi').addEventListener('click', function(e) {
                e.preventDefault();
                showCard('provinsi');
            });

            // Menampilkan card kelurahan saat halaman pertama kali diload
            showCard('kelurahan');
        });
    </script>
@endsection
