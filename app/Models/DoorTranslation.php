<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoorTranslation extends Model
{
    /** @use HasFactory<\Database\Factories\DoorTranslationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'collection_name',
        'sertification_title',
        'sertification_description',
        'sertification_badge'
    ];
}
