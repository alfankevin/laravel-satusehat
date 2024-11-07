<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tglDaftar',
        'keluhan',
        'kunjSakit',
        'sistole',
        'diastole',
        'beratBadan',
        'tinggiBadan',
        'respRate',
        'lingkarPerut',
        'heartRate',
        'rujukBalik',
        'kdTkp',
        'created_by',
        'updated_by',
        'deleted_by',
        'pasien_id',
        'poli_id',
        'practitioner_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tglDaftar' => 'date',
        'sistole' => 'float',
        'diastole' => 'float',
        'beratBadan' => 'float',
        'tinggiBadan' => 'float',
        'respRate' => 'float',
        'lingkarPerut' => 'float',
        'heartRate' => 'float',
        'deleted_at' => 'datetime',
        'pasien_id' => 'integer',
        'poli_id' => 'integer',
        'practitioner_id' => 'integer',
    ];

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class);
    }

    public function practitioner(): BelongsTo
    {
        return $this->belongsTo(Practitioner::class);
    }
}
