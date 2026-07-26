<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Door extends Model
{
    /** @use HasFactory<\Database\Factories\DoorFactory> */
    use HasFactory, Translatable;

    protected $fillable = [
        'media_id'
    ];

    protected $translatedAttributes = [
        'collection_name',
        'name',
        'slug',
        'description',
    ];

    public function variants() : HasMany
    {
        return $this->hasMany(DoorVariant::class, 'door_id', 'id');
    }
}
