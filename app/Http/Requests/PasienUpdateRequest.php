<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasienUpdateRequest extends FormRequest
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
            'nomorRm' => ['required', 'integer'],
            'noKartu' => ['required', 'string', 'max:13'],
            'nama' => ['required', 'string'],
            'hubunganKeluarga' => ['required', 'string'],
            'sex' => ['required', 'string', 'max:1'],
            'tglLahir' => ['required', 'date'],
            'jnsPeserta' => ['required', 'integer'],
            'golDarah' => ['required', 'string'],
            'noHp' => ['required', 'string'],
            'noKtp' => ['required', 'string'],
            'pstProl' => ['required', 'string'],
            'pstPrb' => ['required', 'string'],
            'aktif' => ['required'],
            'ketAktif' => ['required', 'string'],
            'created_by' => ['required', 'integer'],
            'updated_by' => ['required', 'integer'],
            'deleted_at' => ['required'],
            'deleted_by' => ['required', 'integer'],
            'kelurahan_id' => ['required', 'integer', 'exists:kelurahans,id'],
        ];
    }
}
