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
        'alamat',
        'created_by',
        'updated_by',
        'deleted_by',
        'KD_KELURAHAN',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pasien) {
            $pasien->nomorRm = Pasien::max('nomorRm') + 1; // Increment rekamMedis
        });
    }

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
        'KD_KELURAHAN' => 'integer',
    ];

    public function kelurahan(): BelongsTo
    {
        return $this->belongsTo(Kelurahan::class, 'KD_KELURAHAN');
    }
}