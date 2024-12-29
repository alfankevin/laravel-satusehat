<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pemeriksaan - {{ $pendaftaran->pasien->nama }} - {{ \Carbon\Carbon::parse($pendaftaran->tglDaftar)->translatedFormat('d F Y') }}\</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 12px;
            color: #000;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #000 !important;
        }

        .header-text {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        @media print {
            @page {
                size: A4;
                margin: 5mm;
                /* Margin kiri, kanan, atas, bawah 2,5 cm */
            }

            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
            }

            .container {
                width: 100%;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col-2 d-flex justify-content-start">
                <img src="https://erm.klinikbimamedika.com/uploads/settings/logo_64e846e26ce60.png" alt="Logo Klinik"
                    class="img-fluid logo" style="width: 120px">
            </div>
            <div class="col-8 text-center">
                <h4 class="mb-0">KLINIK BIMA MEDIKA</h4>
                <p class="mb-0">Jl. Sumobito - Kesamben, Dusun Rembugwangi</p>
                <p class="mb-1">Email: bima.medika@gmail.com</p>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <img src="https://erm.klinikbimamedika.com/uploads/settings/logo_64e846e26ce60.png" alt="Logo Klinik"
                    class="img-fluid logo" style="width: 120px">
            </div>
        </div>
        <hr>
        <div class="text-center mb-4">
            <h6 class="fw-bold">FORM LAPORAN HASIL PEMERIKSAAN LABORATORIUM</h6>
        </div>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td><b>No. RM</b></td>
                    <td>:
                        {{ substr(str_pad($pendaftaran->pasien->nomorRm ?? '', 6, '0', STR_PAD_LEFT), 0, 2) . '-' . substr(str_pad($pendaftaran->pasien->nomorRm ?? '', 6, '0', STR_PAD_LEFT), 2, 2) . '-' . substr(str_pad($pendaftaran->pasien->nomorRm ?? '', 6, '0', STR_PAD_LEFT), 4, 2) }}
                    </td>
                    <td><b>Umur</b></td>
                    <td>:
                        {{ $pendaftaran->pasien->tglLahir ? \Carbon\Carbon::parse($pendaftaran->pasien->tglLahir)->age . ' Tahun' : '-' }}
                    </td>
                    <td>{{ $pendaftaran->pasien->sex ?? '-' }}</td>
                </tr>
                <tr>
                    <td><b>Nama</b></td>
                    <td colspan="4">: {{ $pendaftaran->pasien->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td><b>Dokter Pengirim</b></td>
                    <td colspan="4">: {{ $pendaftaran->practitioner->namaPractitioner ?? '-' }}</td>
                </tr>
                <tr>
                    <td><b>Asal Poli</b></td>
                    <td colspan="4">: {{ $pendaftaran->poli->namaPoli ?? '-' }}</td>
                </tr>
                <tr>
                    <td><b>Pembiayaan</b></td>
                    <td colspan="4">:
                        {{ $pendaftaran->pasien->jnsPeserta == 1 ? 'BPJS' : ($pendaftaran->pasien->jnsPeserta == 2 ? 'Mandiri' : '-') }}
                    </td>
                </tr>
                <tr>
                    <td><b>Tanggal Pemeriksaan</b></td>
                    <td colspan="4">: {{ \Carbon\Carbon::parse($pendaftaran->tglDaftar)->translatedFormat('d F Y') }}</td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>JENIS PEMERIKSAAN</th>
                    <th>SATUAN</th>
                    <th>NILAI NORMAL</th>
                    <th>HASIL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendaftaran->laborat as $lab)
                    <tr>
                        <td>{{ $lab->kategoriPemeriksaan->pemeriksaan ?? '-' }}</td>
                        <td>mg/dl</td>
                        <td>90-130</td>
                        <td>{{ $lab->hasil_pemeriksaan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-5">
            <div class="text-center mt-3">
                <p class="mb-5">Petugas Laboratorium</p>
                <p class="mt-1">(________________________)</p>
            </div>
            <div class="text-center">
                <p class="mb-5">Mengetahui,<br>KEPALA KLINIK BIMA MEDIKA</p>
                <p><strong>dr. Henry Sitompul</strong><br>NIP 197405042003121005</p>
            </div>
        </div>
    </div>
</body>

</html>
