<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasienObat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kunjungan_id',
        'obat_id',
        'jumlah_obat',
        'harga_obat',
        'instruksi',
    ];

    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }


    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class, 'kunjungan_id');
    }
}
