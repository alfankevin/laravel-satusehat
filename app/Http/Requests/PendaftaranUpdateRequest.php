<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranUpdateRequest extends FormRequest
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
            'tglDaftar' => ['required', 'date'],
            'keluhan' => ['required', 'string'],
            'kunjSakit' => ['required', 'string'],
            'sistole' => ['required', 'numeric'],
            'diastole' => ['required', 'numeric'],
            'beratBadan' => ['required', 'numeric'],
            'tinggiBadan' => ['required', 'numeric'],
            'respRate' => ['required', 'numeric'],
            'lingkarPerut' => ['required', 'numeric'],
            'heartRate' => ['required', 'numeric'],
            'rujukBalik' => ['required', 'integer'],
            'kdTkp' => ['required', 'integer'],
            'created_at' => ['required'],
            'created_by' => ['required', 'integer'],
            'updated_at' => ['required'],
            'updated_by' => ['required', 'integer'],
            'deleted_at' => ['required'],
            'deleted_by' => ['required', 'integer'],
            'pasien_id' => ['required', 'integer', 'exists:pasiens,id'],
            'poli_id' => ['required', 'integer', 'exists:polis,id'],
            'practitioner_id' => ['required', 'integer', 'exists:practitioners,id'],
        ];
    }
}
