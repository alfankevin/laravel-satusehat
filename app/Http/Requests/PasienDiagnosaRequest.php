<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasienDiagnosaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'pasien_id' => ['required', 'integer', 'exists:pasiens,id'],
            'diagnosa_id' => ['required', 'integer', 'exists:diagnosas,id'],
            'practitioner_id' => ['required', 'integer', 'exists:practitioner,id'],
        ];
    }
}
