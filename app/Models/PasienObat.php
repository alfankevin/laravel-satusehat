<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasienObat extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis_obats'; // Nama tabel

    protected $fillable = [
        'pasien_id',
        'obat_id',
        'jumlah_obat',
        'instruksi',
    ];

    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }


    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}
