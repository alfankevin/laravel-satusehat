<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasienStoreRequest;
use App\Http\Requests\PasienUpdateRequest;
use App\Models\Pasien;
use App\Models\Kelurahan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use App\Helpers\TokenHelper;

class PasienController extends Controller
{


    public function index(Request $request): View
    {
        $pasiens = Pasien::with('kelurahan.kecamatan')->orderByDesc('id')->get();

        return view('dashboard.main-menu.pasien.index', compact('pasiens'));
    }


    public function create(Request $request): View
    {
        $kelurahans = Kelurahan::with('kecamatan')->get();
        // $kelurahans = Kelurahan::orderBy('KELURAHAN')->get();
        $latestPasien = Pasien::orderBy('nomorRm', 'desc')->first();
        $nomorRm = $latestPasien->nomorRm + 1;


        return view('dashboard.main-menu.pasien.create', compact('nomorRm', 'kelurahans'));
    }

    public function store(PasienStoreRequest $request): RedirectResponse
    {
        try {
            // Simpan data pasien ke database
            $pasien = Pasien::create($request->validated());

            // Simpan data pasien ke session untuk referensi
            session()->flash('newPasien', [
                'id' => $pasien->id,
                'nama' => $pasien->nama,
                'nomorRm' => $pasien->nomorRm,
            ]);

            // Kirim data ke API Satusehat
            $payload = $this->prepareSatusehatPayload($request);

            $token = TokenHelper::getAccessToken(); // Panggil helper untuk token
            $url = env('SANDBOX_URL') . '/fhir-r4/v1/Patient';

            $response = Http::withToken($token)->post($url, $payload);

            if ($response->failed()) {
                return redirect()->route('kunjungan.index')
                    ->with('error', 'Pasien berhasil disimpan ke database, tetapi gagal dikirim ke Satusehat.');
            }

            return redirect()->route('kunjungan.index')
                ->with('success', 'Pasien berhasil ditambahkan dan dikirim ke Satusehat.');
        } catch (\Exception $e) {
            
            return redirect()->route('kunjungan.index')
                ->with('error', 'Terjadi kesalahan saat menyimpan data pasien.');
        }
    }

    /**
     * Menyiapkan payload untuk API Satusehat.
     */
    private function prepareSatusehatPayload(Request $request): array
    {
        return [
            "resourceType" => "Patient",
            "meta" => [
                "profile" => ["https://fhir.kemkes.go.id/r4/StructureDefinition/Patient"]
            ],
            "identifier" => [
                [
                    "use" => "official",
                    "system" => "https://fhir.kemkes.go.id/id/nik",
                    "value" => $request->input('noKtp'),
                ]
            ],
            "active" => true,
            "name" => [
                [
                    "use" => "official",
                    "text" => $request->input('nama'),
                ]
            ],
            "telecom" => array_filter([
                [
                    "system" => "phone",
                    "value" => $request->input('noHp'),
                    "use" => "mobile",
                ],
                $request->input('homePhone') ? [
                    "system" => "phone",
                    "value" => $request->input('noHp'),
                    "use" => "home",
                ] : null,
                $request->input('email') ? [
                    "system" => "email",
                    "value" => $request->input('email') ?? "jhon@gmail.com",
                    "use" => "home",
                ] : null,
            ]),
            "gender" => $request->input('sex') === 'L' ? 'male' : 'female',
            "birthDate" => $request->input('tglLahir'),
            "deceasedBoolean" => false,
            "address" => [
                [
                    "use" => "home",
                    "line" => [$request->input('alamat')],
                    "city" => $request->input('city') ?? "Jakarta", // Default jika tidak diisi
                    "postalCode" => $request->input('postalCode') ?? "12950", // Default jika tidak diisi
                    "country" => "ID",
                    "extension" => [
                        [
                            "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                            "extension" => [
                                [
                                    "url" => "province",
                                    "valueCode" => $request->input('province') ?? "33",
                                ],
                                [
                                    "url" => "city",
                                    "valueCode" => $request->input('cityCode') ?? "3313",
                                ],
                                [
                                    "url" => "district",
                                    "valueCode" => $request->input('districtCode') ?? "331316",
                                ],
                                [
                                    "url" => "village",
                                    "valueCode" => $request->input('villageCode') ?? "3313162009",
                                ],
                                [
                                    "url" => "rt",
                                    "valueCode" => $request->input('rt') ?? "7",
                                ],
                                [
                                    "url" => "rw",
                                    "valueCode" => $request->input('rw') ?? "11",
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            "maritalStatus" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/v3-MaritalStatus",
                        "code" => $request->input('maritalStatusCode') ?? "M",
                        "display" => $request->input('maritalStatusText') ?? "Married",
                    ]
                ],
                "text" => $request->input('maritalStatusText') ?? "Married",
            ],
            "multipleBirthInteger" => $request->input('multipleBirthInteger') ?? 0,
            "contact" => [
                [
                    "relationship" => [
                        [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/v2-0131",
                                    "code" => "C"
                                ]
                            ]
                        ]
                    ],
                    "name" => [
                        "use" => "official",
                        "text" => $request->input('contactName') ?? "Jane Smith",
                    ],
                    "telecom" => [
                        [
                            "system" => "phone",
                            "value" => $request->input('contactPhone') ?? "0690383372",
                            "use" => "mobile"
                        ]
                    ]
                ]
            ],
            "communication" => [
                [
                    "language" => [
                        "coding" => [
                            [
                                "system" => "urn:ietf:bcp:47",
                                "code" => "id-ID",
                                "display" => "Indonesian",
                            ]
                        ],
                        "text" => "Indonesian"
                    ],
                    "preferred" => true
                ]
            ],
            "extension" => [
                [
                    "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/birthPlace",
                    "valueAddress" => [
                        "city" => $request->input('birthCity') ?? "Bandung",
                        "country" => "ID"
                    ]
                ],
                [
                    "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/citizenshipStatus",
                    "valueCode" => $request->input('citizenshipStatus') ?? "WNI",
                ]
            ]
        ];
    }


    public function update(PasienUpdateRequest $request, Pasien $pasien): RedirectResponse
    {
        $pasien->save();

        return redirect()->route('pasien.index');
    }

    public function destroy(Request $request, Pasien $pasien): RedirectResponse
    {
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Delete Pasien Successfully!');
    }



    public function getPatientByNIK(Request $request): array
    {
        // Validasi input
        $validated = $request->validate([
            'identifier' => 'required|string',
        ]);

        // Ambil token akses
        $token = TokenHelper::getAccessToken(); // Panggil helper untuk token

        // Lakukan permintaan ke API
        $response = Http::withToken($token)->get(env('SANDBOX_URL') . '/fhir-r4/v1/Patient', [
            'identifier' => $validated['identifier'],
        ]);

        if ($response->failed()) {
            return [
                'error' => true,
                'message' => 'Failed to retrieve patient data by NIK',
                'details' => $response->json(),
            ];
        }

        return $response->json();
    }
}
