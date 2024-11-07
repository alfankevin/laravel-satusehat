<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Practitioner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'namaPractitioner',
        'nikPractitioner',
        'practitioner_group_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'practitioner_group_id' => 'integer',
    ];

    public function practitionerGroup(): BelongsTo
    {
        return $this->belongsTo(PractitionerGroup::class);
    }
}
