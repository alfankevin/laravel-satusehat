<div class="modal fade" id="modal-riwayat-medis-2">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="modal-title">Rincian Riwayat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Suhu (C)</th>
                                <th>Tensi (mmHg)</th>
                                <th>Nadi (/menit)</th>
                                <th>RR (/menit)</th>
                                <th>Tinggi (cm)</th>
                                <th>Berat (Kg)</th>
                                <th>Instruksi & Evaluasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="7">1</td>
                                <td width="15%" rowspan="7">
                                    <b>Rawat Jalan</b> <br>
                                    <small>2024-11-06 10:35:14</small>
                                </td>
                                <td>{{ $pemeriksaan->suhu }}</td>
                                <td>{{ $pemeriksaan->diastole }}</td>
                                <td>{{ $pemeriksaan->heartRate }}</td>
                                <td>{{ $pemeriksaan->respRate }}</td>
                                <td>{{ $pemeriksaan->tinggiBadan }}</td>
                                <td>{{ $pemeriksaan->beratBadan }}</td>
                                <td rowspan="7">
                                    <b>Instruksi:</b> <br>
                                    <b>Evaluasi:</b> <br>
                                    <div class="text-center">
                                        <img  src="https://th.bing.com/th?id=OIP.mK2kr2iSUYk_Fvz9c5LDhQHaHa&w=250&h=250&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="QR Code" style="max-width: 120px;">
                                    </div>
                                    Heni Rachmawati, Amd. Kep
        
                                    <div class="form-group mt-5">
                                        <button class="btn btn-success me-2 form-control btn-sm mb-2">Edit</button>
                                        <button class="btn btn-danger form-control btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Keluhan</b></td>
                                <td colspan="8">{{ $pemeriksaan->keluhan }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Lingkar Perut</b></td>
                                <td colspan="8">{{ $pemeriksaan->lingkarPerut }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Subyektif</b></td>
                                <td colspan="8">PANAS, BAPIL</td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Obyektif</b></td>
                                <td colspan="8"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Assessment</b></td>
                                <td colspan="8"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Plan</b></td>
                                <td colspan="8">pamol, cefadroxi, gg</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>