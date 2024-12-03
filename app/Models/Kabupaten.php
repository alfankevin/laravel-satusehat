<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'kabupatens';
    protected $primaryKey = 'KD_KABUPATEN';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'KD_KABUPATEN',
        'KD_PROVINSI',
        'KABUPATEN',
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

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'KD_PROVINSI', 'KD_PROVINSI');
    }

    public function kecamatans()
    {
        return $this->hasMany(Kecamatan::class, 'KD_KABUPATEN', 'KD_KABUPATEN');
    }
}
