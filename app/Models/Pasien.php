<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pasien extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomorRm',
        'noKartu',
        'nama',
        'hubunganKeluarga',
        'sex',
        'tglLahir',
        'jnsPeserta',
        'golDarah',
        'noHp',
        'noKtp',
        'pstProl',
        'pstPrb',
        'aktif',
        'ketAktif',
        'created_by',
        'updated_by',
        'deleted_by',
        'kelurahan_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tglLahir' => 'date',
        'aktif' => 'boolean',
        'deleted_at' => 'datetime',
        'kelurahan_id' => 'integer',
    ];

    public function kelurahan(): BelongsTo
    {
        return $this->belongsTo(Kelurahan::class);
    }
}
