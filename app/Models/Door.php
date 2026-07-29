<?php

namespace App\Models;

use App\Observers\DoorObserver;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy(DoorObserver::class)]
class Door extends Model
{
    /** @use HasFactory<\Database\Factories\DoorFactory> */
    use HasFactory, Translatable;

    protected $fillable = [
        'media_id',
        'status',
        'spec_image_id'
    ];

    protected $translatedAttributes = [
        'collection_name',
        'name',
        'slug',
        'description',
        'sertification_title',
        'sertification_description',
        'sertification_badge'
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

    public function sertificates() : HasMany
    {
        return $this->hasMany(DoorSertificate::class, 'door_id', 'id');
    }
}
