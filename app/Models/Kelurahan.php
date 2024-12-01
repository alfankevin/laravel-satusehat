<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kelurahan extends Model
{
    use HasFactory;

    protected $primaryKey = 'KD_KELURAHAN';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'KD_KELURAHAN',
        'KD_KECAMATAN',
        'KELURAHAN',
        'ninput_oleh',
        'ninput_tgl',
        'nupdate_oleh',
        'nupdate_tgl',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'KD_KECAMATAN' => 'integer',
    ];

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class, 'KD_KECAMATAN');
    }

}
