<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Door extends Model
{
    /** @use HasFactory<\Database\Factories\DoorFactory> */
    use HasFactory, Translatable;

    protected $fillable = [
        'media_id',
        'status'
    ];

    protected $translatedAttributes = [
        'collection_name',
        'name',
        'slug',
        'description',
    ];

    public function variants(): HasMany
    {
        return $this->hasMany(DoorVariant::class, 'door_id', 'id');
    }

    public function image(): HasOne
    {
        return $this->hasOne(Media::class,
            'id', 'media_id');
    }

    public function spesificationImage(): HasOne
    {
        return $this->hasOne(Media::class, 'id', 'spec_image_id');
    }

    public function spesifications(): HasMany
    {
        return $this->hasMany(DoorSpesification::class, 'door_id', 'id');
    }
}
