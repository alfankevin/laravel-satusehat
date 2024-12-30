<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bayar extends Model
{

    use HasFactory;

    protected $fillable = [
        'kunjungan_id',
        'total_tagihan',
        'jumlah_bayar',
        'kembalian',
    ];
}
