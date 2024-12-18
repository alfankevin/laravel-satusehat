<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemeriksaan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kunjungan_id',
        'kategori_pemeriksaan_id',
        'hasil_pemeriksaan',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'kunjungan_id' => 'integer',
        'kategori_pemeriksaan_id' => 'integer',
    ];

    public function kategoriPemeriksaan(): BelongsTo
    {
        return $this->belongsTo(KategoriPemeriksaan::class, 'kategori_pemeriksaan_id');
    }
}
