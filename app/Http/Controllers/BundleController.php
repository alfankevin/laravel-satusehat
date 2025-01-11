<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Helpers\TokenHelper;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Http;

class BundleController extends Controller
{
    private $pendaftarans; // Class property to store the fetched data

    private function loadPendaftaran(Request $request): void
    {
        $this->pendaftarans = Pendaftaran::with(
            'pasien',
            'poli',
            'obat.obat',
            'laborat.kategoriPemeriksaan',
            'laborat.practitioner',
            'diagnosa.diagnosa',
            'tindakan.tindakan',
            'tindakan.practitioner'
        )->findOrFail($request->id);
    }

    public $uuid = [
        'uuidEncounter' => "39b138e0-5500-47a8-878f-81f8b25405d7",
        'uuidCondition1' => "4c1d7fec-30cb-4f4b-b7e9-5e81e600b2e7",
        'uuidObservation1' => "4eae995c-7313-4138-8e47-8093b417b2d8",
        'uuidObservation2' => "f33e00c4-fb4f-4bed-919a-b8d2a92821d0",
        'uuidObservation3' => "008b71a2-c688-4214-9479-f0fbf698cb27",
        'uuidObservation4' => "ffddcf99-4b0d-469c-b8d9-a181ac3817aa",
        'uuidObservation5' => "77413394-fd1a-43bb-bf57-7ed7065ac033",
        'uuidProcedure1' => "c928e1a0-cf7b-4355-a1bb-1e0e4776dbad",
    ];



    public function index()
    {
        return view('bundle');
    }

    public function storeBundleApi(Request $request)
    {


        try {
            // Prepare the payload
            $payload = $this->prepareBundlePayload($request);

            // Get the access token
            $token = TokenHelper::getAccessToken();

            // Define the API URL
            $url = env('SANDBOX_URL') . '/fhir-r4/v1';

            // Send the request to the API
            $response = Http::withToken($token)->post($url, $payload);

            // Check for a failed response
            if ($response->failed()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send data to Satusehat API.',
                    'errors' => $response->json(),
                ], $response->status());
            }

            // Successful response
            return response()->json([
                'success' => true,
                'message' => 'Data successfully sent to Satusehat API.',
                'data' => $response->json(),
            ]);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing the request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function storeBundle(Request $request)
    {
        try {
            // Prepare the payload
            $payload = $this->prepareBundlePayload($request);

            // Get the access token
            $token = TokenHelper::getAccessToken();

            // Define the API URL
            $url = env('SANDBOX_URL') . '/fhir-r4/v1';

            // Send the request to the API
            $response = Http::withToken($token)->post($url, $payload);

            // Check for a failed response
            if ($response->failed()) {
                return redirect()->back()->withErrors([
                    'error' => 'Failed to send data to Satusehat API.',
                    'details' => $response->json(),
                ]);
            }

            // Successful response
            return redirect()->back()->with('success', 'Data berhasil disimpan ke Satusehat API.');
        } catch (\Exception $e) {
            // Handle exceptions
            return redirect()->back()->withErrors([
                'error' => 'An error occurred while processing the request.',
                'details' => $e->getMessage(),
            ]);
        }
    }


    private function prepareBundlePayload(Request $request): array
    {
        // Pastikan $pendaftarans dimuat
        $this->loadPendaftaran($request);

        // Mulai membangun array entry untuk Bundle
        $entries = [];

        // Array untuk menyimpan UUID diagnosa
        $diagnosaUUIDs = [];

        // Loop untuk membuat UUID diagnosa
        foreach ($this->pendaftarans->diagnosa as $diagnosa) {
            $diagnosaUUIDs[$diagnosa->id] = \Str::uuid();
        }

        // Tambahkan Encounter entry
        $entries[] = $this->createEncounterEntry($request, $diagnosaUUIDs);

        // Tambahkan Condition entry untuk setiap diagnosa
        foreach ($this->pendaftarans->diagnosa as $diagnosa) {
            $entries[] = $this->createConditionEntry($request, $diagnosa, $diagnosaUUIDs[$diagnosa->id]);
        }

        // Tambahkan Observations
        $entries[] = $this->createObservation1Entry($request);
        $entries[] = $this->createObservation2Entry($request);
        $entries[] = $this->createObservation3Entry($request);
        $entries[] = $this->createObservation4Entry($request);
        $entries[] = $this->createObservation5Entry($request);

        // Tambahkan Procedure entry
        $entries[] = $this->createProcedureEntry($request);

        return [
            "resourceType" => "Bundle",
            "type" => "transaction",
            "entry" => $entries,
        ];
    }

    private function createEncounterEntry(Request $request, array $diagnosaUUIDs): array
    {
        // Pastikan $pendaftarans dimuat
        $this->loadPendaftaran($request);

        // Array untuk menyimpan diagnosis
        $diagnoses = [];

        // Loop data diagnosa untuk membuat array diagnosis
        foreach ($this->pendaftarans->diagnosa as $index => $diagnosa) {
            // Gunakan UUID dari array $diagnosaUUIDs
            $uuid = $diagnosaUUIDs[$diagnosa->id];

            // Tambahkan diagnosa ke array diagnosis
            $diagnoses[] = [
                "condition" => [
                    "reference" => "urn:uuid:" . $uuid, // UUID diagnosa di encounter sama dengan uuid di condition
                    "display" => $diagnosa->diagnosa->diagnosa, // Deskripsi diagnosa
                ],
                "use" => [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                            "code" => "DD",
                            "display" => "Discharge diagnosis"
                        ]
                    ]
                ],
                "rank" => $index + 1 // Urutan diagnosa dimulai dari 1
            ];
        }

        // Kembalikan hasil Encounter Entry
        return [
            "fullUrl" => "urn:uuid:" . $this->uuid['uuidEncounter'],
            "resource" => [
                "resourceType" => "Encounter",
                "status" => "finished",
                "class" => [
                    "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                    "code" => "AMB",
                    "display" => "ambulatory"
                ],
                "subject" => [
                    "reference" => "Patient/" . $this->pendaftarans->pasien->satusehat_id,
                    "display" => $this->pendaftarans->pasien->nama
                ],
                "participant" => [
                    [
                        "type" => [
                            [
                                "coding" => [
                                    [
                                        "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                        "code" => "ATND",
                                        "display" => "attender"
                                    ]
                                ]
                            ]
                        ],
                        "individual" => [
                            "reference" => "Practitioner/" . $this->pendaftarans->practitioner->satusehat_id,
                            "display" => $this->pendaftarans->practitioner->namaPractitioner,
                        ]
                    ]
                ],
                "period" => [
                    "start" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                    "end" => \Carbon\Carbon::parse($this->pendaftarans->end_InProgress)->format('Y-m-d\TH:i:sP')
                ],
                "location" => [
                    [
                        "location" => [
                            "reference" => "Location/4133230a-c0f5-458f-9b43-8af1e830068b",
                            "display" => $this->pendaftarans->poli->namaPoli
                        ]
                    ]
                ],
                "diagnosis" => $diagnoses, // Tambahkan array diagnosis hasil looping
                "statusHistory" => [
                    [
                        "status" => "arrived",
                        "period" => [
                            "start" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                            "end" => \Carbon\Carbon::parse($this->pendaftarans->start_InProgress)->format('Y-m-d\TH:i:sP')
                        ]
                    ],
                    [
                        "status" => "in-progress",
                        "period" => [
                            "start" => \Carbon\Carbon::parse($this->pendaftarans->start_InProgress)->format('Y-m-d\TH:i:sP'),
                            "end" => \Carbon\Carbon::parse($this->pendaftarans->end_InProgress)->format('Y-m-d\TH:i:sP')
                        ]
                    ],
                    [
                        "status" => "finished",
                        "period" => [
                            "start" => \Carbon\Carbon::parse($this->pendaftarans->end_InProgress)->format('Y-m-d\TH:i:sP'),
                            "end" => \Carbon\Carbon::parse($this->pendaftarans->end_InProgress)->format('Y-m-d\TH:i:sP')
                        ]
                    ]
                ],
                "serviceProvider" => [
                    "reference" => "Organization/" . env('SATUSEHAT_ORGANIZATION_ID'),
                ],
                "identifier" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/encounter/" . env('SATUSEHAT_ORGANIZATION_ID'),
                        "value" => "P20240001AAA"
                    ]
                ],
            ],
            "request" => [
                "method" => "POST",
                "url" => "Encounter"
            ]
        ];
    }


    //Diagnosa ICD-10
    private function createConditionEntry(Request $request, $diagnosa, string $uuid): array
    {
        return [
            // Gunakan UUID unik untuk setiap diagnosa
            "fullUrl" => "urn:uuid:" .  $uuid, // Gunakan UUID yang sama dengan Encounter
            "resource" => [
                "resourceType" => "Condition",
                "clinicalStatus" => [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                            "code" => "active",
                            "display" => "Active"
                        ]
                    ]
                ],
                "category" => [
                    [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                                "code" => "encounter-diagnosis",
                                "display" => "Encounter Diagnosis"
                            ]
                        ]
                    ]
                ],
                "code" => [
                    "coding" => [
                        [
                            "system" => "http://hl7.org/fhir/sid/icd-10",
                            "code" => $diagnosa->diagnosa->kode, // Ambil kode ICD-10 dari diagnosa
                            "display" => $diagnosa->diagnosa->diagnosa // Ambil deskripsi dari diagnosa
                        ]
                    ]
                ],
                "subject" => [
                    "reference" => "Patient/" . $this->pendaftarans->pasien->satusehat_id,
                    "display" => $this->pendaftarans->pasien->nama
                ],
                "encounter" => [
                    "reference" => "urn:uuid:" . $this->uuid['uuidEncounter'],
                    "display" => "Kunjungan " . $this->pendaftarans->pasien->nama . " di hari " . \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('l, d F Y')
                ]
            ],
            "request" => [
                "method" => "POST",
                "url" => "Condition"
            ],
        ];
    }

    //Heart rate
    private function createObservation1Entry(Request $request): array
    {
        // Ensure $pendaftarans is loaded
        $this->loadPendaftaran($request);

        return [
            "fullUrl" => "urn:uuid:" . $this->uuid['uuidObservation1'],
            "resource" => [
                "resourceType" => "Observation",
                "status" => "final",
                "category" => [
                    [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/observation-category",
                                "code" => "vital-signs",
                                "display" => "Vital Signs"
                            ]
                        ]
                    ]
                ],
                "code" => [
                    "coding" => [
                        [
                            "system" => "http://loinc.org",
                            "code" => "8867-4",
                            "display" => "Heart rate"
                        ]
                    ]
                ],
                "subject" => [
                    "reference" => "Patient/" . $this->pendaftarans->pasien->satusehat_id,
                ],
                "performer" => [
                    [
                        "reference" => "Practitioner/" . $this->pendaftarans->practitioner->satusehat_id
                    ]
                ],
                "encounter" => [
                    "reference" => "urn:uuid:" . $this->uuid['uuidEncounter'],
                    "display" => "Pemeriksaan Fisik Nadi " . $this->pendaftarans->pasien->nama . " di hari " . \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('l, d F Y')
                ],
                "effectiveDateTime" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                "issued" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                "valueQuantity" => [
                    "value" => $this->pendaftarans->heartRate,
                    "unit" => "beats/minute",
                    "system" => "http://unitsofmeasure.org",
                    "code" => "/min"
                ]
            ],
            "request" => [
                "method" => "POST",
                "url" => "Observation"
            ]
        ];
    }

    //Respiratory rate
    private function createObservation2Entry(Request $request): array
    {
        // Ensure $pendaftarans is loaded
        $this->loadPendaftaran($request);

        return [
            "fullUrl" => "urn:uuid:" . $this->uuid['uuidObservation2'],
            "resource" => [
                "resourceType" => "Observation",
                "status" => "final",
                "category" => [
                    [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/observation-category",
                                "code" => "vital-signs",
                                "display" => "Vital Signs"
                            ]
                        ]
                    ]
                ],
                "code" => [
                    "coding" => [
                        [
                            "system" => "http://loinc.org",
                            "code" => "9279-1",
                            "display" => "Respiratory rate"
                        ]
                    ]
                ],
                "subject" => [
                    "reference" => "Patient/" . $this->pendaftarans->pasien->satusehat_id
                ],
                "performer" => [
                    [
                        "reference" => "Practitioner/" . $this->pendaftarans->practitioner->satusehat_id
                    ]
                ],
                "encounter" => [
                    "reference" => "urn:uuid:" . $this->uuid['uuidEncounter'],
                    "display" => "Pemeriksaan Fisik Pernafasan " . $this->pendaftarans->pasien->nama . " di hari " . \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('l, d F Y')
                ],
                "effectiveDateTime" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                "issued" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                "valueQuantity" => [
                    "value" => $this->pendaftarans->respRate,
                    "unit" => "breaths/minute",
                    "system" => "http://unitsofmeasure.org",
                    "code" => "/min"
                ]
            ],
            "request" => [
                "method" => "POST",
                "url" => "Observation"
            ]
        ];
    }

    //Systolic blood pressure
    private function createObservation3Entry(Request $request): array
    {
        // Ensure $pendaftarans is loaded
        $this->loadPendaftaran($request);

        return [
            "fullUrl" => "urn:uuid:" . $this->uuid['uuidObservation3'],
            "resource" => [
                "resourceType" => "Observation",
                "status" => "final",
                "category" => [
                    [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/observation-category",
                                "code" => "vital-signs",
                                "display" => "Vital Signs"
                            ]
                        ]
                    ]
                ],
                "code" => [
                    "coding" => [
                        [
                            "system" => "http://loinc.org",
                            "code" => "8480-6",
                            "display" => "Systolic blood pressure"
                        ]
                    ]
                ],
                "subject" => [
                    "reference" => "Patient/" . $this->pendaftarans->pasien->satusehat_id
                ],
                "performer" => [
                    [
                        "reference" => "Practitioner/" . $this->pendaftarans->practitioner->satusehat_id
                    ]
                ],
                "encounter" => [
                    "reference" => "urn:uuid:" . $this->uuid['uuidEncounter'],
                    "display" => "Pemeriksaan Fisik Sistolik " . $this->pendaftarans->pasien->nama . " di hari " . \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('l, d F Y')
                ],
                "effectiveDateTime" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                "issued" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                "bodySite" => [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "368209003",
                            "display" => "Right arm"
                        ]
                    ]
                ],
                "valueQuantity" => [
                    "value" => $this->pendaftarans->sistole,
                    "unit" => "mm[Hg]",
                    "system" => "http://unitsofmeasure.org",
                    "code" => "mm[Hg]"
                ],
                "interpretation" => [
                    [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v3-ObservationInterpretation",
                                "code" => "HU",
                                "display" => "significantly high"
                            ]
                        ],
                        "text" => $request->input('interpretationText', 'Di atas nilai referensi')
                    ]
                ]
            ],
            "request" => [
                "method" => "POST",
                "url" => "Observation"
            ]
        ];
    }

    //Diastolic blood pressure
    private function createObservation4Entry(Request $request): array
    {
        // Ensure $pendaftarans is loaded
        $this->loadPendaftaran($request);

        return  [
            "fullUrl" => "urn:uuid:" . $this->uuid['uuidObservation4'],
            "resource" => [
                "resourceType" => "Observation",
                "status" => "final",
                "category" => [
                    [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/observation-category",
                                "code" => "vital-signs",
                                "display" => "Vital Signs"
                            ]
                        ]
                    ]
                ],
                "code" => [
                    "coding" => [
                        [
                            "system" => "http://loinc.org",
                            "code" => "8462-4",
                            "display" => "Diastolic blood pressure"
                        ]
                    ]
                ],
                "subject" => [
                    "reference" => "Patient/" . $this->pendaftarans->pasien->satusehat_id,
                    "display" => $this->pendaftarans->pasien->nama
                ],
                "performer" => [
                    [
                        "reference" => "Practitioner/" . $this->pendaftarans->practitioner->satusehat_id
                    ]
                ],
                "encounter" => [
                    "reference" => "urn:uuid:" . $this->uuid['uuidEncounter'],
                    "display" => "Pemeriksaan Fisik Diastolik " . $this->pendaftarans->pasien->nama . " di hari " . \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('l, d F Y')
                ],
                "effectiveDateTime" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                "issued" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                "bodySite" => [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "368209003",
                            "display" => "Right arm"
                        ]
                    ]
                ],
                "valueQuantity" => [
                    "value" =>  $this->pendaftarans->diastole,
                    "unit" => "mm[Hg]",
                    "system" => "http://unitsofmeasure.org",
                    "code" => "mm[Hg]"
                ],
                "interpretation" => [
                    [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v3-ObservationInterpretation",
                                "code" => "L",
                                "display" => "low"
                            ]
                        ],
                        "text" => $request->input('interpretationText', 'Di bawah nilai referensi')
                    ]
                ]
            ],
            "request" => [
                "method" => "POST",
                "url" => "Observation"
            ]
        ];
    }


    //Body temperature
    private function createObservation5Entry(Request $request): array
    {
        // Ensure $pendaftarans is loaded
        $this->loadPendaftaran($request);

        return [
            "fullUrl" => "urn:uuid:" . $this->uuid['uuidObservation5'],
            "resource" => [
                "resourceType" => "Observation",
                "status" => "final",
                "category" => [
                    [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/observation-category",
                                "code" => "vital-signs",
                                "display" => "Vital Signs"
                            ]
                        ]
                    ]
                ],
                "code" => [
                    "coding" => [
                        [
                            "system" => "http://loinc.org",
                            "code" => "8310-5",
                            "display" => "Body temperature"
                        ]
                    ]
                ],
                "subject" => [
                    "reference" => "Patient/" . $this->pendaftarans->pasien->satusehat_id,
                    "display" => $this->pendaftarans->pasien->nama
                ],
                "performer" => [
                    [
                        "reference" => "Practitioner/" . $this->pendaftarans->practitioner->satusehat_id
                    ]
                ],
                "encounter" => [
                    "reference" => "urn:uuid:" . $this->uuid['uuidEncounter'],
                    "display" => "Pemeriksaan Fisik Suhu " . $this->pendaftarans->pasien->nama . " di hari " . \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('l, d F Y')
                ],
                "effectiveDateTime" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                "issued" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                "valueQuantity" => [
                    "value" => $this->pendaftarans->suhu,
                    "unit" => "C",
                    "system" => "http://unitsofmeasure.org",
                    "code" => "Cel"
                ],
                "interpretation" => [
                    [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v3-ObservationInterpretation",
                                "code" => $request->input('interpretationCode', 'H'),
                                "display" => $request->input('interpretationDisplay', 'High')
                            ]
                        ],
                        "text" => $request->input('interpretationText', 'Di atas nilai referensi')
                    ]
                ]
            ],
            "request" => [
                "method" => "POST",
                "url" => "Observation"
            ]
        ];
    }

    //Tindakan
    private function createProcedureEntry(Request $request): array
    {
        return [
            "fullUrl" => "urn:uuid:" . $this->uuid['uuidProcedure1'],
            "resource" => [
                "resourceType" => "Procedure",
                "status" => "completed",
                "category" => [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "103693007",
                            "display" => "Diagnostic procedure"
                        ]
                    ],
                    "text" => "Diagnostic procedure"
                ],
                "code" => [
                    "coding" => [
                        [
                            "system" => "http://hl7.org/fhir/sid/icd-9-cm",
                            "code" => "87.44",
                            "display" => "Routine chest x-ray, so described"
                        ]
                    ]
                ],
                "subject" => [
                    "reference" => "Patient/" . $this->pendaftarans->pasien->satusehat_id,
                    "display" => $this->pendaftarans->pasien->nama
                ],
                "encounter" => [
                    "reference" => "urn:uuid:" . $this->uuid['uuidEncounter'],
                    "display" => "Tindakan Rontgen Dada " . $this->pendaftarans->pasien->nama . " di hari " . \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('l, d F Y')
                ],
                "performedPeriod" => [
                    "start" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP'),
                    "end" => \Carbon\Carbon::parse($this->pendaftarans->created_at)->timezone('Asia/Jakarta')->format('Y-m-d\TH:i:sP')
                ],
                "performer" => [
                    [
                        "actor" => [
                            "reference" => "Practitioner/" . $this->pendaftarans->practitioner->satusehat_id,
                            "display" => $this->pendaftarans->practitioner->namaPractitioner
                        ]
                    ]
                ],
                "reasonCode" => [
                    [
                        "coding" => [
                            [
                                "system" => "http://hl7.org/fhir/sid/icd-10",
                                "code" => "A15.0",
                                "display" => "Tuberculosis of lung, confirmed by sputum microscopy with or without culture"
                            ]
                        ]
                    ]
                ],
                "bodySite" => [
                    [
                        "coding" => [
                            [
                                "system" => "http://snomed.info/sct",
                                "code" => "302551006",
                                "display" => "Entire Thorax"
                            ]
                        ]
                    ]
                ],
                "note" => [
                    [
                        "text" => "Rontgen thorax melihat perluasan infiltrat dan kavitas."
                    ]
                ]
            ],
            "request" => [
                "method" => "POST",
                "url" => "Procedure"
            ]
        ];
    }
}
