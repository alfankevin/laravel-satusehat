<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatans';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'KD_KECAMATAN',
        'KD_KABUPATEN',
        'KECAMATAN',
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
    ];

    public function kelurahans()
    {
        return $this->hasMany(Kelurahan::class, 'KD_KECAMATAN', 'KD_KECAMATAN');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'KD_KABUPATEN', 'KD_KABUPATEN');
    }
}
