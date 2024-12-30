<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi - {{ $pendaftaran->pasien->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 12px;
            color: #000;
        }

        .header-text {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
        }

        @media print {
            @page {
                size: A4;
                margin: 0mm;
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
            <div class="col-2 d-flex justify-content-center">
                <img src="https://erm.klinikbimamedika.com/uploads/settings/logo_64e846e26ce60.png" alt="Logo Klinik"
                    class="img-fluid logo" style="width: 130px">
            </div>
            <div class="col-8 text-start">
                <h4 class="mb-0">KLINIK BIMA MEDIKA</h4>
                <p class="mb-0">Jl. Sumobito - Kesamben, Dusun Rembugwangi</p>
                <p class="mb-1">Email: bima.medika@gmail.com</p>
            </div>
        </div>
        <hr>

        <div class="row mb-3">
            <div class="col-3"><b>Nama / No. RM</b></div>
            <div class="col-9">: {{ $pendaftaran->pasien->nama }} /
                {{ substr(str_pad($pendaftaran->pasien->nomorRm ?? '', 6, '0', STR_PAD_LEFT), 0, 2) . '-' . substr(str_pad($pendaftaran->pasien->nomorRm ?? '', 6, '0', STR_PAD_LEFT), 2, 2) . '-' . substr(str_pad($pendaftaran->pasien->nomorRm ?? '', 6, '0', STR_PAD_LEFT), 4, 2) }}
            </div>
            <div class="col-3"><b>Tgl Kunjungan</b></div>
            <div class="col-9">: {{ \Carbon\Carbon::parse($pendaftaran->tglDaftar)->translatedFormat('d F Y') }}</div>
            <div class="col-3"><b>Alamat</b></div>
            <div class="col-9">: {{ $pendaftaran->pasien->alamat }}</div>
        </div>


        @if ($pendaftaran->obat->count() > 0)
        <div class="mb-2">
            @php $totalFeeObat = 0; @endphp
            <div class="row">
                <div class="col-1 text-center"><b>No</b></div>
                <div class="col-6"><b>Obat</b></div>
                <div class="col-1 text-center"><b>Qty</b></div>
                <div class="col-2"><b>Harga</b></div>
                <div class="col-2 text-end"><b>Subtotal</b></div>
            </div>
            @foreach ($pendaftaran->obat as $key => $data)
                @php
                    $subtotal = $data->harga_obat * $data->jumlah_obat;
                    $totalFeeObat += $subtotal;
                @endphp
                <div class="row">
                    <div class="col-1 text-center">{{ $key + 1 }}</div>
                    <div class="col-6">{{ $data->obat->nama_obat }}</div>
                    <div class="col-1 text-center">{{ $data->jumlah_obat }}</div>
                    <div class="col-2">Rp {{ number_format($data->harga_obat, 0, ',', '.') }}</div>
                    <div class="col-2 text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-9 text-right"><b>Total Fee Obat:</b></div>
                <div class="col-3 text-end">Rp {{ number_format($totalFeeObat, 0, ',', '.') }}</div>
            </div>
        </div>
    @endif
    
    @if ($pendaftaran->laborat->count() > 0)
        <div class="mb-2">
            @php $totalFeeLaborat = 0; @endphp
            <div class="row ">
                <div class="col-1 text-center"><b>No</b></div>
                <div class="col-9"><b>Laborat</b></div>
                <div class="col-2 text-end"><b>Harga</b></div>
            </div>
            @foreach ($pendaftaran->laborat as $key => $data)
                @php $totalFeeLaborat += $data->biaya; @endphp
                <div class="row ">
                    <div class="col-1 text-center">{{ $key + 1 }}</div>
                    <div class="col-9">{{ $data->kategoriPemeriksaan->pemeriksaan }}</div>
                    <div class="col-2 text-end">Rp {{ number_format($data->biaya, 0, ',', '.') }}</div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-8 text-right"><b>Total Fee Laborat:</b></div>
                <div class="col-4 text-end">Rp {{ number_format($totalFeeLaborat, 0, ',', '.') }}</div>
            </div>
        </div>
    @endif
    
    @if ($pendaftaran->tindakan->count() > 0)
        <div class="mb-2">
            @php $totalFeeTindakan = 0; @endphp
            <div class="row ">
                <div class="col-1 text-center"><b>No</b></div>
                <div class="col-9"><b>Tindakan</b></div>
                <div class="col-2 text-end"><b>Harga</b></div>
            </div>
            @foreach ($pendaftaran->tindakan as $key => $data)
                @php $totalFeeTindakan += $data->biaya; @endphp
                <div class="row ">
                    <div class="col-1 text-center">{{ $key + 1 }}</div>
                    <div class="col-9">{{ $data->tindakan->tindakan }}</div>
                    <div class="col-2 text-end">Rp {{ number_format($data->biaya, 0, ',', '.') }}</div>
                </div>
            @endforeach
            <div class="row ">
                <div class="col-8 text-right"><b>Total Fee Tindakan:</b></div>
                <div class="col-4 text-end">Rp {{ number_format($totalFeeTindakan, 0, ',', '.') }}</div>
            </div>
        </div>
    @endif
    
    <div class="mt-2 ">
        <div class="row ">
            <div class="col-9 text-right"><b>Total Tagihan:</b></div>
            <div class="col-3 text-end">Rp {{ number_format($pendaftaran->bayar->total_tagihan?? 0, 0, ',', '.') }}</div>
        </div>
        <div class="row">
            <div class="col-9 text-right"><b>Bayar:</b></div>
            <div class="col-3 text-end">Rp {{ number_format($pendaftaran->bayar->jumlah_bayar?? 0, 0, ',', '.') }}</div>
        </div>
        <div class="row">
            <div class="col-9 text-right"><b>Kembali:</b></div>
            <div class="col-3 text-end">Rp {{ number_format($pendaftaran->bayar->kembalian?? 0, 0, ',', '.') }}</div>
        </div>
    </div>
    

        <div class="d-flex justify-content-between mt-5">
            <div class="text-center mt-3">
                <p class="mb-5">Petugas Kasir</p>
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
