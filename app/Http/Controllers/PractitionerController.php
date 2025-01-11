<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Practitioner;
use Illuminate\Http\Request;
use App\Models\PractitionerGroup;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PractitionerStoreRequest;
use App\Http\Requests\PractitionerUpdateRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Helpers\TokenHelper;

class PractitionerController extends Controller
{
    /**
     * Mengambil token akses dengan caching.
     */
    public function getAccessToken(): string
    {
        // Cek apakah token sudah ada di cache
        $tokenData = Cache::get('access_token');

        if ($tokenData && now()->lt($tokenData['expires_at'])) {
            return $tokenData['token'];
        }

        // Token tidak ada atau sudah kedaluwarsa, generate token baru
        $response = Http::asForm()->post(env('AUTH_URL') . '/accesstoken?grant_type=client_credentials', [
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to retrieve access token');
        }

        $token = $response->json()['access_token'];
        $expiresIn = $response->json()['expires_in']; // Waktu kedaluwarsa dalam detik

        // Simpan token ke cache
        Cache::put('access_token', [
            'token' => $token,
            'expires_at' => now()->addSeconds($expiresIn - 60), // Beri buffer 1 menit untuk menghindari kedaluwarsa mendadak
        ]);

        return $token;
    }

    public function index(Request $request): View
    {
        $practitioners = Practitioner::all();

        return view('dashboard.master-data.practitioner.index', compact('practitioners'));
    }

    public function store(PractitionerStoreRequest $request): RedirectResponse
    {
        $practitioner = Practitioner::create($request->validated());
        return redirect()->route('practitioner.index')->with('success', 'Data practitioner berhasil ditambahkan.');
    }

    public function update(PractitionerUpdateRequest $request, Practitioner $practitioner): RedirectResponse
    {
        // Menggunakan data yang divalidasi dari request untuk mengupdate objek practitioner
        $practitioner->update($request->validated());

        return redirect()->route('practitioner.index')->with('success', 'Data practitioner berhasil diperbarui.');
    }

    public function destroy(Request $request, Practitioner $practitioner): RedirectResponse
    {
        $practitioner->delete();

        return redirect()->route('practitioner.index')->with('success', 'Data practitioner berhasil dihapus.');
    }


    // Mengambil data id satusehat practitioner berdasarkan NIK
    /**
     * Mengambil data id satusehat practitioner berdasarkan NIK.
     */
    public function getPractitionerByNIK(Request $request): array
    {
        $validated = $request->validate([
            'identifier' => 'required|string',
        ]);

        $token = TokenHelper::getAccessToken(); // Panggil helper untuk token

        $response = Http::withToken($token)->get(env('SANDBOX_URL') . '/fhir-r4/v1/Practitioner', $validated);

        if ($response->failed()) {
            return [
                'error' => true,
                'message' => 'Failed to retrieve Practitioner data by NIK',
                'details' => $response->json(),
            ];
        }

        return $response->json();
    }
}
