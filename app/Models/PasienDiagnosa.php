<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasienDiagnosa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kunjungan_id',
        'diagnosa_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'kunjungan_id' => 'integer',
        'diagnosa_id' => 'integer',
    ];

    public function diagnosa(): BelongsTo
    {
        return $this->belongsTo(Diagnosa::class, 'diagnosa_id');
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'kunjungan_id');
    }
}
