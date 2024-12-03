<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsis';
    protected $primaryKey = 'KD_PROVINSI';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'KD_PROVINSI',
        'PROVINSI',
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

    public function kabupatens()
    {
        return $this->hasMany(Kabupaten::class, 'KD_PROVINSI', 'KD_PROVINSI');
    }
}
