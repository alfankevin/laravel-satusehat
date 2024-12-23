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
        'noAntrian',
        'keluhan',
        'kunjSakit',
        'suhu',
        'sistole',
        'diastole',
        'beratBadan',
        'tinggiBadan',
        'respRate',
        'lingkarPerut',
        'heartRate',
        'rujukBalik',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'pasien_id',
        'poli_id',
        'practitioner_id',
        'tkp_id',
        'subyektif',
        'assesment',
        'instruksi',
        'obyektif',
        'plan',
        'evaluasi',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tglDaftar' => 'date',
        'suhu' => 'float',
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
        'tkp_id' => 'integer',
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

    public function tkp(): BelongsTo
    {
        return $this->belongsTo(Tkp::class);
    }

    public function obat()
    {
        return $this->hasMany(PasienObat::class, 'kunjungan_id', 'id');
    }

    public function laborat()
    {
        return $this->hasMany(PasienPemeriksaan::class, 'kunjungan_id', 'id');
    }

    public function diagnosa()
    {
        return $this->hasMany(PasienDiagnosa::class, 'kunjungan_id', 'id');
    }

    public function tindakan()
    {
        return $this->hasMany(PasienTindakan::class, 'kunjungan_id', 'id');
    }
}
