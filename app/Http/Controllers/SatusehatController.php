<?php

namespace App\Http\Controllers;

use App\Models\AppInfo;
use App\Models\Pasien;
use App\Models\Practitioner;
use App\Models\Satusehat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SatusehatController extends Controller
{
    /**
     * Sync patient data with Satusehat API and save the ID to the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function syncSatusehat(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
        ]);

        $nik = $request->input('nik');
        $url = "http://laravel-satusehat.test/nik?identifier=https://fhir.kemkes.go.id/id/nik|{$nik}";

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                $data = $response->json();

                // Periksa apakah data entry ada
                if (isset($data['entry'][0]['resource']['id'])) {
                    $satusehatId = $data['entry'][0]['resource']['id'];

                    // Cari pasien berdasarkan NIK
                    $pasien = Pasien::where('noKtp', $nik)->first();

                    if ($pasien) {
                        $pasien->satusehat_id = $satusehatId;
                        $pasien->save();

                        return response()->json([
                            'success' => true,
                            'message' => 'ID Satusehat berhasil disimpan.',
                            'data' => $pasien,
                        ]);
                    } else {
                        return response()->json([
                            'success' => false,
                            'message' => 'Pasien dengan NIK tersebut tidak ditemukan.',
                        ], 404);
                    }
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Pasien dengan NIK tersebut tidak ditemukan.',
                        'data' => $data, // Kirim data API untuk debugging
                    ], 400);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghubungi API Satusehat.',
                    'error' => $response->body(),
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat sinkronisasi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // Sinkronisasi semua pasien
    public function syncAllPatients()
    {
        // Ambil pasien yang satusehat_id-nya kosong (null atau string kosong)
        $pasiens = Pasien::whereNull('satusehat_id') // Kondisi untuk null
            ->orWhere('satusehat_id', '') // Kondisi untuk string kosong
            ->get();

        $failed = [];
        $success = 0;

        foreach ($pasiens as $pasien) {
            $url = "http://laravel-satusehat.test/nik?identifier=https://fhir.kemkes.go.id/id/nik|{$pasien->noKtp}";
            try {
                $response = Http::get($url);
                $data = $response->json();

                if ($response->successful() && isset($data['entry'][0]['resource']['id'])) {
                    $satusehatId = $data['entry'][0]['resource']['id'];
                    $pasien->satusehat_id = $satusehatId;
                    $pasien->save();
                    $success++;
                } else {
                    $failed[] = $pasien->noKtp;
                }
            } catch (\Exception $e) {
                $failed[] = $pasien->noKtp;
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Sinkronisasi selesai. {$success} berhasil, " . count($failed) . " gagal.",
            'failed' => $failed
        ]);
    }


    // Sinkronisasi semua practitioner
    public function syncAllPractitioner()
    {
        // Ambil praktisi yang satusehat_id-nya kosong (null atau string kosong)
        $practitioners = Practitioner::whereNull('satusehat_id')
            ->orWhere('satusehat_id', '')
            ->get();

        $failed = [];
        $success = 0;

        foreach ($practitioners as $practitioner) {
            // URL API untuk mendapatkan data Practitioner
            $url = "http://laravel-satusehat.test/practitioner-nik?identifier=https://fhir.kemkes.go.id/id/nik|{$practitioner->nikPractitioner}";
            try {
                $response = Http::get($url);
                $data = $response->json();

                // Periksa apakah respons API berhasil dan berisi data yang diharapkan
                if ($response->successful() && isset($data['entry'][0]['resource']['id'])) {
                    $satusehatId = $data['entry'][0]['resource']['id'];

                    // Simpan satusehat_id ke database
                    $practitioner->satusehat_id = $satusehatId;
                    $practitioner->save();

                    $success++;
                } else {
                    // Jika respons tidak valid, tambahkan ke daftar gagal
                    $failed[] = [
                        'nik' => $practitioner->nikPractitioner,
                        'reason' => 'Invalid response structure',
                        'response' => $data,
                    ];
                }
            } catch (\Exception $e) {
                // Tangkap kesalahan dan tambahkan ke daftar gagal
                $failed[] = [
                    'nik' => $practitioner->nikPractitioner,
                    'reason' => $e->getMessage(),
                ];
            }
        }

        // Kembalikan hasil sinkronisasi
        return response()->json([
            'success' => true,
            'message' => "Sinkronisasi selesai. {$success} berhasil, " . count($failed) . " gagal.",
            'failed' => $failed,
        ]);
    }

    public function index()
    {
        // Get the first record or null if no record exists
        $satusehat = Satusehat::first();
        $appInfo = AppInfo::first();
        return view('dashboard.master-data.modul.index', compact('satusehat', 'appInfo'));
    }

    /**
     * Store or update data in the Satusehat table.
     */
    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:AKTIF,TIDAK AKTIF',
            'environment' => 'required|in:TESTING,PRODUCTION',
            'organization_id' => 'nullable|string',
            'client_id' => 'nullable|string',
            'client_secret' => 'nullable|string',
        ]);

        // Check if a record exists
        $satusehat = Satusehat::first();

        if ($satusehat) {
            // Update the existing record
            $satusehat->update($validated);

            return redirect()->back()->with('success', 'Data updated successfully.');
        } else {
            // Create a new record
            Satusehat::create($validated);

            return redirect()->back()->with('success', 'Data created successfully.');
        }
    }
}
