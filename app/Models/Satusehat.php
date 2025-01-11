<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satusehat extends Model
{
    use HasFactory;

    protected $table = 'satusehats';

    protected $fillable = [
        'status',
        'environment',
        'organization_id',
        'client_id',
        'client_secret',
    ];
}
